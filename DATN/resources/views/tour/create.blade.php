@extends('shared._layoutAdmin')
@section('title', 'Thêm Tour')

@section('content')
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
        <a class="box_link" href="{{ route('tour.index') }}">Danh sách Tour</a>
        <div class="content px-3">
            <form action="{{ route('tour.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mx-3">
                    <div class="col-8">
                        <div class="form-group">
                            <label class="form_ext w-25" for="">Tên Tour</label>
                            <input type="text" class="form-control w-75" name="name" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="">Địa chỉ Email</label>
                            <input type="text" class="form-control w-75" name="email" value="{{ old('email') }}">
                        </div>
                        <div class="form-group">
                            <label for="" class="form_ext w-25">Mô tả</label>
                            <textarea class="form-control w-75" cols="20" rows="4" name="description">
                                {{ old('description') }}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="">Danh Mục Tour</label>
                            <div class=" tbody-item-flex w-75">
                                <select class="form-control w-50" name="product_category_id" id="">
                                    @foreach ($categoryTour as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="">Giá 1:</label>
                            <input type="text" class="form-control w-75" name="price1" value="{{ old('price1') }}">
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="">Giá 2:</label>
                            <input type="text" class="form-control w-75" name="price2" value="{{ old('price2') }}">
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="">Giá 3:</label>
                            <input type="text" class="form-control w-75" name="price3" value="{{ old('price3') }}">
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="">Giá 4:</label>
                            <input type="text" class="form-control w-75" name="price4" value="{{ old('price4') }}">
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="">Giá 5:</label>
                            <input type="text" class="form-control w-75" name="price5" value="{{ old('price5') }}">
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="">Giá Trung Bình:</label>
                            <input type="text" class="form-control w-75" name="original_price"
                                value="{{ old('original_price') }}">
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="">Đặt cọc:</label>
                            <input type="text" class="form-control w-75" name="dat_coc" value="{{ old('dat_coc') }}">
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="">Đặt cọc:</label>
                            <input type="text" class="form-control w-75" name="dat_coc" value="{{ old('dat_coc') }}">
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="">Độ tuổi trẻ em:</label>
                            <input type="text" class="form-control w-75" name="do_tuoi_tre_em"
                                value="{{ old('do_tuoi_tre_em') }}">
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="">Độ tuổi trẻ nhỏ:</label>
                            <input type="text" class="form-control w-75" name="do_tuoi_tre_nho"
                                value="{{ old('do_tuoi_tre_nho') }}">
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="">Độ tuổi em bé:</label>
                            <input type="text" class="form-control w-75" name="do_tuoi_em_be"
                                value="{{ old('do_tuoi_em_be') }}">
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="">Tiêu đề phụ thu:</label>
                            <input type="text" class="form-control w-75" name="tieu_de_phu_thu"
                                value="{{ old('tieu_de_phu_thu') }}">
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="">Mã Combo:</label>
                            <input type="text" class="form-control w-75" name="product_code"
                                value="{{ old('product_code') }}">
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="TimeDetail">Thời gian Tour:</label>
                            <select class="form-control w-75" name="time" required>
                                <option selected disabled>Chọn thời gian</option>
                                @for ($i = 1; $i < 20; $i++)
                                    @if ($i == 1)
                                        <option value="{{ $i }}" data-time="{{ $i }}"
                                            {{ old('time') == $i ? 'selected' : '' }}>
                                            {{ $i }} ngày
                                        </option>
                                    @else
                                        <option value="{{ $i }}" data-time="{{ $i }}"
                                            {{ old('time') == $i ? 'selected' : '' }}>
                                            {{ $i }} ngày {{ $i - 1 }} đêm
                                        </option>
                                    @endif
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="">Quà:</label>
                            <input type="text" class="form-control w-75" name="gift" value="{{ old('gift') }}">
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="">Chi tiết quà:</label>
                            <input type="text" class="form-control w-75" name="gift_note"
                                value="{{ old('gift_note') }}">
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="sort">Thứ Tự</label>
                            <input type="number" class="form-control w-75" id="" name="slot"
                                value="{{ old('slot') }}">
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="slogan">Url</label>
                            <input type="text" class="form-control w-75" id="" name="url"
                                value="{{ old('url') }}" required>
                        </div>
                        <div class="form-group">
                            <label class="form_ext w-25" for="slogan">Url đặt tour:</label>
                            <input type="text" class="form-control w-75" id="" name="url_book_tour"
                                value="{{ old('url_book_tour') }}" required>
                        </div>
                        <div class="form_check">
                            <label class="form_ext w-25" for="active">Trạng Thái</label>
                            <input type="checkbox" id="active" name="active" value="1"
                                {{ old('active') == 1 ? 'checked' : '' }}>
                        </div>

                        <button type="submit" class="btn btn-success">Thêm Mới</button>
                        <a href="{{ route('tour.index') }}" class="btn btn-secondary">Quay lại</a>
                    </div>
                </div>
            </form>

        </div>
    </div>

@endsection
