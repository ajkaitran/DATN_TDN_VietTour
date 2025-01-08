@extends("shared._layoutMain")
@section("title", "Main")

@section("content")
<section class="banner">
    <div class="slide_banner">
        @foreach($listBanner1 as $items)
        <img src="{{ asset('storage/' . $items->image) }}" alt="hình ảnh" width="100">
        @endforeach
    </div>
    <div class="banner_content">
        <div class="title_banner">
            <h2 class="title">Du lịch thả ga - Không lo về giá cùng VietTour Travel</h2>
            <p>Chọn điểm đến mà bạn muốn tới, VietTour Travel sẽ mang đến cho bạn chuyến đi tuyệt vời nhất</p>
        </div>
        <form class="search-form" method="get">
            <input type="text" placeholder="Nhập từ khóa tìm kiếm...">
            <button type="submit"><i class="far fa-search"></i></button>
        </form>
    </div>
</section>
<section class="index_1">
    <div class="container">
        <h2 class="title_index title">Ưu đãi hấp dẫn</h2>
        <div class="slide_banner mt-4">
            @foreach($listBanner2 as $items)
            <img src="{{ asset('storage/' . $items->image) }}" alt="hình ảnh" width="100">
            @endforeach
        </div>
    </div>
</section>
<section class="index_2">
    <div class="container">
        <h2 class="title_index title">Những điểm đến được yêu thích</h2>
        <p class="title_content">Tour du lịch quốc tế</p>
        <div class="slide_4">
            @foreach($listCate1 as $items)
            <a class="location" href="">
                <img src="{{ asset('storage/categoryTour/'.$items->image) }}" alt="hình ảnh" width="100">
                <p class="title">{{$items->name}}</p>
            </a>
            @endforeach
        </div>
        <p class="title_content">Tour du lịch nội địa</p>
        <div class="slide_4">
            @foreach($listCate2 as $items)
            <a class="location" href="#">
                <img src="{{ asset('storage/categoryTour/'.$items->image)}}" alt="hình ảnh" width="100">
                <p class="title">{{$items->name}}</p>
            </a>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a class="btn_link" href="#"><i class="fa-solid fa-location-dot"></i> Xem tất cả các điểm đến</a>
        </div>
    </div>
</section>
<section class="index_3">
    <div class="container">
        <h2 class="title_index title">Tour hot 2024</h2>
        <p class="title_content">Các tour được đặt nhiều nhất trong năm nay</p>
        <div class="row row-cols-4">
            @foreach($listTourHome as $items)
            <div class="col my-3">
                <div class="tour_card">
                    <a class="tour_img" href="{{route('home.detail',['id' => $items->id])}}">
                        <img src="{{ asset('storage/Anh_Tour/' . $items->image) }}" alt="hình ảnh" width="100">
                    </a>
                    <div class="tour_content">
                        <a class="tour_name title_name" href="{{route('home.detail',$items->id)}}">{{$items->name}}</a>
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
        <div class="text-center mt-3">
            <a class="btn_link" href="#">Xem tất cả <i class="fa-solid fa-arrow-right"></i></a>
        </div>
    </div>
</section>
<section class="index_3">
    <div class="container">
        <h2 class="title_index title">combo du lịch linh hoạt</h2>
        <div class="row row-cols-4">
            @foreach($listTourCombo as $items)
            <div class="col my-3">
                <div class="tour_card">
                    <a class="tour_img" href="#">
                        <img src="{{ asset('storage/Anh_Tour/' . $items->image) }}" alt="hình ảnh" width="100">
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
    </div>
</section>
<section class="index_4">
    <div class="container">
        <h2 class="title_index title">Blog Du Lịch</h2>
        <p class="title_content">Những kinh nghiệm thú vị về du lịch được chia sẻ ở đây</p>
        <div class="slide_3 my-3">
            @for ($i = 0; $i < 8; $i++)
                <div class="article_group">
                <div class="article_card">
                    <a class="article_img" href="#">
                        <img src="{{ url('images/Banner_home_1.jpg') }}">
                    </a>
                    <a class="title title_name" href="#">Review</a>
                    <a class="article_name title_name" href="#">Du lịch Nhật Bản mua gì về làm quà? Ghi điểm với list những món quà cực ý nghĩa</a>
                </div>
                @for ($j = 0; $j < 2; $j++)
                    <div class="article_card">
                    <a class="article_img" href="#">
                        <img src="{{ url('images/Banner_home_1.jpg') }}">
                    </a>
                    <div class="article_content">
                        <a class="article_name title_name" href="#">Du lịch Nhật Bản mua gì về làm quà? ghi ghi Ghi điểm với list những món quà cực ý nghĩa</a>
                        <div class="date">
                            <i class="fa-solid fa-calendar-clock me-1"></i><time>01/07/2024</time>
                        </div>
                    </div>
        </div>
        @endfor
    </div>
    @endfor
    </div>
    </div>
