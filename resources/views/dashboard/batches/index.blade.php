<x-layout.dashboard title="Batches">
    @pushOnce('vites')
        @vite(['resources/css/lib/datatable.css', 'resources/js/lib/datatable.js', 'resources/js/handler/offcanvas.js', 'resources/js/addon/batch-page.js'])
    @endPushOnce

    <header data-debug="{{ config('app.debug') ? 'true' : 'false' }}"
        data-routes='{
            "update": "{{ route('dashboard.batches.update', ':id') }}",
            "destroy": "{{ route('dashboard.batches.destroy', ':id') }}"
        }'>
    </header>

    <div class="mb-8 flex items-center justify-between">
        <h1 class="text-3xl font-bold text-neutral-900">
            List of Batches
        </h1>
        <button id="add-new-record-btn" type="button" data-target="#add-new-record"
            class="inline-flex items-center gap-2 bg-primary-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-primary-700 transition-colors cursor-pointer">
            <box-icon name="plus" class="w-5 h-5" color="white"></box-icon>
            Batch
        </button>
    </div>

    {{ $dataTable->table() }}

    <x-canvas.wrapper id="add-new-record">
        <x-canvas.header title="New Record">
            <form class="space-y-4" method="POST" action="{{ route('dashboard.batches.store') }}"
                id="form-add-new-record">
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-1.5">Batch Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter batch name"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                </div>
                <div>
                    <label for="description"
                        class="block text-sm font-semibold text-gray-700 mb-1.5">Description</label>
                    <textarea id="description" name="description" placeholder="Enter batch description"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"></textarea>
                </div>
            </form>
        </x-canvas.header>
        <x-canvas.footer :isCreate="true" />
    </x-canvas.wrapper>

    <x-canvas.wrapper id="show-record">
        <x-canvas.header title="Show Record">
            <div class="space-y-4">
                <div>
                    <h3 class="text-sm font-semibold text-gray-700 mb-1.5">Batch Name</h3>
                    <p id="show-name" class="text-gray-900">-</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-700 mb-1.5">Description</h3>
                    <p id="show-description" class="text-gray-900">-</p>
                </div>
            </div>
        </x-canvas.header>
        <x-canvas.footer type="show" />
    </x-canvas.wrapper>

    <x-canvas.wrapper id="edit-record">
        <x-canvas.header title="Edit Candidate">
            <form id="form-edit-record" class="space-y-4" method="PUT" action="#">
                <div>
                    <label for="edit-name" class="block text-sm font-semibold text-gray-700 mb-1.5">Batch Name</label>
                    <input type="text" id="edit-name" name="name" placeholder="Enter batch name"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                </div>
                <div>
                    <label for="edit-description"
                        class="block text-sm font-semibold text-gray-700 mb-1.5">Description</label>
                    <textarea id="edit-description" name="description" placeholder="Enter batch description"
                        class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"></textarea>
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
