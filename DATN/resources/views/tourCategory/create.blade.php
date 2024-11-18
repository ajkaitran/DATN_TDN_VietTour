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
    <a class="box_link" href="{{route('tourType.index')}}">Danh mục tour</a>
    <form action="{{ route('tourCategory.store') }}" method="post">
        @csrf
        <div class="row mx-3">
            <div class="col-8">
                <div class="form-group">
                    <label for="" class="form_ext w-25">Tên danh mục</label>
                    <input type="text" class="form-control w-75" name="" value="{{ old('') }}">
                </div>
                <div class="form-group">
                    <label for="" class="form_ext w-25">Số Hotline</label>
                    <input type="text" class="form-control w-75" name="" value="{{ old('') }}">
                </div>
                <div class="form-group">
                    <label for="" class="form_ext w-25">Tên địa danh</label>
                    <input type="text" class="form-control w-75" name="" value="{{ old('') }}">
                </div>
                <div class="form-group">
                    <label for="" class="form_ext w-25">Hình Ảnh</label>
                    <div class="w-75">
                        <label class="form__container" id="upload-container">Choose or Drag & Drop Files
                            <input class="form__file" id="upload-files" type="file" accept="image/*"
                                multiple="multiple" name="image" />
                        </label>
                        <div class="form__files-container" id="files-list-container"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="form_ext w-25">Đường dẫn</label>
                    <input type="text" class="form-control w-75" name="" value="{{ old('') }}">
                </div>
                <div class="form-group">
                    <label for="" class="form_ext w-25">Bài giới thiệu dầu trang</label>
                    <textarea type="text" class="form-control w-75" id="editor" name="" value="{{ old('') }}"></textarea>
                </div>
                <div class="form-group">
                    <label for="" class="form_ext w-25">Thẻ tiêu đề</label>
                    <textarea type="text" class="form-control w-75" id="editor1" name="" value="{{ old('') }}"></textarea>
                </div>
                <div class="form-group">
                    <label for="" class="form_ext w-25">Thẻ mô tả</label>
                    <textarea type="text" class="form-control w-75" id="editor2" name="" value="{{ old('') }}"></textarea>
                </div>
                
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="" class="form_ext w-45">Loại tour</label>
                    <select class="form-control w-75" aria-label="Default select example">
                        <option value="1">Tour</option>
                        <option value="2">Combo</option>
                        <option value="3">Visa/Hộ chiếu</option>
                      </select>
                </div>
                <div class="form-group">
                    <label for="" class="form_ext w-45">Danh mục tour</label>
                    <select class="form-control  w-75" aria-label="Default select example">
                        <option value="1">Tour</option>
                        <option value="2">Combo</option>
                        <option value="3">Visa/Hộ chiếu</option>
                      </select>
                </div>
                <div class="form_check">
                    <label for="" class="form_ext w-45">Hoạt động</label>
                    <input class="w-75" type="checkbox" name="" value="{{ old('') }}">
                </div>
                <div class="form_check">
                    <label for="" class="form_ext w-45">Hiển thị menu</label>
                    <input class="w-75" type="checkbox" name="" value="{{ old('') }}">
                </div>
                <div class="form_check">
                    <label for="" class="form_ext w-45">Hiển thị trang chủ</label>
                    <input class="w-75" type="checkbox" name="" value="{{ old('') }}">
                </div>
                <div class="form_check">
                    <label for="" class="form_ext w-45">Hiển thị chân trang</label>
                    <input class="w-75" type="checkbox" name="" value="{{ old('') }}">
                </div>
                <div class="form_check">
                    <label for="" class="form_ext w-45">Hiển thị nổi bật</label>
                    <input class="w-75" type="checkbox" name="" value="{{ old('') }}">
                </div>
            </div>
            <div class="mx-auto">
                <button type="submit" class="btn btn-success">Thêm mới</button>
            </div>
        </div>
    </form>
</div>

@endsection
