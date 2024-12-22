@extends('shared._layoutAdmin')
@section('title', 'Sửa danh mục bài viết')

@section('content')
    <h2 class="title_page">
        Sửa danh mục bài viết
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
        <a class="box_link" href="{{ route('categoryArticle.index') }}">Danh sách danh mục bài viết</a>
        <form action="{{ route('categoryArticle.update', $data->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row mx-3">
                <div class="col-8">
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Tên danh mục bài viết</label>
                        <input type="text" class="form-control w-75" name="category_name"
                            value="{{ $data->category_name }}">
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Đường dẫn</label>
                        <input type="text" class="form-control w-75" name="url" value="{{ $data->url }}">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Loại danh mục</label>
                        <input type="text" class="form-control w-75" name="type_post" value="{{ $data->type_post }}">
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-45">Danh mục bài viết</label>
                        <select class="form-control  w-75" aria-label="Default select example" name="parent_id">
                            <option value="" {{ $data->parent_id == null ? 'selected' : '' }}>Danh mục chính
                            </option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $data->parent_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form_check">
                        <label for="" class="form_ext w-45">Hoạt động</label>
                        <input class="w-75" type="checkbox" name="category_active" value="1"
                            {{ $data->category_active ? 'checked' : '' }}>
                    </div>
                    <div class="form_check">
                        <label for="" class="form_ext w-45">Thứ tự hiển thị</label>
                        <input class="w-75" type="number" name="category_sort" value="{{ $data->category_sort }}">
                    </div>
                </div>
                <div class="mx-auto">
                    <button type="submit" class="btn btn-success">Cập nhật</button>
                </div>
            </div>
        </form>
    </div>

@endsection
