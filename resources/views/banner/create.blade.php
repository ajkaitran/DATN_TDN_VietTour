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
                        <label class="form_ext w-25" for="banner_group">Vị trí quảng cáo</label>
                        <select class="form-control w-75" name="banner_group" id="banner_group">
                            <option selected disabled>Chọn vị trí banner</option>
                            @foreach ($bannerGroup as $key => $value)
                                <option value="{{ $key }}" {{ old('banner_group') == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
        
                    <!-- Tên Banner -->
                    <div class="form-group">
                        <label class="form_ext w-25" for="banner_name">Tên Banner</label>
                        <input type="text" class="form-control w-75" id="banner_name" name="banner_name" value="{{ old('banner_name') }}">
                    </div>
        
                    <!-- URL -->
                    <div class="form-group">
                        <label class="form_ext w-25" for="url">URL</label>
                        <input type="url" class="form-control w-75" id="url" name="url" value="{{ old('url') }}">
                    </div>
        
                    <div class="form-group">
                        <label class="form_ext w-25" for="image">Hình Ảnh</label>
                        <div class="w-75">
                            <label class="form__container" for="image" id="upload-container">Choose or Drag & Drop Files
                                <input class="form__file" id="upload-files" type="file" accept="image/*" name="image" multiple="multiple">
                            </label>
                            <div class="desktop-show"></div> <!-- Hiển thị ảnh trên desktop -->
                        </div>
                    </div>
                    
                    <!-- Hình Ảnh Mobile -->
                    <div class="form-group">
                        <label class="form_ext w-25" for="image_mobile">Hình Ảnh Mobile</label>
                        <div class="w-75">
                            <label class="form__container" for="image_mobile">Choose or Drag & Drop Files
                                <input class="form__file" id="image_mobile" type="file" accept="image/*" name="image_mobile">
                            </label>
                            <div class="mobile-show"></div> <!-- Hiển thị ảnh trên mobile -->
                        </div>
                    </div>
                    
        
                    <!-- Trạng Thái -->
                    <div class="form_check">
                        <label class="form_ext w-25" for="active">Trạng Thái</label>
                        <input type="checkbox" id="active" name="active" value="1" {{ old('active') == 1 ? 'checked' : '' }}>
                    </div>
        
                    <!-- Sắp xếp -->
                    <div class="form-group">
                        <label class="form_ext w-25" for="sort">Sắp xếp</label>
                        <input type="number" class="form-control w-75" id="sort" name="sort" value="{{ old('sort') }}">
                    </div>
        
                    <!-- Slogan -->
                    <div class="form-group">
                        <label class="form_ext w-25" for="slogan">Slogan</label>
                        <input type="text" class="form-control w-75" id="slogan" name="slogan" value="{{ old('slogan') }}">
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
