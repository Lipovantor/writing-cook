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
      $('.gallery .slider-for').slick({
        // centerMode: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        // vertical: true,
        // verticalSwiping: true,
        arrows: false,
        fade: true,
        infinite: false,
        asNavFor: '.gallery .slider-nav'
      });
      $('.gallery .slider-nav').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        vertical: true,
        verticalSwiping: true,
        asNavFor: '.gallery .slider-for',
        prevArrow: false,
        nextArrow: false,
        dots: false,
        infinite: false,
        centerMode: true,
        focusOnSelect: true
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