<x-layout.dashboard title="Setting Account">
    @pushOnce('vites')
        @vite(['resources/js/addon/profile-page.js'])
    @endPushOnce

    <x-profile.navbar />

    <section class="grid gap-6 md:grid-cols-3">
        <div class="p-6 bg-white rounded-xl shadow-sm">
            <div class="flex items-center gap-4">
                <div
                    class="w-14 h-14 rounded-full bg-primary-500 text-white grid place-items-center text-lg font-semibold ring-2 ring-blue-100 shadow-sm">
                    {{ $initialName }}
                </div>
                <div>
                    <div class="font-semibold text-lg text-gray-900">{{ $user->name }}</div>
                    <div class="text-sm text-gray-500">{{ ucfirst($user->username) }}</div>
                </div>
            </div>
        </div>

        <div class="md:col-span-2 p-6 bg-white rounded-xl shadow-sm">
            <h2 class="font-semibold text-gray-900 mb-4">Settings Information</h2>
            <form method="POST" action="{{ route('profile.setting.store') }}" class="space-y-4"
                id="form-setting-account">
                @csrf

                <div class="flex flex-col gap-4 h-full">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                            class="mt-1 block w-full rounded-lg border border-gray-200 bg-gray-50 px-3 py-2 text-sm text-gray-900 shadow-sm placeholder-gray-400 focus:border-primary-600 focus:ring-2 focus:ring-primary-200 focus:outline-none transition"
                            required placeholder="Enter your full name">
                        @error('name')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                        <input type="text" name="username" id="username"
                            value="{{ old('username', $user->username) }}"
                            class="mt-1 block w-full rounded-lg border border-gray-200 bg-gray-50 px-3 py-2 text-sm text-gray-900 shadow-sm placeholder-gray-400 focus:border-primary-600 focus:ring-2 focus:ring-primary-200 focus:outline-none transition"
                            required placeholder="Enter your username">
                        @error('username')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-auto flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-5 py-2 bg-primary-600 text-white rounded-lg shadow hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 cursor-pointer">
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</x-layout.dashboard>
