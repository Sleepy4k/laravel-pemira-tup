<?php

namespace App\View\Components\Dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Footer extends Component
{
    private array $poweredBy = [];

    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $appName = '',
    ) {
        $this->poweredBy = [
            [
                'name' => 'SI Telkom University Purwokerto',
                'url' => 'https://bis-pwt.telkomuniversity.ac.id',
                'logo' => asset('images/si.png'),
            ],
            [
                'name' => 'Telkom University Purwokerto',
                'url' => 'https://purwokerto.telkomuniversity.ac.id',
                'logo' => asset('images/telkom.webp'),
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.footer', [
            'poweredBy' => $this->poweredBy,
        ]);
    }
}
