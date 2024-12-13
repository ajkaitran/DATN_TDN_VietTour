import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faAngleLeft, faAngleRight } from '@fortawesome/free-solid-svg-icons'

import 'slick-carousel/slick/slick.css';
import 'slick-carousel/slick/slick-theme.css';
export const settings1 = {
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    slideCount: 3,
    currentSlide: 1,
    arrows: true,
    prevArrow: (
        <button type="button" className="slick-prev pull-left">
            <FontAwesomeIcon icon={faAngleLeft} />
        </button>
    ),
    nextArrow: (
        <button type="button" className="slick-next pull-right">
            <FontAwesomeIcon icon={faAngleRight} />
        </button>
    ),
    dots: true,
    autoplay: true,
    autoplaySpeed: 3000
};
export const settings2 = {
    infinite: true,
    slidesToShow: 2,
    slidesToScroll: 1,
    slideCount: 1,
    currentSlide: 1,
    arrows: true,
    prevArrow: (
        <button type="button" className="slick-prev pull-left">
            <FontAwesomeIcon icon={faAngleLeft} />
        </button>
    ),
    nextArrow: (
        <button type="button" className="slick-next pull-right">
            <FontAwesomeIcon icon={faAngleRight} />
        </button>
    ),
    dots: true,
    autoplay: true,
    autoplaySpeed: 3000
};
export const settings3 = {
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    slideCount: 3,
    arrows: true,
    currentSlide: 1,
    prevArrow: (
        <button type="button" className="slick-prev pull-left">
            <FontAwesomeIcon icon={faAngleLeft} />
        </button>
    ),
    nextArrow: (
        <button type="button" className="slick-next pull-right">
            <FontAwesomeIcon icon={faAngleRight} />
        </button>
    ),
    dots: true,
    autoplay: true,
    autoplaySpeed: 3000
};
export const settings4 = {
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    slideCount: 3,
    currentSlide: 1,
    arrows: true,
    prevArrow: (
        <button type="button" className="slick-prev pull-left">
            <FontAwesomeIcon icon={faAngleLeft} />
        </button>
    ),
    nextArrow: (
        <button type="button" className="slick-next pull-right">
            <FontAwesomeIcon icon={faAngleRight} />
        </button>
    ),
    dots: true,
    autoplay: true,
    autoplaySpeed: 3000
};
