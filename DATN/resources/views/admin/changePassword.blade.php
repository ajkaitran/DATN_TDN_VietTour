@extends("shared._layoutAdmin")
@section("title", "ChangePassword")

@section("content")
<h2 class="title_page">
    Đổi mật khẩu
</h2>
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
    <form action="{{ route('admin.postChange') }}" method="post">
        @csrf
        @method('PUT')
        <div class="row ">
            <div class="col-6 mx-auto">
                <div class="form-group d-flex">
                    <label for="" class="form_ext">Current Password</label>
                    <input type="password" class="input-text form-control w-75" name="current_password">
                </div>
                <div class="form-group d-flex">
                    <label for="" class="form_ext">New Password</label>
                    <input type="password" class="input-text form-control w-75" name="new_password">
                </div>
                <div class="form-group d-flex">
                    <label for="" class="form_ext">Confirm New Password</label>
                    <input type="password" class="input-text form-control w-75" name="new_password_confirmation">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Đổi mật khẩu</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection