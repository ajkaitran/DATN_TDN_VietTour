@extends('shared._layoutAdmin')
@section('title', 'Register')

@section('content')
    <h2 class="title_page">
        Quản lý đánh giá
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
        <div class="content px-3">
            <table class="table table-striped">
                <thead class="thead">
                    <tr>
                        <th style="width: 50px;" scope="col">STT</th>
                        <th style="width: 150px;" scope="col">Mã Đơn hàng</th>
                        <th style="width: 250px;" scope="col">Nội dung</th>
                        <th style="width: 100px;" scope="col">Số Sao</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($assess as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->order_id }}</td>
                            <td>{{ $item->content ?? 'Không có nội dung' }}</td>
                            <td>
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $item->star)
                                        <i class="fa-solid fa-star text-warning"></i>
                                    @else
                                        <i class="fa-regular fa-star text-muted"></i>
                                    @endif
                                @endfor
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $assess->links() }}
        </div>
    </div>
@endsection
