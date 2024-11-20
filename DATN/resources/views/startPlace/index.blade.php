@extends("shared._layoutAdmin")
@section("title", "Register")

@section("content")
<h2 class="title_page">
    Danh sách điểm xuất phát
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
    <a class="box_link" href="{{route('startPlace.create')}}">Thêm điểm xuất phát</a>
    <div class="content px-3">
        <table class="table table-strped">
            <thead class="thead">
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Điểm xuất phát</th>
                    <th scope="col">Tiêu đề</th>
                    <th scope="col">Nội dung</th>
                    <th scope="col">Hot</th>
                    <th scope="col">Kich hoat</th>
                    <th scope="col">Hành động</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($startPlaces as $startPlace)
                <tr>
                    <td>{{ $startPlace->id }}</td>
                    <td>{{ $startPlace->name }}</td>
                    <td>{{ $startPlace->title }}</td>
                    <td>{{ $startPlace->body }}</td>
                    <td>
                        <input type="checkbox" {{ $startPlace->hot === 1 ? 'checked' : '' }}>
                    </td>
                    <td>
                        <input type="checkbox" {{ $startPlace->active === 1 ? 'checked' : '' }}>
                    </td>
                    <td>
                        <form action="{{route('startPlace.destroy', $startPlace->id )}}" method="post">
                            @csrf
                            @method('DELETE')
                            <a class="btn btn-primary" href="">Cập nhật</a>
                            <a class="btn btn-warning" href="{{route('startPlace.edit', $startPlace->id)}}">Sửa</a>
                            <button type="submit" onclick="return confirm('Bạn có muốn xóa không ?')" class="btn btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection