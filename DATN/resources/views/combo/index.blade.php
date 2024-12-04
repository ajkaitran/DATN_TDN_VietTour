@extends("shared._layoutAdmin")
@section("title", "Quản lý Banner")

@section("content")
<h2 class="title_page">Quản lý Combo</h2>

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
    <a class="box_link" href="{{route('combo.create')}}">Thêm Combo</a>
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
                @for ($i = 0; $i < 5; $i++)
                <tr>
                    <td>1</td>
                    <td>
                        <img src="{{ url('images/avt.jpg') }}" style="width: 100%;">
                    </td>
                    <td>
                        <div class="tbody-item-column">
                            <p>Tour du lịch Sapa 3N2D</p>
                            <div class="tbody-item-flex">
                                <p>Mã SP: 001</p>
                                <p class="p_check">Nổi Bật: <input type="checkbox" name="" id=""></p>
                                <p class="p_check">Trang Chủ: <input type="checkbox" name="" id=""></p>
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
                            <input type="text" name="" id="">
                        </div>
                        <div class="tbody-item-column">
                            <p>Giá Bán:</p>
                            <input type="text" name="" id="">
                        </div>
                    </td>
                    <td>
                        <div class="tbody-item-column">
                            <strong>Tour Quốc Tế</strong>
                            <strong>Đông Nam Á</strong>
                            <strong>Singapore - Malaysia</strong>
                        </div>
                    </td>
                    <td>
                        <input type="checkbox" name="" id="">
                    </td>
                    <td>
                        <a class="btn btn-primary mb-2" href="#">Cập nhật</a> <br>
                        <a class="btn btn-warning mr-1" href="#">Sửa</a>
                        <a class="btn btn-danger ml-1" href="#" >Xóa</a>
                    </td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>

@endsection
