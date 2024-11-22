@extends("shared._layoutAdmin")
@section("title", "Register")

@section("content")
<h2 class="title_page">
    Quản lý Loại Tour
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
    <a class="box_link" href="{{route('tourType.create')}}">Thêm loại tour</a>
    <div class="content px-3">
        <table class="table table-strped">
            <thead class="thead">
                <tr>
                    <th style="width: 50px;" scope="col">STT</th>
                    <th style="width: 250px;" scope="col">Hình Ảnh</th>
                    <th  scope="col">Tên danh mục</th>
                    <th  scope="col">Loại danh mục</th>
                    <th  scope="col">Hiện menu</th>
                    <th  scope="col">Hiện trang chủ</th>
                    <th  scope="col">Hoạt động</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($tourtypes as $type)
                <tr>
                    <td>{{ $type->order }}</td>
                    <td>
                        <img src="{{ $type->image?''.Storage::url($type->image):''}}" alt="logo_papo" style="width: 100%; object-fit: cover">
                    </td>
                    <td>{{ $type->name }}</td>
                    <td>{{ $type->home_name }}</td>
                    <td>
                        <input type="checkbox" name="show_menu" id="show_menu" value="1"
                            {{ old('show_menu', $type->show_menu ?? 0) == 1 ? 'checked' : '' }}>
                    </td>
                    <td>
                        <input type="checkbox" name="show_home" id="show_home" value="1"
                            {{ old('show_home', $type->show_home ?? 0) == 1 ? 'checked' : '' }}>
                    </td>
                    <td>
                        <input type="checkbox" name="active" id="active" value="1"
                            {{ old('active', $type->active ?? 0) == 1 ? 'checked' : '' }}>
                    </td>
                    <td>
                        <a class="btn btn-secondary" href="{{ route ('tourType.edit', ['id'=>$type->id]) }}">Sửa</a>
                        <a class="btn btn-danger" href="{{ route ('tourType.destroy', ['id'=>$type->id]) }}">Xoá</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection