<?php

declare(strict_types=1);

namespace App\Domains\Guild\Services;

use App\Domains\Guild\Actions\CreateGuildAction;
use App\Domains\Guild\DTOs\CreateGuildDTO;
use App\Domains\Guild\Events\GuildCreated;
use App\Domains\Guild\Models\Guild;
use Exception;
use Illuminate\Support\Facades\Auth;

final class GuildService
{
    public function __construct(
        private readonly CreateGuildAction $createGuildAction,

    ) {}

    /**
     * @param  array{name: string, slug: string, description?: string|null, is_public: bool}  $data
     */
    public function createGuild(array $data): Guild
    {
        /** @var int $ownerId */
        $ownerId = Auth::id();
        $guild = $this->createGuildAction->handle(CreateGuildDTO::make(
            name: $data['name'],
            slug: $data['slug'],
            isPublic: $data['is_public'],
            ownerId: $ownerId,
            description: $data['description'] ?? null,
        ));

        event(new GuildCreated($guild));

        return $guild;

        // Validar que el usuario no tenga ya un gremio como owner
        // futura opcion de pago, limite de guilds
        //        $existingGuild = $this->guildRepository->getUserGuilds(Auth::id())
        //            ->where('owner_id', Auth::id())
        //            ->first();
        //
        //        if ($existingGuild) {
        //            throw new Exception('Ya tienes un gremio creado. Solo puedes ser propietario de un gremio.');
        //        }

        // Procesar archivos si existen

        // Generar slug único
        //        $data['slug'] = $this->generateUniqueSlug($data['slug']);
        //
        //        $guild = $this->guildRepository->create($data);
        //
        //        // Disparar evento
        //        event(new GuildCreated($guild));
        //
        //        return $guild;
    }
}
