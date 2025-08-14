<?php

declare(strict_types=1);

namespace App\Domains\Guild\Repositories;

use App\Domains\Guild\Models\Guild;

interface GuildRepositoryInterface
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Guild;

    public function findById(int $id): ?Guild;

    public function findBySlug(string $slug): ?Guild;

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(Guild $guild, array $data): ?Guild;

    public function delete(Guild $guild): ?bool;

    public function slugExists(string $slug, ?int $excludeId = null): bool;
}
