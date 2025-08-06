<?php

declare(strict_types=1);

namespace App\View\Components\layout\menu\sidebarAlerts;

use App\DTOs\dashboard\layout\menu\sidebarAlerts\AlertDTO;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class Alert extends Component
{
    public function __construct(
        private readonly AlertDTO $dto) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.layout.menu.sidebar-alerts.alert', [
            'dto' => $this->dto,
        ]);
    }
}
