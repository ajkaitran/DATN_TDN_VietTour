@extends('shared._layoutAdmin')
@section('title', 'Thêm Banner')

@section('content')
    <h2 class="title_page">Thêm Combo</h2>

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
        <a class="box_link" href="{{ route('combo.index') }}">Danh sách Combo</a>
        <div class="content px-3">
            <form action="{{ route('combo.create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mx-3">
                    <div class="col-8">
                        <div class="form-group">
                            <label class="form_ext w-25" for="">Điểm Khởi hành</label>
                            <select class="form-control w-75" name="start_places_id" id="">
                                <option selected disabled>Chọn điểm khởi hành</option>
                                @foreach ($startplace as $place)
                                <option value="{{ $place->id }}">{{ $place->name }}</option>
                                @endforeach
                                {{-- <option value="1">Hà Nội</option>
                                <option value="2">Miền Tung</option>
                                <option value="3">Miền Nam</option> --}}
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="category_type_id">Loại Tour</label>
                            <select class="form-control w-75" name="category_type_id" id="category_type_id" required>
                                <option selected disabled>Chọn loại tour</option>
                                @foreach ($tourtype as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="">Danh Mục Tour</label>
                            <div class=" tbody-item-flex w-75">
                                <select class="form-control w-50" name="main_category_id" id="">
                                    <option selected >Chọn danh mục cha</option>
                                    @foreach ($parentCategories as $categories)
                                        <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                                    @endforeach
                                </select>
                                <select class="form-control w-50" name="product_category_id" id="product_category_id">
                                    <option selected disabled>Chọn danh mục tour</option>
                                    @foreach ($childCategories as $categories)
                                        <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="">Tên Combo</label>
                            <input type="text" class="form-control w-75" name="name" value="">
                        </div>
                        <div class="form-group">
                            <label for="" class="form_ext w-25">Trích Dẫn Ngắn</label>
                            <textarea class="form-control w-75" cols="20" rows="4" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="">Mã Combo</label>
                            <input type="" class="form-control w-75" name="product_code" value="">
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="">Điểm Tham Quan</label>
                            <input type="url" class="form-control w-75" name="attractions" value="">
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="image">Hình Ảnh</label>
                            <div class="w-75">
                                <label class="form__container" for="image" id="upload-container">Choose or Drag & Drop
                                    Files
                                    <input class="form__file" id="upload-files" type="file" accept="image/*"
                                        name="image" multiple="multiple">
                                </label>
                                <div class="desktop-show"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="form_ext w-25">Combo Có Gì Đắc Sắc</label>
                            <textarea type="text" class="form-control w-75" id="editor11" name="highlights"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="">Lịch Khởi Hành</label>
                            <input type="text" class="form-control w-75" name="schedule" value="">
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="">Phương Tiện Di Chuyển</label>
                            <input type="text" class="form-control w-75" name="schedule" value="">
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="">Khách Sạn Mấy Sao</label>
                            <input type="number" class="form-control w-75" name="star" value="">
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="">Giá Bán</label>
                            <input type="text" class="form-control w-75" name="price" value="">
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="">Giá Khuyến Mãi</label>
                            <input type="text" class="form-control w-75" name="sale_off" value="">
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="">Số Hotline</label>
                            <input type="text" class="form-control w-75" name="hotline" value="">
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="TimeDetail">Lịch Trình</label>
                            <select class="form-control w-75" name="TimeDetail" id="TimeDetail" required>
                                <option selected disabled>Chọn lịch trình</option>
                                @for ($i = 1; $i < 20; $i++)
                                    @if ($i == 1)
                                        <option value="{{ $i }}" data-time="{{ $i }}"
                                            {{ old('TimeDetail') == $i ? 'selected' : '' }}>
                                            {{ $i }} ngày
                                        </option>
                                    @else
                                        <option value="{{ $i }}" data-time="{{ $i }}"
                                            {{ old('TimeDetail') == $i ? 'selected' : '' }}>
                                            {{ $i }} ngày {{ $i - 1 }} đêm
                                        </option>
                                    @endif
                                @endfor
                            </select>
                        </div>

                        <!-- Lặp qua các ngày để cho phép người dùng nhập thông tin -->
                        @for ($i = 1; $i <= 20; $i++)
                            <div data-count="{{ $i }}" class="day-info" style="display: none;">
                                <div class="form-group">
                                    <label class="form_ext w-25">Tiêu đề ngày {{ $i }}</label>
                                    <input type="text" name="TimeDetailName[{{ $i }}]"
                                        class="form-control w-75" placeholder="Tiêu đề ngày {{ $i }}">
                                </div>
                                <div class="form-group">
                                    <label class="form_ext w-25">Nội dung ngày {{ $i }}</label>
                                    <textarea class="form-control ckeditor w-75" name="TimeDetailBody[{{ $i }}]"></textarea>
                                </div>
                            </div>
                        @endfor

                        <!-- <div class="form-group">
                            <label for="" class="form_ext w-25">Lưu Ý</label>
                            <textarea class="form-control w-75" cols="20" rows="4" name=""></textarea>
                        </div> -->
                        <div class="form-group">
                            <label for="" class="form_ext w-25">Giá tour trọn gói</label>
                            <textarea type="text" class="form-control w-75" id="editor3" name="package_price"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="" class="form_ext w-25">Giá Tour bao gồm</label>
                            <textarea type="text" class="form-control w-75" id="editor4" name="price_included"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="" class="form_ext w-25">Giá Tour chưa bao gồm</label>
                            <textarea type="text" class="form-control w-75" id="editor5" name="price_excluded"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="" class="form_ext w-25">Điều khoản trẻ em</label>
                            <textarea type="text" class="form-control w-75" id="editor6" name="children_policy"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="" class="form_ext w-25">Quy định đăng ký & thanh toán</label>
                            <textarea type="text" class="form-control w-75" id="editor7" name="registration_terms"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="" class="form_ext w-25">Điều kiện hoãn hủy Tour</label>
                            <textarea type="text" class="form-control w-75" id="editor8" name="cancellation_policy"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="" class="form_ext w-25">Thông tin xin Visa</label>
                            <textarea type="text" class="form-control w-75" id="editor9" name="visa_info"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="" class="form_ext w-25">Lưu ý</label>
                            <textarea type="text" class="form-control w-75" id="editor10" name="notes"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="sort">Thứ Tự</label>
                            <input type="number" class="form-control w-75" id="" name="sort"
                                value="">
                        </div>
                        <div class="form_check">
                            <label class="form_ext w-25" for="hot">Nổi Bật</label>
                            <input type="checkbox" id="hot" name="hot" value="1"
                                {{ old('hot') == 1 ? 'checked' : '' }}>
                        </div>
                        <div class="form_check">
                            <label class="form_ext w-25" for="home_page">Hiện Trang Chủ</label>
                            <input type="checkbox" id="home_page" name="home_page" value="1"
                                {{ old('home_page') == 1 ? 'checked' : '' }}>
                        </div>
                        <div class="form_check">
                            <label class="form_ext w-25" for="active">Trạng Thái</label>
                            <input type="checkbox" id="active" name="active" value="1"
                                {{ old('active') == 1 ? 'checked' : '' }}>
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="slogan">Tag</label>
                            <input type="text" class="form-control w-75" id="" name="tags"
                                value="">
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="slogan">Url</label>
                            <input type="text" class="form-control w-75" id="" name="url"
                                value="">
                        </div>
                        <div class="form-group">
                            <label for="" class="form_ext w-25">Thẻ tiêu đề</label>
                            <textarea class="form-control w-75" cols="20" rows="4" name="title"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="" class="form_ext w-25">Thẻ mô tả</label>
                            <textarea class="form-control w-75" cols="20" rows="4" name="detailed_description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Thêm Mới</button>
                        <a href="{{ route('banner.index') }}" class="btn btn-secondary">Quay lại</a>
                    </div>
                    <div class="col-4">
                        <div class="box_article">
                            <h5><strong>Bài Viết</strong></h5>
                            <input class="my-2" type="text" name="" id=""
                                placeholder="Nhập từ Khóa...">
                            <ul>
                                @for ($i = 1; $i < 15; $i++)
                                    <li>
                                        <label><input type="checkbox" name="ArticleId" value="33"> Ghé thăm cố trấn
                                            Lệ Giang - nơi được mệnh danh là cổ trấn đẹp nhất Trung Quốc</label>
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
