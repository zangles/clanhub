<?php

declare(strict_types=1);

namespace App\Domains\Guild\Services;

use App\Domains\Guild\Events\GuildCreated;
use App\Domains\Guild\Events\GuildDeleted;
use App\Domains\Guild\Events\GuildUpdated;
use App\Domains\Guild\Models\Guild;
use App\Domains\Guild\Repositories\GuildRepositoryInterface;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

final class GuildService
{
    public function __construct(
        private GuildRepositoryInterface $guildRepository
    ) {}

    public function createGuild(array $data): Guild
    {
        // Validar que el usuario no tenga ya un gremio como owner
        $existingGuild = $this->guildRepository->getUserGuilds(Auth::id())
            ->where('owner_id', Auth::id())
            ->first();

        if ($existingGuild) {
            throw new Exception('Ya tienes un gremio creado. Solo puedes ser propietario de un gremio.');
        }

        // Procesar archivos si existen
        if (isset($data['logo']) && $data['logo'] instanceof UploadedFile) {
            $data['logo'] = $this->uploadImage($data['logo'], 'logos');
        }

        if (isset($data['banner']) && $data['banner'] instanceof UploadedFile) {
            $data['banner'] = $this->uploadImage($data['banner'], 'banners');
        }

        // Generar slug único
        $data['slug'] = $this->generateUniqueSlug($data['name']);
        $data['owner_id'] = Auth::id();

        // Configuraciones por defecto
        $data['settings'] = array_merge([
            'auto_accept_members' => false,
            'require_application' => true,
            'min_level_required' => 1,
            'allow_member_invites' => false,
        ], $data['settings'] ?? []);

        $guild = $this->guildRepository->create($data);

        // Disparar evento
        event(new GuildCreated($guild));

        return $guild;
    }

    public function updateGuild(Guild $guild, array $data): Guild
    {
        // Verificar permisos
        if (! $guild->isOwner(Auth::id())) {
            throw new Exception('No tienes permisos para editar este gremio.');
        }

        // Procesar archivos si existen
        if (isset($data['logo']) && $data['logo'] instanceof UploadedFile) {
            // Eliminar logo anterior
            if ($guild->logo) {
                Storage::disk('public')->delete($guild->logo);
            }
            $data['logo'] = $this->uploadImage($data['logo'], 'logos');
        }

        if (isset($data['banner']) && $data['banner'] instanceof UploadedFile) {
            // Eliminar banner anterior
            if ($guild->banner) {
                Storage::disk('public')->delete($guild->banner);
            }
            $data['banner'] = $this->uploadImage($data['banner'], 'banners');
        }

        // Si cambió el nombre, generar nuevo slug
        if (isset($data['name']) && $data['name'] !== $guild->name) {
            $data['slug'] = $this->generateUniqueSlug($data['name'], $guild->id);
        }

        $updatedGuild = $this->guildRepository->update($guild, $data);

        // Disparar evento
        event(new GuildUpdated($updatedGuild));

        return $updatedGuild;
    }

    public function deleteGuild(Guild $guild): bool
    {
        // Verificar permisos
        if (! $guild->isOwner(Auth::id())) {
            throw new Exception('No tienes permisos para eliminar este gremio.');
        }

        // Verificar que no tenga miembros (opcional)
        if ($guild->getMemberCount() > 0) {
            throw new Exception('No puedes eliminar un gremio que tiene miembros.');
        }

        // Eliminar archivos
        if ($guild->logo) {
            Storage::disk('public')->delete($guild->logo);
        }
        if ($guild->banner) {
            Storage::disk('public')->delete($guild->banner);
        }

        $result = $this->guildRepository->delete($guild);

        if ($result) {
            // Disparar evento
            event(new GuildDeleted($guild));
        }

        return $result;
    }

    public function transferOwnership(Guild $guild, int $newOwnerId): Guild
    {
        // Verificar permisos
        if (! $guild->isOwner(Auth::id())) {
            throw new Exception('No tienes permisos para transferir este gremio.');
        }

        // Verificar que el nuevo owner sea miembro del gremio
        $isMember = $guild->members()->where('user_id', $newOwnerId)->exists();
        if (! $isMember) {
            throw new Exception('El nuevo propietario debe ser miembro del gremio.');
        }

        return $this->guildRepository->update($guild, ['owner_id' => $newOwnerId]);
    }

    // Métodos de consulta
    public function findGuildBySlug(string $slug): ?Guild
    {
        return $this->guildRepository->findBySlug($slug);
    }

    public function getPublicGuilds(int $perPage = 15)
    {
        return $this->guildRepository->getPublicGuilds($perPage);
    }

    public function searchGuilds(string $query, int $perPage = 15)
    {
        return $this->guildRepository->searchGuilds($query, $perPage);
    }

    public function getUserGuilds(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->guildRepository->getUserGuilds(Auth::id());
    }

    private function uploadImage(UploadedFile $file, string $folder): string
    {
        $filename = Str::uuid().'.'.$file->getClientOriginalExtension();

        return $file->storeAs("guilds/{$folder}", $filename, 'public');
    }

    private function generateUniqueSlug(string $name, ?int $excludeId = null): string
    {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug;
        $counter = 1;

        while ($this->guildRepository->slugExists($slug, $excludeId)) {
            $slug = $baseSlug.'-'.$counter;
            $counter++;
        }

        return $slug;
    }
}
