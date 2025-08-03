<?php

declare(strict_types=1);

namespace App\Domains\Guild\Repositories;

use App\Domains\Guild\Models\Guild;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface GuildRepositoryInterface
{
    public function create(array $data): Guild;

    public function findById(int $id): ?Guild;

    public function findBySlug(string $slug): ?Guild;

    public function update(Guild $guild, array $data): Guild;

    public function delete(Guild $guild): bool;

    public function getPublicGuilds(int $perPage = 15): LengthAwarePaginator;

    public function getRecruitingGuilds(int $perPage = 15): LengthAwarePaginator;

    public function getUserGuilds(int $userId): Collection;

    public function searchGuilds(string $query, int $perPage = 15): LengthAwarePaginator;

    public function slugExists(string $slug, ?int $excludeId = null): bool;
}
