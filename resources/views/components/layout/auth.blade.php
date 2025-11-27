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

        @vite(['resources/css/app.css', 'resources/css/addon/signin.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-50 min-h-screen flex flex-col items-center justify-center p-4">
        <div class="refresh-animation">
            <div class="refresh-logo">
                <div class="logo-item logo-2">
                    <img src="{{ asset('images/pemira.png') }}" alt="HIMASI Logo" loading="lazy">
                </div>
            </div>
        </div>

        <div class="pattern-overlay"></div>
        <div class="floating-shapes">
            <div class="shape shape1"></div>
            <div class="shape shape2"></div>
            <div class="shape shape3"></div>
        </div>

        <div
            class="w-full max-w-md bg-white border border-gray-200 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-6 sm:p-8 z-10">
            <div class="flex justify-center">
                <a href="{{ route('landing') }}" class="inline-block">
                    <img src="{{ $appSettings['app_logo'] }}" alt="{{ $appSettings['app_name'] }} Logo"
                        class="mx-auto h-12 sm:h-16 w-auto drop-shadow-sm" loading="lazy" />
                </a>
            </div>

            {{ $slot }}
        </div>

        <div class="w-full max-w-md text-center mt-6 sm:mt-8 px-2">
            <p class="text-sm sm:text-base text-gray-400 leading-relaxed">
                © {{ date('Y') }} <span class="font-semibold text-neutral-700">{{ $appSettings['app_name'] }}</span>.
                All rights reserved.
            </p>
        </div>

        <x-utils.noscript />
    </body>
</html>
