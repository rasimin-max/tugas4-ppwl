<header class="topbar">
    <a class="brand" href="{{ route('dashboard') }}" aria-label="CampusInfo, dashboard">
        <span class="brand-mark" aria-hidden="true">C</span>
        <span class="brand-copy">
            <strong>CampusInfo</strong>
            <small>PORTAL AKADEMIK</small>
        </span>
    </a>

    <span class="topbar-page-title">@yield('title', 'Dashboard Akademik')</span>

    <div class="topbar-right">
        <span class="semester-label">TA 2026/2027 <span aria-hidden="true">·</span> Ganjil</span>
        <span class="user-profile">
            <span class="user-name">{{ $administratorName }}</span>
            <span class="user-avatar" aria-label="Profil {{ $administratorName }}">
                {{ strtoupper(substr($administratorName, 0, 1)) }}
            </span>
        </span>
    </div>
</header>
