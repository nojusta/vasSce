(function ($) {
  /**
   * adding slider for patternberg
   */

  // Wait for a short time to ensure classes are applied before initializing Swiper
  setTimeout(function () {
    // Initialize Swiper
    var tgPostSwiper = new Swiper(".tg-post-slider", {
      slidesPerView: 1,
      spaceBetween: 20,
      loop: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".tgpost-slider-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".tgpost-slider-next",
        prevEl: ".tgpost-slider-prev",
      },
      // Add more options as needed
    });
    var tgPostSwiper2 = new Swiper(".tg-post-slider-2", {
      slidesPerView: 1,
      spaceBetween: 20,
      centeredSlides: true,
      loop: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".tgpost-slider-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".tgpost-slider-next",
        prevEl: ".tgpost-slider-prev",
      },
      breakpoints: {
        400: {
          slidesPerView: 1,
        },
        1180: {
          slidesPerView: 2,
        },
      },
      // Add more options as needed
    });
    var tgPostSwiper3 = new Swiper(".tg-post-slider-3", {
      slidesPerView: 1,
      spaceBetween: 20,
      loop: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".tgpost-slider-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      breakpoints: {
        400: {
          slidesPerView: 1,
        },
        767: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 2,
        },
        1180: {
          slidesPerView: 3,
        },
      },
      // Add more options as needed
    });
    var tgPostSwiper4 = new Swiper(".tg-post-slider-4", {
      slidesPerView: 1,
      spaceBetween: 20,
      loop: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".tgpost-slider-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".tgpost-slider-next",
        prevEl: ".tgpost-slider-prev",
      },
      breakpoints: {
        400: {
          slidesPerView: 1,
        },
        767: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 2,
        },
        1180: {
          slidesPerView: 4,
        },
      },
      // Add more options as needed
    });

    var tgPostTicker = new Swiper(".tg-news-ticker", {
      direction: "vertical",
      slidesPerView: 1,
      loop: true,
      spaceBetween: 0,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".tg-ticker-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".tg-ticker-next",
        prevEl: ".tg-ticker-prev",
      },
      // Add more options as needed
    });
    var tgPostTicker2 = new Swiper(".tg-news-ticker-2", {
      slidesPerView: 4,
      direction: "vertical",
      spaceBetween: 20,
      loop: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".tgv-ticker-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".tgv-ticker-next",
        prevEl: ".tgv-ticker-prev",
      },
      // Add more options as needed
    });
    var tgPostTicker3 = new Swiper(".tg-news-ticker-3", {
      slidesPerView: 3,
      direction: "vertical",
      loop: true,
      spaceBetween: 20,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".tgv-ticker-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".tgv-ticker-next",
        prevEl: ".tgv-ticker-prev",
      },
      // Add more options as needed
    });

    var tgPostCarsl = new Swiper(".tg-post-carousel", {
      slidesPerView: 1,
      spaceBetween: 20,
      loop: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".tgpost-carousel-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".tgpost-carousel-next",
        prevEl: ".tgpost-carousel-prev",
      },
      breakpoints: {
        400: {
          slidesPerView: 1,
        },
        767: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 2,
        },
        1180: {
          slidesPerView: 3,
        },
      },
      // Add more options as needed
    });
    var tgPostCarsl4 = new Swiper(".tg-post-carousel-4", {
      slidesPerView: 1,
      spaceBetween: 20,
      loop: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".tgpost-carousel-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".tgpost-carousel-next",
        prevEl: ".tgpost-carousel-prev",
      },
      breakpoints: {
        400: {
          slidesPerView: 1,
        },
        767: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 2,
        },
        1180: {
          slidesPerView: 4,
        },
      },
      // Add more options as needed
    });
    var tgPostCarsl5 = new Swiper(".tg-post-carousel-5", {
      slidesPerView: 1,
      spaceBetween: 20,
      loop: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".tgpost-carousel-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".tgpost-carousel-next",
        prevEl: ".tgpost-carousel-prev",
      },
      breakpoints: {
        400: {
          slidesPerView: 1,
        },
        767: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 2,
        },
        1180: {
          slidesPerView: 5,
        },
      },
      // Add more options as needed
    });
    var tgContentBox1 = new Swiper(".tg-content-carousel-1", {
      slidesPerView: 1,
      spaceBetween: 20,
      loop: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".tgcontent-carousel-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".tgcontent-slide-next",
        prevEl: ".tgcontent-slide-prev",
      },
      breakpoints: {
        400: {
          slidesPerView: 1,
        },
        767: {
          slidesPerView: 1,
        },
        1024: {
          slidesPerView: 1,
        },
        1180: {
          slidesPerView: 1,
        },
      },
      // Add more options as needed
    });
    var tgContentBox2 = new Swiper(".tg-content-carousel-2", {
      slidesPerView: 1,
      spaceBetween: 20,
      loop: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".tgcontent-carousel-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".tgcontent-slide-next",
        prevEl: ".tgcontent-slide-prev",
      },
      breakpoints: {
        400: {
          slidesPerView: 1,
        },
        767: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 2,
        },
        1180: {
          slidesPerView: 2,
        },
      },
      // Add more options as needed
    });
    var tgContentBox = new Swiper(".tg-content-carousel", {
      slidesPerView: 1,
      spaceBetween: 20,
      loop: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".tgcontent-carousel-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".tgcontent-slide-next",
        prevEl: ".tgcontent-slide-prev",
      },
      breakpoints: {
        400: {
          slidesPerView: 1,
        },
        767: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 2,
        },
        1180: {
          slidesPerView: 3,
        },
      },
      // Add more options as needed
    });
    var tgContentBox4 = new Swiper(".tg-content-carousel-4", {
      slidesPerView: 1,
      spaceBetween: 20,
      loop: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".tgcontent-carousel-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".tgcontent-slide-next",
        prevEl: ".tgcontent-slide-prev",
      },
      breakpoints: {
        400: {
          slidesPerView: 1,
        },
        767: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 2,
        },
        1180: {
          slidesPerView: 4,
        },
      },
      // Add more options as needed
    });
    var tgContentBox5 = new Swiper(".tg-content-carousel-5", {
      slidesPerView: 1,
      spaceBetween: 20,
      loop: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".tgcontent-carousel-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".tgcontent-slide-next",
        prevEl: ".tgcontent-slide-prev",
      },
      breakpoints: {
        400: {
          slidesPerView: 1,
        },
        767: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
        },
        1180: {
          slidesPerView: 5,
        },
      },
      // Add more options as needed
    });
  }, 100); // You can adjust the delay as needed
  // });
  $(".tg-swiper-holder").find(".wp-block-post").addClass("swiper-slide");

  $(".tg-swiper-holder").each(function (index) {
    var sliderHeight = $(this).find(".wp-block-cover").css("min-height");
    $(this).find(".wp-block-cover").css("height", sliderHeight);
  });

  $(".news-ticker-holderv").each(function (index) {
    var tickerHeight = $(this).css("min-height");
    $(this).find(".tg-news-ticker-2").css("height", tickerHeight);
  });
  $(".news-ticker-holderv").each(function (index) {
    var tickerHeight = $(this).css("min-height");
    $(this).find(".tg-news-ticker-3").css("height", tickerHeight);
  });

  /**
   * PatternBerg Counter
   */
  var viewed = [];
  $(".tg-counter").each(function () {
    viewed.push(false);
  });

  $(window).scroll(function () {
    var windowHeight = $(window).height();
    var scrollTop = $(window).scrollTop();
    $(".tg-counter").each(function (index) {
      var offset = $(this).offset().top;
      var distance = offset - scrollTop;

      if (!viewed[index] && distance < windowHeight) {
        viewed[index] = true;
        var count = parseInt($(this).text());
        $(this)
          .prop("Counter", 0)
          .animate(
            {
              Counter: count,
            },
            {
              duration: 3000,
              easing: "swing",
              step: function (now) {
                $(this).text(Math.ceil(now));
              },
            }
          );
      }
    });
  });
  document.addEventListener("DOMContentLoaded", function () {
    var tgSwiper = new Swiper(".tg-slider", {
      // Swiper configuration options
      slidesPerView: 1,
      spaceBetween: 20,
      autoplay: {
        delay: 5000, // Set the delay (in milliseconds) between slides
        disableOnInteraction: false, // Allow navigation when interacting with the slider
      },
      pagination: {
        el: ".tg-slider-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".tg-slider-next",
        prevEl: ".tg-slider-prev",
      },
      // Add more options as needed
    });
  });
})(jQuery);
