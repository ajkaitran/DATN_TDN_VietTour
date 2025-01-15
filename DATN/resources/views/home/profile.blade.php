@extends('shared._layoutMain')
@section('title', 'Register')

@section('content')

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
<section class="page_member">
    <div class="container">
        <div class="row">
            <!-- Tab tiêu đề -->
            <div class="col-4 border-end">
                <div class="info">
                    <div class="box_avt">
                        @if (!empty($user->image))
                        <img src="{{ Storage::url($user->image) }}" alt="Ảnh đại diện">
                        @else
                        <img src="{{ asset('images/avatar-mac-dinh.jpg') }}" alt="Ảnh mặc định">
                        @endif
                    </div>
                    <h2>{{ $user->name }}</h2>
                </div>
                <ul class="list_tabs">
                    <li>
                        <h3 class="list_title">Quản lý tài khoản</h3>
                    </li>
                    <li><a href="#tab1" class="tab-link active"><i class="fa-sharp fa-solid fa-file me-2"></i> Lịch sử
                            giao dịch</a></li>
                    <li><a href="#tab2" class="tab-link"><i class="fa-sharp fa-solid fa-pen-to-square me-2"></i> Thông
                            tin tài khoản</a></li>
                    <li><a href="#tab3" class="tab-link"><i class="fa-sharp fa-solid fa-key me-2"></i> Đổi mật
                            khẩu</a></li>
                </ul>
            </div>
            <!-- Nội dung tab -->
            <div class="col-8">
                <div id="tab1" class="tab-content active">
                    <h1 class="title_bold">Lịch sử giao dịch</h1>
                    <table class="table table-striped mt-4">
                        <thead class="thead">
                            <tr>
                                <th style="width: 150px;" scope="col">Ngày Đặt</th>
                                <th style="text-align: start" scope="col">Thông Tin Đơn hàng</th>
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
                                            <p>{{ $items->customer_info_full_name ?? 'Khách hàng tiềm năng' }}</p>
                                            <p>Mã đơn hàng: {{ $items->oder_code }}</p>
                                        </div>
                                        <div class="tbody-item-flex">
                                            <p>Ngày xuất phát:
                                                {{ \Carbon\Carbon::parse($items->transport_date)->format('d-m-Y') }}
                                            </p>
                                            <p>Ngày về:
                                                {{ \Carbon\Carbon::parse($items->return_date)->format('d-m-Y') }}
                                            </p>
                                        </div>
                                        <div class="tbody-item-flex">
                                            <p>Số lượng: {{ $items->quantity }}</p>
                                            <p>Hình thức thanh toán:
                                                {{ $payments[$items->payment] ?? 'Không xác định' }}
                                            </p>
                                        </div>
                                        <div class="tbody-item-flex">
                                            <p>Tổng tiền: {{ number_format($items->price, 0, ',', '.') }}đ</p>
                                            <p>Trang thái: {{ $status[$items->status] ?? 'Không xác định' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if ($items->status == 1)
                                    <!-- Chưa thanh toán -->
                                    <a class="btn btn-primary mb-2"
                                        href="{{ route('home.detail', ['id' => $items->id]) }}">Chi Tiết</a>
                                    <a class="btn btn-success mb-2" href="#" data-bs-toggle="modal"
                                        data-bs-target="#ModalCheckout">Thanh Toán COD</a>
                                    <form action="{{ route('home.onlineCheckout') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="oder_code" value="{{ $items->oder_code }}">
                                        <button class="btn btn-danger" type="submit" name="payUrl">Thanh Toán Momo</button>
                                    </form>
                                    @elseif ($items->status == 2)
                                    <!-- Đã thanh toán -->
                                    <p>Đang chờ xử lý</p>
                                    <a class="btn btn-primary"
                                        href="{{ route('home.detail', ['id' => $items->id]) }}">Chi Tiết</a>
                                    @elseif ($items->status == 3)
                                    <!-- Đã hủy -->
                                    <p>Thanh toán thành công</p>
                                    <a class="btn btn-primary"
                                        href="{{ route('home.detail', ['id' => $items->id]) }}">Chi Tiết</a>
                                    @elseif ($items->status == 4)
                                    <!-- Đã hủy -->
                                    <p>Tour đang diễn ra</p>
                                    <a class="btn btn-primary"
                                        href="{{ route('home.detail', ['id' => $items->id]) }}">Chi Tiết</a>
                                    @elseif($items->status == 5 && !$items->isAssessed())
                                    {{-- đã hoàn thành --}}
                                    <button class="btn btn-primary" id="btn-danh-gia"
                                        data-id="{{ $items->id }}">Đánh giá</button>
                                    @elseif ($items->status == 6)
                                    <!-- Đã hủy -->
                                    <p>đã huỷ</p>
                                    <a class="btn btn-primary"
                                        href="{{ route('home.detail', ['id' => $items->id]) }}">Chi Tiết</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $listOrder->links() }}
                </div>
                <div id="tab2" class="tab-content">
                    <h1 class="title_bold">Thông tin tài khoản</h1>
                    <div class="d-flex justify-content-center mb-3">
                        <div class="box_avt">
                            @if (!empty($user->image))
                            <img src="{{ Storage::url($user->image) }}" alt="Ảnh đại diện">
                            @else
                            <img src="{{ asset('images/avatar-mac-dinh.jpg') }}" alt="Ảnh mặc định">
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Họ và Tên</label>
                        <input type="text" class="input-text form-control w-75" name="name"
                            value="{{ $user->name }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Tên Tài Khoản</label>
                        <input type="text" class="input-text form-control w-75" name="username"
                            value="{{ $user->username }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Email</label>
                        <input type="text" class="input-text form-control w-75" name="email"
                            value="{{ $user->email }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Số Điện Thoại</label>
                        <input type="text" class="input-text form-control w-75" name="phone"
                            value="{{ $user->phone }}" disabled>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-success tab-link" href="#updateInfo">Sửa Thông Tin</a>
                    </div>
                </div>
                <div id="updateInfo" class="tab-content">
                    <h1 class="title_bold">Cập nhật thông tin</h1>
                    <form action="{{ route('home.update', $user->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="d-flex justify-content-center mb-3">
                            <div class="box_avt">
                                @if (!empty($user->image))
                                <img id="avatarPreview" src="{{ Storage::url($user->image) }}"
                                    alt="Ảnh đại diện">
                                @else
                                <img id="avatarPreview" src="{{ asset('images/avatar-mac-dinh.jpg') }}"
                                    alt="Ảnh mặc định">
                                @endif
                                <input type="file" name="image" id="imageUpload" class="d-none">
                                <button type="button" class="btn-add-image"
                                    onclick="document.getElementById('imageUpload').click();"><i
                                        class="fa-solid fa-camera"></i></button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="form_ext w-25">Họ và Tên</label>
                            <input type="text" class="input-text form-control w-75" name="name"
                                value="{{ $user->name }}">
                        </div>
                        <div class="form-group">
                            <label for="" class="form_ext w-25">Tên Tài Khoản</label>
                            <input type="text" class="input-text form-control w-75" name="username"
                                value="{{ $user->username }}">
                        </div>
                        <div class="form-group">
                            <label for="" class="form_ext w-25">Email</label>
                            <input type="text" class="input-text form-control w-75" name="email"
                                value="{{ $user->email }}">
                        </div>
                        <div class="form-group">
                            <label for="" class="form_ext w-25">Số Điện Thoại</label>
                            <input type="text" class="input-text form-control w-75" name="phone"
                                value="{{ $user->phone }}">
                        </div>
                        <div class="form-group justify-content-start">
                            <button class="btn btn-success" type="submit">Cập Nhật Thông Tin</button>
                            <a class="btn btn-secondary tab-link" href="#tab1">Quay Lại</a>
                        </div>
                    </form>
                </div>
                <div id="tab3" class="tab-content">
                    <h1 class="title_bold">Đổi mật khẩu</h1>
                    <form action="{{ route('home.postChange') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group d-flex">
                            <label for="current_password" class="form_ext">Mật khẩu hiện tại</label>
                            <input type="password" class="input-text form-control w-75" name="current_password">
                        </div>
                        <div class="form-group d-flex">
                            <label for="new_password" class="form_ext">Mật khẩu mới</label>
                            <input type="password" class="input-text form-control w-75" name="new_password">
                        </div>
                        <div class="form-group d-flex">
                            <label for="new_password_confirmation" class="form_ext">Xác nhận mật khẩu mới</label>
                            <input type="password" class="input-text form-control w-75"
                                name="new_password_confirmation">
                        </div>
                        <div class="form-group justify-content-start">
                            <button type="submit" class="btn btn-success">Đổi mật khẩu</button>
                            <button type="button" class="btn btn-secondary" onclick="history.back();">Quay
                                lại</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ratingModal" tabindex="-1" aria-labelledby="ratingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ratingModalLabel">Đánh giá</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="ratingForm">
                        @csrf
                        <input type="hidden" name="id" id="ratingItemId">
                        <div class="mb-3">
                            <label for="ratingContent" class="form-label">Nội dung đánh giá</label>
                            <textarea id="ratingContent" name="content" class="form-control" rows="3"
                                placeholder="Viết đánh giá của bạn"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Đánh giá</label>
                            <div id="ratingStars" class="text-warning">
                                <i class="fa-regular fa-star" data-rating="1"></i>
                                <i class="fa-regular fa-star" data-rating="2"></i>
                                <i class="fa-regular fa-star" data-rating="3"></i>
                                <i class="fa-regular fa-star" data-rating="4"></i>
                                <i class="fa-regular fa-star" data-rating="5"></i>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary" id="submitRating">Gửi đánh giá</button>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    document.getElementById('imageUpload').addEventListener('change', function(event) {
        const file = event.target.files[0]; // Lấy file đã chọn
        if (file) {
            const reader = new FileReader(); // Tạo đối tượng FileReader để đọc file
            reader.onload = function(e) {
                // Cập nhật src của ảnh hiện tại bằng ảnh mới
                document.getElementById('avatarPreview').src = e.target.result;
            };
            reader.readAsDataURL(file); // Đọc file dưới dạng Data URL
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('#btn-danh-gia').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                document.getElementById('ratingItemId').value = id;
                const ratingModal = new bootstrap.Modal(document.getElementById(
                    'ratingModal'));
                ratingModal.show();
            });
        });

        const stars = document.querySelectorAll('#ratingStars i');
        stars.forEach(function(star) {
            star.addEventListener('click', function() {
                const rating = this.getAttribute(
                    'data-rating');
                stars.forEach(function(s) {
                    s.classList.remove('fa-solid', 'fa-regular');
                    s.classList.add(s.getAttribute('data-rating') <= rating ?
                        'fa-solid' : 'fa-regular'
                    );
                });
            });
        });

        document.getElementById('submitRating').addEventListener('click', function() {
            const id = document.getElementById('ratingItemId').value;
            const content = document.getElementById('ratingContent').value;
            const rating = [...stars].filter(star => star.classList.contains('fa-solid'))
                .length;

            if (!content || rating === 0) {
                alert('Vui lòng nhập nội dung và chọn số sao!');
                return;
            }

            $.ajax({
                url: '/danh-gia',
                type: 'POST',
                data: {
                    content: content,
                    star: rating,
                    order_id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        alert('Đánh giá thành công!');
                        location.reload();
                    } else {
                        alert('Có lỗi xảy ra: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Lỗi hệ thống: ' + error);
                }
            });
        });
    });
</script>
@endsection