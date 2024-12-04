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
                    <th scope="col">Hoạt động</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @for($i = 0; $i < 5; $i++)
                <tr>
                    <td>1</td>
                    <td>name1</td>
                    <td>
                        <input type="checkbox">
                        {{-- <input type="checkbox" {{ $items->status == 1 ? 'checked' : '' }} > --}}
                    </td>
                    <td>
                        <a class="btn btn-primary" href="">Cập nhật</a>
                        <a class="btn btn-warning" href="">Sửa</a>
                        <a class="btn btn-danger" href="">Xóa</a>
                    </td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>


@endsection