<?php

declare(strict_types=1);

namespace App\View\Components\layout\menu\sidebarAlerts;

use App\DTOs\layout\menu\sidebarAlerts\AlertDTO;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class Container extends Component
{
    /**
     * Create a new component instance.
     *
     * @param  array  $alerts<int,  AlertDTO>
     */
    public function __construct(
        private readonly string $title = '&nbsp;',
        private readonly array $alerts = []
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.layout.menu.sidebar-alerts.container', [
            'title' => $this->title,
            'alerts' => $this->alerts,
        ]);
    }
}
