<aside class="sidebar">
    <p class="sidebar-label">MENU UTAMA</p>
    <nav aria-label="Navigasi utama">
        <a
            href="{{ route('dashboard') }}"
            @class(['sidebar-link', 'is-active' => request()->routeIs('dashboard')])
            @if (request()->routeIs('dashboard')) aria-current="page" @endif
        >
            <span class="nav-icon" aria-hidden="true">⌂</span>
            <span>Dashboard</span>
        </a>
        <a
            href="{{ route('mahasiswa.index') }}"
            @class(['sidebar-link', 'is-active' => request()->routeIs('mahasiswa.*')])
            @if (request()->routeIs('mahasiswa.*')) aria-current="page" @endif
        >
            <span class="nav-icon" aria-hidden="true">▤</span>
            <span>Data Mahasiswa</span>
        </a>
        <a
            href="{{ route('dashboard') }}#laporan"
            class="sidebar-link"
        >
            <span class="nav-icon" aria-hidden="true">▥</span>
            <span>Laporan</span>
        </a>
    </nav>

    <div class="sidebar-note">
        <span class="sidebar-note-mark" aria-hidden="true">i</span>
        <p>Data pada dashboard ini merupakan contoh untuk demonstrasi.</p>
    </div>
</aside>
