import React from 'react'
import { Link } from 'react-router-dom'
import '../../css/style_main.scss';
import '../../css/userHome.css'
import { Logo_TV1Image } from '../../images/image'

const Header = () => {
  return (
    <div>
          <header>
              <div className="header">
                  <Link className="logo" to="/">
                      <img src={Logo_TV1Image} alt="logo_papo" />
                  </Link>
                  <ul className="nav_menu">
                      <li className="nav_item">
                          <Link className="nav_link" to="/">TOUR QUỐC TẾ</Link>
                      </li>
                      <li className="nav_item">
                          <Link className="nav_link" to="/">TUOR NỘI ĐỊA</Link>
                      </li>
                      <li className="nav_item">
                          <Link className="nav_link" to="/">COMBO DU LỊCH</Link>
                      </li>
                      <li className="nav_item">
                          <Link className="nav_link" to="/">BLOG DU LỊCH</Link>
                      </li>
                      <li className="nav_item">
                          <Link className="nav_link" to="/">VỀ CHÚNG TÔI</Link>
                      </li>
                  </ul>
                  <div className="header_bars">
                      <button className="icons_search">
                          <i className="fa-solid fa-search fs-4"></i>
                      </button>
                      <button className="icons_user">
                          <i className="fa-solid fa-user fs-4"></i>
                      </button>
                      <ul className="header_user">
                          <li className="user_item">
                              <Link className="user_link" to="#">Đăng Nhập</Link>
                          </li>
                          <li className="user_item">
                              <Link className="user_link" to="#">Đăng Ký</Link>
                          </li>
                          <li className="user_item">
                              <Link className="user_link" to="#">Thông Tin Chung</Link>
                          </li>
                          <li className="user_item">
                              <Link className="user_link" to="#">Đăng Xuất</Link>
                          </li>
                      </ul>
                  </div>
                  <a className="header_contact" href="tel:19004692">
                      <i className="fa-solid fa-phone-volume fs-4"></i>
                      <span>1900 4692</span>
                  </a>
              </div>
              <div className="header_search">
                  <div className="close-btn">
                      <i className="fa-solid fa-xmark"></i>
                  </div>
                  <h2 className="text-green">Tìm kiếm</h2>
                  <form className="search-form" method="get">
                      <input type="text" placeholder="Nhập từ khóa tìm kiếm..." />
                      <button type="submit"><i className="far fa-search"></i></button>
                  </form>
              </div>
          </header>
    </div>
  )
}

export default Header