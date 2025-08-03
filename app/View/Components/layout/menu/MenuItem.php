<?php

declare(strict_types=1);

namespace App\View\Components\layout\menu;

use App\DTOs\layout\menu\MenuItemDTO;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class MenuItem extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public readonly MenuItemDTO $dto,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layout.menu.menu-item', [
            'dto' => $this->dto,
        ]);
    }
}
