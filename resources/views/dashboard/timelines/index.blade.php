<x-layout.dashboard title="Timelines">
    @pushOnce('vites')
        @vite(['resources/css/lib/datatable.css', 'resources/js/lib/datatable.js', 'resources/js/handler/offcanvas.js', 'resources/js/addon/timeline-page.js'])
    @endPushOnce

    <header data-debug="{{ config('app.debug') ? 'true' : 'false' }}"
        data-routes='{
            "update": "{{ route('dashboard.timelines.update', ':id') }}",
            "destroy": "{{ route('dashboard.timelines.destroy', ':id') }}"
        }'>
    </header>

    <div class="mb-8 flex items-center justify-between">
        <h1 class="text-3xl font-bold text-neutral-900">
            List of Timelines
        </h1>
        <button id="add-new-record-btn" type="button" data-target="#add-new-record"
            class="inline-flex items-center gap-2 bg-primary-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-primary-700 transition-colors cursor-pointer">
            <box-icon name="plus" class="w-5 h-5" color="white"></box-icon>
            Timeline
        </button>
    </div>

    {{ $dataTable->table() }}

    <x-canvas.wrapper id="add-new-record">
        <x-canvas.header title="New Record">
            <form class="space-y-4" method="POST" action="{{ route('dashboard.timelines.store') }}"
                id="form-add-new-record">
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                    <input type="datetime-local" name="start_date" id="start_date"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                </div>
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                    <input type="datetime-local" name="end_date" id="end_date"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                </div>
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name" placeholder="e.g., Registration Period"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="3" placeholder="e.g., Description of the timeline event"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm"></textarea>
                </div>
                <div>
                    <label for="icon" class="block text-sm font-medium text-gray-700">Icon (Boxicon Name)</label>
                    <input type="text" name="icon" id="icon" placeholder="e.g., calendar-event"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                </div>
                <div>
                    <label for="range" class="block text-sm font-medium text-gray-700">Range</label>
                    <input type="text" name="range" id="range" placeholder="e.g., 01 Jan - 07 Jan"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                </div>
            </form>
        </x-canvas.header>
        <x-canvas.footer :isCreate="true" />
    </x-canvas.wrapper>

    <x-canvas.wrapper id="show-record">
        <x-canvas.header title="Show Record">
            <div class="space-y-4">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Timeline Details</h3>
                </div>
                <div>
                    <strong>Start Date:</strong>
                    <div id="show-start-date"></div>
                </div>
                <div>
                    <strong>End Date:</strong>
                    <div id="show-end-date"></div>
                </div>
                <div>
                    <strong>Name:</strong>
                    <div id="show-name"></div>
                </div>
                <div>
                    <strong>Description:</strong>
                    <div id="show-description"></div>
                </div>
                <div>
                    <strong>Icon:</strong>
                    <div id="show-box-icon"></div>
                </div>
                <div>
                    <strong>Range:</strong>
                    <div id="show-range"></div>
                </div>
            </div>
        </x-canvas.header>
        <x-canvas.footer type="show" />
    </x-canvas.wrapper>

    <x-canvas.wrapper id="edit-record">
        <x-canvas.header title="Edit Candidate">
            <form id="form-edit-record" class="space-y-4" method="PUT" action="#">
                <div>
                    <label for="edit_start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                    <input type="datetime-local" name="start_date" id="edit_start_date"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                </div>
                <div>
                    <label for="edit_end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                    <input type="datetime-local" name="end_date" id="edit_end_date"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                </div>
                <div>
                    <label for="edit_name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="edit_name" placeholder="e.g., Registration Period"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                </div>
                <div>
                    <label for="edit_description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="edit_description" rows="3"
                        placeholder="e.g., Description of the timeline event"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm"></textarea>
                </div>
                <div>
                    <label for="edit_icon" class="block text-sm font-medium text-gray-700">Icon (Boxicon Name)</label>
                    <input type="text" name="icon" id="edit_icon" placeholder="e.g., calendar-event"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                </div>
                <div>
                    <label for="edit_range" class="block text-sm font-medium text-gray-700">Range</label>
                    <input type="text" name="range" id="edit_range" placeholder="e.g., 01 Jan - 07 Jan"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
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
