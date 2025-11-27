<nav class="bg-white shadow-sm border-b border-neutral-200 sticky top-0 z-20">
    <div class="px-4 lg:px-8 py-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <button id="mobile-menu-button" class="lg:hidden top-4 left-4 p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16">
                        </path>
                    </svg>
                </button>

                <h1 class="text-lg font-semibold text-neutral-800">{{ $title }}</h1>
            </div>

            <div class="relative">
                <button id="profile-dropdown-button"
                    class="flex items-center space-x-2 rounded-lg p-2 hover:bg-neutral-50 transition-all duration-200 cursor-pointer">
                    <div
                        class="w-8 h-8 rounded-full bg-primary-500 flex items-center justify-center text-white font-semibold text-sm">
                        {{ $initialName }}
                    </div>
                    <div class="text-left hidden sm:block">
                        <p class="text-sm font-medium text-neutral-700">
                            {{ $userName }}</p>
                    </div>
                    <svg class="w-4 h-4 text-neutral-500 transition-transform duration-200" id="dropdown-arrow"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <div id="profile-dropdown"
                    class="hidden absolute right-0 w-48 bg-white rounded-lg shadow-lg border border-neutral-200 overflow-hidden">
                    <a href="{{ route('profile.account') }}"
                        class="flex items-center px-3 py-2 text-neutral-700 text-sm hover:bg-primary-700 hover:text-white transition-all duration-200 {{ request()->routeIs('profile.account') ? 'bg-primary-500 text-white' : '' }}">
                        <box-icon name='user' size='s' class="flex-shrink-0"></box-icon>
                        <span class="ml-3 mb-1">Profile</span>
                    </a>
                    <hr class="my-1 border-neutral-200">
                    <button id="dropdown-logout-button"
                        class="w-full flex items-center px-3 py-2 text-sm text-error hover:bg-red-600 hover:text-white transition-all duration-200 cursor-pointer">
                        <box-icon name='exit' size='s' class="flex-shrink-0"></box-icon>
                        <span class="ml-3 mb-1">Logout</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</nav>
