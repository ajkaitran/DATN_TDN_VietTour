@extends("shared._layoutAdmin")
@section("title", "Register")

@section("content")
<h2 class="title_page">
    Thêm Điểm Xuát Phát
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
    <a class="box_link" href="{{route('startPlace.index')}}">Danh sách điểm xuất phát</a>
    <form action="{{ route('startPlace.store') }}" method="post">
        @csrf
        <div class="row mx-3">
            <div class="col-8 mx-auto">
                <div class="form-group">
                    <label for="" class="form_ext w-25">Điểm xuất phát</label>
                    <input type="text" class="form-control w-75" name="" value="{{ old('') }}">
                </div>
                <div class="form_check">
                    <label for="" class="form_ext w-25">Hoạt động</label>
                    <input type="checkbox" name="" value="{{ old('') }}">
                </div>
                <div class="mx-auto">
                    <button type="submit" class="btn btn-success">Thêm mới</button>
                </div>
            </div>
        </div>
    </form>
</div>


@endsection