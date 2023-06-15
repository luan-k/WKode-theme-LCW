import $ from "jquery";

$(".slider-fuck-test").slick({
  autoplay: false,
  autoplaySpeed: 2000,
  dots: true,
  infinite: true,
  speed: 500,
  slidesToShow: 1,
  slidesToScroll: 1,
});
$(".wkode-used-bikes__slider").slick({
  autoplay: false,
  autoplaySpeed: 2000,
  dots: false,
  infinite: true,
  speed: 500,
  arrows: true,
  prevArrow: `<button class="arrow-button left-arrow" style="background-image: url('../../wp-content/themes/WKode-theme-LCW/assets/img/svg/new-carrousel-left.svg')"></button>`,
  nextArrow: `<button class="arrow-button right-arrow" style="background-image: url('../../wp-content/themes/WKode-theme-LCW/assets/img/svg/new-carrousel-right.svg')"></button>`,
  slidesToShow: 3,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1000,
      settings: {
        slidesToShow: 2,
      },
    },
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 1,
      },
    },
    {
      breakpoint: 520,
      settings: {
        slidesToShow: 1,
      },
    },
  ],
});
$(".trial-slider").slick({
  centerMode: true,
  autoplay: false,
  autoplaySpeed: 2000,
  dots: false,
  infinite: true,
  speed: 500,
  arrows: true,
  prevArrow: `<button class="arrow-button left-arrow" style="background-image: url('../../wp-content/themes/WKode-theme-LCW/assets/img/svg/new-carrousel-left.svg')"></button>`,
  nextArrow: `<button class="arrow-button right-arrow" style="background-image: url('../../wp-content/themes/WKode-theme-LCW/assets/img/svg/new-carrousel-right.svg')"></button>`,
  /* slidesToShow: 3,
  centerPadding: "400px", */
  slidesToShow: 5,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1600,
      settings: {
        slidesToShow: 3,
        centerMode: false,
      },
    },
    {
      breakpoint: 1000,
      settings: {
        slidesToShow: 2,
      },
    },
    {
      breakpoint: 800,
      settings: {
        slidesToShow: 1,
      },
    },
    {
      breakpoint: 500,
      settings: {
        slidesToShow: 1,
        centerMode: false,
      },
    },
  ],
});

/*
$(".logo-carousel").slick({
  slidesToShow: 6,
  slidesToScroll: 1,
  autoplay: false,
  autoplaySpeed: 1000,
  arrows: true,
  prevArrow:
    '<button class="slide-arrow slick-prev"><i class="fas fa-chevron-left"></i></button>',
  nextArrow:
    '<button class="slide-arrow slick-next"><i class="fas fa-chevron-right"></i></button>',
  dots: false,
  pauseOnHover: false,
  responsive: [
    {
      breakpoint: 768,
      settings: {
        slidesToShow: 4,
      },
    },
    {
      breakpoint: 520,
      settings: {
        slidesToShow: 2,
      },
    },
  ],
});
 */
