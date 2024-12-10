@extends('shared._layoutAdmin')
@section('title', 'Quản lý Banner')

@section('content')
    <h2 class="title_page">Quản lý Tour</h2>

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
        <a class="box_link" href="{{ route('tour.create') }}">Thêm Tour</a>
        <div class="content px-3">
            <table class="table table-striped mt-4">
                <thead class="thead">
                    <tr>
                        <th style="width: 50px;" scope="col">STT</th>
                        <th style="width: 120px;" scope="col">Hình Ảnh</th>
                        <th style="width: 350px;" scope="col">Thông Tin Tour</th>
                        <th style="width: 150px;" scope="col">Giá tiền</th>
                        <th style="width: 200px;" scope="col">Danh Mục</th>
                        <th style="width: 120px;" scope="col">Trạng Thái</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tours as $key => $tour)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                <img src="{{ Storage::url('tour/' . $tour->image) }}" style="width: 100%;">
                            </td>
                            <td>
                                <div class="tbody-item-column">
                                    <p>{{ $tour->name }}</p>
                                    <div class="tbody-item-flex">
                                        <p>Mã SP: {{ $tour->product_code }}</p>
                                        <p class="p_check">Nổi Bật: <input type="checkbox" name="is_hot"
                                                data-id="{{ $tour->id }}" id=""
                                                {{ $tour->is_hot == 1 ? 'checked' : '' }}>
                                        </p>
                                        <p class="p_check">Trang Chủ: <input type="checkbox" name="active"
                                                data-id="{{ $tour->id }}" id=""
                                                {{ $tour->active == 1 ? 'checked' : '' }}>
                                        </p>
                                    </div>
                                    <div class="tbody-item-flex">
                                        <a href="#">Nhân Đôi</a>
                                        <a href="#">Xem Thử</a>
                                    </div>
                                    <div class="tbody-item-flex">
                                        <a href="#">Danh Sách Đánh Giá</a>
                                        <a href="#">Danh Sách Câu Hỏi</a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="tbody-item-column">
                                    <p>Giá KM:</p>
                                    <input type="text" name="price" id="" value="{{ $tour->price }}">
                                </div>
                                <div class="tbody-item-column">
                                    <p>Giá Bán:</p>
                                    <input type="text" name="sale_off" value="{{ $tour->sale_off }}" id="">
                                </div>
                            </td>
                            <td>
                                <div class="tbody-item-column">
                                    {{ $tour->category->name ?? 'Chua co danh muc' }}
                                </div>
                            </td>
                            <td>
                                <input type="checkbox" name="active" data-id="{{ $tour->id }}" id="">
                            </td>
                            <td>
                                <a class="btn btn-primary mb-2" href="#">Cập nhật</a> <br>
                                <a class="btn btn-warning mr-1" href="#">Sửa</a>
                                <a class="btn btn-danger ml-1" href="#">Xóa</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
