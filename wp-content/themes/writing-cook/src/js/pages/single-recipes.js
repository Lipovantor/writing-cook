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
      this.inventory_open_close = this.inventory_open_close(this)
      this.calculator_ingredients = this.calculator_ingredients(this)
      this.open_close_info = this.open_close_info(this)
      this.step_open_close = this.step_open_close(this)
      this.call_sidebar = this.call_sidebar(this)
      
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

    inventory_open_close: function() {
      $(document).ready(function () {
        let $ingredientList = $('.ingredients__list'),
            $inventoryItems = $ingredientList.find('.inventory-item');

        if ($inventoryItems.length > 2) {
          $inventoryItems.slice(2).hide();

          let $expandButton = $('<button class="expand-btn">Смотреть все</button>');
          $ingredientList.after($expandButton);

          $expandButton.on('click', function () {
            $inventoryItems.slice(2).slideToggle('slow');
            let buttonText = $expandButton.text() === 'Смотреть все' ? 'Спрятать' : 'Смотреть все';
            $expandButton.text(buttonText);
          });
        }
      });
    },

    open_close_info: function() {

      $('.info-board').each(function() {
        var $infoText = $(this).find('.info-board__text');
        var textHeight = $infoText.height();
    
        if (textHeight < 56) {
          $(this).find('.info-board__button').hide();
        }
      });
      
      $('.info-board__button').click(function() {
        var $textElement = $(this).siblings('.info-board__text');
        $textElement.toggleClass('info-board__text_active');
        $textElement.css('max-height', $textElement.hasClass('info-board__text_active') ? $textElement[0].scrollHeight + 'px' : '56px');
        $(this).toggleClass('info-board__button_active')
      });
    },

    step_open_close: function() {
      $('.step__count').on('click', function() {
        $(this).closest('.step').find('.step__content').slideToggle(50)
        $(this).closest('.step').toggleClass('step_hide')
      });
    },

    calculator_ingredients: function() {
        let minusButton = $('.portion-controls__button_minus'),
            plusButton = $('.portion-controls__button_plus'),
            portionInput = $('.portion-controls__input'),
            ingredientsCountElements = $('.sidebar__ingredients-count');

        function getPortionEnding(number) {
          let lastTwoDigits = number % 100,
              lastDigit = number % 10;
        
          if ((lastTwoDigits >= 11 && lastTwoDigits <= 14) || lastDigit === 0 || (lastDigit >= 5 && lastDigit <= 9)) {
            return 'порций';
          } else if (lastDigit === 1) {
            return 'порцию';
          } else if (lastDigit >= 2 && lastDigit <= 4) {
            return 'порции';
          }
        }
        
        function updatePortionLabel() {
          var currentPortion = parseInt(portionInput.val());
          var portionEnding = getPortionEnding(currentPortion);
          $('.portion-label').text(portionEnding);
        }
        
        portionInput.on('change', updatePortionLabel);
    
        minusButton.click(function() {
          var currentPortion = parseInt(portionInput.val());
          if (currentPortion > 1) {
            portionInput.val(currentPortion - 1);
            updateIngredientsCount();
          }
        });
    
        plusButton.click(function() {
          var currentPortion = parseInt(portionInput.val());
          portionInput.val(currentPortion + 1);
          updateIngredientsCount();
        });
    
        // Обновление количества ингредиентов
        function updateIngredientsCount() {
          var portion = parseInt(portionInput.val());
          var portionEnding = getPortionEnding(portion);
          $('.portion-label').text(portionEnding);

          ingredientsCountElements.each(function() {
            var ingredientCountForOnePortion = parseFloat($(this).data('ingredient'));
            var newIngredientCount = ingredientCountForOnePortion * portion;
        
            // Округляем до целого, если число близко к целому
            if (Math.abs(newIngredientCount - Math.round(newIngredientCount)) < 0.0001) {
                newIngredientCount = Math.round(newIngredientCount);
            } else {
                newIngredientCount = newIngredientCount.toFixed(1);
            }
        
            $(this).text(' ' + newIngredientCount);
        });
        

        
        }
    
        // Инициализация
        portionInput.val($('.ingredients__portions').text()); // Установка начального значения инпута
        updateIngredientsCount();
    },

    call_sidebar: function() {
      let $sidebar = $('.sidebar'),
          $openSidebarBtn = $('.call-sidebar');
    
      $openSidebarBtn.on('click', function(e) {
        e.stopPropagation();
        if (window.innerWidth <= 1200) {
          $sidebar.slideToggle();
          $openSidebarBtn.hide();
        }
      });
    
      $(document).on('click', function(event) {
        if (
          window.innerWidth <= 1200 &&
          !$(event.target).closest('.sidebar').length &&
          !$(event.target).is('.call-sidebar') &&
          !$(event.target).closest('.header').length
        ) {
          $sidebar.slideUp();
          $openSidebarBtn.show();
        }
      });
    
      $('.sidebar__close').on('click', function(event) {
        if (window.innerWidth <= 1200) {
          $sidebar.slideUp();
          $openSidebarBtn.show();
        }
      });
    
      let touchStartX = 0,
          minSwipeDistance = 50;
    
      $sidebar.on('touchstart', function(event) {
        touchStartX = event.originalEvent.touches[0].pageX;
      });
    
      $sidebar.on('touchend', function(event) {
        if (window.innerWidth <= 1200) {
          let touchEndX = event.originalEvent.changedTouches[0].pageX,
              swipeDistance = touchEndX - touchStartX;
    
          if (swipeDistance > minSwipeDistance) {
            $sidebar.slideUp();
            $openSidebarBtn.show();
          }
        }
      });

      $(window).on('resize', function() {
        if (window.innerWidth > 1200) {
          $sidebar.show();
          $openSidebarBtn.hide();
        }
        if (window.innerWidth < 1200) {
          $sidebar.hide();
          $openSidebarBtn.show();
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