jQuery(function ($) {

  'use strict';

  /******************************************************************
   * Single Recipes
   * @type {{init: FrontPage.init, install: FrontPage.install}}
   * @since 1.0
   * @author Serge Bayraktar
   * @date 20.12.2023
   */
  const FrontPage = {

    /**
     * Init
     */
    init: function () {

      this.install = this.install(this)
      this.optional_recipes_slider_right_to_left = this.optional_recipes_slider_right_to_left(this)
      this.optional_recipes_slider_left_to_right = this.optional_recipes_slider_left_to_right(this)
    
    },

    /**
     * Install
     */
    install: function () {},

    /**
     * Slider for section Optional Recipes
     */
    optional_recipes_slider_right_to_left: function() {
      let optionalRecipesSlider = $('.optional-recipes__slider_standart');
    
      function initializeSlider() {
        optionalRecipesSlider.slick({
          slidesToShow: 6,
          slidesToScroll: 1,
          infinite: true,
          autoplay: true,
          autoplaySpeed: 1500,
          pauseOnHover: true,
          centerMode: true,
          variableWidth: true,
          adaptiveHeight: true,
          arrows: false,

          responsive: [
            {
              breakpoint: 768,
              settings: {
                
              }
            },
          ]
        });
      }

      // Initialize the sliders on page load
      initializeSlider();
    
      // Reinitialize sliders on window resize
      let resizeTimer;

      $(window).on('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
          optionalRecipesSlider.slick('unslick');
          initializeSlider();
        }, 100); // Настройте подходящую задержку
      });
    },
   
    /**
     * Slider for section Optional Recipes RTL
     */
    optional_recipes_slider_left_to_right: function() {
      let optionalRecipesSlider = $('.optional-recipes__slider_rtl');
    
      function initializeSlider() {
        optionalRecipesSlider.slick({
          slidesToShow: 6,
          slidesToScroll: 1,
          infinite: true,
          autoplay: true,
          autoplaySpeed: 1500,
          pauseOnHover: true,
          centerMode: true,
          variableWidth: true,
          adaptiveHeight: true,
          arrows: false,
          rtl: true,

          responsive: [
            {
              breakpoint: 768,
              settings: {
                
              }
            },
          ]
        });
      }

      // Initialize the sliders on page load
      initializeSlider();
    
      // Reinitialize sliders on window resize
      let resizeTimer;

      $(window).on('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
          optionalRecipesSlider.slick('unslick');
          initializeSlider();
        }, 100); // Настройте подходящую задержку
      });
    },
    
  }

  /**
   * Init Global
   */
  $(document).ready(function() {
    FrontPage.init()
  });

});