<?php

declare(strict_types=1);

namespace App\View\Components\layout\menu;

use App\DTOs\layout\menu\SubMenuItemDTO;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class SubMenuItem extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        private readonly SubMenuItemDTO $dto
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layout.menu.sub-menu-item', [
            'dto' => $this->dto,
        ]);
    }
}
