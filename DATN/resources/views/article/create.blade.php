@extends('shared._layoutAdmin')
@section('title', 'Thêm Bài Viết')

@section('content')
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
        <a class="box_link" href="{{ route('article.index') }}">Danh sách Bài Viết</a>
        <div class="content px-3">
            <form action="{{ route('article.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mx-3">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form_ext w-25" for="">Danh Mục bài viết</label>
                            <select class="form-control w-75" name="article_category_id" id="">
                                @foreach ($categories as $articleCategory)
                                    <option value="{{ $articleCategory->id }}"
                                        @if (old('article_category_id') == $articleCategory->id) selected @endif>
                                        {{ $articleCategory->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="">Tiêu Đề</label>
                            <input type="text" class="form-control w-75" name="subject" value="{{ old('subject') }}">
                        </div>
                        <div class="form-group">
                            <label for="" class="form_ext w-25">Hình Ảnh</label>
                            <div class="w-75">
                                <label class="form__container" id="upload-container">Choose or Drag & Drop Files
                                    <input class="form__file" id="upload-files" type="file" accept="image/*"
                                        name="image" multiple value="{{ old('image') }}" />
                                </label>
                                <div class="form__files-container" id="files-list-container"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="form_ext w-25">Trích dẫn ngắn</label>
                            <textarea class="form-control w-75" cols="20" rows="4" name="description">
                                {{ old('description') }}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="" class="form_ext w-25">Nội dung</label>
                            <textarea type="text" class="form-control w-75" id="editor1" name="body">
                                {{ old('body') }}
                            </textarea>
                        </div>
                        <div class="form_check">
                            <label class="form_ext w-25" for="active">Hiện Trang Chủ</label>
                            <input type="checkbox" id="active" name="hot" value="1"
                                {{ old('hot') == 1 ? 'checked' : '' }}>
                        </div>
                        <div class="form_check">
                            <label class="form_ext w-25" for="active">Trạng Thái</label>
                            <input type="checkbox" id="active" name="active" value="1"
                                {{ old('active') == 1 ? 'checked' : '' }}>
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="slogan">Url</label>
                            <input type="text" class="form-control w-75" id="" name="url"
                                value="
                                {{ old('url') }}">
                        </div>
                        <button type="submit" class="btn btn-success">Thêm Mới</button>
                        <a href="{{ route('article.index') }}" class="btn btn-secondary">Quay lại</a>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection
