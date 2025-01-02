import React, { useEffect, useState } from 'react'

const Feedback = () => {
    const [isFeedbackActive, setIsFeedbackActive] = useState(false);
    const handleFeedBackClick = (event: any) => {
        event.stopPropagation();
        setIsFeedbackActive(!isFeedbackActive);
        
    };
    const handleHeaderClick = (event: any) => {
        event.stopPropagation();
    };
    useEffect(() => {
            const handleClickOutside = () => {
                setIsFeedbackActive(false);
            };
    
            document.addEventListener('click', handleClickOutside);
            return () => {
                document.removeEventListener('click', handleClickOutside);
            };
        }, []);
  return (
      <main className="w-full max-w-4xl mt-8">
          <div className="flex flex-col w-full  p-4">
              <div className="flex items-center justify-between mb-4">
                  <div className="flex items-center">
                      <span className="text-lg font-semibold mr-2">0</span>
                      <span className="text-gray-500">/5</span>
                      <div className="flex ml-2">
                          <i className="fas fa-star text-orange-400"></i>
                          <i className="fas fa-star text-orange-400"></i>
                          <i className="fas fa-star text-orange-400"></i>
                          <i className="fas fa-star text-orange-400"></i>
                          <i className="fas fa-star text-orange-400"></i>
                      </div>
                  </div>
                  <button className="bg-gradient-to-r from-blue-500 to-blue-300 text-white py-2 px-4 rounded">
                      ĐÁNH GIÁ CỦA KHÁCH HÀNG
                  </button>
              </div>
              <button onClick={handleFeedBackClick} className={`bg-orange-500 text-white py-2 px-4 rounded self-end`}>
                  Viết đánh giá
              </button>
          </div>
          <div className="bg-white p-6 rounded-lg shadow-lg" style={{ display: isFeedbackActive ? 'block' : 'none' }} onClick={handleHeaderClick}>
              <div className="flex justify-between items-center mb-4">
                  <h2 className="text-xl font-bold">Đánh giá</h2>
                  <button className="text-gray-500"><i className="fas fa-times"></i></button>
              </div>
              <textarea className="w-full p-2 border rounded-md mb-4" placeholder="Nội dung đánh giá"></textarea>
              <div className="flex space-x-4 mb-4">
                  <input type="text" placeholder="Họ và tên" className="w-1/2 p-2 border rounded-md" />
                  <input type="text" placeholder="Số điện thoại" className="w-1/2 p-2 border rounded-md" />
              </div>
              <div className="flex items-center mb-4">
                  {[...Array(5)].map((star, index) => (
                      <span key={index} className={index === 0 ? "text-yellow-500" : "text-gray-300"}><i className="fas fa-star"></i></span>
                  ))}
              </div>
              <button className="bg-green-500 text-white p-2 rounded-md mb-4">Chọn ảnh...</button>
              <p className="text-gray-500 text-sm mb-4">- Chọn ảnh để upload: gif, png, jpg, jpeg nhỏ hơn 4MB, tối đa 10 ảnh</p>
              <button className="bg-blue-500 text-white p-2 rounded-md">Đánh giá</button>
          </div>
      </main>
  )
}

export default Feedback