<x-layout.landing title="Pemilihan PEMIRA {{ date('Y') }}">
    @pushOnce('vites')
        @vite(['resources/js/lib/boxicons.js', 'resources/css/addon/vote.css', 'resources/js/addon/vote-landing-page.js'])
    @endPushOnce

    @if ($rateLimiter['remaining'] <= 0 && $rateLimiter['reset_at'])
        <header
            data-remaining="{{ $rateLimiter['remaining'] }}"
            data-reset-at="{{ $rateLimiter['reset_at'] }}"
        ></header>
    @endif

    <div class="token-section" id="tokenSection">
        <div class="token-card">
            <div class="token-icon">
                <box-icon name='shield-alt-2' type='solid' color='#ffffff'></box-icon>
            </div>
            <h1 class="token-title">Verifikasi Token</h1>
            <p class="token-subtitle">Masukkan token voting Anda untuk melanjutkan ke halaman pemilihan kandidat</p>

            <div class="token-hint">
                <box-icon name='info-circle' color='#16a085'></box-icon>
                Masukkan token yang telah Anda terima untuk mengakses sistem
                voting
            </div>

            <div class="error-message" id="errorMessage">
                <box-icon name='error-circle' type='solid' color='#e74c3c'></box-icon>
                Token tidak valid! Silakan coba lagi.
            </div>

            <div class="token-input-group">
                <input type="text" class="token-input" id="tokenInput" placeholder="Masukkan Token" minlength="10"
                    maxlength="15" />
                <box-icon name='key' type='solid' color='#16a085' class="input-icon"></box-icon>
            </div>

            <button class="btn-verify" id="verifyBtn" data-verify-url="{{ route('vote.verify') }}">
                <box-icon name='check-circle' type='solid' color='#ffffff'></box-icon>
                Verifikasi Token
            </button>
        </div>
    </div>
</x-layout.landing>
