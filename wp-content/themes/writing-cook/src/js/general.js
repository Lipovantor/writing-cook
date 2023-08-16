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
      this.open_close_card_recipe = this.open_close_card_recipe(this)
    },

    /**
     * Install
     */
    install: function () {

      // Page Speed JQuery optimization
      jQuery.event.special.touchstart = {
        setup: function( _, ns, handle ) {
          this.addEventListener("touchstart", handle, { passive: !ns.includes("noPreventDefault") });
        }
      };
      jQuery.event.special.touchmove = {
        setup: function( _, ns, handle ) {
          this.addEventListener("touchmove", handle, { passive: !ns.includes("noPreventDefault") });
        }
      };

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

  }

  /**
   * Init Global
   */
  $(document).ready(function() {
    Global.init()
  });

});