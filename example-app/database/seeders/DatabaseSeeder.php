<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Gọi Seeder cho bảng LoaiNhanVien
        $this->call(LoaiNhanVienSeeder::class);

        // Gọi Seeder cho bảng NhanVien
        $this->call(NhanVienSeeder::class);
    }
}