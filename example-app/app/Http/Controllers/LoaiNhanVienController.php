<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiNhanVien;

class LoaiNhanVienController extends Controller
{
    // Hiển thị giao diện quản lý LoaiNhanVien
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');
        $loaiNhanViens = LoaiNhanVien::when($keyword, function ($query, $keyword) {
            $query->where('TenLoai', 'like', "%{$keyword}%");
        })->paginate(3); // Phân trang 5 kết quả mỗi trang

        return view('loainhanvien.index', compact('loaiNhanViens', 'keyword'));
    }

    // Thêm hoặc sửa LoaiNhanVien
    public function save(Request $request)
    {
        $request->validate([
            'TenLoai' => 'required|unique:loai_nhan_viens,TenLoai',
        ], [
            'TenLoai.required' => 'Tên Loại không được để trống',
            'TenLoai.unique' => 'Tên Loại đã tồn tại',
        ]);

        // Sử dụng 'MaLoai' thay vì 'id'
        LoaiNhanVien::updateOrCreate(
            ['MaLoai' => $request->id], // Thay 'id' bằng 'MaLoai'
            ['TenLoai' => $request->TenLoai, 'TrangThai' => $request->TrangThai ?? 1]
        );

        return redirect()->route('loainhanvien.index')->with('success', 'Lưu thành công!');
    }
    // Thêm hoặc sửa Loại Nhân Viên


    // Cập nhật trạng thái ẩn/hiện
    public function toggleStatus($MaLoai)
    {
        $loaiNhanVien = LoaiNhanVien::findOrFail($MaLoai); // Thay 'id' bằng 'MaLoai'
        $loaiNhanVien->TrangThai = $loaiNhanVien->TrangThai == 1 ? 0 : 1;
        $loaiNhanVien->save();
        return redirect()->route('loainhanvien.index')->with('success', 'Trạng thái đã được cập nhật.');
    }

    // Xoá LoaiNhanVien
    public function delete($MaLoai) // Thay 'id' bằng 'MaLoai'
    {
        $loaiNhanVien = LoaiNhanVien::findOrFail($MaLoai); // Tìm theo MaLoai thay vì id
        $loaiNhanVien->delete();

        return redirect()->route('loainhanvien.index')->with('success', 'Loại nhân viên đã được xóa');
    }
}