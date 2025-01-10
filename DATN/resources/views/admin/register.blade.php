@extends("shared._layoutAdmin")
@section("title", "Register")

@section("content")
<h2 class="title_page">
    Quản lý Admin
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
    <form action="{{ route('admin.postRegister') }}" method="post">
        @csrf
        <div class="row ">
            <div class="col-6 mx-auto">
                <div class="form-group d-flex">
                    <label for="" class="form_ext">UserName</label>
                    <input type="text" class="input-text form-control w-75" name="username" placeholder="abc123"
                        value="{{ old('username') }}">
                </div>
                <div class="form-group d-flex">
                    <label for="" class="form_ext">Email</label>
                    <input type="text" class="input-text form-control w-75" name="email" placeholder="abc@gmail.com"
                        value="{{ old('email') }}">
                </div>
                <div class="form-group d-flex">
                    <label for="" class="form_ext">Password</label>
                    <input type="password" class="input-text form-control w-75" name="password" placeholder="*********">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Đăng Ký Tài Khoản</button>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="box_content">
    <div class="content p-3">
        <table class="table table-strped mt-4">
            <thead>
                <tr>
                    <th style="width: 80px;" scope="col">STT</th>
                    <th style="width: 200px;" scope="col">Tên</th>
                    <th style="width: 200px; text-align: start" scope="col">Tài khoản</th>
                    <th style="width: 200px;" scope="col">Hình ảnh</th>
                    <th style="width: 120px;" scope="col">Hoạt động</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($listAdmin as $index => $items)
                <tr data-id="{{ $items->id }}">
                    <td>{{$listAdmin->firstItem() + $index}}</td>
                    <td>{{$items->username}}</td>
                    <td>
                        <select id="role_{{ $items->id }}" class="form-control" {{ $items->role == 0 ? 'disabled' : '' }}>
                            @foreach($roles as $key => $value)
                            <option value="{{ $key }}" {{ $items->role == $key ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        @if(!isset($items->image))
                        <strong>NO PHOTO</strong>
                        @else
                            <img src="{{Storage::url($items->image)}}" style="width: 150px; height: 50px; object-fit: cover">
                        @endif
                    </td>
                    <td>
                        <input type="checkbox" {{ $items->role == 0 ? 'disabled' : '' }} {{ $items->status == 1 ? 'checked' : '' }} id="status_{{ $items->id }}">
                    </td>
                    <td class="d-flex justify-content-around py-4">
                        <a class="btn btn-primary" href="javascript:;" onclick="updateUser({{ $items->id }})">Cập nhật</a>
                        <a href="{{route('admin.changePassword',['id'=>$items->id])}}" class="btn btn-warning">Đổi mật khẩu</a>
                        @if(Auth::check() && Auth::user()->role == 0)
                        <a class="btn btn-danger"  href="{{route('admin.destroy',['id'=>$items->id])}}">Xóa Tài Khoản</a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>            
        </table>
        {{$listAdmin->links()}}
    </div>
</div>
<script>
function updateUser(id) {
    // Lấy giá trị từ các trường input
    var role = $('#role_' + id).val();
    var status = $('#status_' + id).prop('checked') ? 1 : 0; // Lấy trạng thái của checkbox (1: checked, 0: unchecked)

    $.ajax({
        url: '{{ route('admin.quickUpdate') }}', // Đường dẫn đến route xử lý cập nhật
        type: 'POST',
        data: {
            id: id,
            role: role,
            status: status,
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