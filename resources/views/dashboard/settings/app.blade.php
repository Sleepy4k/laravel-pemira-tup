<x-layout.dashboard title="Settings">
    @pushOnce('vites')
        @vite(['resources/js/addon/application-page.js'])
    @endPushOnce

    <header data-maintenance-url="{{ route('dashboard.settings.store') }}" data-success="{{ session('success', '') }}"
        data-error="{{ session('error', '') }}"></header>

    <div class="mb-8 flex items-center justify-between">
        <h1 class="text-3xl font-bold text-neutral-900">
            Settings
        </h1>
        <button id="maintenance-btn" type="button" data-target="#maintenance-mode"
            class="inline-flex items-center gap-2 bg-primary-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-primary-700 transition-colors cursor-pointer">
            @if ($isMaintenanceMode)
                Disable Maintenance Mode
            @else
                Enable Maintenance Mode
            @endif
        </button>
    </div>

    <div class="mb-6 border-b border-gray-200">
        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
            @foreach ($settingsTabs as $tabKey => $tabLabel)
                <a href="{{ route('dashboard.settings.index', ['tab' => $tabKey]) }}"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm {{ $activeTab === $tabKey ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    {{ $tabLabel }}
                </a>
            @endforeach
        </nav>
    </div>

    <div id="general-settings" style="{{ $activeTab === 'app' ? '' : 'display: none;' }}">
        <div class="p-6 bg-white rounded-xl shadow-sm">
            <h2 class="font-semibold text-gray-900 mb-4">App Settings</h2>
            <form method="POST"
                action="{{ route('dashboard.settings.update', ['tab' => 'app', 'setting' => $types['app']]) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="app_name" class="block text-sm font-medium text-gray-700">Application Name</label>
                    <input type="text" name="app_name" id="app_name"
                        value="{{ old('app_name', $settings['app_name'] ?? '') }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label for="app_description" class="block text-sm font-medium text-gray-700">Application
                        Description</label>
                    <textarea name="app_description" id="app_description" rows="3"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm">{{ old('app_description', $settings['app_description'] ?? '') }}</textarea>
                </div>

                <div class="mb-4 flex flex-col md:flex-row md:space-x-6">
                    <div class="md:w-1/2">
                        <label for="app_logo" class="block text-sm font-medium text-gray-700">Application Logo</label>
                        <input type="file" name="app_logo" id="app_logo"
                            value="{{ old('app_logo', $settings['app_logo'] ?? '') }}" accept="image/*"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm">

                        <img id="app_logo_preview" src="{{ old('app_logo', $settings['app_logo'] ?? '') }}"
                            alt="App Logo Preview" class="mt-2 max-h-20">
                    </div>

                    <div class="md:w-1/2 mt-4 md:mt-0">
                        <label for="app_favicon" class="block text-sm font-medium text-gray-700">Application
                            Favicon</label>
                        <input type="file" name="app_favicon" id="app_favicon"
                            value="{{ old('app_favicon', $settings['app_favicon'] ?? '') }}" accept="image/*"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm">

                        <img id="app_favicon_preview" src="{{ old('app_favicon', $settings['app_favicon'] ?? '') }}"
                            alt="App Favicon Preview" class="mt-2 max-h-20">
                    </div>
                </div>

                <div class="mt-2 flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center gap-2 bg-primary-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-primary-700 transition-colors cursor-pointer">
                        Save Settings
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="seo-settings" style="{{ $activeTab === 'seo' ? '' : 'display: none;' }}">
        <div class="p-6 bg-white rounded-xl shadow-sm">
            <h2 class="font-semibold text-gray-900 mb-4">SEO Settings</h2>
            <form method="POST"
                action="{{ route('dashboard.settings.update', ['tab' => 'seo', 'setting' => $types['seo']]) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="seo_author" class="block text-sm font-medium text-gray-700">SEO Author</label>
                    <input type="text" name="seo_author" id="seo_author"
                        value="{{ old('seo_author', $settings['seo_author'] ?? '') }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label for="seo_keywords" class="block text-sm font-medium text-gray-700">SEO Keywords (comma
                        separated)</label>
                    <input type="text" name="seo_keywords" id="seo_keywords"
                        value="{{ old('seo_keywords', $settings['seo_keywords'] ?? '') }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                </div>

                <div class="mb-4">
                    <label for="seo_description" class="block text-sm font-medium text-gray-700">SEO Description</label>
                    <textarea name="seo_description" id="seo_description" rows="3"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm">{{ old('seo_description', $settings['seo_description'] ?? '') }}</textarea>
                </div>

                <div class="mb-4 flex flex-col md:flex-row md:space-x-6">
                    <div class="md:w-1/2">
                        <label for="seo_image_width" class="block text-sm font-medium text-gray-700">SEO Image Width
                            (px)</label>
                        <input type="number" name="seo_image_width" id="seo_image_width"
                            value="{{ old('seo_image_width', $settings['seo_image_width'] ?? '') }}"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                    </div>

                    <div class="md:w-1/2 mt-4 md:mt-0">
                        <label for="seo_image_height" class="block text-sm font-medium text-gray-700">SEO Image Height
                            (px)</label>
                        <input type="number" name="seo_image_height" id="seo_image_height"
                            value="{{ old('seo_image_height', $settings['seo_image_height'] ?? '') }}"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                    </div>
                </div>

                <div class="mt-2 flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center gap-2 bg-primary-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-primary-700 transition-colors cursor-pointer">
                        Save Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout.dashboard>
