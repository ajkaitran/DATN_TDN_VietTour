@extends("shared._layoutAdmin")
@section("title", "Register")

@section("content")
<h2 class="title_page">
    Quản lý Danh Mục Tour
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
    <a class="box_link" href="{{route('tourCategory.create')}}">Thêm danh mục tour</a>
    <div class="content px-3">
        <table class="table table-strped">
            <thead class="thead">
                <tr>
                    <th style="width: 50px;" scope="col">STT</th>
                    <th style="width: 150px;" scope="col">Tên danh mục</th>
                    <th style="width: 100px;" scope="col">Holine</th>
                    <th style="width: 150px;" scope="col">Địa danh</th>
                    <th style="width: 120px;" scope="col">Hình Ảnh</th>
                    <th style="width: 80px;" scope="col">Hoạt động</th>
                    <th style="width: 80px;" scope="col">Điểm tuyến</th>
                    <th style="width: 80px;" scope="col">Trang chủ</th>
                    <th style="width: 80px;" scope="col">Chân trang</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @for($i = 0; $i < 4; $i++)
                <tr>
                    <td>1</td>
                    <td>name1</td>
                    <td>19001018</td>
                    <td>Đông anm á</td>
                    <td>
                        <img src="{{url('images/loai_tour_1.png')}}" alt="logo_papo" style="width: 100%; object-fit: cover">
                    </td>
                    <td>
                        <input type="checkbox">
                        {{-- <input type="checkbox" {{ $items->status == 1 ? 'checked' : '' }} > --}}
                    </td>
                    <td>
                        <input type="checkbox">
                        {{-- <input type="checkbox" {{ $items->status == 1 ? 'checked' : '' }} > --}}
                    </td>
                    <td>
                        <input type="checkbox">
                        {{-- <input type="checkbox" {{ $items->status == 1 ? 'checked' : '' }} > --}}
                    </td>
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