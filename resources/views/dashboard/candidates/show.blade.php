<x-layout.dashboard title="Detail Candidate">
    @pushOnce('vites')
        @vite(['resources/js/addon/update-candidate-page.js'])
    @endPushOnce

    <div class="mb-8 flex items-center justify-between">
        <h1 class="text-3xl font-bold text-neutral-900">
            Detail Candidate
        </h1>
        <a href="{{ route('dashboard.candidates.index') }}"
            class="inline-flex items-center gap-2 bg-primary-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-primary-700 transition-colors cursor-pointer">
            <box-icon name="arrow-back" color="#ffffff"></box-icon>
            Back to Candidates
        </a>
    </div>

    <div class="grid grid-cols-4 gap-8 w-full bg-white p-6 rounded-lg shadow-md">
        <div class="space-y-4 lg:col-span-2 col-span-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Candidate Number</label>
                <div class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 bg-gray-50">
                    {{ $candidate->number }}
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Head Name</label>
                <div class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 bg-gray-50">
                    {{ $candidate->head_name }}
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Vice Name</label>
                <div class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 bg-gray-50">
                    {{ $candidate->vice_name }}
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Photo</label>
                @if ($candidate->photo)
                    <div class="mt-2">
                        <img src="{{ $candidate->photo }}" alt="Candidate Photo"
                            class="rounded-lg w-32 h-32 object-cover border" />
                    </div>
                @else
                    <div class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-gray-500 bg-gray-50">
                        No photo uploaded.
                    </div>
                @endif
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Resume</label>
                @if ($candidate->resume)
                    <a href="{{ $candidate->resume }}" target="_blank"
                        class="inline-flex items-center gap-2 text-primary-600 hover:underline">
                        <box-icon name="download" color="#2563eb"></box-icon>
                        Download Resume
                    </a>
                @else
                    <div class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-gray-500 bg-gray-50">
                        No resume uploaded.
                    </div>
                @endif
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Visi Misi & Proker</label>
                @if ($candidate->attachment)
                    <a href="{{ $candidate->attachment }}" target="_blank"
                        class="inline-flex items-center gap-2 text-primary-600 hover:underline">
                        <box-icon name="download" color="#2563eb"></box-icon>
                        Download Attachment
                    </a>
                @else
                    <div class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-gray-500 bg-gray-50">
                        No attachment uploaded.
                    </div>
                @endif
            </div>
        </div>

        <div class="space-y-4 lg:col-span-2 col-span-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Vision</label>
                <div
                    class="whitespace-pre-wrap w-full px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 bg-gray-50">
                    {{ $candidate->vision->vision ?? '' }}
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Missions</label>
                @if ($candidate->missions->isNotEmpty())
                    <div class="space-y-2">
                        @foreach ($candidate->missions as $mission)
                            <div class="flex items-center w-full">
                                <span
                                    class="flex-1 px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 bg-gray-100 break-words">
                                    {{ $mission->point }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-gray-500 bg-gray-50">
                        No missions added.
                    </div>
                @endif
                <div class="mt-1 text-sm text-gray-500">Maximum of 3 missions allowed.</div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Programs</label>
                @if ($candidate->programs->isNotEmpty())
                    <div class="space-y-2">
                        @foreach ($candidate->programs as $program)
                            <div class="flex items-center w-full">
                                <span
                                    class="flex-1 px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 bg-gray-100 break-words">
                                    {{ $program->point }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-gray-500 bg-gray-50">
                        No programs added.
                    </div>
                @endif
                <div class="mt-1 text-sm text-gray-500">Maximum of 5 programs allowed.</div>
            </div>
        </div>
    </div>
</x-layout.dashboard>
