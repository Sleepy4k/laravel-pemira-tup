<x-layout.dashboard title="Candidates">
    @pushOnce('vites')
        @vite(['resources/css/lib/datatable.css', 'resources/js/lib/datatable.js', 'resources/js/handler/offcanvas.js', 'resources/js/addon/candidate-page.js'])
    @endPushOnce

    <header data-debug="{{ config('app.debug') ? 'true' : 'false' }}"
        data-routes='{
            "destroy": "{{ route('dashboard.candidates.destroy', ':id') }}"
        }'></header>

    <div class="mb-8 flex items-center justify-between">
        <h1 class="text-3xl font-bold text-neutral-900">
            List of Candidates
        </h1>
        <a href="{{ route('dashboard.candidates.create') }}"
            class="inline-flex items-center gap-2 bg-primary-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-primary-700 transition-colors cursor-pointer">
            <box-icon name="plus" class="w-5 h-5" color="white"></box-icon>
            Candidate
        </a>
    </div>

    {{ $dataTable->table() }}

    <form class="d-inline" id="form-delete-record" method="DELETE" action="#"></form>

    @pushOnce('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module', 'nonce' => app('csp-nonce')]) }}
    @endPushOnce
</x-layout.dashboard>
