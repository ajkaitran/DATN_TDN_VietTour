@extends("shared._layoutAdmin")
@section("title", "Thêm Banner")

@section("content")
<h2 class="title_page">Thêm Bài Viết</h2>

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
    <a class="box_link" href="{{route('article.index')}}">Danh sách Bài Viết</a>
    <div class="content px-3">
        <form action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mx-3">
                <div class="col-8">
                    <div class="form-group">
                        <label class="form_ext w-25" for="">Danh Mục bài viết</label>
                        <select class="form-control w-75" name="" id="">
                            <option selected disabled>Chọn danh mục</option>
                            <option value="1">abc</option>
                            <option value="1">abc</option>
                            <option value="1">abc</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form_ext w-25" for="">Tiêu Đề</label>
                        <input type="text" class="form-control w-75" name="" value="">
                    </div>
                    <div class="form-group">
                        <label class="form_ext w-25" for="image">Hình Ảnh</label>
                        <div class="w-75">
                            <label class="form__container" for="image" id="upload-container">Choose or Drag & Drop Files
                                <input class="form__file" id="upload-files" type="file" accept="image/*" name="image" multiple="multiple">
                            </label>
                            <div class="desktop-show"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Trích dẫn ngắn</label>
                        <textarea class="form-control w-75" cols="20" rows="4" name=""></textarea>
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Nội dung</label>
                        <textarea type="text" class="form-control w-75" id="editor1" name=""></textarea>
                    </div>
                    <div class="form_check">
                        <label class="form_ext w-25" for="active">Hiện Trang Chủ</label>
                        <input type="checkbox" id="active" name="active" value="1" {{ old('active') == 1 ? 'checked' : '' }}>
                    </div>
                    <div class="form_check">
                        <label class="form_ext w-25" for="active">Trạng Thái</label>
                        <input type="checkbox" id="active" name="active" value="1" {{ old('active') == 1 ? 'checked' : '' }}>
                    </div>
                    <div class="form-group">
                        <label class="form_ext w-25" for="slogan">Tag</label>
                        <input type="text" class="form-control w-75" id="" name="" value="">
                    </div>
                    <div class="form-group">
                        <label class="form_ext w-25" for="slogan">Url</label>
                        <input type="text" class="form-control w-75" id="" name="" value="">
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Thẻ tiêu đề</label>
                        <textarea class="form-control w-75" cols="20" rows="4" name=""></textarea>
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Thẻ mô tả</label>
                        <textarea class="form-control w-75" cols="20" rows="4" name=""></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Thêm Mới</button>
                    <a href="{{ route('banner.index') }}" class="btn btn-secondary">Quay lại</a>
                </div>
                <div class="col-4">
                    <div class="box_article">
                        <h5><strong>Danh Mục Tour</strong></h5>
                        <input class="my-2" type="text" name="" id="" placeholder="Nhập từ Khóa...">
                        <ul>
                            @for($i = 1; $i < 15; $i++)
                            <li>
                                <label><input type="checkbox" name="ArticleId" value="33"> Châu Âu</label>
                            </li>
                            @endfor
                        </ul>
                    </div>
                </div>
            </div>
        </form>
        
    </div>
</div>

@endsection
