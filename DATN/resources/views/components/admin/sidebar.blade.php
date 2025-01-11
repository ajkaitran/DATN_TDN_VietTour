<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center my-3"
        href="{{ route('home.index') }}">
        <div class="sidebar-brand-icon d-lg-none">
            <img src="{{ url('images/Logo_VietTour (2).png') }}"
                style="width: 100%; height: 100px; object-fit: cover;" alt="">
        </div>
        <div class="sidebar-brand-text mx-3"><img src="{{ url('images/Logo_VietTour (1).png') }}"
                style="width: 100%; object-fit: cover; padding: 15px;" alt="ảnh logo"></div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.index') }}">
            <i class="fa-light fa-house"></i>
            <span>TỔNG QUAN</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Quản Lý Tài Khoản</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <!-- <a class="collapse-item" href="?controller=Admin&action=UpdatePassword">Đổi mật khẩu</a> -->
                <a class="collapse-item" href="{{ route('admin.register') }}">Quản lý admin</a>
                <a class="collapse-item" href="{{ route('admin.listUser') }}">Danh sách thành viên</a>
                <a class="collapse-item" href="{{ route('admin.listClient') }}">Danh sách khách hàng</a>
                {{-- <a class="collapse-item" href="{{ route('admin.signout') }}"
                    onclick="return confirm('Bạn có chắc chắn muốn đăng xuất?');">
                    Đăng xuất
                </a> --}}
            </div>
        </div>
    </li>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Quản lý đơn hàng</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.listOrder') }}">Danh sách đơn hàng</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages1"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Quản lý Tour/Combo</span>
        </a>
        <div id="collapsePages1" class="collapse" aria-labelledby="headingPages"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('tourType.index')}}">Loại Tour</a>
                <a class="collapse-item" href="{{route('tourCategory.index')}}">Danh mục Tour</a>
                <a class="collapse-item" href="{{route('tour.index')}}">Danh sách Tour</a>
                <a class="collapse-item" href="{{route('startPlace.index')}}">Điểm xuất phát</a>
            </div>
        </div>
    </li>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages2"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Quản lý bài viết</span>
        </a>
        <div id="collapsePages2" class="collapse" aria-labelledby="headingPages"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('article.index') }}">Danh sách bài viết</a>
                <a class="collapse-item" href="{{ route('categoryArticle.index') }}">Danh mục bài viết</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages3"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Quản lý phản hồi</span>
        </a>
        <div id="collapsePages3" class="collapse" aria-labelledby="headingPages"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('feedback.index') }}">Danh sách phản hồi</a>
                <a class="collapse-item" href="{{ route('feedback.create') }}">Thêm mới phản hồi</a>
            </div>
        </div>
    </li>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages4"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Quản lý quảng cáo</span>
        </a>
        <div id="collapsePages4" class="collapse" aria-labelledby="headingPages"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('banner.index') }}">Danh sách quảng cáo</a>
                <a class="collapse-item" href="{{ route('banner.create') }}">Thêm mới quảng cáo</a>
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('comment.index') }}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Quản lý bình luận</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>