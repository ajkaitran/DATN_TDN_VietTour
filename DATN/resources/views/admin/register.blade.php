@extends("shared._layoutAdmin")
@section("title", "Register")

@section("content")
<h2 class="title_page">
    Quản lý Admin
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
<div class="right-column">
    <div class="formcontent">
        <div class="content p-3">
            <table class="table table-strped mt-4">
                <thead class="thead">
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Tên đăng nhập</th>
                        <th scope="col">Email</th>
                        <th scope="col">Hoạt động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listAdmin as $items)
                    <tr>
                        <td>{{$items->id}}</td>
                        <td>{{$items->username}}</td>
                        <td>{{$items->email}}</td>
                        <td>
                            <a href="{{route('admin.changePassword',['id'=>$items->id])}}" class="btn btn-warning">Đổi mật khẩu</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection