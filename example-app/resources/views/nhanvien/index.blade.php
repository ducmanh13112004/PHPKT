@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Danh sách Nhân viên</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Tên đăng nhập</th>
                    <th>Họ</th>
                    <th>Tên</th>
                    <th>Loại nhân viên</th>
                    <th>Ảnh</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($nhanViens as $nhanVien)
                    <tr>
                        <td>{{ $nhanVien->TenDN }}</td>
                        <td>{{ $nhanVien->Ho }}</td>
                        <td>{{ $nhanVien->Ten }}</td>
                        <td>{{ $nhanVien->LoaiNhanVien->TenLoai ?? 'Chưa có' }}</td>
                        <td>
                            @if ($nhanVien->image)
                                <img src="{{ asset('storage/' . $nhanVien->image) }}" alt="Ảnh nhân viên" width="50">
                            @else
                                Chưa có ảnh
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('nhanvien.edit', $nhanVien->TenDN) }}" class="btn btn-warning">Sửa</a>
                            <form action="{{ route('nhanvien.destroy', $nhanVien->TenDN) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('nhanvien.create') }}" class="btn btn-primary">Thêm nhân viên</a>
    </div>
@endsection
