<x-layout.landing title="Kandidat {{ date('Y') }}">
    @pushOnce('vites')
        @vite(['resources/js/lib/boxicons.js', 'resources/css/addon/candidate.css', 'resources/js/addon/candidate-landing-page.js'])
    @endPushOnce

    <div class="container">
        <div class="section-title">
            <h2>Kandidat Pasangan Calon</h2>
            <p>Pilih kandidat terbaik untuk masa depan yang lebih baik</p>
        </div>

        @forelse ($candidates as $candidate)
            <div class="candidate-card">
                <div class="card-content">
                    <div class="photo-section">
                        <div class="photo-wrapper">
                            <div class="candidate-number">{{ $candidate->number }}</div>
                            <img src="{{ $candidate->photo }}" alt="Kandidat {{ $candidate->number }}">
                        </div>
                        <div class="candidate-name">
                            <h3>{{ $candidate->name }}</h3>
                            <p>Ketua & Wakil Ketua</p>
                        </div>
                    </div>

                    <div class="info-section">
                        <div class="sub-section">
                            <h4><box-icon name='bullseye' color='#16a085'></box-icon> Visi</h4>
                            <p class="vision-text">
                                {{ Str::limit($candidate->vision->vision, 130, '...') }}
                            </p>
                        </div>
                        <div>
                            <h4><box-icon name='bullseye' color='#16a085'></box-icon> Misi</h4>
                            <ul class="info-list">
                                @foreach ($candidate->missions as $index => $mission)
                                    <li>
                                        <span class="number">{{ $index + 1 }}</span>
                                        <span>{{ $mission->point }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="info-section">
                        <h4><box-icon name='clipboard' color='#16a085'></box-icon> Program Kerja</h4>
                        <ul class="info-list">
                            @foreach ($candidate->programs as $index => $program)
                                <li>
                                    <span class="number">{{ $index + 1 }}</span>
                                    <span>{{ $program->point }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="button-section">
                        <button class="btn btn-pdf" id="download-resume-{{ $candidate->number }}"
                            data-url="{{ $candidate->resume }}">
                            <box-icon name='file-pdf' type='solid' color='#16a085'></box-icon>
                            <span>Download CV</span>
                        </button>
                        <button class="btn btn-visimisi" id="download-attachment-{{ $candidate->number }}"
                            data-url="{{ $candidate->attachment }}">
                            <box-icon name='file-pdf' type='solid' color='#16a085'></box-icon>
                            <span>Visi Misi & Proker</span>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <div class="empty-card">
                    <div class="empty-illustration" aria-hidden="true">
                        <svg width="220" height="140" viewBox="0 0 220 140" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="4" y="10" width="212" height="120" rx="12" fill="#16a085" />
                            <g opacity="1" transform="translate(18,18)">
                                <circle cx="36" cy="36" r="28" fill="#E8F8F5" />
                                <path d="M64 28c0 12-10 22-22 22s-22-10-22-22 10-22 22-22 22 10 22 22z"
                                    fill="#16a085" />
                                <rect x="84" y="10" width="88" height="14" rx="6" fill="#E6F7F2" />
                                <rect x="84" y="34" width="62" height="10" rx="5" fill="#F0FAF8" />
                                <rect x="84" y="52" width="88" height="10" rx="5" fill="#F0FAF8" />
                                <rect x="84" y="74" width="52" height="10" rx="5" fill="#F0FAF8" />
                            </g>
                        </svg>
                    </div>

                    <h3 class="empty-title">Belum ada kandidat</h3>
                    <p class="empty-text">
                        Saat ini belum tersedia pasangan calon. Silakan muat ulang halaman atau kembali ke beranda.
                        Jika Anda menduga ada kesalahan, laporkan ke panitia.
                    </p>

                    <div class="empty-actions">
                        <button class="btn btn-primary" id="reload-page-btn" type="button"
                            aria-label="Muat ulang halaman">
                            Muat Ulang
                        </button>

                        <a href="{{ url('/') }}" class="btn btn-secondary" role="button"
                            aria-label="Kembali ke beranda">
                            Kembali ke Beranda
                        </a>

                        <a href="https://www.instagram.com/pemirahmsi.tup" class="btn btn-outline" role="button"
                            aria-label="Laporkan ke panitia" target="_blank" rel="noopener">
                            Laporkan ke Panitia
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <div id="pdf-modal" class="pdf-modal">
        <div class="pdf-modal-content" id="pdf-modal-content"></div>
    </div>
</x-layout.landing>
