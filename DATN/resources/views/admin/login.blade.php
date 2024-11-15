@extends('shared._layout')
@section('title')
Login
@endsection

@section('content')
<div class="form_admin">
    <a class="logo_form" href="{{route('home.index')}}">
        <img src="{{url('images/Logo_VietTour (1).png')}}" alt="logo_papo" style="width: 100%; object-fit: cover">
    </a>

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
    <form action="{{ route('admin.postLogin') }}" method="post">
        @csrf
        <div class="form_group">
            <label for="" class="form_label">Tài khoản</label>
            <div class="form_input">
                <i class="fa-solid fa-user"></i>
                <input type="text" class="form_item" name="login" placeholder="Tên người dùng hoặc abc@gmail.com" value="{{ old('login') }}">
            </div>
            @error('login')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="form_group">
            <label for="" class="form_label">Mật khẩu</label>
            <div class="form_input">
                <i class="fa-solid fa-lock"></i>
                <input type="password" class="form_item" name="password" placeholder="*********">
            </div>
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100 p-3">Login</button>
    </form>
</div>
@endsection