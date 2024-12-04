@extends("shared._layoutAdmin")
@section("title", "Register")

@section("content")
<h2 class="title_page">
    Thêm Loại Tour
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
    <a class="box_link" href="{{route('tourType.index')}}">Danh sách loại tour</a>
    <form action="{{ route('tourType.create') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row mx-3">
            <div class="col-8 mx-auto">
                <div class="form-group">
                    <label for="" class="form_ext w-25">Loại danh mục</label>
                    <select class="form-control  w-75" name="category_type" aria-label="Default select example">
                        <option value="1">Tour</option>
                        <option value="2">Combo</option>
                        <option value="3">Visa/Hộ chiếu</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="" class="form_ext w-25">Tên Loại</label>
                    <input type="text" class="form-control w-75" name="name" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="" class="form_ext w-25">Tên hiển thị</label>
                    <input type="text" class="form-control w-75" name="home_name" value="{{ old('home_name') }}">
                </div>
                <div class="form-group">
                    <label for="" class="form_ext w-25">Hình Ảnh</label>
                    <div class="w-75">
                        <label class="form__container" id="upload-container">Choose or Drag & Drop Files
                            <input class="form__file" id="upload-files" type="file" accept="image/*" name="image"
                                multiple value="{{ old('image') }}" />
                        </label>
                        <div class="form__files-container" id="files-list-container"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form_ext w-25" for="order">Thứ tự hiển thị</label>
                    <input type="number" name="order" id="" class="form-control w-75" value="{{ old('order') }}">
                </div>
                <div class="form-group">
                    <label for="" class="form_ext w-25">Đường dẫn</label>
                    <input type="text" class="form-control w-75" name="slug" value="">
                </div>
                <div class="form_check">
                    <label for="" class="form_ext w-25">Hoạt động</label>
                    <input type="hidden" name="active" value="0">
                    <input type="checkbox" name="active" value="1">
                </div>
                <div class="form_check">
                    <label for="" class="form_ext w-25">Hiển thị menu</label>
                    <input type="hidden" name="show_menu" value="0">
                    <input type="checkbox" name="show_menu" value="1">
                </div>
                <div class="form_check">
                    <label for="" class="form_ext w-25">Hiển thị trang chủ</label>
                    <input type="hidden" name="show_home" value="0">
                    <input type="checkbox" name="show_home" value="1">
                </div>
                <div class="mx-auto">
                    <button type="submit" class="btn btn-success">Thêm mới</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection