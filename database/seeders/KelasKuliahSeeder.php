<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\KelasKuliah;
use App\Models\MataKuliah;
use Illuminate\Database\Seeder;

class KelasKuliahSeeder extends Seeder
{
    public function run(): void
    {
        $mataKuliahs = MataKuliah::query()->orderBy('id')->get();
        $dosens = Dosen::query()->orderBy('id')->get();

        if ($mataKuliahs->isEmpty() || $dosens->isEmpty()) {
            throw new \RuntimeException('Mata kuliah dan dosen harus di-seed sebelum kelas kuliah.');
        }

        foreach ($mataKuliahs as $index => $mataKuliah) {
            foreach (['A', 'B'] as $namaKelas) {
                KelasKuliah::updateOrCreate(
                    [
                        'mata_kuliah_id' => $mataKuliah->id,
                        'nama_kelas' => $namaKelas,
                        'tahun_akademik' => '2026/2027',
                        'semester' => 'ganjil',
                    ],
                    [
                        'dosen_id' => $dosens[$index % $dosens->count()]?->id,
                        'kapasitas' => 30,
                    ],
                );
            }
        }
    }
}
