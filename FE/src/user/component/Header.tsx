
import { Link } from 'react-router-dom';
import '../../App.css'
import '../../css/userHome.css';
import { Logo_TV1Image } from '../../images/image';
import React, { useState, useEffect, } from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faSearch, faUser, faPhoneVolume, faTimes } from '@fortawesome/free-solid-svg-icons';
const Header: React.FC = () => {
    const [isSearchActive, setIsSearchActive] = useState(false);
    const [isUserActive, setIsUserActive] = useState(false);
    const [isHoveredTourQuocTe, setIsHoveredTourQuocTe] = useState(false);
    const [isHoveredTourNoiDia, setIsHoveredTourNoiDia] = useState(false);
    const [isHoveredComboDuLich, setIsHoveredComboDuLich] = useState(false);

    const handleMouseEnterTourQuocTe = () => {
        setIsHoveredTourQuocTe(true);
        setIsHoveredTourNoiDia(false);
        setIsHoveredComboDuLich(false);
    };

    const handleMouseEnterTourNoiDia = () => {
        setIsHoveredTourNoiDia(true);
        setIsHoveredTourQuocTe(false);
        setIsHoveredComboDuLich(false);
    };

    const handleMouseEnterComboDuLich = () => {
        setIsHoveredComboDuLich(true);
        setIsHoveredTourQuocTe(false);
        setIsHoveredTourNoiDia(false);
    };

    const handleMouseLeave = () => {
        setIsHoveredTourQuocTe(false);
        setIsHoveredTourNoiDia(false);
        setIsHoveredComboDuLich(false);
    };

    const handleSearchIconClick = (event: any) => {
        event.stopPropagation();
        setIsSearchActive(!isSearchActive);
        setIsUserActive(false);
    };

    const handleUserIconClick = (event: any) => {
        event.stopPropagation();
        setIsUserActive(!isUserActive);
        setIsSearchActive(false);
    };

    const handleCloseBtnClick = () => {
        setIsSearchActive(false);
    };

    const handleHeaderClick = (event: any) => {
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
    const [isDropdownOpen, setIsDropdownOpen] = useState(false);
    return (
        <header>
            <div className="header ">
                <Link className="logo" to="/home">
                    <img src={Logo_TV1Image} alt="logo_papo" />
                </Link>
                <ul className="nav_menu flex space-x-4">
                    <li className="nav_item relative group">
                        <a href="/Tour-quoc-te" className="nav_link text-white" onMouseEnter={handleMouseEnterTourQuocTe}>
                            TOUR QUỐC TẾ
                        </a>
                        <ul onMouseLeave={handleMouseLeave} className={`absolute left-0 mt-2 w-96 bg-white shadow-lg rounded-lg ${isHoveredTourQuocTe ? 'opacity-100' : 'opacity-0'} transition-opacity duration-300`} style={{ visibility: isHoveredTourQuocTe ? 'visible' : 'hidden' }}>
                            <li className="p-4">
                                <ul className="list-none">
                                    <li>
                                        <a href="tour-dong-nam-a.html" className="block py-2 text-gray-800 hover:text-gray-600">Đông Nam Á</a>
                                        <a href="du-lich-singapore-malaysia.html" className="block py-2 text-gray-800 hover:text-gray-600">Singapore - Malaysia</a>
                                        <a href="du-lich-thai-lan.html" className="block py-2 text-gray-800 hover:text-gray-600">Thái Lan</a>
                                        <a href="bali-indonesia.html" className="block py-2 text-gray-800 hover:text-gray-600">Bali - Indonesia</a>
                                    </li>
                                    {/* <li>Thêm tour ở đây</li> */}
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li className="nav_item relative group">
                        <a href="/Tour-noi-dia" className="nav_link text-white" onMouseEnter={handleMouseEnterTourNoiDia}>
                            TOUR NỘI ĐỊA
                        </a>
                        <ul onMouseLeave={handleMouseLeave} className={`absolute left-0 mt-2 w-96 bg-white shadow-lg rounded-lg ${isHoveredTourNoiDia ? 'opacity-100' : 'opacity-0'} transition-opacity duration-300`} style={{ visibility: isHoveredTourNoiDia ? 'visible' : 'hidden' }}>
                            <li className="p-4">
                                <ul className="list-none">
                                    <li>
                                        <a href="tour-dong-nam-a.html" className="block py-2 text-gray-800 hover:text-gray-600">Đông Nam Á</a>
                                        <a href="du-lich-singapore-malaysia.html" className="block py-2 text-gray-800 hover:text-gray-600">Singapore - Malaysia</a>
                                        <a href="du-lich-thai-lan.html" className="block py-2 text-gray-800 hover:text-gray-600">Thái Lan</a>
                                        <a href="bali-indonesia.html" className="block py-2 text-gray-800 hover:text-gray-600">Bali - Indonesia</a>
                                    </li>
                                    {/* <li>Thêm tour ở đây</li> */}
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li className="nav_item relative group">
                        <a href="/Combo-du-lich" className="nav_link text-white" onMouseEnter={handleMouseEnterComboDuLich}>
                            COMBO DU LỊCH
                        </a>
                        <ul onMouseLeave={handleMouseLeave} className={`absolute left-0 mt-2 w-96 bg-white shadow-lg rounded-lg ${isHoveredComboDuLich ? 'opacity-100' : 'opacity-0'} transition-opacity duration-300`} style={{ visibility: isHoveredComboDuLich ? 'visible' : 'hidden' }}>
                            <li className="p-4">
                                <ul className="list-none w-1/2">
                                    <li>
                                        <a href="tour-dong-nam-a.html" className="block py-2 text-gray-800 hover:text-gray-600">Đông Nam Á</a>
                                        <a href="du-lich-singapore-malaysia.html" className="block py-2 text-gray-800 hover:text-gray-600">Singapore - Malaysia</a>
                                        <a href="du-lich-thai-lan.html" className="block py-2 text-gray-800 hover:text-gray-600">Thái Lan</a>
                                        <a href="bali-indonesia.html" className="block py-2 text-gray-800 hover:text-gray-600">Bali - Indonesia</a>
                                    </li>
                                    
                                    {/* <li>Thêm tour ở đây</li> */}
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li className="nav_item">
                        <Link to='/Blog-du-lich' className='nav_link text-white'>BLOG DU LỊCH</Link>
                    </li>
                    <li className="nav_item">
                        <Link to='/Ve-chung-toi' className='nav_link text-white'>VỀ CHÚNG TÔI</Link>
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
