<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LoaiNhanVien;
class LoaiNhanVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LoaiNhanVien::insert([
            ['TenLoai' => 'Nhân viên bán hàng', 'TrangThai' => 1],
            ['TenLoai' => 'Nhân viên Marketing', 'TrangThai' => 1],
            ['TenLoai' => 'Nhân viên kế toán', 'TrangThai' => 1],
        ]);
    }
}