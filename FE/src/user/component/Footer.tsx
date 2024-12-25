import React from 'react'
import { Link } from 'react-router-dom'
// import '../../css/userHome.css'

import { BgFooterImage, Logo_TV1Image } from '../../images/image'

const Footer = () => {
  return (
      <footer style={{ backgroundImage: `url(${BgFooterImage})` }}>
          <div className="container">
              <div className="footer_content">
                  <div className="col-lg-5">
                      <a className="logo" href="{{route('home.index')}}">
                          <img src={Logo_TV1Image} alt="logo_papo"/>
                      </a>
                      <div className="text-white">
                          <h4 className="title">CÔNG TY CỔ PHẦN ĐẦU TƯ VÀ DỊCH VỤ DU LỊCH VIETTOUR </h4>
                          <p><strong>Hotline:</strong>1900 4692</p>
                          <p><strong>Email:</strong>demo1234@gmail.com</p>
                          <p><strong>Văn phòng:</strong>Tòa nhà 247 Khuất Duy Tiến, Thanh Xuân, Hà Nội</p>
                          <p><strong>Trụ sở chính:</strong>số 24 ngõ 8 xóm Đại Khang, xã Hữu Hòa, huyện Thanh Trì, Hà Nội </p>
                      </div>
                  </div>
                  <div className="col-lg-3">
                      <ul>
                          <h4 className="title">Về VIETTOUR Travel</h4>
                          <li>
                              <a href="#">Về chúng tôi</a>
                          </li>
                          <li>
                              <a href="#">Chính sách</a>
                          </li>
                          <li>
                              <a href="#">Điều khoản quy định</a>
                          </li>
                          <li>
                              <a href="#">Hình thức thanh toán</a>
                          </li>
                          <h4 className="title">Blog du lịch</h4>
                          <li>
                              <a href="#">Review</a>
                          </li>
                          <li>
                              <a href="#">Điểm đến</a>
                          </li>
                          <li>
                              <a href="#">Ẩm thực</a>
                          </li>
                          <li>
                              <a href="#">Kinh nghiệm</a>
                          </li>
                      </ul>
                  </div>
                  <div className="col-lg-4">
                      <ul>
                          <h4 className="title">Dịch vụ</h4>
                          <li>
                              <a href="#">Tour quốc tế</a>
                          </li>
                          <li>
                              <a href="#">Tour nội địa</a>
                          </li>
                          <li>
                              <a href="#">Combo du lịch</a>
                          </li>
                      </ul>
                      <div className="share">
                          <h4 className="title">Mạng xã hội</h4>
                          <div className="box_icons">
                              <a className="fb_icon" href="#"><i className="fa-brands fa-facebook-f fs-5"></i></a>
                              <a className="inta_icon" href="#"><i className="fa-brands fa-instagram fs-5"></i></a>
                              <a className="tw_icon" href="#"><i className="fa-brands fa-twitter fs-5"></i></a>
                              <a className="in_icon" href="#"><i className="fa-brands fa-linkedin-in"></i></a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div className="copyright">Copyright © VIETTOUR 2024</div>
      </footer>

  )
}

export default Footer