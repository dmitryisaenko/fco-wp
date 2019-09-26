$(document).ready(function(){
  $('.slick-carousel-infrastructure-first').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    fade: false,
    asNavFor: '.slick-carousel-infrastructure-first-nav'
  });
  $('.slick-carousel-infrastructure-first-nav').slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    arrows: false,
    asNavFor: '.slick-carousel-infrastructure-first',
    centerMode: true,
    centerPadding: '60px',
    focusOnSelect: true,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 2000
  });

  $('.slick-carousel-infrastructure-second').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: true,
    fade: false,
    asNavFor: '.slick-carousel-infrastructure-second-nav'
  });
  $('.slick-carousel-infrastructure-second-nav').slick({
    slidesToShow: 2,
    slidesToScroll: 1,
    arrows: false,
    asNavFor: '.slick-carousel-infrastructure-second',
    centerMode: true,
    centerPadding: '60px',
    focusOnSelect: true,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 2000
  });


    $('.slick-carousel-media-single').slick({
      lazyLoad: 'ondemand',
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: true,
      fade: false,
      asNavFor: '.slider-nav'
    });
    $('.slider-nav').slick({
      slidesToShow: 7,
      slidesToScroll: 1,
      arrows: false,
      asNavFor: '.slick-carousel-media-single',
      centerMode: true,
      centerPadding: '60px',
      focusOnSelect: true,
      infinite: true,
      autoplay: true,
      autoplaySpeed: 2000
    });




  });
