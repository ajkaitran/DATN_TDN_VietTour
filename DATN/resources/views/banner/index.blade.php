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

<div class="right-column">
    <div class="formcontent">
        <div class="content p-3">
            <table class="table table-striped mt-4">
                <thead class="thead">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tên Banner</th>
                        <th scope="col">Slogan</th>
                        <th scope="col">URL</th>
                        <th scope="col">Hình Ảnh</th>
                        <th scope="col">Hình Ảnh Mobile</th>
                        <th scope="col">Trạng Thái</th>
                        <th scope="col">Group ID</th>
                        <th scope="col">Sort</th>
                        <th scope="col">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($banner as $banner)
                    <tr>
                        <td>{{ $banner->id }}</td>
                        <td>{{ $banner->banner_name }}</td>
                        <td>{{ $banner->slogan }}</td>
                        <td><a href="{{ $banner->url }}" target="_blank">{{ $banner->url }}</a></td>
                        <td>
                            <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->banner_name }}" width="100">
                        </td>
                        <td>
                            <img src="{{ asset('storage/' . $banner->image_mobile) }}" alt="{{ $banner->banner_name }} Mobile" width="100">
                        </td>
                        <td>{{ $banner->active ? 'Kích hoạt' : 'Không kích hoạt' }}</td>
                        <td>{{ $banner->group_id }}</td>
                        <td>{{ $banner->sort }}</td>
                        <td>
                            <a href="{{ route('banners.edit', $banner->id) }}" class="btn btn-warning">Sửa</a>
                            <form action="{{ route('banners.destroy', $banner->id) }}" method="POST" style="display:inline;">
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
</div>
@endsection
