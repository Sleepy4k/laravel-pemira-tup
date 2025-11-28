<x-layout.landing title="Pilih Jenis Voting">
    @pushOnce('vites')
        @vite(['resources/js/addon/voting-landing-page.js'])
    @endPushOnce

    <section id="info-card"
        class="bg-gradient-to-br from-primary-500 to-primary-800 rounded-[20px] md:rounded-[35px] p-6 md:p-10 text-white shadow-card-glow max-w-7xl mx-auto mt-10 md:mt-16">
        <h1 class="text-2xl md:text-4xl font-bold mb-2 md:mb-3 stagger-item">E-Voting Card</h1>
        <p class="text-tertiary-200 mb-6 md:mb-8 text-sm md:text-base stagger-item">Anda hanya bisa memilih <span
                class="font-bold text-white">satu
                kali</span> untuk setiap jenis voting</p>

        <div class="space-y-3 md:space-y-4 mb-6 md:mb-10">
            <div class="flex flex-col md:flex-row md:items-center stagger-item">
                <span class="text-tertiary-300 w-20 font-medium text-sm md:text-base">Nama</span>
                <span class="font-semibold text-lg w-3 hidden md:inline">:</span>
                <span class="font-semibold text-base md:text-lg">{{ $user->name ?? "Jaiman Cawisono Gunarto" }}</span>
            </div>
            <div class="flex flex-col md:flex-row md:items-center stagger-item">
                <span class="text-tertiary-300 w-20 font-medium text-sm md:text-base">NIM</span>
                <span class="font-semibold text-lg w-3 hidden md:inline">:</span>
                <span class="font-semibold text-base md:text-lg font-mono">{{ $user->nim ?? "1986122504" }}</span>
            </div>
            <div class="flex flex-col md:flex-row md:items-center stagger-item">
                <span class="text-tertiary-300 w-20 font-medium text-sm md:text-base">Email</span>
                <span class="font-semibold text-lg w-3 hidden md:inline">:</span>
                <span class="font-semibold text-base md:text-lg">{{ $user->email ?? "jaiman@student.telkomuniversity.ac.id" }}</span>
            </div>
        </div>

        <p class="text-xs md:text-sm text-tertiary-300 stagger-item">
            Pastikan data diatas benar, jika terjadi kesalahan data silahkan
            <a href="https://wa.me/6281387768990"
                class="text-white underline hover:text-brand-accent transition-colors">kesini</a>
        </p>
    </section>

    <section class="max-w-7xl mx-auto mt-8 md:mt-12 px-4 md:px-0">
        @forelse ($types as $type)
            <div
                class="bg-white border-[3px] voting-type-card border-primary-600 rounded-[20px] md:rounded-[30px] p-6 md:p-12 flex flex-col md:flex-row items-start md:items-center gap-6 md:gap-10 shadow-lg hover:shadow-xl transition-shadow duration-300 voting-type-card mb-6 md:mb-8">
                <div class="flex-1 z-10 w-full">
                    <h3 class="text-2xl md:text-3xl font-bold text-primary-600 mb-3 md:mb-6">{{ $type->name }}</h3>
                    <p class="text-gray-700 leading-relaxed text-base md:text-lg text-justify w-full">
                        {{ $type->description }}
                    </p>
                </div>

                <div class="flex-1 flex justify-start md:justify-end z-10 w-full md:w-auto">
                    <a href="{{ route('vote-candidate', $type->slug) }}"
                        class="bg-primary-600 text-white px-6 py-3 rounded-full hover:bg-primary-800 transition-all shadow-md w-full md:w-auto text-center cta-button">Pilih
                        {{ $type->name }}</a>
                </div>
            </div>
        @empty
            <div
                class="bg-white border-[3px] voting-type-card border-primary-600 rounded-[20px] md:rounded-[30px] p-6 md:p-12 flex flex-col md:flex-row items-center gap-6 md:gap-10 shadow-lg mb-8">
                <div class="flex-1 z-10 w-full">
                    <h3 class="text-2xl md:text-3xl font-bold text-primary-600 mb-3 md:mb-6">Tidak ada jenis voting
                        tersedia</h3>
                    <p class="text-gray-700 leading-relaxed text-base md:text-lg text-justify w-full">
                        Saat ini tidak ada jenis voting yang tersedia. Silahkan hubungi panitia jika Anda
                        mengalami kendala.
                    </p>
                </div>
            </div>
        @endforelse
    </section>
</x-layout.landing>
