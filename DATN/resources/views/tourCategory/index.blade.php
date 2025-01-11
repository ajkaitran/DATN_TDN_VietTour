@extends('shared._layoutAdmin')
@section('title', 'Register')

@section('content')
    <h2 class="title_page">
        Quản lý Danh Mục Tour
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
        <form action="{{ route('tourCategory.index') }}" method="GET" class="mb-3 col-6">
            <div class="input-group flex justify-content-end">
                <input type="text" name="search" class="form-control mr-2" placeholder="Tìm kiếm tên danh mục..."
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            </div>
        </form>
        <a class="box_link" href="{{ route('tourCategory.create') }}">Thêm danh mục tour</a>
        <div class="content px-3">
            <table class="table table-strped">
                <thead class="thead">
                    <tr>
                        <th style="width: 50px;" scope="col">STT</th>
                        <th style="width: 250px;" scope="col">Tên danh mục</th>
                        <th style="width: 250px;" scope="col">Hình Ảnh</th>
                        <th style="width: 110px;" scope="col">Hoạt động</th>
                        <th style="width: 110px;" scope="col">Nổi bật</th>
                        <th style="width: 110px;" scope="col">Menu</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $items)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $items->name }}</td>
                            <td><img src="{{ Storage::url('categoryTour/' . $items->image) }}" alt=""
                                    class="object-fit-cover w-100"></td>
                            <td>
                                <input type="checkbox" id="active_{{ $items->id }}"
                                    {{ $items->active == 1 ? 'checked' : '' }}>
                            </td>
                            <td>
                                <input type="checkbox" id="hot_{{ $items->id }}"
                                    {{ $items->hot == 1 ? 'checked' : '' }}>
                            </td>
                            <td>
                                <input type="checkbox" id="home_page_{{ $items->id }}"
                                    {{ $items->home_page == 1 ? 'checked' : '' }}>
                            </td>
                            <td class="d-flex py-5">
                                <a class="btn btn-primary mr-2" href="javascript:;"
                                    onclick="updateCate({{ $items->id }})">Cập nhật</a>
                                <a class="btn btn-warning mr-2"
                                    href="{{ route('tourCategory.edit', ['id' => $items->id]) }}">Sửa</a>
                                <form action="{{ route('tourCategory.destroy', ['id' => $items->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $data->links() }}
        </div>
    </div>
    <script>
        function updateCate(id) {
            // Lấy giá trị từ các trường input
            var active = $('#active_' + id).prop('checked') ? 1 :
                0; // Lấy trạng thái của checkbox (1: checked, 0: unchecked)
            var hot = $('#hot_' + id).prop('checked') ? 1 : 0; // Lấy trạng thái của checkbox (1: checked, 0: unchecked)
            var home_page = $('#home_page_' + id).prop('checked') ? 1 :
                0; // Lấy trạng thái của checkbox (1: checked, 0: unchecked)

            $.ajax({
                url: '{{ route('tourCategory.quickUpdate') }}', // Đường dẫn đến route xử lý cập nhật
                type: 'POST',
                data: {
                    id: id,
                    active: active,
                    hot: hot,
                    home_page: home_page,
                    _token: '{{ csrf_token() }}' // CSRF token để bảo mật
                },
                success: function(response) {
                    if (response.success) {
                        // Thông báo thành công đẹp mắt
                        toastr.success('Cập nhật thành công!', 'Thông báo', {
                            positionClass: 'toast-bottom-right', // Vị trí thông báo
                            timeOut: 5000, // Thời gian thông báo hiển thị
                            progressBar: true, // Hiển thị thanh tiến trình
                            closeButton: true, // Hiển thị nút đóng
                            newestOnTop: true, // Hiển thị thông báo mới nhất ở trên cùng
                            preventDuplicates: true, // Tránh hiển thị thông báo trùng lặp
                            backgroundColor: '#28a745', // Màu nền xanh lá cây cho thông báo thành công
                            iconClass: 'toast-success', // Icon thành công
                        });
                    } else {
                        // Thông báo lỗi đẹp mắt
                        toastr.error('Có lỗi xảy ra, vui lòng thử lại!', 'Thông báo', {
                            positionClass: 'toast-bottom-right', // Vị trí thông báo
                            timeOut: 5000, // Thời gian thông báo hiển thị
                            progressBar: true, // Hiển thị thanh tiến trình
                            closeButton: true, // Hiển thị nút đóng
                            newestOnTop: true, // Hiển thị thông báo mới nhất ở trên cùng
                            preventDuplicates: true, // Tránh hiển thị thông báo trùng lặp
                            backgroundColor: '#dc3545', // Màu nền đỏ cho thông báo lỗi
                            iconClass: 'toast-error', // Icon lỗi
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Thông báo lỗi với chi tiết lỗi
                    toastr.error('Lỗi: ' + error, 'Thông báo', {
                        positionClass: 'toast-bottom-right', // Vị trí thông báo
                        timeOut: 5000, // Thời gian thông báo hiển thị
                        progressBar: true, // Hiển thị thanh tiến trình
                        closeButton: true, // Hiển thị nút đóng
                        newestOnTop: true, // Hiển thị thông báo mới nhất ở trên cùng
                        preventDuplicates: true, // Tránh hiển thị thông báo trùng lặp
                        backgroundColor: '#ffc107', // Màu nền vàng cho thông báo cảnh báo
                        iconClass: 'toast-warning', // Icon cảnh báo
                    });
                }
            });
        }
    </script>

@endsection
