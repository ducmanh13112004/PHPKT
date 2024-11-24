@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Thêm mới Nhân viên</h1>

        <!-- Display any success or error messages -->
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

        <form action="{{ route('nhanvien.store') }}" method="POST">
            @csrf

            <!-- Tên đăng nhập -->
            <div class="form-group">
                <label for="TenDN">Tên đăng nhập</label>
                <input type="text" class="form-control" id="TenDN" name="TenDN" value="{{ old('TenDN') }}" required>
            </div>

            <!-- Họ -->
            <div class="form-group">
                <label for="Ho">Họ</label>
                <input type="text" class="form-control" id="Ho" name="Ho" value="{{ old('Ho') }}"
                    required>
            </div>

            <!-- Tên -->
            <div class="form-group">
                <label for="Ten">Tên</label>
                <input type="text" class="form-control" id="Ten" name="Ten" value="{{ old('Ten') }}"
                    required>
            </div>

            <!-- Loại nhân viên -->
            <div class="form-group">
                <label for="MaLoaiNV">Loại nhân viên</label>
                <select class="form-control" id="MaLoaiNV" name="MaLoaiNV" required>
                    @foreach ($loaiNhanViens as $loaiNhanVien)
                        <option value="{{ $loaiNhanVien->MaLoai }}"
                            {{ old('MaLoaiNV') == $loaiNhanVien->MaLoai ? 'selected' : '' }}>
                            {{ $loaiNhanVien->TenLoai }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Thêm nhân viên</button>
        </form>
    </div>
@endsection
