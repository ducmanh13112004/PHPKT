@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Quản lý Loại Nhân Viên</h1>

        <!-- Hiển thị thông báo thành công -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form Thêm/Sửa -->
        <form action="{{ route('loainhanvien.save') }}" method="POST">
            @csrf
            <input type="hidden" name="id" id="id" value="{{ old('id') }}">
            <div class="mb-3">
                <label for="TenLoai" class="form-label">Tên Loại</label>
                <input type="text" class="form-control" id="TenLoai" name="TenLoai" value="{{ old('TenLoai') }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="TrangThai" class="form-label">Trạng Thái</label>
                <select class="form-control" id="TrangThai" name="TrangThai">
                    <option value="1" {{ old('TrangThai') == '1' ? 'selected' : '' }}>Hoạt động</option>
                    <option value="0" {{ old('TrangThai') == '0' ? 'selected' : '' }}>Không hoạt động</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Lưu</button>
        </form>

        <!-- Danh sách LoaiNhanVien -->
        <div class="mt-5">
            <!-- Form tìm kiếm -->
            <form method="GET" action="{{ route('loainhanvien.index') }}">
                <div class="mb-3">
                    <input type="text" class="form-control" name="keyword" placeholder="Tìm kiếm..."
                        value="{{ $keyword ?? '' }}">
                </div>
                <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i> Tìm kiếm</button>
            </form>

            <!-- Bảng danh sách -->
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Mã Loại</th>
                        <th>Tên Loại</th>
                        <th>Trạng Thái</th>
                        <th>Chức Năng</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($loaiNhanViens as $loaiNhanVien)
                        <tr>
                            <td>{{ $loaiNhanVien->MaLoai }}</td>
                            <td>{{ $loaiNhanVien->TenLoai }}</td>
                            <td>{{ $loaiNhanVien->TrangThai == 1 ? 'Hoạt động' : 'Không hoạt động' }}</td>
                            <td>
                                <a href="{{ route('loainhanvien.toggleStatus', ['id' => $loaiNhanVien->MaLoai]) }}"
                                    class="btn btn-sm btn-info"><i class="fas fa-toggle-on"></i> Toggle</a>
                                <a href="javascript:void(0)" onclick="editLoaiNhanVien({{ json_encode($loaiNhanVien) }})"
                                    class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Sửa</a>
                                <a href="{{ route('loainhanvien.delete', ['id' => $loaiNhanVien->MaLoai]) }}"
                                    class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');"><i
                                        class="fas fa-trash"></i> Xóa</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Phân trang -->
            <div class="d-flex justify-content-center mt-3">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <!-- Kiểm tra nếu trang trước đó bị vô hiệu hóa -->
                        @if ($loaiNhanViens->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $loaiNhanViens->previousPageUrl() }}"
                                    aria-label="Previous">Previous</a>
                            </li>
                        @endif

                        <!-- Các số trang -->
                        @foreach ($loaiNhanViens->getUrlRange(1, $loaiNhanViens->lastPage()) as $page => $url)
                            <li class="page-item {{ $page == $loaiNhanViens->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}"
                                    aria-current="{{ $page == $loaiNhanViens->currentPage() ? 'page' : '' }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        <!-- Kiểm tra nếu trang tiếp theo bị vô hiệu hóa -->
                        @if ($loaiNhanViens->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $loaiNhanViens->nextPageUrl() }}" aria-label="Next">Next</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">Next</span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <script>
        function editLoaiNhanVien(item) {
            // Điền thông tin vào form khi nhấn "Sửa"
            document.getElementById('id').value = item.id;
            document.getElementById('TenLoai').value = item.TenLoai;
            document.getElementById('TrangThai').value = item.TrangThai;
        }
    </script>
@endsection
