@extends('shared._layoutAdmin')
@section('title', 'Quản lý Bài Viết')

@section('content')
    <h2 class="title_page">Quản lý Bài Viết</h2>

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
        <a class="box_link" href="{{ route('article.create') }}">Thêm Bài viết</a>
        <div class="content px-3">
            <table class="table table-striped mt-4">
                <thead class="thead">
                    <tr>
                        <th style="width: 120px;" scope="col">Ngày Đăng</th>
                        <th style="width: 120px;" scope="col">Hình Ảnh</th>
                        <th style="width: 350px;" scope="col">Thông Tin Bài Viết</th>
                        <th style="width: 200px;" scope="col">Danh Mục</th>
                        <th style="width: 120px;" scope="col">Trạng Thái</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($articles as $article)
                        <tr>
                            <td>{{ $article->created_at->format('Y-m-d H:i') }}</td>
                            <td><img src="{{ Storage::url('article/' . $article->image) }}" alt=""
                                    class="object-fit-cover"></td>
                            <td>
                                <div class="tbody-item-column">
                                    <p><strong>{{ $article->subject }}</strong></p>
                                    <div class="tbody-item-flex">
                                        <p><strong>Lượt xem: </strong>{{ $article->view }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <strong>{{ $article->articleCategory->category_name ?? 'Không xác định' }}</strong>
                            </td>
                            <td>
                                <input type="checkbox" name="" id=""
                                    @if ($article->active == 1) checked @endif disabled>
                            </td>
                            <td class="d-flex justify-content-center align-items-center pt-5">
                                <a class="btn btn-warning mr-1"
                                    href="{{ route('article.edit', ['id' => $article->id]) }}">Sửa</a>
                                <form action="{{ route('article.destroy', ['id' => $article->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$articles->links()}}
        </div>
    </div>

@endsection
