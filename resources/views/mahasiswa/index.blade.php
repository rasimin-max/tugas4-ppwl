@extends('layouts.app')

@section('title', 'Data Mahasiswa')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">DATA AKADEMIK</p>
            <h1>Data Mahasiswa</h1>
            <p class="page-description">Selamat datang, {{ $administratorName }}. Berikut daftar mahasiswa dan statusnya.</p>
        </div>
        <div class="page-actions">
            <span class="date-chip">{{ now()->format('d M Y') }}</span>
            <x-button :href="route('dashboard')" variant="secondary">Kembali ke dashboard</x-button>
        </div>
    </div>

    <x-panel
        title="Daftar mahasiswa"
        description="Nama, nomor induk, program studi, dan status mahasiswa."
    >
        <x-slot:actions>
            <span class="table-count">{{ count($students) }} mahasiswa</span>
        </x-slot:actions>

        <x-table>
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
                            description="Data mahasiswa akan muncul di sini setelah tersedia."
                        />
                    </td>
                </tr>
            @endforelse
        </x-table>
    </x-panel>

    <p class="data-note">Data mahasiswa pada halaman ini merupakan data contoh untuk demonstrasi.</p>
@endsection
