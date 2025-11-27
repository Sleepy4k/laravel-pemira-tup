<nav class="mb-6">
    <div class="inline-flex items-center gap-2 p-1 rounded-xl">
        @foreach ($menus as $menu)
            <a href="{{ route($menu['route']) }}"
                class="px-4 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs($menu['route']) ? 'bg-primary-600 hover:bg-primary-700 text-white shadow' : 'bg-white text-gray-600 hover:text-gray-900 hover:bg-primary-700' }}">
                {{ $menu['name'] }}
            </a>
        @endforeach
    </div>
</nav>
