// Main.tsx
import React, { useEffect } from 'react';
import $ from 'jquery';
import 'slick-carousel';
import '../../css/style_main.scss';
import '../../css/userHome.css'
import { Link } from 'react-router-dom';
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

const BodyHome: React.FC = () => {
    
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
                            <Link key={i} to='/tour' className="location"> 
                            <img src={BannerHomeImage} alt="Location" />
                            <p className="title">Quy nhơn -  phú yên</p></Link>
                        ))}
                    </div>
                    <p className="title_content">Tour du lịch nội địa</p>
                    <div className="slide_4">
                        {/* Loop to render locations */}
                        {[...Array(6)].map((_, i) => (
                            
                            <Link key={i} className="location" to="#">
                                <img src={BannerHomeImage} alt="Location" />
                                <p className="title">Quy nhơn -  phú yên</p>
                            </Link>
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
                    <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        {/* Loop to render tour cards */}
                        {[...Array(8)].map((_, i) => (
                            <div key={i} className="my-3">
                                <div className="tour_card bg-white border border-gray-200 rounded-lg overflow-hidden transition-transform transform hover:scale-105">
                                    <Link to='#' className="tour_img block">
                                        <img src={BannerHomeImage} alt="Tour" className="w-full h-40 object-cover" />
                                    </Link>
                                    <div className="tour_content p-4">
                                        <Link className="tour_name text-lg font-semibold text-gray-800 hover:text-blue-600" to="#">Tour Hàn Quốc: Seoul - Nami - Everland - Bukchon 5N4Đ</Link>
                                        <div className="tour_star text-yellow-500 mt-1">
                                            {[...Array(5)].map((_, j) => (
                                                <i key={j} className="fa-solid fa-star"></i>
                                            ))}
                                        </div>
                                        <div className="date-go text-gray-600 mt-1">
                                            <i className="fa-solid fa-calendar-clock mr-1"></i>Lịch khởi hành: <time>Hàng tuần</time>
                                        </div>
                                        <div className="flex mt-2">
                                            <div className="flex-1">
                                                <div className="price_box text-xl font-bold text-red-600">
                                                    <span>13,990,000đ</span>
                                                    <del className="text-gray-500">17,590,000đ</del>
                                                </div>
                                            </div>
                                            <div className="flex items-center justify-end">
                                                <p className="btn_hover bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition" >
                                                    <Link to='/Order' className="fa-regular fa-calendar-circle-plus">Đặt Tour</Link>
                                                </p>
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

export default BodyHome;
