<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>

    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{url('slick/slick.min.css')}}">
    <link rel="stylesheet" href="{{url('font-awesome/css/all.css')}}">
    @vite([
    'resources/css/style_main.scss',
    ])
</head>

<body>
    <header>
        <div class="header">
            <a class="logo" href="{{route('home.index')}}">
                <img src="{{url('images/Logo_VietTour (1).png')}}" alt="logo_papo">
            </a>
            <ul class="nav_menu">
                <li class="nav_item">
                    <a class="nav_link" href="{{ route('home.tourByCate',['category_type' =>1]) }}">TOUR QUỐC TẾ</a>
                </li>
                <li class="nav_item">
                    <a class="nav_link" href="{{ route('home.tourByCate',['category_type' =>2]) }}">TOUR NỘI ĐỊA</a>
                </li>
                <li class="nav_item">
                    <a class="nav_link" href="{{ route('home.tourByCate',['category_type' =>3]) }}">COMBO DU LỊCH</a>
                </li>
                <li class="nav_item">
                    <a class="nav_link" href="{{route('home.blog')}}">BLOG DU LỊCH</a>
                </li>
                <li class="nav_item">
                    <a class="nav_link" href="{{route('home.about')}}">VỀ CHÚNG TÔI</a>
                </li>
            </ul>
            <div class="header_bars">
                <button class="icons_search">
                    <i class="fa-solid fa-search fs-4"></i>
                </button>
                <button class="icons_user">
                    <i class="fa-solid fa-user fs-4"></i>
                </button>
                <ul class="header_user">
                    @guest
                    <li class="user_item">
                        <a class="user_link" href="#" data-bs-toggle="modal" data-bs-target="#ModalLogin">Đăng Nhập</a>
                    </li>
                    <li class="user_item">
                        <a class="user_link" href="#" data-bs-toggle="modal" data-bs-target="#ModalRegister">Đăng Ký</a>
                    </li>
                    @else
                    <li class="user_item">
                        <a class="user_link" href="#">Thông Tin Chung</a>
                    </li>
                    <li class="user_item">
                        <a class="user_link" href="{{ route('home.modal.signout') }}"
                            onclick="return confirm('Bạn có chắc chắn muốn đăng xuất?');">Đăng Xuất</a>
                    </li>
                    @endguest
                </ul>
            </div>
            <a class="header_contact" href="tel:1900 4692">
                <i class="fa-solid fa-phone-volume fs-4"></i>
                <span>1900 4692</span>
            </a>
        </div>
        <div class="header_search ">
            <div class="close-btn">
                <i class="fa-solid fa-xmark fs-3"></i>
            </div>
            <h2 class="text-green">Tìm kiếm</h2>
            <form class="search-form" action="{{ route('home.searchTour') }}" method="get">
                <input type="text" name='keyword' placeholder="Nhập từ khóa tìm kiếm..." required>
                <button type="submit"><i class="far fa-search"></i></button>
            </form>
        </div>
    </header>
    @include('home.modal.login')
    @include('home.modal.register')
    <main class="main_form">
        @yield("content")
    </main>
    <footer style="background-image: url('images/bg-footer.jpg')">
        <div class="container">
            <div class="footer_content">
                <div class="col-lg-5">
                    <a class="logo" href="{{route('home.index')}}">
                        <img src="{{url('images/Logo_VietTour (1).png')}}" alt="logo_papo">
                    </a>
                    <div class="text-white">
                        <h4 class="title">CÔNG TY CỔ PHẦN ĐẦU TƯ VÀ DỊCH VỤ DU LỊCH VIETTOUR </h4>
                        <p><strong>Hotline:</strong>1900 4692</p>
                        <p><strong>Email:</strong>demo1234@gmail.com</p>
                        <p><strong>Văn phòng:</strong>Tòa nhà 247 Khuất Duy Tiến, Thanh Xuân, Hà Nội</p>
                        <p><strong>Trụ sở chính:</strong>số 24 ngõ 8 xóm Đại Khang, xã Hữu Hòa, huyện Thanh Trì, Hà Nội </p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <ul>
                        <h4 class="title">Về VIETTOUR Travel</h4>
                        <li>
                            <a href="#">Về chúng tôi</a>
                        </li>
                        <li>
                            <a href="#">Chính sách</a>
                        </li>
                        <li>
                            <a href="#">Điều khoản quy định</a>
                        </li>
                        <li>
                            <a href="#">Hình thức thanh toán</a>
                        </li>
                        <h4 class="title">Blog du lịch</h4>
                        <li>
                            <a href="#">Review</a>
                        </li>
                        <li>
                            <a href="#">Điểm đến</a>
                        </li>
                        <li>
                            <a href="#">Ẩm thực</a>
                        </li>
                        <li>
                            <a href="#">Kinh nghiệm</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <ul>
                        <h4 class="title">Dịch vụ</h4>
                        <li>
                            <a href="">Tour quốc tế</a>
                        </li>
                        <li>
                            <a href="#">Tour nội địa</a>
                        </li>
                        <li>
                            <a href="#">Combo du lịch</a>
                        </li>
                    </ul>
                    <div class="share">
                        <h4 class="title">Mạng xã hội</h4>
                        <div class="box_icons">
                            <a class="fb_icon" href="#"><i class="fa-brands fa-facebook-f fs-5"></i></a>
                            <a class="inta_icon" href="#"><i class="fa-brands fa-instagram fs-5"></i></a>
                            <a class="tw_icon" href="#"><i class="fa-brands fa-twitter fs-5"></i></a>
                            <a class="in_icon" href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">Copyright © VIETTOUR 2024</div>
    </footer>


    <!-- JS -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{url('slick/slick.min.js')}}"></script>

    @vite([
    'resources/js/app_main.js',
    ])
</body>

</html>