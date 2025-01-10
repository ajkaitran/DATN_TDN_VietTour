<header>
    <div class="header">
        <a class="logo" href="{{route('home.index')}}">
            <img src="{{url('images/Logo_VietTour (1).png')}}" alt="logo_papo">
        </a>
        <ul class="nav_menu">
            @foreach($listType as $type)
            <li class="nav_item">
                <a class="nav_link" href="{{ route('home.tourByCate',['category_type' =>$type->id])}}">{{ $type->name }}</a>
                <ul class="nav_drop row">
                    @if($type->categories->isEmpty())
                    <li class="col-12">
                        <div class="alert alert-success">
                            Không có danh mục nào!
                        </div>
                    </li>
                    @else
                    @foreach($type->categories as $category)
                    @if($category->parent_id === null)
                    <!-- Danh mục cha -->
                    <li class="col-3 mb-2">
                        <ul class="list_cate">
                            <li class="title_name">
                                <a href="{{route('home.tourLog',['id' => $category->id])}}">{{ $category->name }}</a>
                            </li>
                            <!-- Hiển thị các danh mục con -->
                            @foreach($category->children as $child)
                            <li>
                                <a class="item_name" href="{{route('home.tourLog',['id' => $child->id])}}">{{ $child->name }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @endif
                    @endforeach
                    @endif
                </ul>
            </li>
            @endforeach
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