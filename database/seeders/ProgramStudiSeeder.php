<?php

namespace Database\Seeders;

use App\Models\ProgramStudi;
use Illuminate\Database\Seeder;

class ProgramStudiSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['kode' => 'IF', 'nama' => 'Informatika'],
            ['kode' => 'SI', 'nama' => 'Sistem Informasi'],
            ['kode' => 'BD', 'nama' => 'Bisnis Digital'],
        ] as $programStudi) {
            ProgramStudi::updateOrCreate(
                ['kode' => $programStudi['kode']],
                [...$programStudi, 'jenjang' => 'S1', 'aktif' => true],
            );
        }
    }
}
