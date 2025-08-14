<?php

declare(strict_types=1);

namespace App\Domains\Guild\Enums;

enum GuildMemberRole: string
{
    case OWNER = 'owner';
    case ADMIN = 'admin';
    case MODERATOR = 'moderator';
    case MEMBER = 'member';

    public function getLabel(): string
    {
        return match ($this) {
            self::OWNER => 'Líder del Guild',
            self::ADMIN => 'Administrador',
            self::MODERATOR => 'Moderador',
            self::MEMBER => 'Miembro',
        };
    }
}
