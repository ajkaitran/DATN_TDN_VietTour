@extends("shared._layoutAdmin")
@section("title", "Register")

@section("content")
<h2 class="title_page">
    Quản lý Loại Tour
</h2>
@if ($errors->any())
<div class="alert alert-danger my-3">
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
    <a class="box_link" href="{{route('tourType.create')}}">Thêm loại tour</a>
    <div class="content px-3">
        <table class="table table-strped">
            <thead class="thead">
                <tr>
                    <th style="width: 50px;" scope="col">STT</th>
                    <th style="width: 250px;" scope="col">Hình Ảnh</th>
                    <th  scope="col">Tên Loại Tour</th>
                    <th  scope="col">Hiện menu</th>
                    <th  scope="col">Hiện trang chủ</th>
                    <th  scope="col">Hoạt động</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($tourtypes as $index => $items)
                <tr data-id="{{ $items->id }}">
                    <td>{{ $tourtypes->firstItem() + $index }}</td>
                    <td>
                        <img src="{{ $items->image?''.Storage::url($items->image):''}}" alt="logo_papo" style="width: 100%; object-fit: cover">
                    </td>
                    <td>{{ $items->name }}</td>
                    <td>
                        <input type="checkbox" name="show_menu" id="show_menu_{{ $items->id }}" value="1"
                            {{ old('show_menu', $items->show_menu ?? 0) == 1 ? 'checked' : '' }}>
                    </td>
                    <td>
                        <input type="checkbox" name="show_home" id="show_home_{{ $items->id }}" value="1"
                            {{ old('show_home', $items->show_home ?? 0) == 1 ? 'checked' : '' }}>
                    </td>
                    <td>
                        <input type="checkbox" name="active" id="active_{{ $items->id }}" value="1"
                            {{ old('active', $items->active ?? 0) == 1 ? 'checked' : '' }}>
                    </td>
                    <td>
                        <a class="btn btn-primary" href="javascript:;" onclick="updateType({{ $items->id }})">Cập nhật</a>
                        <a class="btn btn-warning" href="{{ route ('tourType.edit', ['id'=>$items->id]) }}">Sửa</a>
                        <a class="btn btn-danger" href="{{ route ('tourType.destroy', ['id'=>$items->id]) }}">Xoá</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$tourtypes->links()}}
    </div>
</div>
<script>
    function updateType(id) {
        // Lấy giá trị từ các trường input
        var show_menu = $('#show_menu_' + id).prop('checked') ? 1 : 0;
        var show_home = $('#show_home_' + id).prop('checked') ? 1 : 0;
        var active = $('#active_' + id).prop('checked') ? 1 : 0;
    
        $.ajax({
            url: '{{ route('tourType.quickUpdate') }}', // Đường dẫn đến route xử lý cập nhật
            type: 'POST',
            data: {
                id: id,
                show_menu: show_menu,
                show_home: show_home,
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
            error: function(xhr, status, error) {
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