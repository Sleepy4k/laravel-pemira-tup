@vite(['resources/js/addon/signin-page.js'])

<x-layout.auth title="Sign In">
    @if ($rateLimiter['remaining'] <= 0 && $rateLimiter['reset_at'])
        <header
            data-remaining="{{ $rateLimiter['remaining'] }}"
            data-reset-at="{{ $rateLimiter['reset_at'] }}"
        ></header>
    @endif

    <h1 class="text-xl sm:text-2xl font-bold text-gray-900 text-center mb-2">Welcome back!</h1>
    <p class="text-xs sm:text-sm text-gray-500 text-center mb-6">Sign in to manage various settings and
        configurations</p>

    <div id="info-container" class="mb-4 text-center text-sm text-red-600 hidden"></div>

    <form id="signin-form" class="space-y-4" data-action="{{ route('signin.store') }}"
        data-redirect="{{ route('dashboard') }}">
        <div>
            <label for="username" class="block text-sm font-semibold text-gray-700 mb-1.5">Username</label>
            <input type="text" id="username" placeholder="Admin123" autocomplete="username"
                class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
        </div>

        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
            <div class="relative">
                <input type="password" id="password" placeholder="••••••••••••" autocomplete="current-password"
                    class="w-full px-4 py-2.5 pr-12 border border-gray-200 rounded-lg text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                <button type="button" id="toggle-password-btn"
                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                    <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.051 7.36 4.5 12 4.5c4.638 0 8.573 2.551 9.963 7.178.07.207.07.431 0 .639C20.577 16.949 16.64 19.5 12 19.5c-4.638 0-8.573-2.551-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <svg id="eye-slash-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hidden">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                    </svg>
                </button>
            </div>
        </div>

        <button type="submit" id="signin-submit-btn"
            class="w-full py-2.5 rounded-lg text-white font-medium hover:opacity-95 transition-opacity shadow-md cursor-pointer bg-gradient-to-br from-teal-700 via-teal-500 to-cyan-300">
            Sign In
        </button>
    </form>

    <div class="relative flex items-center py-5">
        <div class="flex-grow border-t border-gray-200"></div>
    </div>

    <div class="text-center">
        <a href="{{ route('landing') }}"
            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg text-sm font-medium text-gray-600 bg-white border border-gray-200 hover:bg-gray-50 hover:border-gray-300 transition-all duration-200 shadow-sm hover:shadow">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Back to Home
        </a>
    </div>
</x-layout.auth>
