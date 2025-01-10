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
    <div class="row ">
        <div class="col-6 mx-auto">
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
                <a class="btn btn-warning" href="{{route('admin.changePassword',['id'=>$user->id])}}">Đổi Mật Khẩu</a>
                <a class="btn btn-success" href="{{route('admin.edit',['id'=>$user->id])}}">Sửa Thông Tin</a>
                <a class="btn btn-danger"  href="{{route('admin.destroy',['id'=>$user->id])}}">Xóa Tài Khoản</a>
            </div>
        </div>
    </div>
</div>
@endsection