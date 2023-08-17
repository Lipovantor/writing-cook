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
      
    },
  }

  /**
   * Init Global
   */
  $(document).ready(function() {
    SingleRecipes.init()
  });

});