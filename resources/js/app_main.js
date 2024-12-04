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