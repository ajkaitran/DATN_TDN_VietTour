import React from 'react'
import { Link } from 'react-router-dom'
import '../../css/style_main.scss';
import '../../css/userHome.css'
import { BgFooterImage, Logo_TV1Image } from '../../images/image'

const Footer = () => {
  return (
    <div>
          <footer style={{ backgroundImage: `url(${BgFooterImage})` }}>
              <div className="container">
                  <div className="footer_content">
                      <div className="col-lg-5">
                          <Link className="logo" to="/">
                              <img src={Logo_TV1Image} alt="logo_papo" />
                          </Link>
                          <div className="text-white">
                              <h4 className="title">CÔNG TY CỔ PHẦN ĐẦU TƯ VÀ DỊCH VỤ DU LỊCH VIETTOUR</h4>
                              <p><strong>Hotline:</strong> 1900 4692</p>
                              <p><strong>Email:</strong> demo1234@gmail.com</p>
                              <p><strong>Văn phòng:</strong> Tòa nhà 247 Khuất Duy Tiến, Thanh Xuân, Hà Nội</p>
                              <p><strong>Trụ sở chính:</strong> số 24 ngõ 8 xóm Đại Khang, xã Hữu Hòa, huyện Thanh Trì, Hà Nội</p>
                          </div>
                      </div>
                      <div className="col-lg-3">
                          <ul>
                              <h4 className="title">Về VIETTOUR Travel</h4>
                              <li><Link to="#">Về chúng tôi</Link></li>
                              <li><Link to="#">Chính sách</Link></li>
                              <li><Link to="#">Điều khoản quy định</Link></li>
                              <li><Link to="#">Hình thức thanh toán</Link></li>
                              <h4 className="title">Blog du lịch</h4>
                              <li><Link to="#">Review</Link></li>
                              <li><Link to="#">Điểm đến</Link></li>
                              <li><Link to="#">Ẩm thực</Link></li>
                              <li><Link to="#">Kinh nghiệm</Link></li>
                          </ul>
                      </div>
                      <div className="col-lg-4">
                          <ul>
                              <h4 className="title">Dịch vụ</h4>
                              <li><Link to="#">Tour quốc tế</Link></li>
                              <li><Link to="#">Tour nội địa</Link></li>
                              <li><Link to="#">Combo du lịch</Link></li>
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

    </div>
  )
}

export default Footer