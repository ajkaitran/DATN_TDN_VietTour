@extends('shared._layoutAdmin')
@section('title', 'Quản lý Tour')

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
                        <th style="width: 350px;" scope="col">Thông Tin Tour</th>
                        <th style="width: 250px;" scope="col">Giá tiền</th>
                        <th style="width: 200px;" scope="col">Danh Mục</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tours as $key => $tour)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>
                                <div class="tbody-item-column pl-5">
                                    <p>Tên tour: {{ $tour->name }}</p>
                                    <div class="tbody-item-flex">
                                        <p>Mã SP: {{ $tour->product_code }}</p>
                                        <p class="p_check">Trang Chủ: <input type="checkbox" name="active"
                                                data-id="{{ $tour->id }}" id=""
                                                {{ $tour->active == 1 ? 'checked' : '' }}>
                                        </p>
                                    </div>
                                    <div class="tbody-item-flex">
                                        <p>Email: {{ $tour->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="tbody-item-column pl-5">
                                    <p>Giá 1: {{ $tour->price1 }}</p>
                                    <p>Giá 2: {{ $tour->price2 }}</p>
                                    <p>Giá 3: {{ $tour->price3 }}</p>
                                    <p>Giá 4: {{ $tour->price4 }}</p>
                                    <p>Giá 5: {{ $tour->price5 }}</p>
                                    <p>Giá gốc: {{ $tour->original_price }}</p>
                                </div>
                            </td>
                            <td>
                                <div class="tbody-item-column">
                                    {{ $tour->product_category->name ?? 'Chua co danh muc' }}
                                </div>
                            </td>
                            <td class="d-flex justify-content-center align-center pt-5 gap-3">
                                <a class="btn btn-warning mr-1"
                                    href="{{ route('tour.edit', ['id' => $tour->id]) }}">Sửa</a>
                                <form action="{{ route('tour.destroy', ['id' => $tour->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
