@extends("shared._layoutAdmin")
@section("title", "Quản lý Banner")

@section("content")
<h2 class="title_page">Quản lý Banner</h2>

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
    <a class="box_link" href="{{route('banner.create')}}">Thêm Quảng Cáo</a>
    <div class="content px-3">
        <table class="table table-striped mt-4">
            <thead class="thead">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tên Banner</th>
                    <th scope="col">Hình Ảnh</th>
                    <th scope="col">Hình Ảnh Mobile</th>
                    <th scope="col">Trạng Thái</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($banner as $banner)
                <tr>
                    <td>{{ $banner->id }}</td>
                    <td>{{ $banner->banner_name }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->banner_name }}" width="100">
                    </td>
                    <td>
                        <img src="{{ asset('storage/' . $banner->image_mobile) }}" alt="{{ $banner->banner_name }} Mobile" width="100">
                    </td>
                    <td><input type="checkbox" {{ $banner->active == 1 ? 'checked' : '' }} ></td>
                    <td>
                        <a class="btn btn-primary" href="">Cập nhật</a>
                        <a href="{{ route('banner.edit', $banner->id) }}" class="btn btn-warning">Sửa</a>
                        <form action="{{ route('banner.destroy', $banner->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa banner này không?')">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
