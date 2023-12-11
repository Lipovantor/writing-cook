jQuery(function ($) {

  'use strict';

  /******************************************************************
   * Global
   * @type {{init: Global.init, install: Global.install}}
   * @since 1.0
   * @author Serge Bayraktar
   * @date 13.03.2023
   */
  const Global = {

    /**
     * Init
     */
    init: function () {

      this.install = this.install(this)
      this.header_open_close_main_menu = this.header_open_close_main_menu(this)
      this.open_close_card_recipe = this.open_close_card_recipe(this)
      this.header_light = this.header_light(this)
      this.wp_recall_to_header = this.wp_recall_to_header(this)
      
    },

    /**
     * Install
     */
    install: function () {

      // Page Speed JQuery optimization
      // jQuery.event.special.touchstart = {
      //   setup: function( _, ns, handle ) {
      //     this.addEventListener("touchstart", handle, { passive: !ns.includes("noPreventDefault") });
      //   }
      // };
      // jQuery.event.special.touchmove = {
      //   setup: function( _, ns, handle ) {
      //     this.addEventListener("touchmove", handle, { passive: !ns.includes("noPreventDefault") });
      //   }
      // };

    },

    /**
     * Open-close main-menu in header
     */
    header_open_close_main_menu: function() {
      $('#burger-menu').on('click', function() {
        $('.main-menu').slideToggle();
      });
    },

    /**
     * Open-close description card recipe
     */
    open_close_card_recipe: function() {

      $(document).on('click', '.recipe-card__button', function(e) {
        e.preventDefault();
        let button = $(this),
            card = button.closest('.recipe-card'),
            cardContent = card.find('.recipe-card__content_second');
    
            card.css('z-index', -card.index()+20);
    
        cardContent.slideToggle();
        button.toggleClass('recipe-card__button_active');
        card.toggleClass('recipe-card_active');
      });

    },

    header_light: function() {
      $(document).ready(function() {
        $(window).scroll(function() {
            var header = $('#header');
            if ($(this).scrollTop() >= 100) {
                header.addClass('header_light');
            } else {
                header.removeClass('header_light');
            }
        });
      });
    },

    wp_recall_to_header: function() {
      $("#recallbar").insertBefore("#header .header__container .header__row .header__col_right .header__burger");
    },

  }

  /**
   * Init Global
   */
  $(document).ready(function() {
    Global.init()
  });

});
