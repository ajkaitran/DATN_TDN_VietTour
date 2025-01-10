@extends("shared._layoutAdmin")
@section("title", "ChangePassword")

@section("content")
<h2 class="title_page">
    Đổi mật khẩu
</h2>

<!-- Hiển thị thông báo lỗi và thành công -->
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
    <form action="{{ route('admin.postChange') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-6 mx-auto">
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
                    <input type="password" class="input-text form-control w-75" name="new_password_confirmation">
                </div>
                <div class="form-group justify-content-start">
                    <button type="submit" class="btn btn-success">Đổi mật khẩu</button>
                    <button type="button" class="btn btn-secondary" onclick="history.back();">Quay lại</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
