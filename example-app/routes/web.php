<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoaiNhanVienController;
use App\Http\Controllers\NhanVienController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route mặc định
Route::get('/', function () {
    return view('welcome');
});

// Routes cho quản lý LoaiNhanVien
Route::prefix('loainhanvien')->group(function () {
    Route::get('/', [LoaiNhanVienController::class, 'index'])->name('loainhanvien.index'); // Hiển thị danh sách
    Route::post('/save', [LoaiNhanVienController::class, 'save'])->name('loainhanvien.save'); // Thêm/Sửa
    Route::get('/toggle-status/{id}', [LoaiNhanVienController::class, 'toggleStatus'])->name('loainhanvien.toggleStatus');    // Cập nhật trạng thái
    Route::get('/delete/{id}', [LoaiNhanVienController::class, 'delete'])->name('loainhanvien.delete');    // Xóa
});









// Trang danh sách nhân viên
Route::get('/nhanvien', [NhanVienController::class, 'index'])->name('nhanvien.index');

// Trang tạo mới nhân viên
Route::get('/nhanvien/create', [NhanVienController::class, 'create'])->name('nhanvien.create');

// Lưu nhân viên mới
Route::post('/nhanvien', [NhanVienController::class, 'store'])->name('nhanvien.store');

// Trang sửa thông tin nhân viên
Route::get('/nhanvien/{TenDN}/edit', [NhanVienController::class, 'edit'])->name('nhanvien.edit');

// Cập nhật thông tin nhân viên
Route::put('/nhanvien/{TenDN}', [NhanVienController::class, 'update'])->name('nhanvien.update');

// Xóa nhân viên
Route::delete('/nhanvien/{TenDN}', [NhanVienController::class, 'destroy'])->name('nhanvien.destroy');

// Route để thay đổi trạng thái của nhân viên (Ẩn/Hiện)
Route::post('nhanvien/toggle-status/{id}', [NhanVienController::class, 'toggleStatus'])->name('nhanvien.toggleStatus');