</section>
<section class="index_5" style="background-image: url('images/bando.png')">
    <div class="container">
        <h2 class="title_index title">KHÁCH HÀNG NÓI VỀ CHÚNG TÔI</h2>
        <p class="title_content">Những phản hồi thực tế từ những khách hàng đã sử dụng dịch vụ của Nam A Travel</p>
        <div class="slide_1 my-3">
            @for ($i = 0; $i < 8; $i++)
                <div class="feedback">
                <div class="feedback_content">
                    <h3 class="title text_main">Mình đã từng đi tour Thái Lan của Nam A Travel một lần và thấy rất hài lòng.</h3>
                    <div class="feedback_text">
                        "Mình đã từng đi tour Thái Lan của Nam A Mình đã từng đi tour Thái Lan của Nam A Travel một lần và thấy rất hài lòng. Mình đã từng đi tour Thái Lan của Nam A Travel một lần và thấy rất hài lòng. Mình đã từng đi tour Thái Lan của Nam A Travel một lần và thấy rất hài lòng.Travel một lần và thấy rất hài lòng. Lần này mình tiếp tục lựa chọn Nam A cho chuyến du lịch Trung Quốc. Cũng như lần trước, các bạn chuyên viên tư vấn của Nam A hỗ trợ mình rất nhiệt tình. Trong chuyến đi, hướng dẫn viên chăm sóc đoàn rất chu đáo. Nói chung là 10 điểm nha!"
                    </div>

                    <div class="media mt-3">
                        <div class="media-avt">
                            <img src="{{ url('images/avt.jpg') }}">
                        </div>
                        <div class="media-body ms-3">
                            <div class="text_main">
                                Trần Hải Linh
                            </div>
                            <div class="star">
                                <i class="fa-sharp fa-solid fa-star"></i>
                                <i class="fa-sharp fa-solid fa-star"></i>
                                <i class="fa-sharp fa-solid fa-star"></i>
                                <i class="fa-sharp fa-solid fa-star"></i>
                                <i class="fa-sharp fa-solid fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="feedback_img">
                    <img src="{{ url('images/avt.jpg') }}">
                </div>
        </div>
        @endfor
    </div>
    </div>
</section>
<section class="index_4">
    <div class="container">
        <h2 class="title_index title">khách hàng tiêu biểu của nam a travel</h2>
        <p class="title_content">Những hình ảnh tuyệt vời nhất trong chuyến đi của chúng tôi</p>
        <div class="slide_3 my-3">
            @for ($i = 0; $i < 4; $i++)
                <div class="card_feedback">
                <img src="{{ url('images/avt.jpg') }}">
                <div class="title_content text-center">
                    Đoàn Hàn Quốc
                </div>
        </div>
        @endfor
    </div>
    </div>
</section>
<section class="index_3">
    <div class="container">
        <h2 class="title_index title">ĐỐI TÁC</h2>
        <p class="title_content">Nam A Travel là đối tác của các nhãn hàng lớn để mang lại cho bạn các chương trình ưu đãi độc quyền</p>
        <div class="slide_6 my-4 mx-5">
            @foreach ($listBanner3 as $items)
            <div class="card_banner">
                <img src="{{ asset('storage/' . $items->image) }}" alt="hình ảnh" width="100">
            </div>
            @endforeach
        </div>
        <h2 class="title_index title">Góc báo chí</h2>
        <p class="title_content">Xem những gì báo chí đang nói về Nam A Travel</p>
        <div class="slide_6 my-4 mx-5">
            @foreach ($listBanner4 as $items)
            <div class="card_banner">
                <img src="{{ asset('storage/' . $items->image) }}" alt="hình ảnh" width="100">
            </div>
            @endforeach
        </div>
    </div>
</section>
<section class="index_6">
    <div class="container">
        <h2 class="title">nam a travel cam kết</h2>
        <div class="row row-cols-4">
            @foreach ($listBanner4 as $items)
            <div class="col text-center">
                <div class="camket-thuml">
                    <img src="{{ asset('storage/' . $items->image) }}" alt="hình ảnh" width="100">
                </div>
                <div class="camket_content">
                    <h4 class="title">{{$items->banner_name}}</h4>
                    <p class="text-white">{{$items->slogan}}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection