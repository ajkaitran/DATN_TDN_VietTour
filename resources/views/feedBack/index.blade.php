@extends('shared._layoutAdmin')
@section('title', 'Register')

@section('content')
<h2 class="title_page">
    Quản lý Phản Hồi
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
    <a class="box_link" href="{{ route('feedback.create') }}">Thêm phản hồi</a>
    <div class="content px-3">
        <table class="table table-strped">
            <thead class="thead">
                <tr>
                    <th style="width: 50px;" scope="col">STT</th>
                    <th style="width: 250px;" scope="col">Hình ảnh</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Nội dung</th>
                    <th scope="col">Loại phản hồi</th>
                    <th style="width: 110px;" scope="col">Hoạt động</th>
                    <th style="width: 200px;"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($feedback as $item)
                <tr>
                    <td>{{ $item->order }}</td>
                    <td><img src="{{ $item->image?''.Storage::url($item->image):''}}" style="width: 100%;" /></td>
                    <td>{{ $item->full_name }}</td>
                    <td>{{ $item->comment }}</td>
                    <td>{{ $item->type == 0 ? 'Khách hàng nói về chúng tôi' : 'Khách hàng tiêu biểu' }}</td>
                    <td>
                        <input type="checkbox" name="active" id="active" value="1"
                            {{ old('active', $item->active ?? 0) == 1 ? 'checked' : '' }}>
                    </td>
                    <td>
                        <a class="btn btn-secondary" href="{{ route('feedback.edit', ['id'=>$item->id]) }}">Sửa</a>
                        <a class="btn btn-danger" href="{{ route('feedback.destroy', ['id'=>$item->id]) }}">Xoá</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection