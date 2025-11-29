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

        @vite(['resources/css/app.css', 'resources/css/addon/error.css', 'resources/js/app.js', 'resources/js/addon/layout-error.js'])
    </head>
    <body class="flex flex-col min-h-screen">
        <main class="flex flex-col items-center justify-center min-h-screen">
            <div class="text-9xl font-black text-primary-500 bg-radial-primary">
                {{ $status }}
            </div>
            <h1 class="mt-6 text-3xl font-bold text-neutral-800">{{ $title }}</h1>
            <p class="mt-4 text-md text-center text-neutral-600 max-w-lg">{{ $message }}</p>
            <button data-href="{{ route('landing') }}" id="home-btn"
                class="mt-6 inline-block px-6 py-3 bg-primary-500 text-white font-semibold rounded-lg shadow-md hover:bg-primary-600 transition-colors cursor-pointer">
                Back to Home
            </button>
        </main>

        <x-utils.noscript />
    </body>
</html>
