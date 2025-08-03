<?php

declare(strict_types=1);

namespace App\View\Components\layout;

use App\DTOs\layout\menu\MenuItemDTO;
use App\DTOs\layout\menu\sidebarAlerts\AlertDTO;
use App\DTOs\layout\menu\SubMenuItemDTO;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class Sidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct() {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        /** @var MenuItemDTO[] $menu<int, MenuItemDTO> */
        $menu = [
            MenuItemDTO::make(
                title: 'Dashboard',
                url: route('guild.create'),
                iconClass: 'fi flaticon-home',
            ),
            MenuItemDTO::make(
                title: 'Ultima alianza',
                url: '#',
                iconClass: 'fi flaticon-flag-3',
                submenu: [
                    SubMenuItemDTO::make('Miembros', route('guild.create')),
                    SubMenuItemDTO::make('Eventos', '#'),
                    SubMenuItemDTO::make('Reglas', '#'),
                ]
            ),
        ];

        /** @var AlertDTO[] $sideBarAlerts<int, AlertDTO> */
        $sideBarAlerts = [
            AlertDTO::make(
                title: 'Test1',
                footerText: 'lorem imps um',
                percentage: 50.9,
                progressBarClass: 'bg-danger'
            ),
            AlertDTO::make(
                title: 'Capacidad del gremio',
                footerText: 'Tienes 30/100 miembros',
                percentage: 30,
                progressBarClass: 'bg-primary'
            ),
        ];

        return view('components.layout.sidebar', [
            'menu' => $menu,
            'alerts' => $sideBarAlerts,
        ]);
    }
}
