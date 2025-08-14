<?php

declare(strict_types=1);

namespace App\Domains\Member\DTOs;

use App\Domains\Guild\Enums\GuildMemberRole;

final class CreateMemberDTO
{
    public function __construct(
        public readonly int $userId,
        public readonly int $guildId,
        public readonly GuildMemberRole $role,
    ) {}

    public static function make(
        int $userId,
        int $guildId,
        GuildMemberRole $role
    ): self {
        return new self(
            userId: $userId,
            guildId: $guildId,
            role: $role
        );
    }

    /**
     * @return array{
     *      userId: int,
     *      guildId: int,
     *      role: GuildMemberRole
     * }
     */
    public function toArray(): array
    {
        return [
            'userId' => $this->userId,
            'guildId' => $this->guildId,
            'role' => $this->role,
        ];
    }
}
