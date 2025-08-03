<?php

declare(strict_types=1);

namespace App\DTOs\layout\menu;

use App\DTOs\layout\menu\SubMenuItemDTO;
use InvalidArgumentException;

/**
 * Data Transfer Object para items del menú principal
 *
 * @property-read string $title Título del item del menú
 * @property-read string $url URL de destino del item
 * @property-read string $iconClass Clase CSS del icono (ej: 'bi bi-house-door')
 * @property-read bool|null $active Estado activo del item
 * @property-read bool $hasSubmenu Indica si el item tiene submenú
 * @property-read SubMenuItemDTO[] $submenu Array de items del submenú
 */
final readonly class MenuItemDTO
{
    /**
     * @param  string  $title  Título del item del menú
     * @param  string  $url  URL de destino
     * @param  string  $iconClass  Clase CSS del icono
     * @param  bool|null  $active  Si el item está activo/seleccionado
     * @param  bool  $hasSubmenu  Sí tiene items hijos
     * @param  SubMenuItemDTO[]  $submenu  Array de items del submenú
     *
     * @throws InvalidArgumentException Si hasSubmenu es true pero submenu está vacío
     */
    public function __construct(
        public string $title,
        public string $url,
        public string $iconClass,
        public ?bool $active = null,
        public bool $hasSubmenu = false,
        /** @var SubMenuItemDTO[] */
        public array $submenu = []
    ) {
        // Validaciones opcionales
        if ($this->hasSubmenu && empty($this->submenu)) {
            throw new InvalidArgumentException('Menu item marked as having submenu but submenu is empty');
        }
    }

    public static function make(
        string $title,
        string $url,
        string $iconClass,
        ?bool $active = null,
        array $submenu = []
    ): self {
        return new self(
            title: $title,
            url: $url,
            iconClass: $iconClass,
            active: $active ?? self::isCurrentUrl($url),
            hasSubmenu: ! empty($submenu),
            submenu: $submenu
        );
    }

    public function isActive(): bool
    {
        if ($this->active) {
            return true;
        }

        // Un item padre está activo si algún hijo está activo
        return collect($this->submenu)->some(fn (SubMenuItemDTO $item) => $item->active);
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'url' => $this->url,
            'iconClass' => $this->iconClass,
            'active' => $this->active,
            'hasSubmenu' => $this->hasSubmenu,
            'submenu' => array_map(fn (SubMenuItemDTO $item) => $item->toArray(), $this->submenu),
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
