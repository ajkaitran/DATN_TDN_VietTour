@extends("shared._layoutAdmin")
@section("title", "Thêm Banner")

@section("content")
<h2 class="title_page">Thêm Banner</h2>

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
            <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="banner_name">Tên Banner</label>
                    <input type="text" class="form-control" name="banner_name" required value="{{ old('banner_name') }}">
                </div>

                <div class="form-group">
                    <label for="url">URL</label>
                    <input type="url" class="form-control" name="url" value="{{ old('url') }}">
                </div>

                <div class="form-group">
                    <label for="image">Hình Ảnh</label>
                    <input type="file" class="form-control" name="image" accept="image/*" required>
                    <small class="form-text text-muted">Chọn hình ảnh cho banner.</small>
                </div>

                <div class="form-group">
                    <label for="image_mobile">Hình Ảnh Mobile</label>
                    <input type="file" class="form-control" name="image_mobile" accept="image/*" required>
                    <small class="form-text text-muted">Chọn hình ảnh cho banner trên di động.</small>
                </div>

                <div class="form-group">
                    <label for="active">Trạng Thái</label>
                    <select class="form-control" name="active">
                        <option value="1" {{ old('active') == 1 ? 'selected' : '' }}>Kích hoạt</option>
                        <option value="0" {{ old('active') == 0 ? 'selected' : '' }}>Không kích hoạt</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="group_id">Group ID</label>
                    <input type="number" class="form-control" name="group_id" required value="{{ old('group_id') }}">
                </div>

                <div class="form-group">
                    <label for="sort">Sắp xếp</label>
                    <input type="number" class="form-control" name="sort" required value="{{ old('sort') }}">
                </div>

                <div class="form-group">
                    <label for="slogan">Slogan</label>
                    <input type="text" class="form-control" name="slogan" value="{{ old('slogan') }}">
                </div>

                <button type="submit" class="btn btn-success">Thêm Banner</button>
                <a href="{{ route('banners.index') }}" class="btn btn-secondary">Quay lại</a>
            </form>
        </div>
    </div>
</div>
@endsection
