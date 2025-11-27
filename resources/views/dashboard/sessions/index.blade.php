<x-layout.dashboard title="Sessions">
    @pushOnce('vites')
        @vite(['resources/css/lib/datatable.css', 'resources/js/lib/datatable.js', 'resources/js/handler/offcanvas.js', 'resources/js/addon/session-page.js'])
    @endPushOnce

    <header data-debug="{{ config('app.debug') ? 'true' : 'false' }}"
        data-routes='{
            "update": "{{ route('dashboard.sessions.update', ':id') }}",
            "destroy": "{{ route('dashboard.sessions.destroy', ':id') }}"
        }'
        data-voting-start="{{ $start_date }}" data-voting-end="{{ $end_date }}"></header>

    <div class="mb-8 flex items-center justify-between">
        <h1 class="text-3xl font-bold text-neutral-900">
            List of Sessions
        </h1>
        <button id="add-new-record-btn" type="button" data-target="#add-new-record"
            class="inline-flex items-center gap-2 bg-primary-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-primary-700 transition-colors cursor-pointer">
            <box-icon name="plus" class="w-5 h-5" color="white"></box-icon>
            Session
        </button>
    </div>

    {{ $dataTable->table() }}

    <x-canvas.wrapper id="add-new-record">
        <x-canvas.header title="New Record">
            <form class="space-y-4" method="POST" action="{{ route('dashboard.sessions.store') }}"
                id="form-add-new-record">
                <div>
                    <label for="batch_id" class="block text-sm font-semibold text-gray-700 mb-1.5">Batch</label>
                    <select id="batch_id" name="batch_id"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        <option value="" disabled selected>Select a batch</option>
                        @foreach ($batches as $batch)
                            <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="start_time" class="block text-sm font-semibold text-gray-700 mb-1.5">Start Time</label>
                    <input type="datetime-local" id="start_time" name="start_time"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                </div>
                <div>
                    <label for="end_time" class="block text-sm font-semibold text-gray-700 mb-1.5">End Time</label>
                    <input type="datetime-local" id="end_time" name="end_time"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                </div>
            </form>
        </x-canvas.header>
        <x-canvas.footer :isCreate="true" />
    </x-canvas.wrapper>

    <x-canvas.wrapper id="show-record">
        <x-canvas.header title="Show Record">
            <div class="space-y-4">
                <div>
                    <h3 class="text-sm font-semibold text-gray-700 mb-1.5">Batch</h3>
                    <p id="show-batch" class="text-gray-900">-</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-700 mb-1.5">Start Time</h3>
                    <p id="show-start-time" class="text-gray-900">-</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-700 mb-1.5">End Time</h3>
                    <p id="show-end-time" class="text-gray-900">-</p>
                </div>
            </div>
        </x-canvas.header>
        <x-canvas.footer type="show" />
    </x-canvas.wrapper>

    <x-canvas.wrapper id="edit-record">
        <x-canvas.header title="Edit Candidate">
            <form id="form-edit-record" class="space-y-4" method="PUT" action="#">
                <div>
                    <label for="edit-batch_id" class="block text-sm font-semibold text-gray-700 mb-1.5">Batch</label>
                    <select id="edit-batch_id" name="batch_id"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        <option value="" disabled>Select a batch</option>
                        @foreach ($batches as $batch)
                            <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="edit-start_time" class="block text-sm font-semibold text-gray-700 mb-1.5">Start
                        Time</label>
                    <input type="datetime-local" id="edit-start_time" name="start_time"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                </div>
                <div>
                    <label for="edit-end_time" class="block text-sm font-semibold text-gray-700 mb-1.5">End Time</label>
                    <input type="datetime-local" id="edit-end_time" name="end_time"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                </div>
            </form>
        </x-canvas.header>
        <x-canvas.footer />
    </x-canvas.wrapper>

    <form class="d-inline" id="form-delete-record" method="DELETE" action="#"></form>

    @pushOnce('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module', 'nonce' => app('csp-nonce')]) }}
    @endPushOnce
</x-layout.dashboard>
