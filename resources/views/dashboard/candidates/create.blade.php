<x-layout.dashboard title="Create Candidate">
    @pushOnce('vites')
        @vite(['resources/js/addon/create-candidate-page.js'])
    @endPushOnce

    <div class="mb-8 flex items-center justify-between">
        <h1 class="text-3xl font-bold text-neutral-900">
            Create New Candidate
        </h1>
        <a href="{{ route('dashboard.candidates.index') }}"
            class="inline-flex items-center gap-2 bg-primary-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-primary-700 transition-colors cursor-pointer">
            <box-icon name="arrow-back" color="#ffffff"></box-icon>
            Back to Candidates
        </a>
    </div>

    <form id="create-candidate-form" data-method="POST" action="#" enctype="multipart/form-data"
        data-redirect="{{ route('dashboard.candidates.index') }}"
        class="grid grid-cols-4 gap-8 w-full bg-white p-6 rounded-lg shadow-md"
        data-action="{{ route('dashboard.candidates.store') }}">
        @csrf

        <div class="space-y-4 lg:col-span-2 col-span-4">
            <div>
                <label for="number" class="block text-sm font-semibold text-gray-700 mb-1.5">Candidate
                    Number</label>
                <input type="number" id="number" name="number" placeholder="Enter candidate number" min="1"
                    max="8" value="{{ old('number') }}"
                    class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                    required>
            </div>
            <div>
                <label for="head_name" class="block text-sm font-semibold text-gray-700 mb-1.5">Head
                    Name</label>
                <input type="text" id="head_name" name="head_name" placeholder="Enter head name"
                    value="{{ old('head_name') }}"
                    class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                    required>
            </div>
            <div>
                <label for="vice_name" class="block text-sm font-semibold text-gray-700 mb-1.5">Vice
                    Name</label>
                <input type="text" id="vice_name" name="vice_name" placeholder="Enter vice name"
                    value="{{ old('vice_name') }}"
                    class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                    required>
            </div>
            <div>
                <label for="photo" class="block text-sm font-semibold text-gray-700 mb-1.5">Photo</label>
                <input type="file" id="photo" accept="image/*" name="photo"
                    class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                <div class="mt-2 text-sm text-gray-500">Accepted formats: .png, .jpg, .jpeg</div>
                <div id="photo-preview-container" class="mt-2 hidden">
                    <img id="photo-preview" src="#" alt="Photo Preview" class="rounded-lg w-32 h-32" />
                </div>
            </div>
            <div>
                <label for="resume" class="block text-sm font-semibold text-gray-700 mb-1.5">Resume</label>
                <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx"
                    class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                    required />
                <div class="mt-2 text-sm text-gray-500">Accepted formats: .pdf, .doc, .docx</div>
                <div id="resume-preview-container" class="mt-2 hidden"></div>
            </div>
            <div>
                <label for="attachment" class="block text-sm font-semibold text-gray-700 mb-1.5">Visi
                    Misi & Proker</label>
                <input type="file" id="attachment" name="attachment" accept=".pdf,.doc,.docx"
                    class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                    required />
                <div class="mt-2 text-sm text-gray-500">Accepted formats: .pdf, .doc, .docx</div>
                <div id="attachment-preview-container" class="mt-2 hidden"></div>
            </div>
        </div>
        <div class="space-y-4 lg:col-span-2 col-span-4">
            <div>
                <label for="vision" class="block text-sm font-semibold text-gray-700 mb-1.5">Vision</label>
                <textarea id="vision" name="vision" placeholder="Enter candidate vision"
                    class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                    required>{{ old('vision') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Missions</label>

                <div id="missions-input-container" class="space-y-4">
                    <div class="flex items-center">
                        <input type="text" placeholder="Enter mission"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        <button type="button" id="add-mission-btn"
                            class="ml-3 bg-primary-600 hover:bg-primary-700 text-white p-2 rounded-lg cursor-pointer shadow-md flex items-center justify-center">
                            <box-icon name="plus" color="#ffffff"></box-icon>
                        </button>
                    </div>
                </div>

                <div id="missions-preview" class="mt-3"></div>

                <div class="mt-1 text-sm text-gray-500">Maximum of 3 missions allowed.</div>
            </div>
            <div>
                <label for="programs" class="block text-sm font-semibold text-gray-700 mb-1.5">Programs</label>

                <div id="programs-input-container" class="space-y-4">
                    <div class="flex items-center">
                        <input type="text" placeholder="Enter program" id="program-input"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                        <button type="button" id="add-program-btn"
                            class="ml-3 bg-primary-600 hover:bg-primary-700 text-white p-2 rounded-lg cursor-pointer shadow-md flex items-center justify-center">
                            <box-icon name="plus" color="#ffffff"></box-icon>
                        </button>
                    </div>
                </div>

                <div id="programs-preview" class="mt-3"></div>

                <div class="mt-1 text-sm text-gray-500">Maximum of 5 programs allowed.</div>
            </div>
        </div>
        <div class="col-span-4 flex justify-end mt-4">
            <button type="submit"
                class="bg-primary-600 hover:bg-primary-700 text-white font-medium py-2 px-4 rounded-lg mr-3 cursor-pointer shadow-md">
                Create Candidate
            </button>
        </div>
    </form>
</x-layout.dashboard>
