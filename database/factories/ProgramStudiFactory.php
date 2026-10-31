<?php

namespace Database\Factories;

use App\Models\ProgramStudi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProgramStudi>
 */
class ProgramStudiFactory extends Factory
{
    protected $model = ProgramStudi::class;

    public function definition(): array
    {
        return [
            'kode' => fake()->unique()->bothify('PS###'),
            'nama' => fake()->unique()->words(2, true),
            'jenjang' => 'S1',
            'aktif' => true,
        ];
    }
}
