<?php

namespace App\View\Components\Dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    private array $menus = [];

    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $appName = '',
        public string $appLogo = '',
    ) {
        $this->menus = [
            [
                'name' => 'Dashboard',
                'route' => 'dashboard',
                'icon' => 'line-chart',
                'is_header' => false,
            ],
            [
                'name' => 'User Data',
                'is_header' => true,
            ],
            [
                'name' => 'Candidates',
                'route' => 'dashboard.candidates.index',
                'icon' => 'user-check',
                'is_header' => false,
            ],
            [
                'name' => 'Voters',
                'route' => 'dashboard.voters.index',
                'icon' => 'user',
                'is_header' => false,
            ],
            [
                'name' => 'Management',
                'is_header' => true,
            ],
            [
                'name' => 'Batches',
                'route' => 'dashboard.batches.index',
                'icon' => 'layer',
                'is_header' => false,
            ],
            [
                'name' => 'Sessions',
                'route' => 'dashboard.sessions.index',
                'icon' => 'folder-open',
                'is_header' => false,
            ],
            [
                'name' => 'Timelines',
                'route' => 'dashboard.timelines.index',
                'icon' => 'calendar-event',
                'is_header' => false,
            ],
            [
                'name' => 'Admin',
                'route' => 'dashboard.admins.index',
                'icon' => 'shield',
                'is_header' => false,
            ],
            [
                'name' => 'Settings',
                'is_header' => true,
            ],
            [
                'name' => 'Application',
                'route' => 'dashboard.settings.index',
                'icon' => 'cog',
                'is_header' => false,
            ],
            [
                'name' => 'Voting',
                'route' => 'dashboard.voting.index',
                'icon' => 'check-circle',
                'is_header' => false,
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.sidebar', [
            'menus' => $this->menus,
            'currentUrl' => url()->current(),
            'activeClasses' => 'bg-primary-500 text-white',
            'inactiveClasses' => 'text-gray-600 hover:bg-gray-50 hover:text-gray-700text-neutral-700 hover:bg-neutral-100 hover:text-neutral-900',
        ]);
    }
}
