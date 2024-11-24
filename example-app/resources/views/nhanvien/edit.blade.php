@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Sửa thông tin Nhân viên</h1>

        <!-- Hiển thị thông báo thành công hoặc lỗi -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('nhanvien.update', $nhanVien->TenDN) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Tên đăng nhập -->
            <div class="form-group">
                <label for="TenDN">Tên đăng nhập</label>
                <input type="text" class="form-control" id="TenDN" name="TenDN" value="{{ $nhanVien->TenDN }}"
                    readonly>
            </div>

            <!-- Họ -->
            <div class="form-group">
                <label for="Ho">Họ</label>
                <input type="text" class="form-control" id="Ho" name="Ho"
                    value="{{ old('Ho', $nhanVien->Ho) }}" required>
            </div>

            <!-- Tên -->
            <div class="form-group">
                <label for="Ten">Tên</label>
                <input type="text" class="form-control" id="Ten" name="Ten"
                    value="{{ old('Ten', $nhanVien->Ten) }}" required>
            </div>

            <!-- Loại nhân viên -->
            <div class="form-group">
                <label for="MaLoaiNV">Loại nhân viên</label>
                <select class="form-control" id="MaLoaiNV" name="MaLoaiNV" required>
                    @foreach ($loaiNhanViens as $loaiNhanVien)
                        <option value="{{ $loaiNhanVien->MaLoai }}"
                            {{ old('MaLoaiNV', $nhanVien->MaLoaiNV) == $loaiNhanVien->MaLoai ? 'selected' : '' }}>
                            {{ $loaiNhanVien->TenLoai }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Ảnh -->
            <div class="form-group">
                <label for="image">Ảnh nhân viên</label>
                <input type="file" class="form-control" id="image" name="image">
                @if ($nhanVien->image)
                    <p><strong>Ảnh hiện tại:</strong></p>
                    <img src="{{ asset('storage/' . $nhanVien->image) }}" alt="Ảnh nhân viên" width="100">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Cập nhật nhân viên</button>
        </form>
    </div>
@endsection
