<?php

declare(strict_types=1);

namespace App\DTOs\dashboard\Elements;

/**
 * @property-read array{title: string, class: string}|null $title
 * @property-read array<int, array{title: string, url: string, class: string}>|null $buttons
 */
final class CardDTO
{
    /**
     * @param  array{title: string, class: string}|null  $title
     * @param  array<int, array{title: string, url: string, class: string}>|null  $buttons
     */
    public function __construct(
        public readonly ?array $title,
        public readonly ?array $buttons
    ) {}

    /**
     * @param  array{title: string, class: string}|null  $title
     * @param  array<int, array{title: string, url: string, class: string}>|null  $buttons
     */
    public static function make(
        ?array $title = null,
        ?array $buttons = null
    ): self {
        return new self(
            title: $title,
            buttons: $buttons
        );
    }

    /**
     * @return array{
     *     title: array{title: string, class: string}|null,
     *     buttons: array<int, array{title: string, url: string, class: string}>|null
     * }
     */
    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'buttons' => $this->buttons,
        ];
    }
}
