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
                    <input type="text" class="form-control w-75" name="name" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="" class="form_ext w-25">Tiêu đề</label>
                    <input type="text" class="form-control w-75" name="title" value="{{ old('title') }}">
                </div>
                <div class="form-group">
                    <label for="" class="form_ext w-25">Nôi dung</label>
                    <input type="text" class="form-control w-75" name="body" value="{{ old('body') }}">
                </div>
                <div class="form_check">
                    <label for="hot" class="form_ext w-25">Hot</label>
                    <input type="checkbox" id="hot" name="hot" value="1" {{ old('hot') ? 'checked' : '' }}>
                </div>
                <div class="form_check">
                    <label for="hot" class="form_ext w-25">Hoạt động</label>
                    <input type="checkbox" id="hot" name="active" value="1" {{ old('active') ? 'checked' : '' }}>
                </div>
                <div class="mx-auto">
                    <button type="submit" class="btn btn-success">Thêm mới</button>
                </div>
            </div>
        </div>
    </form>
</div>


@endsection