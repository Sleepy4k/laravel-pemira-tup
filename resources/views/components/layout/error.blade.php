<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="title" content="{{ $appSettings['app_name'] }} - {{ $title }}">
        <meta name="description" content="{{ $appSettings['app_description'] }}">
        <meta name="author" content="{{ $appSettings['seo_author'] }}">
        <meta name="coverage" content="Worldwide">
        <meta name="distribution" content="Global">
        <meta name="robots" content="noindex, nofollow">
        <meta name="keywords" content="{{ $appSettings['seo_keywords'] }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="canonical" href="{{ config('app.url') }}">

        <link rel="icon" href="{{ $appSettings['app_favicon'] }}" />
        <link rel="shortcut icon" href="{{ $appSettings['app_favicon'] }}" />
        <link rel="apple-touch-icon" href="{{ $appSettings['app_favicon'] }}" />
        <link rel="apple-touch-icon-precomposed" href="{{ $appSettings['app_favicon'] }}" />

        <title>{{ $appSettings['app_name'] }} - {{ $title }}</title>

        @cspMetaTag

        <meta property="csp-nonce" content="{{ app('csp-nonce') }}">

        <meta property="og:locale" content="{{ app()->getLocale() }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="{{ $appSettings['app_name'] }}">
        <meta property="og:title" content="{{ $appSettings['app_name'] }} - {{ $title }}">
        <meta property="og:description" content="{{ $appSettings['app_description'] }}">
        <meta property="og:image" content="{{ $appSettings['app_logo'] }}">
        <meta property="og:image:width" content="{{ $appSettings['seo_image_width'] }}" />
        <meta property="og:image:height" content="{{ $appSettings['seo_image_height'] }}" />
        <meta property="og:image:type" content="image/png">
        <meta property="og:image:alt" content="{{ $appSettings['app_name'] }} - {{ $title }}">

        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:domain" content="{{ url()->current() }}">
        <meta property="twitter:url" content="{{ url()->current() }}">
        <meta property="twitter:locale" content="{{ app()->getLocale() }}">
        <meta property="twitter:title" content="{{ $appSettings['app_name'] }} - {{ $title }}">
        <meta property="twitter:description" content="{{ $appSettings['app_description'] }}">
        <meta property="twitter:image" content="{{ $appSettings['app_logo'] }}">
        <meta property="twitter:image:width" content="{{ $appSettings['seo_image_width'] }}" />
        <meta property="twitter:image:height" content="{{ $appSettings['seo_image_height'] }}" />
        <meta property="twitter:image:type" content="image/png">
        <meta property="twitter:image:alt" content="{{ $appSettings['app_name'] }} - {{ $title }}">

        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/addon/layout-error.js'])
    </head>
    <body>
        <main class="min-h-screen flex items-center justify-center bg-gradient-to-br from-cyan-100 via-cyan-200 to-teal-400 p-6">
            <section class="w-full max-w-4xl bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl ring-1 ring-white/30 overflow-hidden">
                <div class="md:flex">
                    <div class="md:w-1/2 p-8 flex flex-col items-start justify-center gap-4">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 flex items-center justify-center rounded-full bg-cyan-50 text-cyan-700 ring-1 ring-cyan-100">
                                <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M3 12a9 9 0 1018 0 9 9 0 00-18 0z"></path>
                                    <path d="M12 8v4"></path>
                                    <path d="M12 16h.01"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-teal-700">Status</p>
                                <h1 class="text-5xl md:text-6xl font-extrabold tracking-tight text-teal-800">{{ $status }}</h1>
                            </div>
                        </div>

                        <div class="pt-2">
                            <h2 class="text-2xl font-semibold text-teal-900">{{ $title }}</h2>
                            <p class="mt-2 text-sm text-teal-800/90">{{ $message }}</p>
                        </div>

                        <div class="mt-3 flex flex-wrap gap-3">
                            <button id="back-btn" data-href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-teal-600 text-white rounded-md shadow-sm hover:bg-teal-700 transition cursor-pointer" style="display: none;">
                                ← Back
                            </button>

                            <button id="home-btn" data-href="{{ route('landing') }}" class="inline-flex items-center px-4 py-2 border border-teal-600 text-teal-700 rounded-md bg-white hover:bg-teal-50 transition cursor-pointer">
                                Home
                            </button>

                            <button id="retry-btn" class="inline-flex items-center px-4 py-2 bg-cyan-50 text-cyan-800 border border-cyan-300 rounded-md hover:bg-cyan-100 transition cursor-pointer">
                                Retry
                            </button>
                        </div>

                        <p class="mt-3 text-xs text-teal-700/60">Timestamp: <span id="timestamp">{{ now()->toDateTimeString() }}</span></p>
                    </div>

                    <div class="md:w-1/2 hidden md:flex items-center justify-center bg-gradient-to-br from-teal-600 to-cyan-400 text-white p-8">
                        <div class="text-center max-w-xs">
                            <svg class="mx-auto w-24 h-24 mb-4 opacity-90" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M12 2v6"></path>
                                <path d="M12 22v-6"></path>
                                <path d="M4.9 4.9l4.2 4.2"></path>
                                <path d="M19.1 19.1l-4.2-4.2"></path>
                                <path d="M4 12h6"></path>
                                <path d="M14 12h6"></path>
                            </svg>

                            <h3 class="text-2xl font-semibold">It's seems you've encountered an issue.</h3>
                            <p class="mt-2 text-sm opacity-90">If this keeps happening, please report the issue so we can investigate.</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <x-utils.noscript />
    </body>
</html>
