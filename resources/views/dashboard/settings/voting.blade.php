<x-layout.dashboard title="Voting">
    @pushOnce('vites')
        @vite(['resources/js/addon/voting-page.js'])
    @endPushOnce

    <header data-success="{{ session('success', '') }}" data-error="{{ session('error', '') }}"></header>

    <div class="mb-8 flex items-center justify-between">
        <h1 class="text-3xl font-bold text-neutral-900">
            Voting
        </h1>
    </div>

    <div class="mb-6 border-b border-gray-200">
        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
            @foreach ($settingsTabs as $tabKey => $tabLabel)
                <a href="{{ route('dashboard.voting.index', ['tab' => $tabKey]) }}"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm {{ $activeTab === $tabKey ? 'border-primary-500 text-primary-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    {{ $tabLabel }}
                </a>
            @endforeach
        </nav>
    </div>

    <div id="voting-settings" style="{{ $activeTab === 'voting' ? '' : 'display: none;' }}">
        <div class="p-6 bg-white rounded-xl shadow-sm">
            <h2 class="font-semibold text-gray-900 mb-4">Voting Settings</h2>
            <form method="POST"
                action="{{ route('dashboard.voting.update', ['tab' => 'voting', 'voting' => $types['voting']]) }}">
                @csrf
                @method('PUT')

                <div class="mb-4 flex flex-col md:flex-row md:space-x-6">
                    <div class="md:w-1/2">
                        <label for="voting_start" class="block text-sm font-medium text-gray-700">Voting Start
                            Date</label>
                        <input type="datetime-local" name="voting_start" id="voting_start"
                            value="{{ old('voting_start', $settings['voting_start'] ?? '') }}"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                    </div>

                    <div class="md:w-1/2 mt-4 md:mt-0">
                        <label for="voting_end" class="block text-sm font-medium text-gray-700">Voting End Date</label>
                        <input type="datetime-local" name="voting_end" id="voting_end"
                            value="{{ old('voting_end', $settings['voting_end'] ?? '') }}"
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
