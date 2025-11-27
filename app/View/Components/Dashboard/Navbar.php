<?php

namespace App\View\Components\Dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navbar extends Component
{
    private $userName = null;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $title = '',
    )
    {
        $this->userName = auth('web')->user()->name ?? "Admin";
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.navbar', [
            'userName' => $this->userName,
            'initialName' => strtoupper(substr($this->userName, 0, 1)),
        ]);
    }
}
