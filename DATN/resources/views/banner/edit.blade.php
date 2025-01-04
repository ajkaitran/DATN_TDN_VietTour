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

<div class="box_content">
    <a class="box_link" href="{{route('banner.index')}}">Danh sách quảng cáo</a>
    <div class="content px-3">
        <form action="{{ route('banner.update', $idBanner->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row mx-3">
                <div class="col-8 mx-auto">
                    <div class="form-group">
                        <label class="form_ext w-25" for="banner_group">Vị trí quảng cáo</label>
                        <select class="form-control w-75" name="banner_group" id="banner_group">
                            <option selected disabled>Chọn vị trí banner</option>
                            @foreach ($bannerGroup as $key => $value)
                            <option value="{{ $key }}" {{ $idBanner->banner_group == $key ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Tên Banner -->
                    <div class="form-group">
                        <label class="form_ext w-25" for="banner_name">Tên Banner</label>
                        <input type="text" class="form-control w-75" id="banner_name" name="banner_name" value="{{ old('banner_name', $idBanner->banner_name) }}">
                    </div>

                    <!-- URL -->
                    <div class="form-group">
                        <label class="form_ext w-25" for="url">URL</label>
                        <input type="url" class="form-control w-75" id="url" name="url" value="{{ old('url', $idBanner->url) }}">
                    </div>

                    <!-- Hình Ảnh -->
                    <div class="form-group">
                        <label class="form_ext w-25" for="image">Hình Ảnh</label>
                        <div class="w-75">
                            <label class="form__container" for="image" id="upload-container">Choose or Drag & Drop Files
                                <input class="form__file" id="upload-files" type="file" accept="image/*" name="image" multiple="multiple">
                            </label>
                            <div class="desktop-show">
                                @if ($idBanner->image)
                                <img src="{{ asset('storage/' . $idBanner->image) }}" alt="Hình ảnh hiện tại" width="200">
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Hình Ảnh Mobile -->
                    <div class="form-group">
                        <label class="form_ext w-25" for="image_mobile">Hình Ảnh Mobile</label>
                        <div class="w-75">
                            <label class="form__container" for="image_mobile">Choose or Drag & Drop Files
                                <input class="form__file" id="image_mobile" type="file" accept="image/*" name="image_mobile">
                            </label>
                            <div class="mobile-show">
                                @if ($idBanner->image_mobile)
                                <img src="{{ asset('storage/' . $idBanner->image_mobile) }}" alt="Hình ảnh mobile hiện tại" width="200">
                                @endif

                            </div>
                        </div>
                    </div>

                    <!-- Trạng Thái -->
                    <div class="form_check">
                        <label class="form_ext w-25" for="active">Trạng Thái</label>
                        <input type="checkbox" id="active" name="active" value="1" {{ old('active', $idBanner->active) ? 'checked' : '' }}>
                    </div>

                    <!-- Sắp xếp -->
                    <div class="form-group">
                        <label class="form_ext w-25" for="sort">Sắp xếp</label>
                        <input type="number" class="form-control w-75" id="sort" name="sort" value="{{ old('sort', $idBanner->sort) }}">
                    </div>

                    <!-- Slogan -->
                    <div class="form-group">
                        <label class="form_ext w-25" for="slogan">Slogan</label>
                        <input type="text" class="form-control w-75" id="slogan" name="slogan" value="{{ old('slogan', $idBanner->slogan) }}">
                    </div>
        
                    <!-- Buttons -->
                    <button type="submit" class="btn btn-success">Cập nhật</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
