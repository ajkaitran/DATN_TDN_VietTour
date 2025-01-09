import React from 'react'
import Header from './component/Header'
import Footer from './component/Footer'
import { Link } from 'react-router-dom'
import Feedback from './component/Feedback'


const DetailTour = () => {
  return (
      <div>
        <Header/>
          <div className="container mx-auto p-4">
              <nav className="text-sm text-gray-500 mb-4 ">
                  <a href="#" className="hover:underline text-gray-500">Trang chủ</a> &gt;
                  <a href="#" className="hover:underline text-gray-500">Sapa</a> &gt;
                  <span>Combo Sapa Jade Hill Resort & Spa 2N1Đ</span>
              </nav>
              <h1 className="text-2xl font-bold text-blue-600 mb-2">Combo Sapa Jade Hill Resort & Spa 2N1Đ</h1>
              <p className="text-sm text-gray-500 mb-2">
                  <i className="fas fa-calendar-alt"></i> Lịch khởi hành: <span className="text-red-500">Hàng ngày</span>
              </p>
              <div className="flex items-center mb-4">
                  <div className="text-yellow-500">
                      <i className="fas fa-star"></i>
                      <i className="fas fa-star"></i>
                      <i className="fas fa-star"></i>
                      <i className="fas fa-star"></i>
                      <i className="fas fa-star"></i>
                  </div>
                  <button className="ml-auto bg-blue-500 text-white px-4 py-2 rounded flex items-center">
                      <i className="fas fa-share mr-2"></i> Share
                  </button>
              </div>
              <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                  <div className="md:col-span-2">
                      <img src="https://placehold.co/800x400" alt="A couple walking with bicycles in front of a thatched-roof house at Combo Sapa Jade Hill Resort & Spa" className="w-full rounded-lg relative"  />
                      <p className="text-white text-sm absolute bottom-auto left-auto bg-black bg-opacity-50 px-0 py-1 rounded">Combo Sapa Jade Hill Resort & Spa 2N1Đ</p>
                  </div>
                  <div className="grid grid-cols-2 gap-4">
                      <div className="relative">
                          <img src="https://placehold.co/400x200" alt="A person looking at the mountains from a balcony at Combo Sapa Jade Hill Resort & Spa" className="w-full rounded-lg" />
                          <p className="text-white text-sm absolute bottom-50 left-0 bg-black bg-opacity-50 px-0 py-1 rounded">Combo Sapa Jade Hill Resort & Spa 2N1Đ</p>
                      </div>
                      <div className="relative">
                          <img src="https://placehold.co/400x200" alt="A person enjoying a waterfall in a pool at Combo Sapa Jade Hill Resort & Spa" className="w-full rounded-lg" />
                          <p className="text-white text-sm absolute bottom-50 left-0 bg-black bg-opacity-50 px-0 py-1 rounded">Combo Sapa Jade Hill Resort & Spa 2N1Đ</p>
                      </div>
                      <div className="relative">
                          <img src="https://placehold.co/400x200" alt="A person walking on a path surrounded by trees at Combo Sapa Jade Hill Resort & Spa" className="w-full rounded-lg" />
                          <p className="text-white text-sm absolute bottom-50 left-0 bg-black bg-opacity-50 px-0 py-1 rounded">Combo Sapa Jade Hill Resort & Spa 2N1Đ</p>
                      </div>
                      <div className="relative">
                          <img src="https://placehold.co/400x200" alt="A person sitting in front of a thatched-roof house at Combo Sapa Jade Hill Resort & Spa" className="w-full rounded-lg" />
                          <p className="text-white text-sm absolute bottom-50 left-0 bg-black bg-opacity-50 px-0 py-1 rounded">Combo Sapa Jade Hill Resort & Spa 2N1Đ</p>
                      </div>
                  </div>
              </div>
          </div>
          <div className="container mx-auto p-4">
              <div className="flex flex-col lg:flex-row">
                  <div className="lg:w-2/3 p-4">
                      <p className="text-gray-700 mb-4">
                          Cách trung tâm thị trấn Sapa gần 2km, Sapa Jade Hill Resort & Spa ẩn mình giữa núi rừng. Dù gần để du khách có thể dễ dàng kết nối với trung tâm thị trấn cũ và các điểm tham quan nổi tiếng tại Sapa như Hàm Rồng, Cát Cát, Tả Van, Thung lũng Mường Hoa,... Và cũng đủ xa để giữ sự biệt lập, trong lành, riêng tư của một khu nghỉ dưỡng đẳng cấp. Nào hãy cùng Nam A Travel khám phá combo du lịch Sapa Jade Hill Resort & Spa 2N1Đ dưới đây nhé!
                          Hãy gọi ngay cho chúng tôi để được tư vấn Hotline: <span className="text-blue-600">1900 4692</span> - Bạn chỉ việc đặt tour, việc còn lại để chúng tôi lo!
                      </p>
                      <div className="flex space-x-4 mb-4">
                          <button className="bg-blue-500 text-white py-2 px-4 rounded flex items-center">
                              <i className="fas fa-gift mr-2"></i> Giữ chỗ bây giờ - Thanh toán sau
                          </button>
                          <button className="bg-red-500 text-white py-2 px-4 rounded flex items-center">
                              <i className="fas fa-phone-alt mr-2"></i> Bấm để nghe tư vấn miễn phí
                          </button>
                      </div>
                      <div className="bg-white p-4 rounded shadow">
                          <h2 className="bg-blue-500 text-white text-center py-2 rounded mb-4">COMBO SAPA JADE HILL RESORT & SPA 2N1Đ CÓ GÌ ĐẶC SẮC</h2>
                          <ul className="list-disc list-inside text-gray-700">
                              <li>Xe giường nằm 2 chiều đến trung tâm thị trấn Sapa(*)</li>
                              <li>Nghỉ dưỡng tại hạng phòng Deluxe Valley View tiện nghi, ấm áp</li>
                              <li>Thưởng thức đồ uống chào mừng khi nhận phòng</li>
                              <li>Buffet sáng với món ăn bản địa tươi ngon nóng hổi</li>
                              <li>Miễn phí sử dụng bể bơi vô cực view thung lũng Mường Hoa</li>
                              <li>Tặng tín dụng 250.000 VND/phòng/đêm sử dụng dịch vụ Spa(**)</li>
                              <li>Tặng 01 set trà chiều ngắm hoàng hôn trên Thung lũng Mường Hoa</li>
                              <li>Miễn phí 3 món đồ giặt là/phòng/đêm</li>
                              <li>Shuttle Bus vào trung tâm Thị trấn Sapa theo giờ cố định</li>
                              <li>Miễn phí 01 nồi lẩu bò chua cay hoặc lẩu cá hồi vào bữa trưa</li>
                              <li>Dạo quanh "làng cổ" bằng xe đạp tận hưởng không khí trong lành và thư giãn tại hồ bơi vô cực nước ấm</li>
                          </ul>
                      </div>
                      <div className="bg-white p-6 rounded-lg shadow-lg">
                          <div className="text-center mb-6">
                              <button className="bg-blue-500 text-white py-2 px-4 rounded-full text-lg font-semibold">
                                  CHÍNH SÁCH NHẬN & TRẢ PHÒNG
                              </button>
                          </div>
                          <div className="text-gray-800">
                              <h2 className="font-bold text-lg mb-2">Giờ nhận - trả phòng:</h2>
                              <ul className="list-disc list-inside mb-4">
                                  <li>Giờ nhận phòng: 14:00</li>
                                  <li>Giờ trả phòng: 12:00</li>
                              </ul>
                              <h2 className="font-bold text-lg mb-2">Quy định nhận phòng: Khách đến nhận phòng vui lòng mang theo:</h2>
                              <ul className="list-disc list-inside mb-4">
                                  <li>Giấy xác nhận của  Việt Tour</li>
                                  <li>CCCD hoặc passport</li>
                              </ul>
                              <h2 className="font-bold text-lg mb-2">Lưu ý:</h2>
                              <p className="mb-4">Tiền phòng đã bao gồm phí khi đi qua trạm Lao Chải - Tả Van theo số khách mặc định trên từng hạng phòng.</p>
                              <p className="mb-4">Khi check-in, cần đặt cọc 1,000,000VND/Villa cho chi phí phát sinh, sẽ được hoàn khi check-out nếu không phát sinh thêm chi phí.</p>
                              <h2 className="font-bold text-lg mb-2">Quy định hủy đổi của khách sạn: (Áp dụng từ 01/01/2024 đến 31/12/2024)</h2>
                              <ul className="list-disc list-inside mb-4">
                                  <li>Hủy phòng trước 33 ngày (trừ T7, CN, Lễ Tết) trước ngày khách đến: không tính phí</li>
                                  <li>Hủy phòng trong vòng 33 ngày (trừ T7, CN, Lễ Tết) trước ngày khách đến: tính 50% giá trị tiền phòng</li>
                                  <li>Hủy phòng trong vòng 18 ngày (trừ T7, CN, Lễ Tết) trước ngày khách đến hoặc không đến: tính 100% tổng tiền phòng đã đặt.</li>
                              </ul>
                              <h2 className="font-bold text-lg mb-2">Lưu ý:</h2>
                              <p className="mb-4">Giai đoạn lễ Tết không áp dụng hoàn, hủy hay thay đổi ngày đến.</p>
                              <p className="mb-4">Các yêu cầu về thay đổi thời gian ở, rút ngắn thời gian lưu trú hay giảm số lượng phòng đều được xem là hủy phòng và sẽ áp dụng theo chính sách hủy như trên.</p>
                          </div>
                      </div>
                      <div className="mt-6">
                          <div className="bg-white p-4 rounded-lg shadow-lg">
                              <h2 className="text-center text-blue-500 font-bold text-lg mb-4">Cảm ơn quý khách, chúc quý khách có một chuyến đi vui vẻ</h2>
                              <p className="text-center text-gray-800"> Việt Tour - Đơn vị tổ chức tour du lịch hàng đầu!</p>
                          </div>
                      </div>
                      {/* Feedback */}
                      <Feedback/>
                      <div className="flex flex-col w-full  p-4 mt-4 md:mt-0">
                          <button className="bg-gradient-to-r from-blue-500 to-blue-300 text-white py-2 px-4 rounded mb-4">
                              CÂU HỎI THƯỜNG GẶP
                          </button>
                          <button className="bg-orange-500 text-white py-2 px-4 rounded self-end">
                              Viết câu hỏi
                          </button>
                      </div>
                  </div>
                  
                  <div className="lg:w-1/3 p-4">
                      <div className="bg-white p-4 rounded shadow mb-4">
                          <div className="flex justify-between items-center mb-2">
                              <span className="line-through text-gray-500">2,990,000đ</span>
                              <span className="bg-red-500 text-white px-2 py-1 rounded">Tiết kiệm 44%</span>
                          </div>
                          <div className="text-red-500 text-2xl font-bold mb-2">Giá mới: 1,690,000đ</div>
                          <div className="flex items-center mb-2">
                              <i className="fas fa-star text-yellow-500"></i>
                              <i className="fas fa-star text-yellow-500"></i>
                              <i className="fas fa-star text-yellow-500"></i>
                              <i className="fas fa-star text-yellow-500"></i>
                              <i className="fas fa-star text-yellow-500"></i>
                          </div>
                          <div className="text-gray-700 mb-2">Thời gian: 2 ngày 1 đêm</div>
                          <div className="text-gray-700 mb-2">Lịch khởi hành: Hàng ngày</div>
                          <div className="text-gray-700 mb-4">Phương tiện: Ô tô</div>
                          <button className="bg-blue-500 text-white py-2 px-4 rounded w-full mb-4"><Link to='/Order'>ĐẶT NGAY</Link></button>
                          <div className="text-center text-gray-700 mb-4">Giữ chỗ ngay bây giờ - Tính tiền sau</div>
                          <div className="flex items-center justify-center mb-4">
                              <i className="fas fa-phone-alt text-orange-500 mr-2"></i>
                              <span className="text-orange-500">Hotline tư vấn 24/7</span>
                          </div>
                          <div className="text-center text-orange-500 text-2xl mb-4">1900 4692</div>
                          <div className="text-center text-gray-700 mb-4">Để lại SĐT chúng tôi sẽ gọi cho bạn</div>
                          <div className="flex items-center border border-gray-300 rounded p-2">
                              <input type="text" className="flex-grow outline-none" placeholder="Nhập số điện thoại của bạn..." />
                              <button className="text-blue-500"><i className="fas fa-paper-plane"></i></button>
                          </div>
                      </div>
                      <div className="bg-white p-4 rounded shadow">
                          <h3 className="text-gray-700 mb-4">Tour Khuyến mãi</h3>
                          <div className="mb-4">
                              <img src="https://placehold.co/100x100" alt="Tour Singapore - Garden by the bay - Đảo Sentosa" className="w-full rounded mb-2" />
                              <div className="text-gray-700">Tour Singapore - Garden by the bay - Đảo Sentosa - Jewel 4N3Đ</div>
                              <div className="text-gray-500">Lịch khởi hành: Hàng tuần</div>
                              <div className="text-red-500 font-bold">11,490,000đ <span className="line-through text-gray-500">13,790,000đ</span></div>
                          </div>
                          <div>
                              <img src="https://placehold.co/100x100" alt="Tour Singapore - Indonesia (Batam)" className="w-full rounded mb-2" />
                              <div className="text-gray-700">Tour Singapore - Indonesia (Batam)</div>
                              <div className="text-gray-500">Lịch khởi hành: Hàng tuần</div>
                              <div className="text-red-500 font-bold">11,490,000đ <span className="line-through text-gray-500">13,790,000đ</span></div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <Footer/>
      </div>
  )
}

export default DetailTour