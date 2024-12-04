@extends('shared._layoutAdmin')
@section('title', 'Register')

@section('content')
    <h2 class="title_page">
        Quản lý Danh Mục Tour
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
        <a class="box_link" href="{{ route('tourCategory.create') }}">Thêm danh mục tour</a>
        <div class="content px-3">
            <table class="table table-strped">
                <thead class="thead">
                    <tr>
                        <th style="width: 50px;" scope="col">STT</th>
                        <th style="width: 250px;" scope="col">Tên danh mục</th>
                        <th style="width: 150px;" scope="col">Holine</th>
                        <th style="width: 200px;" scope="col">Địa danh</th>
                        <th style="width: 120px;" scope="col">Hình Ảnh</th>
                        <th style="width: 110px;" scope="col">Hoạt động</th>
                        <th style="width: 110px;" scope="col">Nổi bật</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $tourType)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $tourType->name }}</td>
                            <td>{{ $tourType->hotline }}</td>
                            <td>{{ $tourType->city }}</td>
                            <td><img src="{{ Storage::url('categoryTour/' . $tourType->image) }}" alt=""
                                    class="object-fit-cover"></td>
                            <td>
                                <input type="checkbox" disabled {{ $tourType->active == 1 ? 'checked' : '' }}>
                            </td>
                            <td>
                                <input type="checkbox" disabled {{ $tourType->hot == 1 ? 'checked' : '' }}>
                            </td>
                            <td class="d-flex justify-content-around py-5"> <a class="btn btn-warning"
                                    href="{{ route('tourCategory.edit', ['id' => $tourType->id]) }}">Cập nhật</a>
                                <form action="{{ route('tourCategory.destroy', ['id' => $tourType->id]) }}" method="POST">
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
