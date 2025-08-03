<?php

declare(strict_types=1);

namespace App\Domains\Guild\Repositories;

use App\Domains\Guild\Models\Guild;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

final class GuildRepository implements GuildRepositoryInterface
{
    public function create(array $data): Guild
    {
        return Guild::create($data);
    }

    public function findById(int $id): ?Guild
    {
        return Guild::with(['owner', 'members'])->find($id);
    }

    public function findBySlug(string $slug): ?Guild
    {
        return Guild::with(['owner', 'members'])
            ->where('slug', $slug)
            ->first();
    }

    public function update(Guild $guild, array $data): Guild
    {
        $guild->update($data);

        return $guild->fresh(['owner', 'members']);
    }

    public function delete(Guild $guild): bool
    {
        return $guild->delete();
    }

    public function getPublicGuilds(int $perPage = 15): LengthAwarePaginator
    {
        return Guild::with(['owner'])
            ->public()
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function getRecruitingGuilds(int $perPage = 15): LengthAwarePaginator
    {
        return Guild::with(['owner'])
            ->public()
            ->recruiting()
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function getUserGuilds(int $userId): Collection
    {
        return Guild::with(['members'])
            ->where('owner_id', $userId)
            ->orWhereHas('members', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->get();
    }

    public function searchGuilds(string $query, int $perPage = 15): LengthAwarePaginator
    {
        return Guild::with(['owner'])
            ->public()
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%")
                    ->orWhere('game', 'like', "%{$query}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
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
