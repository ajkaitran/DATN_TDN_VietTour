@extends("shared._layoutAdmin")
@section("title", "Register")

@section("content")
<h2 class="title_page">
    Sửa Loại Tour
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
    <a class="box_link" href="{{route('tourType.index')}}">Danh sách loại tour</a>
    <form action="{{ route('tourType.store') }}" method="post">
        @csrf
        <div class="row mx-3">
            <div class="col-8 mx-auto">
                <div class="form-group">
                    <label for="" class="form_ext w-25">Loại danh mục</label>
                    <select class="form-control  w-75" aria-label="Default select example">
                        <option value="1">Tour</option>
                        <option value="2">Combo</option>
                        <option value="3">Visa/Hộ chiếu</option>
                      </select>
                </div>
                <div class="form-group">
                    <label for="" class="form_ext w-25">Tên Loại</label>
                    <input type="text" class="form-control w-75" name="" value="{{ old('') }}">
                </div>
                <div class="form-group">
                    <label for="" class="form_ext w-25">Tên hiển thị</label>
                    <input type="text" class="form-control w-75" name="" value="{{ old('') }}">
                </div>
                <div class="form-group">
                    <label for="" class="form_ext w-25">Hình Ảnh</label>
                    <div class="w-75">
                        <label class="form__container" id="upload-container">Choose or Drag & Drop Files
                            <input class="form__file" id="upload-files" type="file" accept="image/*"
                                multiple="multiple" name="image" />
                        </label>
                        <div class="form__files-container" id="files-list-container">
                            {{-- @if(isset($idPro->image))
                                <img src="{{Storage::url($idPro->image)}}" style="width:200px" height="200px">
                            @else
                            Không có hình ảnh
                            @endif --}}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="form_ext w-25">Đường dẫn</label>
                    <input type="text" class="form-control w-75" name="" value="{{ old('') }}">
                </div>
                <div class="form_check">
                    <label for="" class="form_ext w-25">Hoạt động</label>
                    <input type="checkbox" name="" value="{{ old('') }}">
                </div>
                <div class="form_check">
                    <label for="" class="form_ext w-25">Hiển thị menu</label>
                    <input type="checkbox" name="" value="{{ old('') }}">
                </div>
                <div class="form_check">
                    <label for="" class="form_ext w-25">Hiển thị trang chủ</label>
                    <input type="checkbox" name="" value="{{ old('') }}">
                </div>
                <div class="mx-auto">
                    <button type="submit" class="btn btn-success">Cập nhật</button>
                </div>
            </div>
        </div>
    </form>
</div>


@endsection