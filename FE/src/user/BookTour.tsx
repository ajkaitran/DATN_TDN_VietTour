import React, { useState } from 'react'
import Header from './component/Header'
import Footer from './component/Footer'

const BookTour = () => {
    const [quantity, setQuantity] = useState(1);
    const unitPrice = 18900000; // Đơn giá

    // Tính toán tổng tiền và thanh toán
    const totalPrice = unitPrice * quantity;
  return (
    <>
    <Header/>
      <main className="p-8 bg-gray-100">
          <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
              <div className="bg-white p-6 rounded shadow">
                  <h2 className="text-center text-blue-500 text-xl font-bold mb-4">THÔNG TIN LIÊN HỆ</h2>
                  <form className="space-y-4">
                      <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                          <div>
                              <label className="flex items-center space-x-2">
                                  <input type="checkbox" className="form-checkbox" />
                                  <span>Xác nhận gửi cho số được gửi qua email này.</span>
                              </label>
                              <input type="email" placeholder="Email" className="w-full p-2 border rounded" />
                          </div>
                          <div>
                              <label className="flex items-center space-x-2">
                                  <input type="checkbox" className="form-checkbox" />
                                  <span>Chúng tôi sẽ liên hệ với quý khách qua SĐT này.</span>
                              </label>
                              <input type="text" placeholder="Số điện thoại" className="w-full p-2 border rounded" />
                          </div>
                          <div>
                              <input type="text" placeholder="Họ và tên" className="w-full p-2 border rounded" />
                          </div>
                          <div>
                              <input type="text" placeholder="Địa chỉ" className="w-full p-2 border rounded" />
                          </div>
                      </div>
                      <textarea placeholder="Yêu cầu thêm" className="w-full p-2 border rounded h-24"></textarea>
                      <div className="flex items-center space-x-2">
                          <input type="checkbox" className="form-checkbox" />
                          <span>Đặt trước giữ chỗ, thanh toán sau. Dễ dàng, thuận tiện, nhanh chóng!</span>
                      </div>
                      <button type="submit" className="w-full bg-red-500 text-white p-2 rounded">HOÀN THÀNH</button>
                  </form>
              </div>
              <div className="bg-white p-6 rounded shadow">
                  <h2 className="text-center text-blue-500 text-xl font-bold mb-4">CHI PHÍ DỰ KIẾN</h2>
                      <div className="space-y-4">
                          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                              <div>
                                  <label>Ngày khởi hành</label>
                                  <input type="date" className="w-full p-2 border rounded" />
                              </div>
                              <div>
                                  <label>Số lượng</label>
                                  <select
                                      className="w-full p-2 border rounded"
                                      value={quantity}
                                      onChange={(e) => setQuantity(Number(e.target.value))}
                                  >
                                      {[...Array(15).keys()].map(i => (
                                          <option key={i + 1} value={i + 1}>{i + 1}</option>
                                      ))}
                                  </select>
                              </div>
                          </div>
                          <div className="space-y-2">
                              <div className="flex justify-between">
                                  <span>Đơn giá</span>
                                  <span>{unitPrice.toLocaleString()} đ</span>
                              </div>
                              <div className="flex justify-between">
                                  <span>Tổng tiền</span>
                                  <span>{totalPrice.toLocaleString()} đ</span>
                              </div>
                              <div className="flex justify-between">
                                  <span>Thanh toán</span>
                                  <span>{totalPrice.toLocaleString()} đ</span>
                              </div>
                          </div>
                          <div className="border-t pt-4">
                              <h3 className="font-bold">Tour Hàn Quốc: Hà Nội - Busan - Cố Đô Gyeongju - Seoul 6N5Đ</h3>
                              <div className="flex items-center space-x-4 mt-2">
                                  <img src="https://placehold.co/100x100" alt="Tour Image" className="w-24 h-24 object-cover rounded" />
                                  <div>
                                      <p>6 ngày 5 đêm</p>
                                      <p>Hạng tuần</p>
                                      <p>Máy bay</p>
                                  </div>
                              </div>
                          </div>
                      </div>
              </div>
          </div>
      </main>
        <Footer />
     </>
  )
}

export default BookTour