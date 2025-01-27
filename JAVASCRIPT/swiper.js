const swiper = new Swiper('.slider_wrap', {
    loop: true,
    grabCursor:true,
    spaceBetween:1,
  
    // If we need pagination
    pagination: {
      el: '.swiper-pagination',
      clickable:true,
      dynamicBullets:true
    },
  
    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },

    //Responsive Breakpoint
    breakpoints: {
        0:{
            slidesPerView:1
        },
        
        620:{
            slidesPerView:3
        },

        1024:{
            slidesPerView:4
        },
    }
    
  });