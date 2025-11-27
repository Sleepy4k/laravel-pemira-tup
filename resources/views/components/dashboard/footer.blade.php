<footer class="bg-white border-t border-neutral-200 px-4 lg:px-8 py-4 mt-auto">
    <div class="flex flex-col sm:flex-row items-center justify-between text-sm text-neutral-600">
        <div class="mb-2 sm:mb-0">
            &copy; {{ date('Y') }} <span class="font-semibold text-neutral-700">{{ $appName }}</span>. All
            rights reserved.
        </div>

        <div class="flex items-center gap-3">
            <span class="text-xs text-neutral-500 hidden sm:inline">Powered by</span>
            @foreach ($poweredBy as $item)
                <a href="{{ $item['url'] }}" target="_blank" rel="noopener noreferrer"
                    class="transition-transform hover:scale-110 duration-200" title="{{ $item['name'] }}">
                    <img src="{{ $item['logo'] }}" alt="{{ $item['name'] }}" width="24" height="24"
                        class="inline-block" loading="lazy" />
                </a>
            @endforeach
        </div>
    </div>
</footer>
