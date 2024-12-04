@extends("shared._layoutAdmin")
@section("title", "Thêm Banner")

@section("content")
<h2 class="title_page">Thêm Tour</h2>

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
    <a class="box_link" href="{{route('tour.index')}}">Danh sách Tour</a>
    <div class="content px-3">
        <form action="{{ route('tour.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mx-3">
                <div class="col-8">
                    <div class="form-group">
                        <label class="form_ext w-25" for="">Điểm Khởi hành</label>
                        <select class="form-control w-75" name="" id="">
                            <option selected disabled>Chọn điểm khởi hành</option>
                            <option selected value="1">Chọn điểm khởi hành</option>
                            <option selected value="1">Chọn điểm khởi hành</option>
                            <option selected value="1">Chọn điểm khởi hành</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form_ext w-25" for="">Loại Tour</label>
                        <select class="form-control w-75" name="" id="">
                            <option selected disabled>Chọn loại tour</option>
                            <option selected value="1">Chọn điểm khởi hành</option>
                            <option selected value="1">Chọn điểm khởi hành</option>
                            <option selected value="1">Chọn điểm khởi hành</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form_ext w-25" for="">Danh Mục Tour</label>
                        <div class=" tbody-item-flex w-75">
                            <select class="form-control w-50" name="" id="">
                                <option selected disabled>Chọn danh mục cha</option>
                                <option selected value="1">Chọn điểm khởi hành</option>
                                <option selected value="1">Chọn điểm khởi hành</option>
                                <option selected value="1">Chọn điểm khởi hành</option>
                            </select>
                            <select class="form-control w-50" name="" id="">
                                <option selected disabled>Chọn danh mục tour</option>
                                <option selected value="1">Chọn điểm khởi hành</option>
                                <option selected value="1">Chọn điểm khởi hành</option>
                                <option selected value="1">Chọn điểm khởi hành</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form_ext w-25" for="">Tên Tour</label>
                        <input type="text" class="form-control w-75" name="" value="">
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Thẻ mô tả</label>
                        <textarea class="form-control w-75" cols="20" rows="4" name=""></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form_ext w-25" for="">Mã Tour</label>
                        <input type="url" class="form-control w-75" name="" value="">
                    </div>
                    <div class="form-group">
                        <label class="form_ext w-25" for="">Điểm Tham Quan</label>
                        <input type="url" class="form-control w-75" name="" value="">
                    </div>
                    <div class="form-group">
                        <label class="form_ext w-25" for="image">Hình Ảnh</label>
                        <div class="w-75">
                            <label class="form__container" for="image" id="upload-container">Choose or Drag & Drop Files
                                <input class="form__file" id="upload-files" type="file" accept="image/*" name="image" multiple="multiple">
                            </label>
                            <div class="desktop-show"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Tour Có Gì Đắc Sắc</label>
                        <textarea type="text" class="form-control w-75" id="editor1" name=""></textarea>
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Giới Thiệu Chung</label>
                        <textarea type="text" class="form-control w-75" id="editor2" name=""></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form_ext w-25" for="">Lịch Khởi Hành</label>
                        <input type="text" class="form-control w-75" name="" value="">
                    </div>
                    <div class="form-group">
                        <label class="form_ext w-25" for="">Phương Tiện Di Chuyển</label>
                        <input type="text" class="form-control w-75" name="" value="">
                    </div>
                    <div class="form-group">
                        <label class="form_ext w-25" for="">Khách Sạn Mấy Sao</label>
                        <input type="number" class="form-control w-75" name="" value="">
                    </div>
                    <div class="form-group">
                        <label class="form_ext w-25" for="">Giá Bán</label>
                        <input type="text" class="form-control w-75" name="" value="">
                    </div>
                    <div class="form-group">
                        <label class="form_ext w-25" for="">Giá Khuyến Mãi</label>
                        <input type="text" class="form-control w-75" name="" value="">
                    </div>
                    <div class="form-group">
                        <label class="form_ext w-25" for="">Số Hotline</label>
                        <input type="text" class="form-control w-75" name="" value="">
                    </div>
                    <div class="form-group">
                        <label class="form_ext w-25" for="TimeDetail">Lịch Trình</label>
                        <select class="form-control w-75" name="TimeDetail" id="TimeDetail" required>
                            <option selected disabled>Chọn lịch trình</option>
                            @for ($i = 1; $i < 20; $i++)
                                @if ($i == 1)
                                    <option value="{{ $i }}" data-time="{{ $i }}" {{ old('TimeDetail') == $i ? 'selected' : '' }}>
                                        {{ $i }} ngày
                                    </option>
                                @else
                                    <option value="{{ $i }}" data-time="{{ $i }}" {{ old('TimeDetail') == $i ? 'selected' : '' }}>
                                        {{ $i }} ngày {{ $i - 1 }} đêm
                                    </option>
                                @endif
                            @endfor
                        </select>
                    </div>
                    
                    @for ($i = 1; $i < 20; $i++)
                        <div data-count="{{ $i }}" style="display: none;">
                            <div class="form-group">
                                <label class="form_ext w-25">Tiêu đề ngày {{ $i }}</label>
                                <input type="text" name="TimeDetailName-{{ $i }}" class="form-control w-75" placeholder="Tiêu đề ngày {{ $i }}">
                            </div>
                        </div>
                        <div data-count="{{ $i }}" style="display: none;">
                            <div class="form-group">
                                <label class="form_ext w-25">Nội dung ngày {{ $i }}</label>
                                <textarea class="form-control ckeditor w-75" name="TimeDetailBody-{{ $i }}"></textarea>
                            </div>
                        </div>
                    @endfor
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Lưu Ý</label>
                        <textarea class="form-control w-75" cols="20" rows="4" name=""></textarea>
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Giá tour trọn gói</label>
                        <textarea type="text" class="form-control w-75" id="editor3" name=""></textarea>
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Giá Tour bao gồm</label>
                        <textarea type="text" class="form-control w-75" id="editor4" name=""></textarea>
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Giá Tour chưa bao gồm</label>
                        <textarea type="text" class="form-control w-75" id="editor5" name=""></textarea>
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Điều khoản trẻ em</label>
                        <textarea type="text" class="form-control w-75" id="editor6" name=""></textarea>
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Quy định đăng ký & thanh toán</label>
                        <textarea type="text" class="form-control w-75" id="editor7" name=""></textarea>
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Điều kiện hoãn hủy Tour</label>
                        <textarea type="text" class="form-control w-75" id="editor8" name=""></textarea>
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Thông tin xin Visa</label>
                        <textarea type="text" class="form-control w-75" id="editor9" name=""></textarea>
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Lưu ý khi đi tour</label>
                        <textarea type="text" class="form-control w-75" id="editor10" name=""></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form_ext w-25" for="sort">Thứ Tự</label>
                        <input type="number" class="form-control w-75" id="" name="" value="">
                    </div>
                    <div class="form_check">
                        <label class="form_ext w-25" for="active">Nổi Bật</label>
                        <input type="checkbox" id="active" name="active" value="1" {{ old('active') == 1 ? 'checked' : '' }}>
                    </div>
                    <div class="form_check">
                        <label class="form_ext w-25" for="active">Hiện Trang Chủ</label>
                        <input type="checkbox" id="active" name="active" value="1" {{ old('active') == 1 ? 'checked' : '' }}>
                    </div>
                    <div class="form_check">
                        <label class="form_ext w-25" for="active">Trạng Thái</label>
                        <input type="checkbox" id="active" name="active" value="1" {{ old('active') == 1 ? 'checked' : '' }}>
                    </div>
                    <div class="form-group">
                        <label class="form_ext w-25" for="slogan">Tag</label>
                        <input type="text" class="form-control w-75" id="" name="" value="">
                    </div>
                    <div class="form-group">
                        <label class="form_ext w-25" for="slogan">Url</label>
                        <input type="text" class="form-control w-75" id="" name="" value="">
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Thẻ tiêu đề</label>
                        <textarea class="form-control w-75" cols="20" rows="4" name=""></textarea>
                    </div>
                    <div class="form-group">
                        <label for="" class="form_ext w-25">Thẻ mô tả</label>
                        <textarea class="form-control w-75" cols="20" rows="4" name=""></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Thêm Mới</button>
                    <a href="{{ route('banner.index') }}" class="btn btn-secondary">Quay lại</a>
                </div>
                <div class="col-4">
                    <div class="box_article">
                        <h5><strong>Bài Viết</strong></h5>
                        <input class="my-2" type="text" name="" id="" placeholder="Nhập từ Khóa...">
                        <ul>
                            @for($i = 1; $i < 15; $i++)
                            <li>
                                <label><input type="checkbox" name="ArticleId" value="33"> Ghé thăm cố trấn Lệ Giang - nơi được mệnh danh là cổ trấn đẹp nhất Trung Quốc</label>
                            </li>
                            @endfor
                        </ul>
                    </div>
                </div>
            </div>
        </form>
        
    </div>
</div>

@endsection
