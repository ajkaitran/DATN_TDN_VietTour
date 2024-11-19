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

<div class="box_content">
    <a class="box_link" href="{{route('banner.index')}}">Danh sách quảng cáo</a>
    <div class="content px-3">
        <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mx-3">
                <div class="col-8 mx-auto">
                    <!-- Vị trí quảng cáo -->
                    <div class="form-group">
                        <label class="form_ext w-25" for="group_id">Vị trí quảng cáo</label>
                        <select class="form-control w-75" name="group_id" id="group_id">
                            <option selected disabled>Chọn vị trí banner</option>
                            <option value="1" {{ old('group_id') == 1 ? 'selected' : '' }}>Banner slide</option>
                            <option value="2" {{ old('group_id') == 2 ? 'selected' : '' }}>Ưu đãi</option>
                            <option value="3" {{ old('group_id') == 3 ? 'selected' : '' }}>Đối tác</option>
                            <option value="4" {{ old('group_id') == 4 ? 'selected' : '' }}>Góc báo trí</option>
                            <option value="5" {{ old('group_id') == 5 ? 'selected' : '' }}>Cam kết</option>
                            <option value="6" {{ old('group_id') == 6 ? 'selected' : '' }}>Lý do chọn chúng tôi</option>
                        </select>
                        @error('group_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
        
                    <!-- Tên Banner -->
                    <div class="form-group">
                        <label class="form_ext w-25" for="banner_name">Tên Banner</label>
                        <input type="text" class="form-control w-75" id="banner_name" name="banner_name" required value="{{ old('banner_name') }}">
                        @error('banner_name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
        
                    <!-- URL -->
                    <div class="form-group">
                        <label class="form_ext w-25" for="url">URL</label>
                        <input type="url" class="form-control w-75" id="url" name="url" value="{{ old('url') }}">
                        @error('url') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
        
                    <!-- Hình Ảnh -->
                    <div class="form-group">
                        <label class="form_ext w-25" for="image">Hình Ảnh</label>
                        <div class="w-75">
                            <label class="form__container" for="image" id="upload-container">Choose or Drag & Drop Files
                                <input class="form__file" id="upload-files" type="file" accept="image/*" name="image" multiple="multiple">
                            </label>
                            <div class="form__files-container" id="files-list-container"></div>
                            @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
        
                    <!-- Hình Ảnh Mobile -->
                    <div class="form-group">
                        <label class="form_ext w-25" for="image_mobile">Hình Ảnh Mobile</label>
                        <div class="w-75">
                            <label class="form__container" for="image_mobile">Choose or Drag & Drop Files
                                <input class="form__file" id="image_mobile" type="file" accept="image/*" name="image_mobile">
                            </label>
                            <div class="form__files-container" id="files-list-container"></div>
                            @error('image_mobile') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
        
                    <!-- Trạng Thái -->
                    <div class="form_check">
                        <label class="form_ext w-25" for="active">Trạng Thái</label>
                        <input type="checkbox" id="active" name="active" value="1" {{ old('active') == 1 ? 'checked' : '' }}>
                        @error('active') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
        
                    <!-- Sắp xếp -->
                    <div class="form-group">
                        <label class="form_ext w-25" for="sort">Sắp xếp</label>
                        <input type="number" class="form-control w-75" id="sort" name="sort" required value="{{ old('sort') }}">
                        @error('sort') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
        
                    <!-- Slogan -->
                    <div class="form-group">
                        <label class="form_ext w-25" for="slogan">Slogan</label>
                        <input type="text" class="form-control w-75" id="slogan" name="slogan" value="{{ old('slogan') }}">
                        @error('slogan') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
        
                    <!-- Buttons -->
                    <button type="submit" class="btn btn-success">Thêm Banner</button>
                    <a href="{{ route('banner.index') }}" class="btn btn-secondary">Quay lại</a>
                </div>
            </div>
        </form>
        
    </div>
</div>

@endsection
