@extends("shared._layoutAdmin")
@section("title", "Quản lý Banner")

@section("content")
<h2 class="title_page">Quản lý Bài Viết</h2>

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
    <a class="box_link" href="{{route('article.create')}}">Thêm Bài viết</a>
    <div class="content px-3">
        <table class="table table-striped mt-4">
            <thead class="thead">
                <tr>
                    <th style="width: 120px;" scope="col">Ngày Đăng</th>
                    <th style="width: 120px;" scope="col">Hình Ảnh</th>
                    <th style="width: 350px;" scope="col">Thông Tin Bài Viết</th>
                    <th style="width: 200px;" scope="col">Danh Mục</th>
                    <th style="width: 120px;" scope="col">Trạng Thái</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 0; $i < 5; $i++)
                <tr>
                    <td>22/07/2024 09:42</td>
                    <td>
                        <img src="{{ url('images/avt.jpg') }}" style="width: 100%;">
                    </td>
                    <td>
                        <div class="tbody-item-column">
                            <p><strong>Ghé thăm cố trấn Lệ Giang - nơi được mệnh danh là cổ trấn đẹp nhất Trung Quốc</strong></p>
                            <div class="tbody-item-flex">
                                <p><strong>Lượt xem: </strong>123456</p>
                            </div>
                            <div class="tbody-item-flex">
                                <a href="#">Nhân Đôi</a>
                                <a href="#">Xem Thử</a>
                                <a href="#">Danh Sách Đánh Giá</a>
                            </div>
                        </div>
                    </td>
                    <td>
                        <strong>Blog-Du Lịch</strong>
                    </td>
                    <td>
                        <input type="checkbox" name="" id="">
                    </td>
                    <td>
                        <a class="btn btn-primary mb-2" href="">Cập nhật</a> <br>
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
