<x-layout.dashboard title="Dashboard">
    @pushOnce('vites')
        @vite(['resources/js/lib/apexchart.js', 'resources/js/addon/home-page.js'])
    @endPushOnce

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-neutral-900 mb-2">
            Welcome back, {{ auth('web')->user()->name ?? 'Admin' }}!
        </h1>
        <p class="text-neutral-600">
            Here's an overview of the voting statistics. Ensure to monitor the voter turnout and session details
            regularly.
        </p>
    </div>

    <div class="flex flex-col gap-6 mb-8">
        <div class="flex flex-col md:flex-row gap-6">
            <div
                class="flex-1 bg-white rounded-xl shadow-sm border border-neutral-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-neutral-500 mb-1">Total Voters</p>
                        <p class="text-3xl font-bold text-neutral-900">{{ $totalVoters ?? 0 }}</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>
            <div
                class="flex-1 bg-white rounded-xl shadow-sm border border-neutral-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-neutral-500 mb-1">Has Voted</p>
                        <p class="text-3xl font-bold text-green-600">{{ $votingStatus['hasVoted'] ?? 0 }}</p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div
                class="flex-1 bg-white rounded-xl shadow-sm border border-neutral-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-neutral-500 mb-1">Not Voted</p>
                        <p class="text-3xl font-bold text-red-600">{{ $votingStatus['notVoted'] ?? 0 }}</p>
                    </div>
                    <div class="bg-red-100 p-3 rounded-lg">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (!empty($votesPerCandidateForPie))
        <div class="flex flex-col gap-6 mb-8">
            <div class="flex flex-col md:flex-row gap-6">
                @foreach ($votesPerCandidateForPie as $candidate => $totalVotes)
                    <div
                        class="flex-1 bg-white rounded-xl shadow-sm border border-neutral-200 p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-neutral-500 mb-1">Votes for {{ $candidate }}</p>
                                <p class="text-3xl font-bold text-neutral-900">{{ $totalVotes }}</p>
                            </div>
                            <div class="bg-primary-100 p-3 rounded-lg">
                                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-neutral-200 p-6">
            <div id="pieChart" data-chart="{{ json_encode($votesPerCandidateForPie) }}"></div>
        </div>
        <div class="lg:col-span-3 bg-white rounded-xl shadow-sm border border-neutral-200 p-6">
            <div id="barChart" data-chart="{{ json_encode($votesPerCandidate) }}"
                data-categories="{{ json_encode($candidateCategories) }}"></div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <div class="lg:col-span-3 bg-white rounded-xl shadow-sm border border-neutral-200 p-6">
            <div id="barChart2" data-chart="{{ json_encode($votesPerBatch) }}"
                data-categories="{{ json_encode($batches->pluck('name')) }}"></div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-neutral-200 p-6">
            <div id="pieChart2" data-chart="{{ json_encode($votingStatus) }}"></div>
        </div>
    </div>
</x-layout.dashboard>
