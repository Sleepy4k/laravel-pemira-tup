<div class="bottom-0 left-0 w-full p-4 bg-white border-t border-neutral-200">
    @if ($type === 'show')
        <div class="flex flex-col ml-3">
            <span class="text-gray-500 mb-1 mt-1">Created at: <span id="show-created-at"></span></span>
            <span class="text-gray-500 mb-1">Last updated: <span id="show-last-updated"></span></span>
        </div>
    @else
        <div class="flex ml-3 justify-end">
            <button type="submit" id="{{ $isCreate ? 'add-new' : 'edit' }}-record-submit-btn"
                class="bg-primary-600 hover:bg-primary-700 text-white font-medium py-2 px-4 rounded-lg mr-3 cursor-pointer shadow-md">
                {{ $isCreate ? 'Create Record' : 'Save Changes' }}
            </button>
        </div>
    @endif
</div>
