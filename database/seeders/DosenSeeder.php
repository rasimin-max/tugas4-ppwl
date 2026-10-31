<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['nidn' => '0011223344', 'nama' => 'Dr. Andi Pratama', 'email' => 'andi.pratama@campusinfo.test'],
            ['nidn' => '0055667788', 'nama' => 'Dra. Siti Rahmawati', 'email' => 'siti.rahmawati@campusinfo.test'],
            ['nidn' => '0099887766', 'nama' => 'Ir. Budi Santoso', 'email' => 'budi.santoso@campusinfo.test'],
        ] as $dosen) {
            Dosen::updateOrCreate(
                ['email' => $dosen['email']],
                [...$dosen, 'aktif' => true],
            );
        }
    }
}
