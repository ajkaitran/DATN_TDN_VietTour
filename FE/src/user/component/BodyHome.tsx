// Main.tsx
import React, { useEffect, useState } from 'react';
import 'slick-carousel';
import '../../css/style_main.scss';
import '../../css/userHome.css'
import { Link } from 'react-router-dom';
//import FontAwesone
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faSearch} from '@fortawesome/free-solid-svg-icons';
//Import Slick
import Slider from 'react-slick';
import 'slick-carousel/slick/slick.css';
import 'slick-carousel/slick/slick-theme.css';
import { BannerHomeImage,Banner2} from '../../images/image';
//import slideShow
import { settings1,settings2,settings3,settings4 } from './SlideShow';
import SearchTour from '../SearchTour';

const BodyHome: React.FC = () => {
    //Get Banner from API
    const [banners, setBanners] = useState([]);
    const fetchBannersFromAPI = async () => {
        try {
            const response = await fetch('http://localhost:3000/banner');
            if (!response.ok) {
                throw new Error('Failed to fetch data');
            }
            const data = await response.json();
            setBanners(data);
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    };
    useEffect(() => {
        fetchBannersFromAPI();
    }, []);
    // Search Tour
    
    return (
        <div>
            <section className="banner ">
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
                        <button type="submit"><FontAwesomeIcon icon={faSearch} /></button>
                    </form>
                </div>
            </section>
            <section className="index_1">
                <div className="container">
                    <h2 className="title_index title">Ưu đãi hấp dẫn</h2>
                    <div className="slide_banner mt-4">
                        <Slider {...settings1}>
                            {banners.map((banner, index) => (
                                <div key={index}>
                                    {/* //bannne.image */}
                                    <img src={banner.image} alt='' />
                                </div>
                            ))}
                        </Slider>
                        {/* <Slider {...settings1}>
                            {[Array(4)].map((_,i)=>(
                                <a key ={i}href="" className=''>
                                    <img src={Banner2} alt="" />
                                </a>
                            ))}
                        </Slider> */}
                    </div>
                </div>
            </section>

            <section className="index_2">
                <div className="container">
                    <h2 className="title_index title">Những điểm đến được yêu thích</h2>
                    <p className="title_content">Tour du lịch quốc tế</p>
                    <div className="slide_4">
                        {/* Loop to render locations */}
                       
                            {[...Array(6)].map((_, i) => (
                                <a key={i} href='/tour' className="location">
                                    <img src={BannerHomeImage} alt="Location" />
                                    <p className="title">Quy nhơn -  phú yên</p></a>
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
                                        <Link to='/Detail' className="tour_img block">
                                            <img src={BannerHomeImage} alt="Tour" className="w-full h-40 object-cover" />
                                        </Link>
                                        <div className="tour_content p-4">
                                            <Link className="tour_name text-lg font-semibold text-gray-800 hover:text-blue-600" to="/Detail">Tour Hàn Quốc: Seoul - Nami - Everland - Bukchon 5N4Đ</Link>
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
                                                        <a href='/Order' className="fa-regular fa-calendar-circle-plus">Đặt Tour</a>
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
            <section className="index_3">
                <div className="container">
                    <h2 className="title_index title">Combo du lịch linh hoạt</h2>
                    <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        {/* Loop to render tour cards */}
                        {[...Array(8)].map((_, i) => (
                            <div key={i} className="my-3">
                                <div className="tour_card bg-white border border-gray-200 rounded-lg overflow-hidden transition-transform transform hover:scale-105">
                                    <Link to='Detail' className="tour_img block">
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
                                                    <a href='/Order' className="fa-regular fa-calendar-circle-plus">Đặt Tour</a>
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

            <section className="index_4">
                <div className="container">
                    <h2 className="title_index title">Blog Du Lịch</h2>
                    <p className="title_content">Những kinh nghiệm thú vị về du lịch được chia sẻ ở đây</p>
                    <div className="slide_3 my-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        {/* <Slider>

                        </Slider> */}
                        {Array.from({ length: 8 }).map((_, i) => (
                            <div className="article_group" key={i}>
                                <div className="article_card">
                                    <a className="article_img" href="#">
                                        <img src={BannerHomeImage} alt="Banner" />
                                    </a>
                                    <a className="title title_name" href="#">Review</a>
                                    <a className="article_name title_name" href="#">
                                        Du lịch Nhật Bản mua gì về làm quà? Ghi điểm với list những món quà cực ý nghĩa
                                    </a>
                                </div>
                                {Array.from({ length: 2 }).map((_, j) => (
                                    <div className="article_card" key={j}>
                                        <a className="article_img" href="#">
                                            <img src={BannerHomeImage} alt="Banner" />
                                        </a>
                                        <div className="article_content">
                                            <a className="article_name title_name" href="#">
                                                Du lịch Nhật Bản mua gì về làm quà? ghi ghi Ghi điểm với list những món quà cực ý nghĩa
                                            </a>
                                            <div className="date">
                                                <i className="fa-solid fa-calendar-clock me-1"></i>
                                                <time>01/07/2024</time>
                                            </div>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        ))}
                    </div>
                </div>
            </section>
            {/* Additional sections omitted for brevity */}
        </div>
    );
};

export default BodyHome;
