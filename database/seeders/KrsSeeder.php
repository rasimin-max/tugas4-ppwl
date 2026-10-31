<?php

namespace Database\Seeders;

use App\Models\KelasKuliah;
use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Services\KrsService;
use Illuminate\Database\Seeder;

class KrsSeeder extends Seeder
{
    public function run(): void
    {
        if (Krs::exists()) {
            return;
        }

        $mahasiswa = Mahasiswa::query()->orderBy('id')->firstOrFail();
        $kelasIds = KelasKuliah::query()->orderBy('id')->limit(3)->pluck('id')->all();

        if (count($kelasIds) < 3) {
            throw new \RuntimeException('Minimal tiga kelas kuliah harus di-seed sebelum KRS.');
        }

        app(KrsService::class)->createForMahasiswa(
            $mahasiswa,
            '2026/2027',
            'ganjil',
            $kelasIds,
        );
    }
}
