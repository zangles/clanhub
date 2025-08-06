<?php

declare(strict_types=1);

namespace App\View\Components\layout\menu\sidebarAlerts;

use App\DTOs\dashboard\layout\menu\sidebarAlerts\AlertDTO;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class Container extends Component
{
    /**
     * Create a new component instance.
     *
     * @param  array<int,  AlertDTO>  $alerts
     */
    public function __construct(
        private readonly string $title = '&nbsp;',
        private readonly array $alerts = []
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.layout.menu.sidebar-alerts.container', [
            'title' => $this->title,
            'alerts' => $this->alerts,
        ]);
    }
}
