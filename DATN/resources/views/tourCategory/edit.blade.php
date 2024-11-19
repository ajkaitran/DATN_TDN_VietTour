@extends('shared._layoutAdmin')
@section('title', 'Register')

@section('content')
    <h2 class="title_page">
        Sửa danh mục Tour
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
        <form action="{{ route('tourCategory.update', $category->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row mx-3">
                <div class="col-8">
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Tên danh mục</label>
                        <input type="text" class="form-control w-75" name="name" value="{{ $category->name }}">
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Số Hotline</label>
                        <input type="text" class="form-control w-75" name="hotline" value="{{ $category->hotline }}">
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Hình Ảnh</label>
                        <div class="w-75">
                            <label class="form__container" id="upload-container">
                                Choose or Drag & Drop Files
                                <input class="form__file" id="upload-files" type="file" accept="image/*"
                                    name="image" />
                            </label>

                            <img id="preview-image" src="{{ Storage::url('categoryTour/' . $category->image) }}"
                                class="object-fit-cover" style="display: {{ $category->image ? 'block' : 'none' }}">
                            <div class="form__files-container" id="files-list-container"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Đường dẫn</label>
                        <input type="text" class="form-control w-75" name="url" value="{{ $category->url }}">
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Tên thành phố: </label>
                        <input type="text" class="form-control w-75" name="city" value="{{ $category->city }}">
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Thẻ tiêu đề</label>
                        <textarea type="text" class="form-control w-75" id="editor1" name="meta_title">
                            {{ $category->meta_title }}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Thẻ mô tả</label>
                        <textarea type="text" class="form-control w-75" id="editor2" name="meta_description">
                            {{ $category->meta_description }}
                        </textarea>
                    </div>

                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="" class="form_ext w-45">Loại tour</label>
                        <select class="form-control w-75" aria-label="Default select example" name="type">
                            <option value="1" {{ $category->type == 1 ? 'selected' : '' }}>Tour</option>
                            <option value="2" {{ $category->type == 2 ? 'selected' : '' }}>Combo</option>
                            <option value="3" {{ $category->type == 3 ? 'selected' : '' }}>Visa/Hộ chiếu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-45">Danh mục tour</label>
                        <select class="form-control  w-75" aria-label="Default select example" name="parent_id">
                            <option value="" {{ $category->parent_id == null ? 'selected' : '' }}>Danh mục chính
                            </option>
                            <option value="1" {{ $category->parent_id == 1 ? 'selected' : '' }}>Tour</option>
                            <option value="2" {{ $category->parent_id == 2 ? 'selected' : '' }}>Combo</option>
                            <option value="3" {{ $category->parent_id == 3 ? 'selected' : '' }}>Visa/Hộ chiếu</option>
                        </select>
                    </div>
                    <div class="form_check">
                        <label for="" class="form_ext w-45">Hoạt động</label>
                        <input class="w-75" type="checkbox" name="active" value="1"
                            {{ $category->active == 1 ? 'checked' : '' }}>
                    </div>
                    <div class="form_check">
                        <label for="" class="form_ext w-45">Hiển thị nổi bật</label>
                        <input class="w-75" type="checkbox" name="hot" value="1"
                            {{ $category->hot == 1 ? 'checked' : '' }}>
                    </div>
                </div>
                <div class="mx-auto">
                    <button type="submit" class="btn btn-success">Sửa</button>
                </div>
            </div>
        </form>
    </div>

@endsection
