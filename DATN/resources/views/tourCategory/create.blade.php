@extends('shared._layoutAdmin')
@section('title', 'Register')

@section('content')
    <h2 class="title_page">
        Thêm danh mục Tour
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
        <a class="box_link" href="{{ route('tourCategory.index') }}">Danh mục tour</a>
        <form action="{{ route('tourCategory.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row mx-3">
                <div class="col-8">
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Tên danh mục</label>
                        <input type="text" class="form-control w-75" name="name" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Số Hotline</label>
                        <input type="text" class="form-control w-75" name="hotline" value="{{ old('hotline') }}">
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
                        <label for="" class="form_ext w-25">Đường dẫn</label>
                        <input type="text" class="form-control w-75" name="url" value="{{ old('url') }}">
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Tên thành phố: </label>
                        <input type="text" class="form-control w-75" name="city" value="{{ old('city') }}">
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Thẻ tiêu đề</label>
                        <textarea type="text" class="form-control w-75" id="editor1" name="meta_title">
                            {{ old('meta_title') }}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Thẻ mô tả</label>
                        <textarea type="text" class="form-control w-75" id="editor2" name="meta_description">
                            {{ old('meta_description') }}
                        </textarea>
                    </div>

                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="" class="form_ext w-45">Loại tour</label>
                        <select class="form-control w-75" aria-label="Default select example" name="type">
                            @foreach ($typeTour as $type)
                                <option value="{{ $type->id }}" {{ old('type') == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-45">Danh mục tour</label>
                        <select class="form-control  w-75" aria-label="Default select example" name="parent_id">
                            <option value="" {{ old('parent_id') == null ? 'selected' : '' }}>Danh mục chính
                            </option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('parent_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form_check">
                        <label for="" class="form_ext w-45">Hoạt động</label>
                        <input class="w-75" type="checkbox" name="active" value="1"
                            {{ old('active') ? 'checked' : '' }}>
                    </div>
                    <div class="form_check">
                        <label for="" class="form_ext w-45">Hiển thị nổi bật</label>
                        <input class="w-75" type="checkbox" name="hot" value="{{ old('hot') ? '1' : '' }}">
                    </div>
                </div>
                <div class="mx-auto">
                    <button type="submit" class="btn btn-success">Thêm mới</button>
                </div>
            </div>
        </form>
    </div>

@endsection
