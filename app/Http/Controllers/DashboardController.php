<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $students = $this->sampleStudents();
        $studentCount = count($students);
        $activeCount = count(array_filter($students, fn (array $student): bool => $student['status'] === 'Aktif'));
        $leaveCount = count(array_filter($students, fn (array $student): bool => $student['status'] === 'Cuti'));
        $inactiveCount = count(array_filter($students, fn (array $student): bool => $student['status'] === 'Nonaktif'));

        $statistics = [
            [
                'label' => 'Total mahasiswa',
                'value' => number_format($studentCount, 0, ',', '.'),
                'change' => 'Terdaftar',
                'period' => 'seluruh status',
                'icon' => 'M',
                'tone' => 'blue',
            ],
            [
                'label' => 'Mahasiswa aktif',
                'value' => number_format($activeCount, 0, ',', '.'),
                'change' => 'Aktif',
                'period' => 'sedang menjalani studi',
                'icon' => 'A',
                'tone' => 'violet',
            ],
            [
                'label' => 'Mahasiswa cuti',
                'value' => number_format($leaveCount, 0, ',', '.'),
                'change' => 'Cuti',
                'period' => 'sedang mengambil cuti',
                'icon' => 'C',
                'tone' => 'green',
            ],
            [
                'label' => 'Mahasiswa nonaktif',
                'value' => number_format($inactiveCount, 0, ',', '.'),
                'change' => 'Nonaktif',
                'period' => 'tidak aktif saat ini',
                'icon' => 'N',
                'tone' => 'orange',
            ],
        ];

        return view('dashboard', [
            'administratorName' => 'Rasimin',
            'statistics' => $statistics,
            'students' => array_slice($students, 0, 5),
            'studentCount' => $studentCount,
        ]);
    }

    public function students(): View
    {
        $students = $this->sampleStudents();

        return view('mahasiswa.index', [
            'administratorName' => 'Rasimin',
            'students' => $students,
        ]);
    }

    private function sampleStudents(): array
    {
        return [
            [
                'name' => 'Alya Putri Ramadhani',
                'nim' => '2024101001',
                'program' => 'Informatika',
                'status' => 'Aktif',
            ],
            [
                'name' => 'Bima Aditya Pratama',
                'nim' => '2024101002',
                'program' => 'Sistem Informasi',
                'status' => 'Aktif',
            ],
            [
                'name' => 'Citra Maharani',
                'nim' => '2023101003',
                'program' => 'Informatika',
                'status' => 'Cuti',
            ],
            [
                'name' => 'Dimas Saputra',
                'nim' => '2022101004',
                'program' => 'Bisnis Digital',
                'status' => 'Nonaktif',
            ],
            [
                'name' => 'Eka Nur Aisyah',
                'nim' => '2024101005',
                'program' => 'Sistem Informasi',
                'status' => 'Aktif',
            ],
        ];
    }
}
