<?php

declare(strict_types=1);

namespace App\View\Components\layout\menu\sidebarAlerts;

use App\DTOs\layout\menu\sidebarAlerts\AlertDTO;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class Alert extends Component
{
    /**
     * @param  AlertDTO  $dto
     */
    public function __construct(
        private readonly AlertDTO $dto) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layout.menu.sidebar-alerts.alert', [
            'dto' => $this->dto,
        ]);
    }
}
