<?php

namespace Database\Seeders;
use App\Models\NhanVien;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NhanVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NhanVien::insert([
            ['TenDN' => 'banhang01', 'Ho' => 'Nguyễn Văn', 'Ten' => 'A', 'HinhDaiDien' => 'banhang.jpg', 'MaLoaiNV' => 1],
            ['TenDN' => 'banhang02', 'Ho' => 'Nguyễn Thị', 'Ten' => 'B', 'HinhDaiDien' => 'banhang02.jpg', 'MaLoaiNV' => 1],
            ['TenDN' => 'marketing01', 'Ho' => 'Lê Văn', 'Ten' => 'C', 'HinhDaiDien' => 'marketing.jpg', 'MaLoaiNV' => 2],
            ['TenDN' => 'marketing02', 'Ho' => 'Trần Thị', 'Ten' => 'D', 'HinhDaiDien' => 'marketing02.jpg', 'MaLoaiNV' => 2],
            ['TenDN' => 'ketoan01', 'Ho' => 'Hoàng Văn', 'Ten' => 'E', 'HinhDaiDien' => 'ketoan.jpg', 'MaLoaiNV' => 3],
            ['TenDN' => 'ketoan02', 'Ho' => 'Phạm Thị', 'Ten' => 'F', 'HinhDaiDien' => 'ketoan02.jpg', 'MaLoaiNV' => 3],
        ]);
    }
}