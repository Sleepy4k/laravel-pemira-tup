<?php

namespace App\View\Components\Profile;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navbar extends Component
{
    private array $menus = [];

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->menus = [
            [
                'name' => 'Account',
                'route' => 'profile.account',
            ],
            [
                'name' => 'Settings',
                'route' => 'profile.setting.index',
            ],
            [
                'name' => 'Security',
                'route' => 'profile.security.index',
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.profile.navbar', [
            'menus' => $this->menus,
        ]);
    }
}
