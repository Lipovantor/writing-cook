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
      this.header_open_close_signin_login = this.header_open_close_signin_login(this)
      this.button_open_login = this.button_open_login(this)
      this.button_open_signin = this.button_open_signin(this)
      this.open_close_favorites_list = this.open_close_favorites_list(this)
      this.open_close_to_write_menu = this.open_close_to_write_menu(this)
      this.open_close_card_recipe = this.open_close_card_recipe(this)
      this.header_light = this.header_light(this)
      this.wp_recall_to_header = this.wp_recall_to_header(this)
      this.wp_recall_keydown_enter = this.wp_recall_keydown_enter(this)
      this.share_open = this.share_open(this)
      this.share_close = this.share_close(this)
      this.accordeon = this.accordeon(this)
      this.wp_recall_profile = this.wp_recall_profile(this)
      this.optional_recipes_slider_right_to_left = this.optional_recipes_slider_right_to_left(this)
      this.optional_recipes_slider_left_to_right = this.optional_recipes_slider_left_to_right(this)
      
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
        if (!$(e.target).closest('#burger-menu').length && !$(e.target).closest('.main-menu').length) {
          if ($mainMenu.hasClass('active')) {
            $mainMenu.slideToggle().removeClass('active');
          }
        }
      });
    },   
    
    /**
     * Open-close sign-in and log-in in header
     */
    header_open_close_signin_login: function() {
      $('#login-signin').on('click', function() {
        $('.rcl-loginform').slideToggle().toggleClass('active');
      });

      $('.rcl-loginform').insertAfter("#header .header__container .header__row");
    
      $(document).on('click', function(e) {
        let $mainMenu = $('.rcl-loginform');
        if (!$(e.target).closest('#login-signin').length 
            && !$(e.target).closest('.rcl-loginform').length
            && !$(e.target).closest('.open-log-in').length
            && !$(e.target).closest('.open-sign-in').length) {
          if ($mainMenu.hasClass('active')) {
            $mainMenu.slideToggle().removeClass('active');
          }
        }
      });
    },

    /**
     * Open log-in on click open-log-in
     */
    button_open_login: function() {
      $('.open-log-in').on('click', function() {
        if(!$('.rcl-loginform').hasClass('active')) {
          $('.rcl-loginform').slideToggle().toggleClass('active');
          $('.link-login-rcl').trigger('click');
        } else {
          $('.link-login-rcl').trigger('click');
        }
      });
    },

    /**
     * Open sign-in on click open-sign-in
     */
    button_open_signin: function() {
      $('.open-sign-in').on('click', function() {
        if(!$('.rcl-loginform').hasClass('active')) {
          $('.rcl-loginform').slideToggle().toggleClass('active');
          $('.link-register-rcl').trigger('click');
        } else {
          $('.link-register-rcl').trigger('click');
        }
      });
    },

    /**
     * Open/close favorites-list in header
     */
    open_close_favorites_list: function() {
      if ($('.bookmark').length > 0) {
        $('.bookmark').on('click', function() {
          $('.book-favorites').slideToggle().toggleClass('active');
        });
      
        $(document).on('click', function(e) {
          let $mainMenu = $('.book-favorites');
          if (!$(e.target).closest('.book-favorites').length && !$(e.target).closest('.bookmark').length) {
            if ($mainMenu.hasClass('active')) {
              $mainMenu.slideToggle().removeClass('active');
            }
          }
        });
      }
    },

    /**
     * Open/close favorites-list in header
     */
    open_close_to_write_menu: function() {
      if ($('.to-write').length > 0) {
        $('.to-write').on('click', function() {
          $('.to-write-menu').slideToggle().toggleClass('active');
        });
      
        $(document).on('click', function(e) {
          let $mainMenu = $('.to-write-menu');
          if (!$(e.target).closest('.to-write-menu').length && !$(e.target).closest('.to-write').length) {
            if ($mainMenu.hasClass('active')) {
              $mainMenu.slideToggle().removeClass('active');
            }
          }
        });
      }
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
    
        let zIndexValue = card.closest('.searching').length > 0 ? 21 : 20;
    
        card.css('z-index', -card.index() + zIndexValue);
    
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
        let header = $('#header');
    
        if ($('body').hasClass('error404') || $('body').hasClass('private-office-page')) {
          header.addClass('header_light');
        } else {
          $(window).scroll(function() {
            if ($(this).scrollTop() >= 100) {
              header.addClass('header_light');
            } else {
              header.removeClass('header_light');
            }
          });
        }
      });
    },

    /**
     * Change position wp-recall items to header
     */
    wp_recall_to_header: function() {
      $("#recallbar").insertBefore("#header .header__container .header__row .header__col_right .header__burger");
      $('#recallbar .pr_sub_menu').insertAfter("#header .header__container .main-menu a:last-child");
    },

    /**
     * Keydown Enter for form wp-recall
     */
    wp_recall_keydown_enter: function() {
      $(document).ready(function() {
        $('.rcl-loginform form').on('keydown', function(event) {
          if (event.key === 'Enter') {
            event.preventDefault();
            $(this).submit();
          }
        });
      });
    },

    /**
     * Open popup share
     */
    share_open: function() {
      if($('.share-button').length > 0) {
        $('.share-button').on('click', function() {
          $('.share-popup').slideToggle();
        });
      }
    },

    /**
     * Open popup share
     */
    share_close: function() {
      if($('.share-popup__close').length > 0) {
        $('.share-popup__close').on('click', function() {
          $('.share-popup').slideToggle();
        });
      }
    },

    /**
     * Accordeon open-close
     */
    accordeon: function() {
      $('.accordeon__header').click(function () {
        $(this).next('.accordeon__answer').slideToggle();
        $(this).closest('.accordeon__item').toggleClass('accordeon__item_active');
      });
    },

    /**
     * Styles and functional for profile wp-recall private office
     */
    wp_recall_profile: function() {
      if ($('#rcl-office').length > 0) {
        $('#rcl-office').wrap('<main class="private"><div class="private__container container"></div></main>');
        $('body').addClass('private-office-page');

        $('.cab_lt_title').insertAfter('.lk-avatar');
        $('.cab_lt_line').insertAfter('.lk-sidebar');
      }

      $(document).ready(function() {
        if ($('.rcl-notice__type-success').length > 0) {
          setTimeout(function() {
            $('.rcl-notice__type-success').hide();
          }, 1500);
        }
      });
    },

    /**
     * Slider for section Optional Recipes
     */
    optional_recipes_slider_right_to_left: function() {
      let optionalRecipesSlider = $('.optional-recipes__slider_standart');

      if(optionalRecipesSlider.length > 0) {
        function initializeSlider() {
          optionalRecipesSlider.slick({
            slidesToShow: 1,
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
      }
    },
    
    /**
     * Slider for section Optional Recipes RTL
     */
    optional_recipes_slider_left_to_right: function() {
      let optionalRecipesSlider = $('.optional-recipes__slider_rtl');
    
      if(optionalRecipesSlider.length > 0) {
        function initializeSlider() {
          optionalRecipesSlider.slick({
            slidesToShow: 1,
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
          }, 100);
        });
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
