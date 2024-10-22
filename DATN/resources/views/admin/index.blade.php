@extends("shared._layoutAdmin")
@section("title", "Admin")

@section("content")
<div class="overview">
    <div class="list-name">
        <div class="left">
            <div class="icons">
                <i class="fa-light fa-house"></i>
            </div>
            <h2>Tổng quan</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 col-6 mb-4">
            <div class="box">
                <div class="cart">
                    <div class="top">
                        <a href="?controller=Admin&action=ListAdmin">
                            <h5 class="m-0">Quản trị viên</h5>
                        </a>
                        <p><?= isset($admin) ? $admin: 0 ?></p>
                    </div>
                    <div class="bot">
                        <a href="#">
                            <i class="fa-regular fa-pen-to-square"></i>
                            <span>Có thể thay đổi thông tin website</span>
                        </a>
                    </div>
                </div>
                <div class="icon icon1">
                    <i class="fa-regular fa-user fs-1"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-6 mb-4">
            <div class="box">
                <div class="cart">
                    <div class="top">
                        <a href="?controller=Admin&action=ListUser">
                            <h5 class="m-0">Người dùng</h5>
                        </a>
                        <p><?= isset($user) ? $user: 0 ?></p>
                    </div>
                    <div class="bot">
                        <a href="#">
                            <i class="fa-regular fa-cart-shopping"></i>
                            <span>Cập nhật liên tục</span>
                        </a>
                    </div>
                </div>
                <div class="icon icon3">
                <i class="fa-light fa-users"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-6 mb-4">
            <div class="box">
                <div class="cart">
                    <div class="top">
                        <a href="?controller=Admin&action=ListProduct">
                            <h5 class="m-0">Sản phẩm</h5>
                        </a>
                        <p><?= isset($product) ? $product: 0 ?></p>
                    </div>
                    <div class="bot">
                        <a href="#">
                            <i class="fa-regular fa-cart-shopping"></i>
                            <span>Cập nhật liên tục</span>
                        </a>
                    </div>
                </div>
                <div class="icon icon6">
                <i class="fa-regular fa-folder"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-6 mb-3">
            <div class="box">
                <div class="cart">
                    <div class="top">
                        <a href="?controller=Admin&action=list_order">
                            <h5 class="m-0">Đơn hàng</h5>
                        </a>
                        <p><?= isset($order) ? $order: 0 ?></p>
                    </div>
                    <div class="bot">
                        <a href="#">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                            <span>Cập nhật liên tục</span>
                        </a>
                    </div>
                </div>
                <div class="icon icon4">
                    <i class="fa-regular fa-cart-shopping"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-6 mb-3">
            <div class="box">
                <div class="cart">
                    <div class="top">
                        <a href="?controller=Admin&action=Comment">
                            <h5 class="m-0">Bình luận</h5>
                        </a>
                        <p><?= isset($comment) ? $comment: 0 ?></p>
                    </div>
                    <div class="bot">
                        <a href="#">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                            <span>Cập nhật liên tục</span>
                        </a>
                    </div>
                </div>
                <div class="icon icon5">
                <i class="fa-regular fa-comments"></i>
                </div>
            </div>
        </div>
    </div>
   
</div>
@endsection