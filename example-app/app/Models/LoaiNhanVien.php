<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoaiNhanVien extends Model
{
    use HasFactory;

    protected $table = 'loai_nhan_viens';

    protected $primaryKey = 'MaLoai';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['TenLoai', 'TrangThai'];

    public function nhanViens()
    {
        return $this->hasMany(NhanVien::class, 'MaLoaiNV', 'MaLoai');
    }
}