<nav>
    <div class="logo">
        <div class="logos-container">
            <div class="logo-item logo-1">
                <img src="{{ asset('images/si.png') }}" alt="HIMASI Logo" loading="lazy">
            </div>
            <div class="logo-item logo-2">
                <img src="{{ $logo }}" alt="PEMIRA Logo" loading="lazy">
            </div>
        </div>
    </div>

    <ul class="nav-links">
        <li><a href="{{ route('landing') }}" class="{{ request()->routeIs('landing') ? 'active' : '' }}">Beranda</a></li>
        <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">Tentang</a></li>
        <li><a href="{{ route('timeline') }}" class="{{ request()->routeIs('timeline') ? 'active' : '' }}">Timeline</a></li>
        <li><a href="{{ route('candidates') }}" class="{{ request()->routeIs('candidates') ? 'active' : '' }}">Kandidat</a></li>
    </ul>

    <div class="nav-buttons">
        @if (auth('web')->check())
            <button class="btn-login" id="dashboard-button" data-redirect="{{ route('dashboard') }}">Dashboard</button>
        @else
            <button class="btn-login" id="login-button" data-redirect="{{ route('signin') }}">Masuk</button>
        @endif
        <button class="btn-vote" id="vote-button" data-redirect="{{ route('vote.index') }}">Mulai Voting</button>
    </div>
</nav>
