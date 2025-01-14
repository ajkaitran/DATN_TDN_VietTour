@extends('shared._layoutAdmin')
@section('title', 'Quản lý Banner')

@section('content')
<h2 class="title_page">Danh Sách Đơn Hàng</h2>

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
<form action="{{ route('admin.listOrder') }}" method="GET">
    <div class="row mx-auto">
        <div class="col-6">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Tên Khách Hàng" name="customer_name" value="{{ request('customer_name') }}">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Tên Tour" name="tour_name" value="{{ request('tour_name') }}">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Mã Đơn Hàng" name="order_code" value="{{ request('order_code') }}">
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <select class="form-control" name="payment_method">
                    <option value="">Phương Thức Thanh Toán</option>
                    @foreach($payments as $key => $value)
                        <option value="{{ $key }}" {{ request('payment_method') == $key ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group">
                <select class="form-control" name="status">
                    <option value="">Trạng Thái Đơn Hàng</option>
                    @foreach($status as $key => $value)
                        <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Lọc dữ liệu</button>
    </div>
</form>


</div>
<div class="box_content">
    <div class="content px-3">
        <table class="table table-striped mt-4">
            <thead class="thead">
                <tr>
                    <th style="width: 150px;" scope="col">Ngày Đặt</th>
                    <th style="text-align: start" scope="col">Thông Tin Đơn hàng</th>
                    <th style="width: 200px;" scope="col">Trạng Thái Đơn Hàng</th>
                    <th style="width: 220px;"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listOrder as $items)
                <tr>
                    <td>{{ $items->created_at->format('d-m-Y') }}</td>
                    <td>
                        <div class="tbody-item-column">
                            <p><strong>{{ $items->product->name ?? 'Không có tên tour' }}</strong></p>
                            <div class="tbody-item-flex">
                                <p>{{ $items->customer_info_full_name ?? 'Khách hàng tiềm năng'}}</p>
                                <p>Hình thức thanh toán: {{ $payments[$items->payment] ?? 'Không xác định' }}</p>
                            </div>
                            <div class="tbody-item-flex">
                                <p>Mã đơn hàng: {{ $items->oder_code }}</p>
                                <p>Ngày xuất phát: {{ \Carbon\Carbon::parse($items->created_at)->format('H:i d-m-Y') }}</p>
                            </div>
                            <div class="tbody-item-flex">
                                <p>Số lượng: {{ $items->quantity }}</p>
                                <p>Tổng tiền: {{ number_format($items->price, 0, ',', '.') }}đ</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <select id="status_{{ $items->id }}" class="form-control">
                            @foreach($status as $key => $value)
                            <option value="{{ $key }}" {{ $items->status == $key ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <a class="btn btn-success" href="javascript:;" onclick="updateOrder({{ $items->id }})">Cập Nhật</a>
                        <a class="btn btn-primary" href="{{ route('tour.edit', ['id'=>$items->id]) }}">Chi Tiết</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    {{$listOrder->links()}}
</div>
</div>
<script>
    function updateOrder(id) {
        var status = $('#status_' + id).val();
    
        $.ajax({
            url: '{{ route('admin.quickUpdateOrder') }}', 
            type: 'POST',
            data: {
                id: id,
                status: status,
                _token: '{{ csrf_token() }}' 
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