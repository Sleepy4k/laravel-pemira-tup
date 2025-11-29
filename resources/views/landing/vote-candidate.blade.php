<x-layout.landing title="Pilih Calon {{ $type->name }} Kamu!">
    @pushOnce('vites')
        @vite(['resources/js/addon/vote-candidate-landing-page.js'])
    @endPushOnce

    <div class="fixed top-6 left-6 z-50 mt-[8dvh]">
        <a href="{{ route('voting') }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-white rounded-full shadow-lg border border-gray-200 text-gray-700 font-medium hover:bg-gray-50 hover:shadow-xl transition-all duration-300">
            <box-icon name="arrow-back" class="h-5 w-5"></box-icon>
            <span>Kembali</span>
        </a>
    </div>

    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Pilih Calon {{ $type->name }}</h2>
                <p class="mt-2 text-gray-600">Silakan pilih salah satu calon di bawah ini untuk memberikan suara Anda.
                </p>
            </div>

            @forelse ($type->candidates as $index => $candidate)
                @if ($candidate->is_blank)
                    <div class="max-w-6xl w-full mx-auto mb-12 last:mb-0">
                        <div
                            class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden flex flex-col lg:flex-row transition-all duration-300 hover:shadow-2xl hover:border-primary-100 group/card">
                            <div class="w-full lg:w-2/4 relative bg-gray-200 overflow-hidden">
                                <img src="{{ $candidate->photo }}" alt="Kotak Kosong"
                                    class="w-full h-full object-cover object-center transition-transform duration-700 group-hover/card:scale-105 grayscale opacity-80">

                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-90">
                                </div>

                                <div class="absolute bottom-0 left-0 w-full p-6 text-white">
                                    <p class="text-xs font-medium opacity-80 uppercase tracking-widest mb-1">Pilihan Alternatif</p>
                                    <h2 class="text-3xl font-bold leading-tight">Nomor Urut {{ $index + 1 }}</h2>
                                </div>
                            </div>

                            <div class="w-full lg:w-2/4 p-8 md:p-10 flex flex-col">
                                <div class="flex-grow">
                                    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 mb-6">
                                        <div>
                                            <h2
                                                class="text-3xl font-bold text-gray-900 mb-2 group-hover/card:text-primary-600 transition-colors">
                                                {{ $candidate->name }}
                                            </h2>
                                            <div
                                                class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-sm font-medium">
                                                Opsi Abstain
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex flex-col gap-6 mb-8">
                                        <div class="bg-gray-50 rounded-2xl p-6 w-full">
                                            <div class="flex items-center gap-2 mb-3">
                                                <box-icon name='info-circle' class="fill-gray-500"></box-icon>
                                                <h3
                                                    class="text-lg font-bold text-gray-900 uppercase tracking-wide group-hover/card:text-primary-600 transition-colors">
                                                    Keterangan
                                                </h3>
                                            </div>
                                            <p class="text-gray-600 leading-relaxed text-sm">
                                                Pilihan ini disediakan bagi pemilih yang merasa tidak ada kandidat yang sesuai dengan aspirasi mereka. Memilih kotak kosong berarti Anda menggunakan hak suara Anda untuk menyatakan tidak memilih pasangan calon yang tersedia.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-100 mt-auto">
                                    <button id="select-candidate-btn" data-candidate-id="{{ $candidate->id }}" data-vote-url="{{ route('vote-candidate.submit', ['type' => $type->slug, 'candidate' => $candidate->id]) }}" data-user-id="{{ auth('web')->id() }}"
                                        class="w-full px-6 py-3.5 rounded-xl bg-gray-800 text-white font-bold shadow-lg shadow-gray-600/20 hover:shadow-gray-600/40 hover:bg-gray-900 hover:-translate-y-0.5 transition-all duration-300 flex justify-center items-center gap-2 cursor-pointer">
                                        <box-icon name="check-circle" type="solid"
                                            class="h-5 w-5 fill-white/90"></box-icon>
                                        <span>Pilih Kotak Kosong</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="max-w-6xl w-full mx-auto mb-12 last:mb-0">
                        <div
                            class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden flex flex-col lg:flex-row transition-all duration-300 hover:shadow-2xl hover:border-primary-100 group/card">
                            <div class="w-full lg:w-2/4 relative bg-gray-100 overflow-hidden">
                                <img src="{{ $candidate->photo }}" alt="Foto {{ $candidate->name }}"
                                    class="w-full h-full object-cover object-top transition-transform duration-700 group-hover/card:scale-105">

                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-90">
                                </div>

                                <div class="absolute bottom-0 left-0 w-full p-6 text-white">
                                    <p class="text-xs font-medium opacity-80 uppercase tracking-widest mb-1">Kandidat</p>
                                    <h2 class="text-3xl font-bold leading-tight">Nomor Urut {{ $index + 1 }}</h2>
                                </div>
                            </div>

                            <div class="w-full lg:w-2/4 p-8 md:p-10 flex flex-col">
                                <div class="flex-grow">
                                    <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4 mb-6">
                                        <div>
                                            <h2
                                                class="text-3xl font-bold text-gray-900 mb-2 group-hover/card:text-primary-600 transition-colors">
                                                {{ $candidate->name }}
                                            </h2>
                                            <div
                                                class="inline-flex items-center px-3 py-1 rounded-full bg-primary-50 text-primary-700 text-sm font-medium">
                                                Calon {{ $type->name }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex flex-col gap-6 mb-8">
                                        <div class="bg-gray-50 rounded-2xl p-6 w-full">
                                            <div class="flex items-center gap-2 mb-3">
                                                <box-icon name='bulb' class="fill-primary-500"></box-icon>
                                                <h3
                                                    class="text-lg font-bold text-gray-900 uppercase tracking-wide group-hover/card:text-primary-600 transition-colors">
                                                    Visi
                                                </h3>
                                            </div>
                                            <p class="text-gray-600 leading-relaxed text-sm">
                                                {{ $candidate->vision->vision }}
                                            </p>
                                        </div>

                                        <div class="w-full px-2">
                                            <div class="flex items-center gap-2 mb-4">
                                                <box-icon name='list-check' class="fill-primary-500"></box-icon>
                                                <h3
                                                    class="text-lg font-bold text-gray-900 uppercase tracking-wide group-hover/card:text-primary-600 transition-colors">
                                                    Misi
                                                </h3>
                                            </div>
                                            <ul class="space-y-3 grid md:grid-cols-2 gap-x-8 gap-y-3">
                                                @foreach ($candidate->missions as $mission)
                                                    <li class="flex items-start gap-3 text-gray-600 text-sm group/item">
                                                        <span
                                                            class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary-400 flex-shrink-0 group-hover/item:bg-primary-600 transition-colors"></span>
                                                        <span class="leading-relaxed">{{ $mission->point }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-100 mt-auto">
                                    <button id="view-resume-btn" data-resume-url="{{ $candidate->resume }}"
                                        class="px-6 py-3.5 rounded-xl border-2 border-gray-200 text-gray-700 font-semibold hover:border-gray-300 hover:bg-gray-50 transition-all duration-300 flex justify-center items-center gap-2 group cursor-pointer">
                                        <box-icon name="file-pdf" type="solid"
                                            class="h-5 w-5 fill-gray-500 group-hover:fill-gray-700"></box-icon>
                                        <span>Lihat CV</span>
                                    </button>

                                    <button id="select-candidate-btn" data-candidate-id="{{ $candidate->id }}" data-vote-url="{{ route('vote-candidate.submit', ['type' => $type->slug, 'candidate' => $candidate->id]) }}" data-user-id="{{ auth('web')->id() }}"
                                        class="flex-1 px-6 py-3.5 rounded-xl bg-primary-600 text-white font-bold shadow-lg shadow-primary-600/20 hover:shadow-primary-600/40 hover:bg-primary-700 hover:-translate-y-0.5 transition-all duration-300 flex justify-center items-center gap-2 cursor-pointer">
                                        <box-icon name="check-circle" type="solid"
                                            class="h-5 w-5 fill-white/90"></box-icon>
                                        <span>Pilih Kandidat Ini</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @empty
                <div class="max-w-3xl w-full mx-auto">
                    <div
                        class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden flex flex-col md:flex-row transition-all duration-300 hover:shadow-2xl hover:border-primary-100 group/card p-8 md:p-10">
                        <div class="w-full flex flex-col items-center justify-center py-12">
                            <box-icon name="info-circle" type="solid" class="h-16 w-16 text-gray-400 mb-4"></box-icon>
                            <h2 class="text-2xl font-bold text-gray-800 mb-2 text-center">Belum Ada Kandidat
                            </h2>
                            <p class="text-gray-600 text-center">Saat ini belum ada kandidat untuk tipe
                                {{ $type->name }}. Silakan cek kembali nanti.</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <div id="view-resume-container"
            class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4 hidden z-100">
            <div class="bg-white rounded-2xl shadow-lg w-full max-w-4xl h-full md:h-4/5 overflow-hidden flex flex-col">
                <div class="flex items-center justify-between p-4 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900">Curriculum Vitae</h3>
                    <button id="close-resume-btn"
                        class="text-gray-500 hover:text-gray-700 transition-colors cursor-pointer">
                        <box-icon name="x" class="h-6 w-6"></box-icon>
                    </button>
                </div>
                <div class="flex-grow" id="resume-embed"></div>
            </div>
        </div>
    </section>
</x-layout.landing>
