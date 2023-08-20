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
      this.gallary_slider = this.gallary_slider(this)
      
    },

    /**
     * Install
     */
    install: function () {},

    /**
     * Slider for Galary
     */
    gallary_slider: function() {
      var sliderFor = $('.gallery .slider-for');
      var sliderNav = $('.gallery .slider-nav');
    
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
          focusOnSelect: true
        });
      }

      // Initialize the sliders on page load
      initializeSliders();
    
      // Reinitialize sliders on window resize
      $(window).on('resize', function() {
        sliderFor.slick('unslick');
        sliderNav.slick('unslick');
        initializeSliders();
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