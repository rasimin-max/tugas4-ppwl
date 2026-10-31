<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\ProgramStudi;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        if (Mahasiswa::exists()) {
            return;
        }

        $programStudi = ProgramStudi::query()->orderBy('id')->get();

        if ($programStudi->isEmpty()) {
            throw new \RuntimeException('Program studi harus di-seed sebelum mahasiswa.');
        }

        foreach (range(0, 49) as $index) {
            Mahasiswa::factory()
                ->for($programStudi[$index % $programStudi->count()])
                ->create();
        }
    }
}
