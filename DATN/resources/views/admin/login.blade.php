@extends('shared._layout')
@section('title')
Login
@endsection

@section('content')
<div class="form_admin">
    <a class="logo_form" href="{{route('home.index')}}">
        <img src="{{url('images/logo.png')}}" alt="logo_papo" style="width: 200px; margin: 15px;">
    </a>
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
    <form action="{{ route('admin.postLogin') }}" method="post">
        @csrf
        <div class="form_group">
            <label for="" class="form_label">Email</label>
            <div class="form_input">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" class="form_item" name="email" placeholder="abc@gmail.com" value="{{ old('email') }}">
            </div>
        </div>
        <div class="form_group">
            <label for="" class="form_label">Password</label>
            <div class="form_input">
                <i class="fa-solid fa-lock"></i>
                <input type="password" class="form_item" name="password" placeholder="*********">
            </div>
        </div>
        <button type="submit" class="btn btn-outline-warning w-100">Login</button>
    </form>
</div>
@endsection