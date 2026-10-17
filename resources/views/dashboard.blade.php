@extends('layouts.app')

@section('title', 'Dashboard Mahasiswa')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">RINGKASAN AKADEMIK</p>
            <h1>Dashboard Mahasiswa</h1>
            <p class="page-description">Selamat datang, {{ $administratorName }}. Pantau data dan status mahasiswa.</p>
        </div>
        <div class="page-actions">
            <span class="date-chip">{{ now()->format('d M Y') }}</span>
            <x-button :href="route('mahasiswa.index')" variant="secondary">Data mahasiswa <span aria-hidden="true">↗</span></x-button>
        </div>
    </div>

    @if (session('success'))
        <x-alert variant="success" class="page-alert">{{ session('success') }}</x-alert>
    @endif

    <section id="laporan" class="stats-grid" aria-label="Laporan statistik mahasiswa">
        @foreach ($statistics as $statistic)
            <x-card class="stat-card">
                <div class="stat-topline">
                    <span class="stat-icon stat-icon-{{ $statistic['tone'] }}" aria-hidden="true">{{ $statistic['icon'] }}</span>
                    <span class="stat-change">{{ $statistic['change'] }}</span>
                </div>
                <p class="stat-label">{{ $statistic['label'] }}</p>
                <p class="stat-value">{{ $statistic['value'] }}</p>
                <p class="stat-period">{{ $statistic['period'] }}</p>
            </x-card>
        @endforeach
    </section>

    <div class="dashboard-grid">
        <x-panel
            id="daftar-mahasiswa"
            class="activities-card"
            title="Mahasiswa terbaru"
            description="Daftar mahasiswa dan status akademik."
        >
            <x-slot:actions>
                <span class="table-count">{{ count($students) }} dari {{ $studentCount }} mahasiswa</span>
            </x-slot:actions>

            <x-table class="activity-table">
                <x-slot:head>
                    <th scope="col">No.</th>
                    <th scope="col">Nama mahasiswa</th>
                    <th scope="col">NIM</th>
                    <th scope="col">Program studi</th>
                    <th scope="col">Status</th>
                </x-slot:head>

                @forelse ($students as $student)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="activity-name">{{ $student['name'] }}</td>
                        <td>{{ $student['nim'] }}</td>
                        <td>{{ $student['program'] }}</td>
                        <td>
                            @if ($student['status'] === 'Aktif')
                                <x-badge variant="success">Aktif</x-badge>
                            @elseif ($student['status'] === 'Cuti')
                                <x-badge variant="warning">Cuti</x-badge>
                            @else
                                <x-badge variant="danger">Nonaktif</x-badge>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <x-empty-state
                                title="Belum ada mahasiswa"
                                description="Data mahasiswa terbaru akan muncul di sini setelah tersedia."
                            />
                        </td>
                    </tr>
                @endforelse
            </x-table>
        </x-panel>

        <x-panel
            class="announcement-card"
            title="Status mahasiswa"
            description="Arti status yang digunakan pada daftar."
        >
            <div class="announcement-list">
                <article class="announcement-item">
                    <span class="announcement-dot dot-blue" aria-hidden="true"></span>
                    <div>
                        <h3>Aktif</h3>
                        <p>Mahasiswa terdaftar dan sedang menjalani studi.</p>
                    </div>
                </article>
                <article class="announcement-item">
                    <span class="announcement-dot dot-orange" aria-hidden="true"></span>
                    <div>
                        <h3>Cuti</h3>
                        <p>Mahasiswa sedang mengambil cuti akademik.</p>
                    </div>
                </article>
                <article class="announcement-item">
                    <span class="announcement-dot dot-gray" aria-hidden="true"></span>
                    <div>
                        <h3>Nonaktif</h3>
                        <p>Mahasiswa tidak aktif pada semester berjalan.</p>
                    </div>
                </article>
            </div>
            <x-slot:actions>
                <x-button :href="route('mahasiswa.index')" variant="quiet">Lihat semua mahasiswa <span aria-hidden="true">→</span></x-button>
            </x-slot:actions>
        </x-panel>
    </div>

    <p class="data-note">Data mahasiswa pada halaman ini merupakan data contoh untuk demonstrasi.</p>
@endsection
