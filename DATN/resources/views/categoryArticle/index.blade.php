@extends('shared._layoutAdmin')
@section('title', 'Quản lý danh mục bài viết')

@section('content')
    <h2 class="title_page">
        Quản lý danh mục bài viết
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
        <a class="box_link" href="{{ route('categoryArticle.create') }}">Thêm danh mục bài viết</a>
        <form action="{{ route('categoryArticle.index') }}" method="GET" class="mb-3 ml-1 row">
            <div class="col-4">
                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm danh mục bài viết..."
                    value="{{ request('search') }}">
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            </div>
        </form>
        <div class="content px-3">
            <table class="table table-strped">
                <thead class="thead">
                    <tr>
                        <th style="width: 50px;" scope="col">STT</th>
                        <th style="width: 250px;" scope="col">Tên danh mục</th>
                        <th style="width: 150px;" scope="col">Danh mục cha</th>
                        <th style="width: 200px;" scope="col">Loại bài viết</th>
                        <th style="width: 110px;" scope="col">Hoạt động</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $category)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $category->category_name }}</td>
                            <td>{{ $category->parent->category_name ?? 'Không có danh mục cha' }}</td>
                            <td>{{ $category->type_post }}</td>
                            <td> <input type="checkbox" disabled {{ $category->category_active == 1 ? 'checked' : '' }}>
                            </td>
                            </td>
                            <td class="d-flex justify-content-around py-5"> <a class="btn btn-warning"
                                    href="{{ route('categoryArticle.edit', ['id' => $category->id]) }}">Cập nhật</a>
                                <form action="{{ route('categoryArticle.destroy', ['id' => $category->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection
