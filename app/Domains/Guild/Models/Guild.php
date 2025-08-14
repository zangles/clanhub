<?php

declare(strict_types=1);

namespace App\Domains\Guild\Models;

use App\Domains\Member\Models\Member;
use Carbon\Carbon;
use Database\Factories\GuildFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
 *
 * @use HasFactory<GuildFactory>
 */
final class Guild extends Model
{
    /** @use HasFactory<GuildFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_public',
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];

    /**
     * @var array|string[]
     */
    protected array $dates = [
        'created_at',
        'updated_at',
    ];

    // Relaciones

    /**
     * @return HasMany<Member, $this>
     */
    public function members(): HasMany
    {
        return $this->hasMany(Member::class);
    }
}
