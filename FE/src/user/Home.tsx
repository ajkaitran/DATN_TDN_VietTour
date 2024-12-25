
import React from 'react';
import { Link } from 'react-router-dom';
import '../css/style_main.scss'; // Assuming SCSS is compiled to CSS
import BodyHome from './component/BodyHome';
import '../css/userHome.css'
import {
    bandoImage,
    avtImage,
    Logo_TV1Image,
    BannerHomeImage,
    BgFooterImage,
    LoaiTourImage,
    LigthBulbImage,
    TaiXuongImage
} from '../images/image';
import Header from './component/Header';
import Footer from './component/Footer';

const Home: React.FC = () => {
    return (
        <div>
            <Header/>
            <BodyHome/>
            <Footer/>

            {/* JS scripts can be included in the index.html or imported in the main app file */}
        </div>
    );
};

export default Home;
