<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhanVien extends Model
{
    use HasFactory;

    protected $primaryKey = 'TenDN'; // Định nghĩa khóa chính
    public $incrementing = false; // Khóa chính không tự động tăng
    protected $keyType = 'string'; // Định nghĩa kiểu của khóa chính là chuỗi
    protected $fillable = ['TenDN', 'Ho', 'Ten', 'HinhDaiDien', 'MaLoaiNV'];
    // Hàm trả về đường dẫn đầy đủ của ảnh đại diện
    public function getAvatarUrlAttribute()
    {
        return $this->avatar ? asset('storage/' . $this->avatar) : asset('images/default-avatar.png');
    }
    // Một nhân viên thuộc về một loại nhân viên
    public function loaiNhanVien()
    {
        return $this->belongsTo(LoaiNhanVien::class, 'MaLoaiNV', 'MaLoai');
    }
}