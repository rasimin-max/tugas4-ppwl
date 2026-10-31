<?php

namespace Database\Seeders;

use App\Models\MataKuliah;
use Illuminate\Database\Seeder;

class MataKuliahSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['kode' => 'IF101', 'nama' => 'Algoritma dan Pemrograman', 'sks' => 3, 'semester' => 1],
            ['kode' => 'IF202', 'nama' => 'Basis Data', 'sks' => 3, 'semester' => 2],
            ['kode' => 'IF303', 'nama' => 'Rekayasa Perangkat Lunak', 'sks' => 3, 'semester' => 3],
        ] as $mataKuliah) {
            MataKuliah::updateOrCreate(
                ['kode' => $mataKuliah['kode']],
                [...$mataKuliah, 'aktif' => true],
            );
        }
    }
}
