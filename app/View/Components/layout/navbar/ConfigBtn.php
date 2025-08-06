<?php

declare(strict_types=1);

namespace App\View\Components\layout\navbar;

use App\DTOs\dashboard\layout\navbar\ConfigItemDTO;
use App\Enums\ConfigItemType;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

final class ConfigBtn extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct() {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        /** @var ConfigItemDTO[] $dropdownItems<int, ConfigItemDTO> */
        $dropdownItems = [
            ConfigItemDTO::make(
                type: ConfigItemType::Element,
                title: 'Perfil',
                iconClass: 'glyphicon glyphicon-user',
                url: '#',
            ),
            ConfigItemDTO::make(
                type: ConfigItemType::Division,
            ),
            ConfigItemDTO::make(
                type: ConfigItemType::Element,
                title: 'Logout',
                iconClass: 'la la-sign-out',
                url: route('logout'),
            ),
        ];

        return view('components.layout.navbar.config-btn', [
            'dropdownItems' => $dropdownItems,
        ]);
    }
}
