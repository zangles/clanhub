<?php

declare(strict_types=1);

namespace App\Domains\Member\Models;

use App\Domains\Guild\Enums\GuildMemberRole;
use App\Domains\Guild\Models\Guild;
use App\Models\User;
use Carbon\Carbon;
use Database\Factories\MemberFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property int $id
 * @property int $user_id
 * @property int $guild_id
 * @property GuildMemberRole $role
 * @property Carbon $joined_at
 * @property-read User $user
 * @property-read Guild $guild
 *
 * @use HasFactory<MemberFactory>
 */
final class Member extends Pivot
{
    /** @use HasFactory<MemberFactory> */
    use HasFactory;

    public $timestamps = true;

    protected $table = 'members';

    protected $fillable = [
        'user_id',
        'guild_id',
        'role',
        'joined_at',
    ];

    protected $casts = [
        'role' => GuildMemberRole::class,
        'joined_at' => 'datetime',
    ];

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<Guild, $this>
     */
    public function guild(): BelongsTo
    {
        return $this->belongsTo(Guild::class);
    }
}
