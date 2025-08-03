<?php

declare(strict_types=1);

namespace App\Domains\Guild\Models;

use App\Domains\Member\Models\Member;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property string $logo
 * @property bool $is_public
 * @property int $owner_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
final class Guild extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'logo',
        'is_public',
        'is_recruiting',
        'owner_id',
    ];

    protected $casts = [
        'is_public' => 'boolean',
        'is_recruiting' => 'boolean',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    // Relaciones
    public function owner(): BelongsTo
    {
        return $this->belongsTo(config('auth.providers.users.model'), 'owner_id');
    }

    public function members(): HasMany
    {
        return $this->hasMany(Member::class);
    }

    // Scopes
    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    public function scopeRecruiting($query)
    {
        return $query->where('is_recruiting', true);
    }

    // Accessors & Mutators
    public function getLogoUrlAttribute()
    {
        return $this->logo ? asset('storage/'.$this->logo) : asset('images/default-guild-logo.png');
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    // Métodos de negocio
    public function isFull(): bool
    {
        return $this->members()->count() >= $this->max_members;
    }

    public function canAcceptMembers(): bool
    {
        return $this->is_recruiting && ! $this->isFull();
    }

    public function getMemberCount(): int
    {
        return $this->members()->count();
    }

    public function isOwner($userId): bool
    {
        return $this->owner_id === $userId;
    }

    public function activeSubscription(): HasOne
    {
        return $this->hasOne(GuildSubscription::class)
            ->where('status', 'active')
            ->where(function ($query) {
                $query->whereNull('ends_at')
                    ->orWhere('ends_at', '>', now());
            });
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(GuildSubscription::class);
    }

    public function configurations(): HasMany
    {
        return $this->hasMany(GuildConfiguration::class);
    }

    // Métodos de negocio relacionados con suscripción
    public function getMaxMembers(): int
    {
        return $this->activeSubscription?->subscriptionPlan?->max_members ?? 25; // Free default
    }

    public function canAddMoreMembers(): bool
    {
        return $this->members()->count() < $this->getMaxMembers();
    }

    public function hasFeature(string $feature): bool
    {
        $plan = $this->activeSubscription?->subscriptionPlan;

        return $plan ? $plan->$feature : false;
    }

    // hacer actions para get y set configuration
    public function getConfiguration(string $key, $default = null)
    {
        $config = $this->configurations()
            ->whereHas('configurationType', fn ($q) => $q->where('key', $key))
            ->first();

        if (! $config) {
            // Buscar valor por defecto del tipo
            $type = GuildConfigurationType::where('key', $key)->first();

            return $type?->default_value ?? $default;
        }

        // Convertir según el tipo de dato
        $type = $config->configurationType;

        return match ($type->data_type) {
            'boolean' => filter_var($config->value, FILTER_VALIDATE_BOOLEAN),
            'integer' => (int) $config->value,
            'json' => json_decode($config->value, true),
            default => $config->value
        };
    }

    public function setConfiguration(string $key, $value): void
    {
        $type = GuildConfigurationType::where('key', $key)->firstOrFail();

        // Verificar si requiere premium
        if ($type->requires_premium && ! $this->hasFeature('advanced_permissions')) {
            throw new Exception('Esta configuración requiere un plan premium.');
        }

        // Convertir valor según tipo
        $processedValue = match ($type->data_type) {
            'boolean' => $value ? 'true' : 'false',
            'json' => json_encode($value),
            default => (string) $value
        };

        $this->configurations()->updateOrCreate(
            ['configuration_type_id' => $type->id],
            ['value' => $processedValue]
        );
    }

    // Helpers para configuraciones comunes
    public function shouldAutoAcceptMembers(): bool
    {
        return $this->getConfiguration('auto_accept_members', false);
    }

    public function getMinLevelRequired(): int
    {
        return $this->getConfiguration('min_level_required', 1);
    }

    public function allowsMemberInvites(): bool
    {
        return $this->getConfiguration('allow_member_invites', false);
    }

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($guild) {
            if (empty($guild->slug)) {
                $guild->slug = Str::slug($guild->name);
            }
        });
    }
}
