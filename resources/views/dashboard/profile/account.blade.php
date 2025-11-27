<x-layout.dashboard title="Profile Account">
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
            <h2 class="font-semibold text-gray-900 mb-4">Account Information</h2>
            <dl class="divide-y divide-gray-100">
                <div class="flex items-start justify-between py-3">
                    <dt class="text-xs uppercase tracking-wider text-gray-500">Name</dt>
                    <dd class="text-gray-900 font-medium">{{ $user->name }}</dd>
                </div>
                <div class="flex items-start justify-between py-3">
                    <dt class="text-xs uppercase tracking-wider text-gray-500">Username</dt>
                    <dd class="text-gray-900 font-medium">{{ ucfirst($user->username) }}</dd>
                </div>
                <div class="flex items-start justify-between py-3">
                    <dt class="text-xs uppercase tracking-wider text-gray-500">Member Since</dt>
                    <dd class="text-gray-900 font-medium">{{ $user->created_at->format('d M Y') }}</dd>
                </div>
            </dl>
        </div>
    </section>
</x-layout.dashboard>
