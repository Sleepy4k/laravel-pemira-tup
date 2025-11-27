<x-layout.landing title="Terima Kasih atas Partisipasi Anda dalam PEMIRA {{ date('Y') }}">
    @pushOnce('vites')
        @vite(['resources/js/lib/boxicons.js', 'resources/css/addon/vote-thankyou.css', 'resources/js/addon/vote-thankyou-page.js'])
    @endPushOnce

    <header data-end-time="{{ $endTime }}"></header>

    <div class="thankyou-container">
        <div class="thankyou-card">
            <div class="thankyou-icon">
                <box-icon name='check-circle' type='solid' color='#27ae60' size='80px'></box-icon>
            </div>
            <h1 class="thankyou-title">Terima Kasih!</h1>
            <p class="thankyou-subtitle">Suara Anda telah berhasil direkam.</p>

            <div class="countdown-section">
                <p class="countdown-text">Hasil pemilihan akan diumumkan dalam:</p>
                <div class="countdown-timer" id="countdownTimer">
                    <span id="days">00</span>d :
                    <span id="hours">00</span>h :
                    <span id="minutes">00</span>m :
                    <span id="seconds">00</span>s
                </div>
            </div>

            <div class="info-box">
                <box-icon name='info-circle' color='#2980b9'></box-icon>
                Sementara menunggu hasil, Anda dapat menutup halaman ini atau kembali ke beranda.
            </div>

            <div class="button-section">
                <a href="{{ route('landing') }}" class="btn btn-home">
                    <box-icon name='home' type='solid' color='#ffffff'></box-icon>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</x-layout.landing>
