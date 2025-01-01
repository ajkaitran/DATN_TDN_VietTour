import React from 'react'
import Header from './component/Header'
import { Banner2, BannerHomeImage, InterBanner1, } from '../images/image'
import '../css/style_main.scss';
import '../css/userHome.css'
import { Link } from 'react-router-dom';

const TourNoiDia = () => {
    return (

        <div className='body'>
            <Header />
            <div className="relative mb-5">
                <img src={InterBanner1} alt="Phú Quốc" className="w-full rounded-lg" />
            </div>
            <section className="index_3 bg-white p-5 rounded-lg shadow-md">
                <div className="container">
                    <h2 className="title_index text-2xl font-bold mb-5 text-center text-white">Tour Nội Địa</h2>
                    <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        {/* Loop to render tour cards */}
                        {[...Array(8)].map((_, i) => (
                            <div key={i} className="my-3">
                                <div className="tour_card bg-white border border-gray-200 rounded-lg overflow-hidden transition-transform transform hover:scale-105">
                                    <a className="tour_img block">
                                        <img src={BannerHomeImage} alt="Tour" className="w-full h-40 object-cover" />
                                    </a>
                                    <div className="tour_content p-4">
                                        <a className="tour_name text-lg font-semibold text-gray-800 hover:text-blue-600" href="#">Tour Hàn Quốc: Seoul - Nami - Everland - Bukchon 5N4Đ</a>
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
                                                <a className="btn_hover bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition" href="/">
                                                    <Link to='/Order' className="fa-regular fa-calendar-circle-plus">Đặt Tour</Link>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>
                    <div className="text-center mt-3">
                        <a className="btn_link text-blue-600 hover:underline" href="#">Xem tất cả <i className="fa-solid fa-arrow-right"></i></a>
                    </div>
                </div>
            </section>
        </div>
    )
}

export default TourNoiDia