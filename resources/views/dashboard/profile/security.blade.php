<x-layout.dashboard title="Security Account">
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
            <h2 class="font-semibold text-gray-900 mb-4">Security Information</h2>
            <form method="POST" action="{{ route('profile.security.store') }}" class="space-y-4" id="form-security-account">
                @csrf

                <div class="space-y-4">
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700">Current
                            Password</label>
                        <input type="password" name="current_password" id="current_password"
                            placeholder="Enter your current password"
                            class="mt-1 block w-full rounded-lg border border-gray-200 bg-gray-50 px-3 py-2 text-sm text-gray-900 shadow-sm placeholder-gray-400 focus:border-primary-600 focus:ring-2 focus:ring-primary-200 focus:outline-none transition"
                            required>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                        <input type="password" name="password" id="password" placeholder="Enter your new password"
                            class="mt-1 block w-full rounded-lg border border-gray-200 bg-gray-50 px-3 py-2 text-sm text-gray-900 shadow-sm placeholder-gray-400 focus:border-primary-600 focus:ring-2 focus:ring-primary-200 focus:outline-none transition"
                            required>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New
                            Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            placeholder="Confirm your new password"
                            class="mt-1 block w-full rounded-lg border border-gray-200 bg-gray-50 px-3 py-2 text-sm text-gray-900 shadow-sm placeholder-gray-400 focus:border-primary-600 focus:ring-2 focus:ring-primary-200 focus:outline-none transition"
                            required>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-5 py-2.5 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-300 transition cursor-pointer">
                            Change Password
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</x-layout.dashboard>
