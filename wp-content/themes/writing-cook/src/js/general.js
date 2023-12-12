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
      this.wp_recall_profile = this.wp_recall_profile(this)
      
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
        $('.main-menu').slideToggle().toggleClass('active');
      });
    
      $(document).on('click', function(e) {
        let $mainMenu = $('.main-menu');
        if (!$(e.target).closest('.header').length) {
          if ($mainMenu.hasClass('active')) {
            $mainMenu.slideToggle().removeClass('active');
          }
        }
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

    /**
     * Change header styles to light
     */
    header_light: function() {
      $(document).ready(function() {
        var header = $('#header');
        if( !$('body').hasClass('private-office-page') ) {
          $(window).scroll(function() {
            if ($(this).scrollTop() >= 100) {
                header.addClass('header_light');
            } else {
                header.removeClass('header_light');
            }
          });
        } else if( $('body').hasClass('private-office-page') ) {
          header.addClass('header_light');
        }
      });
    },

    /**
     * Change position wp-recall items to header
     */
    wp_recall_to_header: function() {
      $("#recallbar").insertBefore("#header .header__container .header__row .header__col_right .header__burger");
      $('#recallbar .pr_sub_menu').insertAfter("#header .header__container .main-menu a");
    },

    /**
     * Styles and functional for profile wp-recall private office
     */
    wp_recall_profile: function() {
      if ($('#rcl-office').length > 0) {
        $('#rcl-office').wrap('<main class="private"><div class="private__container container"></div></main>');
        $('body').addClass('private-office-page');

        $('.cab_lt_title').insertAfter('.lk-avatar');
        $('.cab_lt_line').insertAfter('.lk-sidebar')
      }
    },
    
    

  }

  /**
   * Init Global
   */
  $(document).ready(function() {
    Global.init()
  });

});
