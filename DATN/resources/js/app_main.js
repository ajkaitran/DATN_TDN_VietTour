$(document).ready(function() {
    $('.icons_search').click(function(event) {
        event.stopPropagation(); 
        $('.header_search').toggleClass('active'); 
        $('.header_user').removeClass('active'); 
    });
    
    $('.close-btn').click(function() {
        $('.header_search').removeClass('active'); 
    });
    $('.icons_user').click(function(event) {
        event.stopPropagation(); 
        $('.header_user').toggleClass('active'); 
        $('.header_search').removeClass('active');
    });
    $(document).click(function() {
        $('.header_search').removeClass('active'); 
        $('.header_user').removeClass('active');
    });
    $('.header_search, .header_user').click(function(event) {
        event.stopPropagation();
    });
});
// slideshow
$('.slide_banner').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    prevArrow: "<button type='button' class='slick-prev pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
    nextArrow: "<button type='button' class='slick-next pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
    dots: true,
    autoplay: true,
    autoplaySpeed: 3000,
});
$('.slide_1').slick({
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    prevArrow: "<button type='button' class='slick-prev pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
    nextArrow: "<button type='button' class='slick-next pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
    dots: true,
    autoplay: true,
    autoplaySpeed: 5000,
});
$('.slide_3').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    arrows: true,
    prevArrow: "<button type='button' class='slick-prev pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
    nextArrow: "<button type='button' class='slick-next pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
    autoplay: true,
    autoplaySpeed: 3000,
});
$('.slide_4').slick({
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    arrows: true,
    prevArrow: "<button type='button' class='slick-prev pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
    nextArrow: "<button type='button' class='slick-next pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
    autoplay: true,
    autoplaySpeed: 3000,
});
$('.slide_6').slick({
    infinite: true,
    slidesToShow: 6,
    slidesToScroll: 1,
    arrows: false,
    prevArrow: "<button type='button' class='slick-prev pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
    nextArrow: "<button type='button' class='slick-next pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
    autoplay: true,
    autoplaySpeed: 3000,
});
document.addEventListener('DOMContentLoaded', function () {
    const quantityInput = document.getElementById('quantity');
    const unitPrice = document.getElementById('unit-price').getAttribute('data-price');
    const totalPriceSpan = document.getElementById('total-price');
    const hiddenTotalPriceInput = document.getElementById('hidden-total-price');

    // Hàm cập nhật tổng tiền
    function updateTotalPrice() {
            const quantity = parseInt(quantityInput.value);
    const totalPrice = quantity * unitPrice;

    // Hiển thị tổng tiền
    totalPriceSpan.textContent = new Intl.NumberFormat('vi-VN', {
        style: 'currency',
    currency: 'VND'
            }).format(totalPrice);

    // Gán tổng tiền vào trường ẩn
    hiddenTotalPriceInput.value = totalPrice;
        }

    // Lắng nghe sự kiện thay đổi số lượng
    quantityInput.addEventListener('change', updateTotalPrice);

    // Gọi hàm tính tổng tiền khi trang được tải
    updateTotalPrice();
    });
    
CKEDITOR.replace('editor');
