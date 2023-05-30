const swiper = new Swiper('.news-swiper', {
  direction: 'horizontal',
  loop: true,
  freeMode: true,

  pagination: {
    el: '.swiper-pagination',
  },

  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  navigationShow: 2,
  scrollbar: {
    el: '.swiper-scrollbar',
  },

  spaceBetween: 32,

  // autoplay: {
  //     delay: 4000,
  // },

  mousewheel: {
      invert: true,
  },

  // slidesPerView: 4,
  slidesPerView: 'auto',
  // slidesPerGroup: 2,



  breakpoints: {

  },
});

const actionSwiper = new Swiper('.actions_content', {
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  
  spaceBetween: 16,

  mousewheel: {
    invert: true,
  },

  slidesPerView: 'auto',
});

const cardDesignSwiper = new Swiper('.card_design_swiper', {
    direction: 'horizontal',
    loop: true,

    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },

    spaceBetween: 16,

    // autoplay: {
    //     delay: 4000,
    // },

    mousewheel: {
        invert: true,
    },

    // slidesPerView: 4,
    slidesPerView: 'auto',
});

const calendarSwiper = new Swiper('.events_payment_calendar-swiper', {

  navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    
    spaceBetween: 16,

    mousewheel: {
      invert: true,
    },

    slidesPerView: 1,
})