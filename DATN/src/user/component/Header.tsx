
import { Link } from 'react-router-dom';
import '../../App.css'
import '../../css/userHome.css';
import { Logo_TV1Image } from '../../images/image';
import React, { useState, useEffect,  } from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faSearch, faUser, faPhoneVolume, faTimes } from '@fortawesome/free-solid-svg-icons';
const Header: React.FC = () => {
     const [isSearchActive, setIsSearchActive] = useState(false);
            const [isUserActive, setIsUserActive] = useState(false);

            const handleSearchIconClick = (event:any) => {
                event.stopPropagation();
                setIsSearchActive(!isSearchActive);
                setIsUserActive(false);
            };

            const handleUserIconClick = (event:any) => {
                event.stopPropagation();
                setIsUserActive(!isUserActive);
                setIsSearchActive(false);
            };

            const handleCloseBtnClick = () => {
                setIsSearchActive(false);
            };

            const handleHeaderClick = (event:any) => {
                event.stopPropagation();
            };

            useEffect(() => {
                const handleClickOutside = () => {
                    setIsSearchActive(false);
                    setIsUserActive(false);
                };

                document.addEventListener('click', handleClickOutside);
                return () => {
                    document.removeEventListener('click', handleClickOutside);
                };
            }, []);

    return (
        <header>
            <div className="header">
                <Link className="logo" to="/home">
                    <img src={Logo_TV1Image} alt="logo_papo" />
                </Link>
                <ul className="nav_menu">
                    <li className="nav_item">
                        <Link  to='/home' className='nav_link'>TOUR QUỐC TẾ</Link>
                    </li>
                    <li className="nav_item">
                        <Link  to='/home' className='nav_link'>TUOR NỘI ĐỊA</Link>
                    </li>
                    <li className="nav_item">
                        <Link  to='/home' className='nav_link'>COMBO DU LỊCH</Link>
                    </li>
                    <li className="nav_item">
                        <Link  to='/home' className='nav_link'>BLOG DU LỊCH</Link>
                    </li>
                    <li className="nav_item">
                        <Link  to='/home' className='nav_link'>VỀ CHÚNG TÔI</Link>
                    </li>
                </ul>
                <div className="header_bars">
                    <button className="icons_search" onClick={handleSearchIconClick}>
                        <FontAwesomeIcon icon={faSearch} />
                    </button>
                    <button className="icons_user" onClick={handleUserIconClick}>
                        <FontAwesomeIcon icon={faUser} />
                    </button>
                    <ul className={`header_user ${isUserActive ? 'active' : ''}`} onClick={handleHeaderClick}>
                        <li className="user_item">
                            <a className="user_link" href="#">Đăng Nhập</a>
                        </li>
                        <li className="user_item">
                            <a className="user_link" href="#">Đăng Ký</a>
                        </li>
                        <li className="user_item">
                            <a className="user_link" href="#">Thông Tin Chung</a>
                        </li>
                        <li className="user_item">
                            <a className="user_link" href="#">Đăng Xuất</a>
                        </li>
                    </ul>
                </div>
                <a className="header_contact" href="tel:19004692">
                    <FontAwesomeIcon icon={faPhoneVolume} />
                    <span>1900 4692</span>
                </a>
                <div className={`header_search ${isSearchActive ? 'active' : ''}`} onClick={handleHeaderClick}>
                    <div className="close-btn" onClick={handleCloseBtnClick}>
                        <FontAwesomeIcon icon={faTimes} />
                    </div>
                    <h2 className="text-green">Tìm kiếm</h2>
                    <form className="search-form" method="get">
                        <input type="text" placeholder="Nhập từ khóa tìm kiếm..." />
                        <button type="submit"><FontAwesomeIcon icon={faSearch} /></button>
                    </form>
                </div>
            </div>
        </header>
        
    );
};

export default Header;
