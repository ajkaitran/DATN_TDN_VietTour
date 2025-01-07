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
            @for ($i = 0; $i < 8; $i++)
            <div class="col my-3">
                <div class="tour_card">
                    <a class="tour_img" href="#">
                        <img src="{{ url('images/Banner_home_1.jpg') }}">
                    </a>
                    <div class="tour_content">
                        <a class="tour_name title_name" href="#">Tour Hàn Quốc: Seoul - Nami - Everland - Bukchon 5N4Đ</a>
                        <div class="star">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <div class="date-go">
                            <i class="fa-solid fa-calendar-clock me-1"></i>Lịch khởi hành: <time>Hàng tuần</time>
                        </div>
                        <div class="row mt-2">
                            <div class="col-7">
                                <div class="price_box">
                                        <span>
                                            13,990,000đ
                                        </span>
                                        <del>
                                            17,590,000đ
                                        </del>
                                </div>
                            </div>
                            <div class="col-5 d-flex justify-content-end align-items-center">
                                <a class="btn_card" href="/order">
                                    <i class="fa-regular fa-calendar-circle-plus"></i> Đặt Tour
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endfor
        </div>
        <div class="text-center mt-3">
            <a class="btn_link text-blue-600 hover:underline" href="#">Xem tất cả <i class="fa-solid fa-arrow-right"></i></a>
        </div>
    </div>
</section>
@endsection