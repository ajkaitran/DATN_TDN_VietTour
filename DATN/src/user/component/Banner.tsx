// Main.tsx
import React from 'react';
import '../../css/style_main.scss';
import '../../css/userHome.css'
import {
    bandoImage,
    avtImage,
    Logo_TV1Image,
    BannerHomeImage,
    BgFooterImage,
    LoaiTourImage,
    LigthBulbImage,
    TaiXuongImage
} from '../../images/image';

const Banner: React.FC = () => {
    return (
        <>
            <section className="banner">
                <div className="slide_banner">
                        <img src={BannerHomeImage} alt="Banner" />
                </div>
                <div className="banner_content">
                    <div className="title_banner">
                        <h2 className="title">Du lịch thả ga - Không lo về giá cùng VietTour Travel</h2>
                        <p>Chọn điểm đến mà bạn muốn tới, VietTour Travel sẽ mang đến cho bạn chuyến đi tuyệt vời nhất</p>
                    </div>
                    <form className="search-form" method="get">
                        <input type="text" placeholder="Nhập từ khóa tìm kiếm..." />
                        <button type="submit"><i className="far fa-search">Tìm kiếm</i></button>
                    </form>
                </div>
            </section>
            {/* <section className="index_1">
                <div className="container">
                    <h2 className="title_index title">Ưu đãi hấp dẫn</h2>
                    <div className="slide_banner mt-4">
                       
                        {[...Array(4)].map((_, i) => (
                            <img key={i} src={BannerHomeImage} alt="Banner" />
                        ))}
                    </div>
                </div>
            </section> */}
            <section className="index_2">
                <div className="container">
                    <h2 className="title_index title">Những điểm đến được yêu thích</h2>
                    <p className="title_content">Tour du lịch quốc tế</p>
                    <div className="slide_4 ">
                        {/* Loop to render locations */}
                        {[...Array(6)].map((_, i) => (
                            <a key={i} className="location" href="#">
                                <img src={BannerHomeImage} alt="Location" />
                                <p className="title">Quy nhơn -  phú yên</p>
                            </a>
                        ))}
                    </div>
                    <p className="title_content">Tour du lịch nội địa</p>
                    <div className="slide_4">
                        {/* Loop to render locations */}
                        {[...Array(6)].map((_, i) => (
                            <a key={i} className="location" href="#">
                                <img src={BannerHomeImage} alt="Location" />
                                <p className="title">Quy nhơn -  phú yên</p>
                            </a>
                        ))}
                    </div>
                    <div className="text-center mt-4">
                        <a className="btn_link" href="#"><i className="fa-solid fa-location-dot"></i> Xem tất cả các điểm đến</a>
                    </div>
                </div>
            </section>
            <section className="index_3">
                <div className="container">
                    <h2 className="title_index title">Tour hot 2024</h2>
                    <p className="title_content">Các tour được đặt nhiều nhất trong năm nay</p>
                    <div className="row row-cols-4">
                        {/* Loop to render tour cards */}
                        {[...Array(8)].map((_, i) => (
                            <div key={i} className="col my-3">
                                <div className="tour_card">
                                    <a className="tour_img" href="#">
                                        <img src={BannerHomeImage} alt="Tour" />
                                    </a>
                                    <div className="tour_content">
                                        <a className="tour_name" href="#">Tour Hàn Quốc: Seoul - Nami - Everland - Bukchon 5N4Đ</a>
                                        <div className="tour_star">
                                            {[...Array(5)].map((_, j) => (
                                                <i key={j} className="fa-solid fa-star"></i>
                                            ))}
                                        </div>
                                        <div className="date-go">
                                            <i className="fa-solid fa-calendar-clock me-1"></i>Lịch khởi hành: <time>Hàng tuần</time>
                                        </div>
                                        <div className="row mt-2">
                                            <div className="col-7">
                                                <div className="price_box">
                                                    <span>13,990,000đ</span>
                                                    <del>17,590,000đ</del>
                                                </div>
                                            </div>
                                            <div className="col-5 d-flex justify-content-end align-items-center">
                                                <a className="btn_hover" href="#">
                                                    <i className="fa-regular fa-calendar-circle-plus"></i> Đặt Tour
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>
                    <div className="text-center mt-3">
                        <a className="btn_link" href="#">Xem tất cả <i className="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </section>
            {/* Additional sections omitted for brevity */}
        </>
    );
};

export default Banner;
