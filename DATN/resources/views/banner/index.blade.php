@extends("shared._layoutAdmin")
@section("title", "Quản lý Banner")

@section("content")
<h2 class="title_page">Quản lý Banner</h2>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<div class="box_content">
    <a class="box_link" href="{{route('banner.create')}}">Thêm Quảng Cáo</a>
    <div class="content px-3">
        <table class="table table-striped mt-4">
            <thead class="thead">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Loại Banner</th>
                    <th scope="col">Hình Ảnh</th>
                    <th scope="col">Hình Ảnh Mobile</th>
                    <th scope="col">Trạng Thái</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($listBanner as $banner)
                <tr>
                    <td>{{ $banner->id }}</td>
                    <td>{{ $bannerGroup[$banner->banner_group] ?? 'Không xác định' }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->banner_name }}" width="100">
                    </td>
                    <td>
                        <img src="{{ asset('storage/' . $banner->image_mobile) }}" alt="{{ $banner->banner_name }} Mobile" width="100">
                    </td>
                    <td><input type="checkbox" {{ $banner->active == 1 ? 'checked' : '' }} id="active_{{ $banner->id }}"></td>
                    <td>
                        <a class="btn btn-primary" href="javascript:;" onclick="updateBanner({{ $banner->id }})">Cập nhật</a>
                        <a href="{{ route('banner.edit', $banner->id) }}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('banner.destroy', $banner->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa banner này không?')">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$listBanner->links()}}
    </div>
</div>
<script>
    function updateBanner(id) {
        // Lấy giá trị từ các trường input
        
        var active = $('#active_' + id).prop('checked') ? 1 : 0; // Lấy trạng thái của checkbox (1: checked, 0: unchecked)
    
        $.ajax({
            url: '{{ route('banner.quickUpdate') }}', // Đường dẫn đến route xử lý cập nhật
            type: 'POST',
            data: {
                id: id,
                active: active,
                _token: '{{ csrf_token() }}' // CSRF token để bảo mật
            },
            success: function(response) {
                if (response.success) {
                    // Thông báo thành công đẹp mắt
                    toastr.success('Cập nhật thành công!', 'Thông báo', {
                        positionClass: 'toast-bottom-right',  // Vị trí thông báo
                        timeOut: 5000,  // Thời gian thông báo hiển thị
                        progressBar: true,  // Hiển thị thanh tiến trình
                        closeButton: true,  // Hiển thị nút đóng
                        newestOnTop: true,  // Hiển thị thông báo mới nhất ở trên cùng
                        preventDuplicates: true,  // Tránh hiển thị thông báo trùng lặp
                        backgroundColor: '#28a745',  // Màu nền xanh lá cây cho thông báo thành công
                        iconClass: 'toast-success',  // Icon thành công
                    });
                } else {
                    // Thông báo lỗi đẹp mắt
                    toastr.error('Có lỗi xảy ra, vui lòng thử lại!', 'Thông báo', {
                        positionClass: 'toast-bottom-right',  // Vị trí thông báo
                        timeOut: 5000,  // Thời gian thông báo hiển thị
                        progressBar: true,  // Hiển thị thanh tiến trình
                        closeButton: true,  // Hiển thị nút đóng
                        newestOnTop: true,  // Hiển thị thông báo mới nhất ở trên cùng
                        preventDuplicates: true,  // Tránh hiển thị thông báo trùng lặp
                        backgroundColor: '#dc3545',  // Màu nền đỏ cho thông báo lỗi
                        iconClass: 'toast-error',  // Icon lỗi
                    });
                }
            },
            error: function(xhr, active, error) {
                // Thông báo lỗi với chi tiết lỗi
                toastr.error('Lỗi: ' + error, 'Thông báo', {
                    positionClass: 'toast-bottom-right',  // Vị trí thông báo
                    timeOut: 5000,  // Thời gian thông báo hiển thị
                    progressBar: true,  // Hiển thị thanh tiến trình
                    closeButton: true,  // Hiển thị nút đóng
                    newestOnTop: true,  // Hiển thị thông báo mới nhất ở trên cùng
                    preventDuplicates: true,  // Tránh hiển thị thông báo trùng lặp
                    backgroundColor: '#ffc107',  // Màu nền vàng cho thông báo cảnh báo
                    iconClass: 'toast-warning',  // Icon cảnh báo
                });
            }
        });
    }
    
    
    </script>
@endsection
