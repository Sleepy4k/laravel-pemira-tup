<?php

namespace App\View\Components\Landing;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navbar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $logo = '',
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $authUser = auth('web')->user();
        $isLoggedIn = $authUser !== null;
        return view('components.landing.navbar', compact('isLoggedIn', 'authUser'));
    }
}
