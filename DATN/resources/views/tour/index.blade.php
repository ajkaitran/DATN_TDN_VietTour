@extends('shared._layoutAdmin')
@section('title', 'Quản lý Banner')

@section('content')
<h2 class="title_page">Quản lý tour</h2>

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
    <form action="{{ route('tour.index') }}" method="GET">
        <div class="row mx-auto">
            <div class="col-12">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Tên Tour" name="name" value="{{ request('name') }}">
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <select class="form-control" name="category_type_id" id="category_type_id">
                        <option value="">Chọn loại tour</option>
                        @foreach ($tourtypes as $type)
                        <option value="{{ $type->id }}" {{ request('category_type_id') == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <select class="form-control" name="main_category_id" id="main_category_id">
                        <option value="">Chọn danh mục cha</option>
                        @foreach ($parentCategories as $category)
                        <option value="{{ $category->id }}" {{ request('main_category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <select class="form-control" name="product_category_id" id="product_category_id">
                        <option value="">Chọn danh mục con</option>
                        @foreach ($childCategories as $category)
                        <option value="{{ $category->id }}" {{ request('product_category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="box_log">Lọc dữ liệu</button>
        </div>
    </form>

</div>
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
                @foreach ($tours as $tour)
                <tr>
                    <td>{{ $tour->id }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $tour->image) }}" alt="hình ảnh" width="100">
                    </td>
                    <td>
                        <div class="tbody-item-column">
                            <p>{{ $tour->name }}</p>
                            <div class="tbody-item-flex">
                                <p>{{ $tour->product_code }}</p>
                                <p class="p_check">Nổi Bật: <input type="checkbox" name=""
                                        {{ $tour->hot == 1 ? 'checked' : '' }}>
                                </p>
                                <p class="p_check">Trang Chủ: <input type="checkbox" name=""
                                        {{ $tour->home_page == 1 ? 'checked' : '' }}>
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
                            <input type="text" name="" id="" value="{{ $tour->sale_off }}">
                        </div>
                        <div class="tbody-item-column">
                            <p>Giá Bán:</p>
                            <input type="text" name="" id="" value="{{ $tour->price }}">
                        </div>
                    </td>
                    <td>
                        <div class="tbody-item-column">
                            <strong>{{ $tour->type->name ?? 'Không xác định' }}</strong> <!-- Hiển thị loại tour -->

                            <!-- Hiển thị tên danh mục cha -->
                            @foreach($ProductCategories as $parent)
                            @if ($tour->main_category_id == $parent->id)
                            <div>
                                <strong>{{ $parent->name }}</strong> <!-- Tên danh mục cha -->
                            </div>
                            @endif
                            @endforeach
                            <!-- Hiển thị tên danh mục con -->
                            @foreach($ProductCategories as $child)
                            @if ($tour->product_category_id == $child->id)
                            <div>
                                <strong>{{ $child->name }}</strong> <!-- Tên danh mục con -->
                            </div>
                            @endif
                            @endforeach
                        </div>
    </div>
    </td>

    <td>
        <input type="checkbox" name="" {{ $tour->active == 1 ? 'checked' : '' }}>
    </td>
    <td>
        {{-- <a class="btn btn-primary mb-2" href="#">Cập nhật</a> <br> --}}
        <a class="btn btn-warning mr-1" href="{{ route('tour.edit', ['id'=>$tour->id]) }}">Sửa</a>
        <a class="btn btn-danger ml-1" href="{{ route('tour.destroy', ['id'=>$tour->id]) }}">Xóa</a>
    </td>
    </tr>
    @endforeach
    </tbody>
    </table>
    {{$tours->links()}}
</div>
</div>

@endsection