
import { Link } from 'react-router-dom';
import '../../css/style_main.scss';
import '../../css/userHome.css';
import { Logo_TV1Image } from '../../images/image';
import React, { useState, useEffect, useRef } from 'react';

const Header: React.FC = () => {
    const [isSearchActive, setSearchActive] = useState(false);
    const [isUser , setUser ] = useState(false);

    const searchRef = useRef<HTMLDivElement>(null);
    const userRef = useRef<HTMLDivElement>(null);

    const handleSearchClick = (event: React.MouseEvent) => {
        event.stopPropagation();
        setSearchActive(prev => !prev);
        setUser(false);
    };

    const handleUserClick = (event: React.MouseEvent) => {
        event.stopPropagation();
        setUser (prev => !prev);
        setSearchActive(false);
    };

    const handleCloseSearch = () => {
        setSearchActive(false);
    };

    const handleClickOutside = (event: MouseEvent) => {
        if (searchRef.current && !searchRef.current.contains(event.target as Node)) {
            setSearchActive(false);
        }
        if (userRef.current && !userRef.current.contains(event.target as Node)) {
            setUser(false);
        }
    };

    useEffect(() => {
        document.addEventListener('click', handleClickOutside);
        return () => {
            document.removeEventListener('click', handleClickOutside);
        };
    }, []);
    return (
        <div>
            <div className="header">
                <a className="logo" href="/home">
                    <img src={Logo_TV1Image} alt="logo_papo" />
                </a>
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
                <Link className="header_contact" to="tel:19004692">
                    <i className="fa-solid fa-phone-volume fs-4"></i>
                    <span>1900 4692</span>
                </Link>
            </div>
            <div className="header_search" onClick={handleSearchClick}>
                <div className="close-btn" >
                    <i className="fa-solid fa-xmark"></i>
                </div>
                <h2 className="text-green">Tìm kiếm</h2>
                <form className="search-form" method="get">
                    <input type="text" placeholder="Nhập từ khóa tìm kiếm..." />
                    <button type="submit"><i className="far fa-search"></i></button>
                </form>
            </div>
        </div>
    );
};

export default Header;
