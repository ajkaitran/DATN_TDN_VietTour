@extends("shared._layoutAdmin")
@section("title", "Register")

@section("content")
<h2 class="title_page">
    Thông Tin Tài Khoản
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
    <form action="{{ route('admin.update', $user->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row ">
            <div class="col-6 mx-auto">
                <div class="d-flex justify-content-center mb-3">
                    <div class="box_avt">
                        @if (!empty($user->image))
                            <img id="avatarPreview" src="{{ Storage::url($user->image) }}" alt="Ảnh đại diện">
                        @else
                            <img id="avatarPreview" src="{{ asset('images/avatar-mac-dinh.jpg') }}" alt="Ảnh mặc định">
                        @endif
                        <input type="file" name="image" id="imageUpload" class="d-none">
                        <button type="button" class="btn-add-image" onclick="document.getElementById('imageUpload').click();"><i class="fa-solid fa-camera"></i></button>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="form_ext w-25">Họ và Tên</label>
                    <input type="text" class="input-text form-control w-75" name="name"
                        value="{{ $user->name }}" >
                </div>
                <div class="form-group">
                    <label for="" class="form_ext w-25">Tên Tài Khoản</label>
                    <input type="text" class="input-text form-control w-75" name="username"
                        value="{{ $user->username }}" >
                </div>
                <div class="form-group">
                    <label for="" class="form_ext w-25">Email</label>
                    <input type="text" class="input-text form-control w-75" name="email"
                        value="{{ $user->email }}" >
                </div>
                <div class="form-group">
                    <label for="" class="form_ext w-25">Số Điện Thoại</label>
                    <input type="text" class="input-text form-control w-75" name="phone"
                        value="{{ $user->phone }}">
                </div>
                <div class="form-group justify-content-start">
                    <button class="btn btn-success" type="submit">Cập Nhật Thông Tin</button>
                    <button type="button" class="btn btn-secondary" onclick="history.back();">Quay lại</button>
                </div>
            </div>
        </div>
    </form>
</div>
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
</script>
@endsection