<?php

namespace Database\Factories;

use App\Models\Dosen;
use App\Models\KelasKuliah;
use App\Models\MataKuliah;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<KelasKuliah>
 */
class KelasKuliahFactory extends Factory
{
    protected $model = KelasKuliah::class;

    public function definition(): array
    {
        return [
            'mata_kuliah_id' => MataKuliah::factory(),
            'dosen_id' => Dosen::factory(),
            'nama_kelas' => strtoupper(fake()->unique()->lexify('??')),
            'tahun_akademik' => '2026/2027',
            'semester' => 'ganjil',
            'kapasitas' => 30,
        ];
    }
}
