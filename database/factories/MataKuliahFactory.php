<?php

namespace Database\Factories;

use App\Models\MataKuliah;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MataKuliah>
 */
class MataKuliahFactory extends Factory
{
    protected $model = MataKuliah::class;

    public function definition(): array
    {
        return [
            'kode' => fake()->unique()->bothify('MK###'),
            'nama' => fake()->unique()->words(3, true),
            'sks' => fake()->numberBetween(2, 4),
            'semester' => fake()->numberBetween(1, 8),
            'aktif' => true,
        ];
    }
}
