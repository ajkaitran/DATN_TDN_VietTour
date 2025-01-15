@extends("shared._layoutAdmin")
@section("title", "Comment")

@section("content")
<h2 class="title_page">
    Quản lý bình luận
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
    <div class="content p-3">
        <!-- Form bộ lọc -->
        <form method="GET" action="{{ route('comment.index') }}" class="form-inline mb-3">
            <label for="article_id" class="mr-2">Lọc theo bài viết:</label>
            <select name="article_id" id="article_id" class="form-control mr-2">
                <option value="">Tất cả bài viết</option>
                @foreach($articles as $article)
                <option value="{{ $article->id }}"
                    {{ request('article_id') == $article->id ? 'selected' : '' }}>
                    {{ $article->subject }}
                </option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Lọc</button>
        </form>

        <!-- Bảng hiển thị bình luận -->
        <table class="table table-strped mt-4">
            <thead>
                <tr>
                    <th style="width: 50px;" scope="col">STT</th>
                    <th style="width: 150px;" scope="col">Ngày đăng</th>
                    <th style="width: 250px;" scope="col">Tên bài viết</th>
                    <th style="width: 250px;" scope="col">Tên người dùng</th>
                    <th scope="col">Nội dung bình luận</th>
                    <th style="width: 120px;" scope="col">Hoạt động</th>
                    <th style="width: 150px;"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($listComment as $index => $items)
                <tr data-id="{{ $items->id }}">
                    <td>{{$listComment->firstItem() + $index}}</td>
                    <td>{{$items->created_at}}</td>
                    <td>{{$items->loadAllArticle->subject}}</td>
                    <td>{{$items->loadAllUser->username}}</td>
                    <td>{{$items->content}}</td>
                    <form action="{{ route('comment.update', $items->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <td>
                            <input type="checkbox" {{ $items->status == 1 ? 'checked' : '' }}>
                        </td>
                        <td class="d-flex justify-content-around py-4">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </td>
                    </form>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$listComment->links()}}
    </div>
</div>
@endsection