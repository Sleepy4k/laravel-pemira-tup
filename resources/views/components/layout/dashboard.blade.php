<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="title" content="{{ $appSettings['app_name'] }} - {{ $title }}">
        <meta name="description" content="{{ $appSettings['app_description'] }}">
        <meta name="author" content="{{ $appSettings['seo_author'] }}">
        <meta name="coverage" content="Worldwide">
        <meta name="distribution" content="Global">
        <meta name="robots" content="index, follow">
        <meta name="keywords" content="{{ $appSettings['seo_keywords'] }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="canonical" href="{{ config('app.url') }}">

        <link rel="icon" href="{{ $appSettings['app_favicon'] }}" />
        <link rel="shortcut icon" href="{{ $appSettings['app_favicon'] }}" />
        <link rel="apple-touch-icon" href="{{ $appSettings['app_favicon'] }}" />
        <link rel="apple-touch-icon-precomposed" href="{{ $appSettings['app_favicon'] }}" />

        <title>{{ $appSettings['app_name'] }} - {{ $title }}</title>

        @cspMetaTag

        <meta property="csrf-token" content="{{ csrf_token() }}">
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

        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/lib/boxicons.js', 'resources/js/addon/layout-dashboard.js'])

        @stack('vites')
    </head>
    <body>
        <div class="flex h-screen bg-neutral-100 font-sans">
            <div id="sidebar-overlay" class="fixed inset-0 bg-black/30 backdrop-blur-sm z-30 lg:hidden hidden"></div>

            <x-dashboard.sidebar :appName="$appSettings['app_name']" :appLogo="$appSettings['app_logo']" />

            <main class="flex-1 overflow-y-auto flex flex-col">
                <x-dashboard.navbar :title="$title" />

                <div class="flex-1 p-8 lg:p-8" id="main-content" style="display: none;">
                    {{ $slot }}
                </div>

                <div id="offcanvas-backdrop"
                    class="fixed inset-0 backdrop-blur-xs bg-white/30 bg-opacity-50 z-40 hidden transition-opacity duration-300">
                </div>

                <div class="flex-1 p-8 lg:p-8" id="main-loader">
                    <div class="flex flex-col items-center justify-center h-full">
                        <div class="loader ease-linear rounded-full border-8 border-t-8 border-gray-200 h-16 w-16 mb-4"></div>
                        <h2 class="text-center text-xl font-semibold text-neutral-700">Loading...</h2>
                    </div>
                </div>

                <x-dashboard.footer :appName="$appSettings['app_name']" />
            </main>

            <form id="logout-form" data-action="{{ route('logout') }}" data-redirect="{{ route('landing') }}"
                class="hidden"></form>
        </div>

        <x-utils.noscript />

        @stack('scripts')
    </body>
</html>
