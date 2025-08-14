<?php

declare(strict_types=1);

namespace App\Domains\Guild\Repositories;

use App\Domains\Guild\Models\Guild;

final class GuildRepository implements GuildRepositoryInterface
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Guild
    {
        return Guild::create($data);
    }

    public function findById(int $id): ?Guild
    {
        return Guild::with(['members'])->find($id);
    }

    public function findBySlug(string $slug): ?Guild
    {
        return Guild::with(['members'])
            ->where('slug', $slug)
            ->first();
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(Guild $guild, array $data): ?Guild
    {
        $guild->update($data);

        return $guild->fresh(['members']);
    }

    public function delete(Guild $guild): ?bool
    {
        return $guild->delete();
    }

    public function slugExists(string $slug, ?int $excludeId = null): bool
    {
        $query = Guild::where('slug', $slug);

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->exists();
    }
}
