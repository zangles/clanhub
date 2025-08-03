<?php

declare(strict_types=1);

namespace App\DTOs\layout\menu;

/**
 * Data Transfer Object para items del submenú
 *
 * @property-read string $title Título del item del submenú
 * @property-read string $url URL de destino del item
 * @property-read bool|null $active Estado activo del item
 */
final readonly class SubMenuItemDTO
{
    /**
     * @param  string  $title  Título del item del submenú
     * @param  string  $url  URL de destino
     * @param  bool|null  $active  Si el item está activo/seleccionado
     */
    public function __construct(
        public string $title,
        public string $url,
        public ?bool $active = null
    ) {}

    public static function make(string $title, string $url, ?bool $active = null): self
    {
        return new self($title, $url,
            active: $active ?? self::isCurrentUrl($url)
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'url' => $this->url,
            'active' => $this->active,
        ];
    }

    private static function isCurrentUrl($url): bool
    {
        if ($url === '#' || empty($url)) {
            return false;
        }

        $currentUrl = request()->url();

        // Normalizar la URL del menú
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            $menuUrl = $url;
        } else {
            $menuUrl = url($url);
        }

        return $currentUrl === $menuUrl;
    }
}
