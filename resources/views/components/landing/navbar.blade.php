<header
    class="w-full bg-white/80 backdrop-blur-sm py-4 px-6 md:px-12 flex justify-between items-center fixed top-0 z-50 shadow-navbar">
    <div class="flex items-center gap-4">
        <a href="https://purwokerto.telkomuniversity.ac.id" target="_blank"
            class="h-7 w-7 hover:scale-110 transition-transform duration-300">
            <img src="{{ asset('images/telkom.webp') }}" alt="TUP Logo" loading="lazy" class="h-full w-full object-contain">
        </a>
        <a href="{{ route('landing') }}" class="h-10 w-10 hover:scale-110 transition-transform duration-300">
            <img src="{{ $logo }}" alt="PEMIRA Logo" loading="lazy" class="h-full w-full object-contain">
        </a>
    </div>

    <nav class="hidden md:flex items-center gap-8 font-semibold text-gray-600">
        <button id="nav-button" data-redirect="{{ route('landing') }}"
            class="hover:text-primary-600 transition-colors cursor-pointer {{ request()->routeIs('landing') ? 'active' : '' }}">Beranda</button>

        @if ($isLoggedIn)
            <button id="nav-button" data-redirect="{{ route('voting') }}"
                class="hover:text-primary-600 transition-colors cursor-pointer {{ request()->routeIs('voting') ? 'active' : '' }}">Voting</button>
        @endif

        <button id="nav-button" data-redirect="{{ route('faq') }}"
            class="hover:text-primary-600 transition-colors cursor-pointer {{ request()->routeIs('faq') ? 'active' : '' }}">FAQ</button>

        @if ($isLoggedIn)
            @if ($authUser->is_admin)
                <button id="nav-button" data-redirect="{{ route('dashboard') }}"
                    class="hover:text-primary-600 transition-colors cursor-pointer">Dashboard</button>
            @endif

            <button id="logout-button"
                class="bg-primary-600 text-white px-6 py-2.5 rounded-full hover:bg-primary-800 transition-all shadow-md cursor-pointer">Signout</button>
        @else
            <button id="signin-button"
                class="bg-primary-600 text-white px-6 py-2.5 rounded-full hover:bg-primary-800 transition-all shadow-md cursor-pointer">Signin
                dengan SSO</button>
        @endif
    </nav>

    <button id="mobile-menu-btn" class="md:hidden text-gray-600 focus:outline-none">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
        </svg>
    </button>

    <div id="mobile-menu"
        class="hidden absolute top-full left-0 w-full bg-white shadow-lg md:hidden flex-col items-center py-4 gap-4 font-semibold text-gray-600 border-t border-gray-100 transition-all duration-200 ease-in-out opacity-0 -translate-y-2">

        <button id="nav-button" data-redirect="{{ route('landing') }}"
            class="hover:text-primary-600 transition-colors cursor-pointer {{ request()->routeIs('landing') ? 'active' : '' }}">Beranda</button>

        @if ($isLoggedIn)
            <button id="nav-button" data-redirect="{{ route('voting') }}"
                class="hover:text-primary-600 transition-colors cursor-pointer {{ request()->routeIs('voting') ? 'active' : '' }}">Voting</button>
        @endif

        <button id="nav-button" data-redirect="{{ route('faq') }}"
            class="hover:text-primary-600 transition-colors cursor-pointer {{ request()->routeIs('faq') ? 'active' : '' }}">FAQ</button>

        @if ($isLoggedIn)
            @if ($authUser->is_admin)
                <button id="nav-button" data-redirect="{{ route('dashboard') }}"
                    class="hover:text-primary-600 transition-colors cursor-pointer">Dashboard</button>
            @endif

            <button id="logout-button-mobile"
                class="bg-primary-600 text-white px-6 py-2.5 rounded-full hover:bg-primary-800 transition-all shadow-md cursor-pointer">Signout</button>
        @else
            <button id="signin-button"
                class="bg-primary-600 text-white px-6 py-2.5 rounded-full hover:bg-primary-800 transition-all shadow-md cursor-pointer">Signin
                dengan SSO</button>
        @endif
    </div>
</header>
