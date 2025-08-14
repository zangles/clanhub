<?php

declare(strict_types=1);

namespace App\Domains\Guild\DTOs;

use App\Enums\ConfigItemType;

/**
 * @property-read ConfigItemType $type
 * @property-read string $title
 * @property-read string $iconClass
 * @property-read string $url
 */
final class CreateGuildDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $slug,
        public readonly bool $isPublic,
        public readonly int $ownerId,
        public readonly ?string $description = null,
    ) {}

    public static function make(
        string $name,
        string $slug,
        bool $isPublic,
        int $ownerId,
        ?string $description = null,
    ): self {
        return new self(
            name: $name,
            slug: $slug,
            isPublic: $isPublic,
            ownerId: $ownerId,
            description: $description,
        );
    }

    /**
     * @return array{
     *     name: string,
     *     slug: string,
     *     isPublic: bool,
     *     ownerId: int,
     *     description: string|null
     * }
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'slug' => $this->slug,
            'isPublic' => $this->isPublic,
            'ownerId' => $this->ownerId,
            'description' => $this->description,
        ];
    }
}
