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
    
    },

    /**
     * Install
     */
    install: function () {},
    
  }

  /**
   * Init Global
   */
  $(document).ready(function() {
    FrontPage.init()
  });

});