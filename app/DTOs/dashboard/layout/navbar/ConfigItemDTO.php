<?php

declare(strict_types=1);

namespace App\DTOs\dashboard\layout\navbar;

use App\Enums\ConfigItemType;

/**
 * @property-read ConfigItemType $type
 * @property-read string $title
 * @property-read string $iconClass
 * @property-read string $url
 */
final class ConfigItemDTO
{
    public function __construct(
        public readonly ConfigItemType $type,
        public readonly ?string $title = null,
        public readonly ?string $iconClass = null,
        public readonly ?string $url = null,
    ) {}

    public static function make(
        ConfigItemType $type,
        ?string $title = null,
        ?string $iconClass = null,
        ?string $url = null,
    ): self {
        return new self(
            type: $type,
            title: $title,
            iconClass: $iconClass,
            url: $url,
        );
    }

    /**
     * @return array{
     *     type: ConfigItemType,
     *     title: string|null,
     *     iconClass: string|null,
     *     url: string|null
     * }
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'title' => $this->title,
            'iconClass' => $this->iconClass,
            'url' => $this->url,
        ];
    }
}
