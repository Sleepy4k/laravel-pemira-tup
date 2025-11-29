<x-layout.landing title="Pilih Jenis Voting">
    @pushOnce('vites')
        @vite(['resources/js/addon/voting-landing-page.js'])

        <style @cspNonce>
            #info-card, .voting-type-card { visibility: hidden; opacity: 0; }
        </style>
    @endPushOnce

    <header-meta data-success="{{ session('success') }}" data-error="{{ session('error') }}"></header-meta>

    <section id="info-card"
        class="relative overflow-hidden bg-gradient-to-br from-primary-600 to-primary-900 rounded-[24px] md:rounded-[40px] p-8 md:p-12 text-white shadow-2xl max-w-7xl mx-auto mt-10 md:mt-16 isolate">
        <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 rounded-full bg-white/10 blur-3xl -z-10"></div>
        <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-48 h-48 rounded-full bg-brand-accent/20 blur-2xl -z-10">
        </div>

        <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6">
            <div class="w-full">
                <h1 class="text-3xl md:text-5xl font-extrabold mb-3 tracking-tight stagger-item" id="info-title">E-Voting Card</h1>
                <p class="text-primary-100 mb-8 text-sm md:text-lg font-light stagger-item max-w-2xl" id="info-description">
                    Selamat datang di portal pemilihan. Hak suara Anda sangat berharga. Anda hanya memiliki kesempatan
                    <span class="font-bold text-white bg-white/20 px-2 py-0.5 rounded">satu kali</span> untuk setiap
                    kategori.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-8 mb-8 stagger-item">
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-4 border border-white/10">
                        <span
                            class="text-primary-200 text-xs uppercase tracking-wider font-semibold block mb-1">Nama</span>
                        <span class="font-bold text-lg md:text-xl truncate block"
                            title="{{ $user->name ?? 'Jaiman Cawisono Gunarto' }}">{{ $user->name ?? 'Jaiman Cawisono Gunarto' }}</span>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-4 border border-white/10">
                        <span
                            class="text-primary-200 text-xs uppercase tracking-wider font-semibold block mb-1">NIM</span>
                        <span
                            class="font-mono font-bold text-lg md:text-xl tracking-wide block">{{ $user->nim ?? '1986122504' }}</span>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-4 border border-white/10">
                        <span
                            class="text-primary-200 text-xs uppercase tracking-wider font-semibold block mb-1">Email</span>
                        <span class="font-bold text-lg md:text-xl truncate block"
                            title="{{ $user->email ?? 'jaiman@student.telkomuniversity.ac.id' }}">{{ $user->email ?? 'jaiman@student.telkomuniversity.ac.id' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <p class="text-xs md:text-sm text-primary-200/80 stagger-item flex items-center gap-2">
            <box-icon name="info-circle" class="h-5 w-4 fill-primary-200/80"></box-icon>
            <span>
                Pastikan data diatas benar. Jika terdapat kesalahan, hubungi panitia
                <a href="https://wa.me/6281387768990"
                    class="text-white font-semibold underline decoration-brand-accent hover:text-brand-accent transition-colors">
                    di sini.
                </a>
            </span>
        </p>
    </section>

    <section class="max-w-7xl mx-auto mt-12 md:mt-20 px-4 md:px-0 pb-20">
        <div class="grid grid-cols-1 gap-8 voting-type-grid">
            @forelse ($types as $type)
                <div
                    class="group relative bg-white rounded-[24px] md:rounded-[32px] p-1 shadow-lg hover:shadow-2xl transition-all duration-300 voting-type-card transform hover:-translate-y-1">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-primary-500 to-brand-accent rounded-[24px] md:rounded-[32px] opacity-0 group-hover:opacity-100 transition-opacity duration-300 -z-10 blur-sm">
                    </div>

                    <div
                        class="bg-white rounded-[20px] md:rounded-[28px] p-6 md:p-10 h-full flex flex-col md:flex-row items-center gap-8 md:gap-12">
                        <div class="flex-1 w-full">
                            <div class="flex items-center gap-4 mb-4">
                                <div
                                    class="w-12 h-12 rounded-full bg-primary-50 flex items-center justify-center text-primary-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                    </svg>
                                </div>
                                <h3 class="text-2xl md:text-3xl font-bold text-gray-900">{{ $type->name }}</h3>
                            </div>
                            <p class="text-gray-600 leading-relaxed text-base md:text-lg">
                                {{ $type->description }}
                            </p>
                        </div>

                        <div class="w-full md:w-auto flex-shrink-0">
                            <a href="{{ route('vote-candidate', $type->slug) }}"
                                class="group/btn relative inline-flex items-center justify-center w-full md:w-auto px-8 py-4 text-base font-bold text-white transition-all duration-200 bg-primary-600 rounded-full hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-600 shadow-lg shadow-primary-600/30 hover:shadow-primary-600/50 overflow-hidden">
                                <span
                                    class="absolute inset-0 w-full h-full -mt-1 rounded-lg opacity-30"></span>
                                <span class="relative flex items-center gap-2">
                                    Pilih Sekarang
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 transition-transform duration-300 group-hover/btn:translate-x-1"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                @if (!empty($votedTypeIds) || count($votedTypeIds) === count($types))
                    <div
                        class="bg-white rounded-[24px] p-10 text-center shadow-xl border border-gray-100 max-w-3xl mx-auto">
                        <div
                            class="w-20 h-20 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-6">
                            <box-icon name="check-circle" class="h-10 w-10 fill-green-600/80"></box-icon>
                        </div>
                        <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">Terima Kasih!</h3>
                        <p class="text-gray-600 text-lg leading-relaxed">
                            Anda telah menggunakan hak suara Anda untuk semua kategori. Partisipasi Anda sangat berarti
                            untuk masa depan organisasi.
                        </p>
                    </div>
                @else
                    <div
                        class="bg-white rounded-[24px] p-10 text-center shadow-xl border border-gray-100 max-w-3xl mx-auto">
                        <div
                            class="w-20 h-20 bg-gray-100 text-gray-400 rounded-full flex items-center justify-center mx-auto mb-6">
                            <box-icon name="info-circle" class="h-10 w-10 fill-gray-400/80"></box-icon>
                        </div>
                        <h3 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">Belum Ada Voting</h3>
                        <p class="text-gray-600 text-lg leading-relaxed">
                            Saat ini belum ada sesi pemilihan yang aktif. Silakan kembali lagi nanti atau hubungi
                            panitia jika Anda merasa ini adalah kesalahan.
                        </p>
                    </div>
                @endif
            @endforelse
        </div>
    </section>
</x-layout.landing>
