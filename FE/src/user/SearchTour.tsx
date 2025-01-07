import React from 'react';
import { Link, useLocation } from 'react-router-dom';
import Header from './component/Header';
import Footer from './component/Footer';
import { BannerHomeImage } from '../images/image';

const SearchTour = () => {
  const location = useLocation();
  const { data } = location.state || { data: [] };

  return (
    <div>
      <Header/>
      <div className="search-tour">
        <h2 className="title_index title">Kết quả tìm kiếm</h2>
        {data.length > 0 ? (
          <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            {/* Loop to render tour cards */}
            {data.map((tour: any, index: number) => (
              <div key={index} className="my-3">
                <div className="tour_card bg-white border border-gray-200 rounded-lg overflow-hidden transition-transform transform hover:scale-105">
                  <Link to='/Detail' className="tour_img block">
                    <img src={tour.image} alt="Tour" className="w-full h-40 object-cover" />
                  </Link>
                  <div className="tour_content p-4">
                    <Link className="tour_name text-lg font-semibold text-gray-800 hover:text-blue-600" to="/Detail">{tour.name}</Link>
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
                          <span>{tour.pice}</span>
                          <del className="text-gray-500">{tour.sale_off}</del>
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
        ) : (
          <p>Không có kết quả nào phù hợp.</p>
        )}
      </div>
      <Footer/>
    </div>
    
  );
};

export default SearchTour;
