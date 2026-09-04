<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LopHocFactory extends Factory
{
    public function definition(): array
    {
        return [
            'ten_lop'    => 'Lớp ' . fake()->word(),
            'ma_lop'     => strtoupper(fake()->unique()->bothify('LH###')),
            'giao_vien'  => fake()->name(),
            'ghi_chu'    => fake()->optional()->sentence(),
            'si_so'      => fake()->numberBetween(20, 100),
            'trang_thai' => fake()->boolean(),
        ];
    }
}
