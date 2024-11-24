<?php

namespace App\Http\Controllers;

use App\Models\NhanVien;
use App\Models\LoaiNhanVien;
use Illuminate\Http\Request;
// app/Http/Controllers/NhanVienController.php

use Illuminate\Support\Facades\Storage;

class NhanVienController extends Controller
{
    public function index()
    {
        // Lấy tất cả nhân viên từ cơ sở dữ liệu
        $nhanViens = NhanVien::all();

        // Trả về view với danh sách nhân viên
        return view('nhanvien.index', compact('nhanViens'));
    }
    public function create()
    {
        $loaiNhanViens = LoaiNhanVien::all();
        return view('nhanvien.create', compact('loaiNhanViens'));
    }
    // Thêm mới nhân viên
    public function store(Request $request)
    {
        $request->validate([
            'TenDN' => 'required|unique:nhan_viens',
            'Ho' => 'required',
            'Ten' => 'required',
            'MaLoaiNV' => 'required|exists:loai_nhan_viens,MaLoai',
            'HinhDaiDien' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Kiểm tra hình ảnh
        ]);

        $nhanVien = new NhanVien();
        $nhanVien->TenDN = $request->TenDN;
        $nhanVien->Ho = $request->Ho;
        $nhanVien->Ten = $request->Ten;
        $nhanVien->MaLoaiNV = $request->MaLoaiNV;

        // Xử lý tải lên hình ảnh
        if ($request->hasFile('HinhDaiDien')) {
            $path = $request->file('HinhDaiDien')->store('avatars', 'public');
            $nhanVien->HinhDaiDien = $path;
        }

        $nhanVien->save();

        return redirect()->route('nhanvien.index')->with('success', 'Thêm nhân viên thành công!');
    }

    public function update(Request $request, $TenDN)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'Ho' => 'required|string|max:255',
            'Ten' => 'required|string|max:255',
            'MaLoaiNV' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Tìm nhân viên theo tên đăng nhập
        $nhanVien = NhanVien::where('TenDN', $TenDN)->first();

        // Cập nhật thông tin nhân viên
        $nhanVien->Ho = $request->Ho;
        $nhanVien->Ten = $request->Ten;
        $nhanVien->MaLoaiNV = $request->MaLoaiNV;

        // Kiểm tra và lưu ảnh mới nếu có
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($nhanVien->image && Storage::exists('public/' . $nhanVien->image)) {
                Storage::delete('public/' . $nhanVien->image);
            }

            // Lưu ảnh mới
            $imagePath = $request->file('image')->store('images', 'public');
            $nhanVien->image = $imagePath;
        }

        // Lưu thông tin nhân viên
        $nhanVien->save();

        // Thông báo thành công
        return redirect()->route('nhanvien.index')->with('success', 'Cập nhật nhân viên thành công!');
    }

    // Xóa nhân viên
    public function destroy($TenDN)
    {
        $nhanVien = NhanVien::findOrFail($TenDN);

        // Xóa hình ảnh nếu có
        if ($nhanVien->HinhDaiDien && Storage::exists('public/' . $nhanVien->HinhDaiDien)) {
            Storage::delete('public/' . $nhanVien->HinhDaiDien);
        }

        $nhanVien->delete();

        return redirect()->route('nhanvien.index')->with('success', 'Xóa nhân viên thành công!');
    }
}