<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LopHoc;

class LopHocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Tạo 10 lớp học, dữ liệu hoàn toàn ngẫu nhiên từ Factory
        LopHoc::factory()->count(10)->create();
    }
}
