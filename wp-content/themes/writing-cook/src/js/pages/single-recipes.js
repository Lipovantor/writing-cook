jQuery(function ($) {

  'use strict';

  /******************************************************************
   * Single Recipes
   * @type {{init: SingleRecipes.init, install: SingleRecipes.install}}
   * @since 1.0
   * @author Serge Bayraktar
   * @date 13.03.2023
   */
  const SingleRecipes = {

    /**
     * Init
     */
    init: function () {

      this.install = this.install(this)
      this.gallery_slider = this.gallery_slider(this)
      this.open_modal_video = this.open_modal_video(this)
      this.close_modal_video = this.close_modal_video(this)
      
    },

    /**
     * Install
     */
    install: function () {},

    /**
     * Slider for Galary
     */
    gallery_slider: function() {
      let sliderFor = $('.gallery .slider-for'),
          sliderNav = $('.gallery .slider-nav');
    
      function initializeSliders() {
        sliderFor.slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
          fade: true,
          infinite: false,
          asNavFor: sliderNav
        });
    
        sliderNav.slick({
          slidesToShow: 3,
          slidesToScroll: 1,
          vertical: true,
          verticalSwiping: true,
          asNavFor: sliderFor,
          prevArrow: $('.slider-nav__button_prev'),
          nextArrow: $('.slider-nav__button_next'),
          dots: false,
          infinite: false,
          focusOnSelect: true,

          responsive: [
            {
              breakpoint: 768,
              settings: {
                vertical: false,
                verticalSwiping: false,
              }
            },
          ]
        });
      }

      // Initialize the sliders on page load
      initializeSliders();
    
      // Reinitialize sliders on window resize
      let resizeTimer;

      $(window).on('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
          sliderFor.slick('unslick');
          sliderNav.slick('unslick');
          initializeSliders();
        }, 100); // Настройте подходящую задержку
      });
    },

    open_modal_video: function() {
      if($('.video-button').length > 0) {
        $('.video-button').on('click', function() {
          $('.modal-video').addClass('modal-video_show');
        });
      }
    },

    close_modal_video: function() {
      if($('.modal-video__close').length > 0) {
        $('.modal-video__close').on('click', function() {
          $('.modal-video').removeClass('modal-video_show');
        });
      }

      $('.modal-video').on('click', function(event) {
        if (!$(event.target).closest('.modal-video__frame').length) {
          $('.modal-video').removeClass('modal-video_show');
        }
      });

      $(document).on('keydown', function(event) {
        if (event.key === 'Escape' && $('.modal-video').hasClass('modal-video_show')) {
          $('.modal-video').removeClass('modal-video_show');
        }
      });
    },
  }

  /**
   * Init Global
   */
  $(document).ready(function() {
    SingleRecipes.init()
  });

});