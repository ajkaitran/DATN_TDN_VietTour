@extends("shared._layoutAdmin")
@section("title", "Chỉnh Sửa Banner")

@section("content")
<h2 class="title_page">Chỉnh Sửa Banner</h2>

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

<div class="right-column">
    <div class="formcontent">
        <div class="content p-3">
            <form action="{{ route('banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="banner_name" class="form-label">Tên Banner</label>
                    <input type="text" class="form-control" name="banner_name" value="{{ old('banner_name', $banner->banner_name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="slogan" class="form-label">Slogan</label>
                    <input type="text" class="form-control" name="slogan" value="{{ old('slogan', $banner->slogan) }}">
                </div>

                <div class="mb-3">
                    <label for="url" class="form-label">URL</label>
                    <input type="url" class="form-control" name="url" value="{{ old('url', $banner->url) }}" required>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Hình Ảnh</label>
                    <input type="file" class="form-control" name="image">
                    <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->banner_name }}" width="100" class="mt-2">
                </div>

                <div class="mb-3">
                    <label for="image_mobile" class="form-label">Hình Ảnh Mobile</label>
                    <input type="file" class="form-control" name="image_mobile">
                    <img src="{{ asset('storage/' . $banner->image_mobile) }}" alt="{{ $banner->banner_name }} Mobile" width="100" class="mt-2">
                </div>

                <div class="mb-3">
                    <label for="active" class="form-label">Trạng Thái</label>
                    <select class="form-select" name="active">
                        <option value="1" {{ $banner->active ? 'selected' : '' }}>Kích hoạt</option>
                        <option value="0" {{ !$banner->active ? 'selected' : '' }}>Không kích hoạt</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="group_id" class="form-label">Group ID</label>
                    <input type="number" class="form-control" name="group_id" value="{{ old('group_id', $banner->group_id) }}">
                </div>

                <div class="mb-3">
                    <label for="sort" class="form-label">Sort</label>
                    <input type="number" class="form-control" name="sort" value="{{ old('sort', $banner->sort) }}">
                </div>

                <button type="submit" class="btn btn-primary">Cập Nhật</button>
            </form>
        </div>
    </div>
</div>
@endsection
