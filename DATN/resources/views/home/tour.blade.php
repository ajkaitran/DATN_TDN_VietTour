@extends("shared._layoutMain")
@section("title", "Main")

@section("content")
<div class="relative mb-5">
    <img src="{{ url('images/Banner_home_1.jpg') }}">
</div>
<section class="index_3 bg-white p-5 rounded-lg shadow-md">
    <div class="container">
        <h2 class="title_index title">Tour Nội Địa</h2>
        <div class="row row-cols-4">
            @foreach($listTours as $items)
            <div class="col my-3">
                <div class="tour_card">
                    <a class="tour_img" href="#">
                        <img src="{{ asset('storage/' . $items->image) }}" alt="hình ảnh" width="100">
                    </a>
                    <div class="tour_content">
                        <a class="tour_name title_name" href="#">{{$items->name}}</a>
                        <div class="star">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <=$items->star)
                                <i class="fa-solid fa-star"></i>
                                @else
                                <i class="fa-regular fa-star"></i>
                                @endif
                                @endfor
                        </div>
                        <div class="date-go">
                            <i class="fa-solid fa-calendar-clock me-1"></i>Lịch khởi hành: <time>{{$items->transport}}</time>
                        </div>
                        <div class="row mt-2">
                            <div class="col-7">
                                <div class="price_box">
                                    <span>{{ number_format($items->sale_off, 0, ',', '.') }}đ</span>
                                    <del>{{ number_format($items->price, 0, ',', '.') }}đ</del>
                                </div>
                            </div>
                            <div class="col-5 d-flex justify-content-end align-items-center">
                                <a class="btn_card" href="#">
                                    <i class="fa-regular fa-calendar-circle-plus"></i> Đặt Tour
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mx-auto">
            {{$listTours->links()}}
        </div>
    </div>
</section>
@endsection