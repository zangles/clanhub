<?php

declare(strict_types=1);

namespace App\Domains\Guild\Actions;

use App\Domains\Guild\DTOs\CreateGuildDTO;
use App\Domains\Guild\Enums\GuildMemberRole;
use App\Domains\Guild\Models\Guild;
use App\Domains\Member\Actions\CreateMemberAction;
use App\Domains\Member\DTOs\CreateMemberDTO;

final class CreateGuildAction
{
    public function __construct(
        private readonly CreateMemberAction $createMemberAction
    ) {}

    public function handle(CreateGuildDTO $data): Guild
    {
        $guild = Guild::create([
            'name' => $data->name,
            'slug' => $data->slug,
            'description' => $data->description,
            'is_public' => $data->isPublic,
        ]);

        $this->createMemberAction->handle(
            new CreateMemberDTO(
                userId: $data->ownerId,
                guildId: $guild->id,
                role: GuildMemberRole::OWNER
            )
        );

        return $guild;
    }
}
