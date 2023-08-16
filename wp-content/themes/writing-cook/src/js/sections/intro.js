jQuery(function ($) {

  'use strict';

  /******************************************************************
   * IntroSection
   * @type {{init: IntroSection.init, install: IntroSection.install}}
   * @since 1.0
   * @author Serge Bayraktar
   * @date 13.03.2023
   */
  const IntroSection = {

    /**
     * Init
     */
    init: function () {

      this.install = this.install(this)
      this.search_recipes = this.search_recipes(this)
      this.filter_recipes_by_category = this.filter_recipes_by_category(this)

    },

    /**
     * Install
     */
    install: function () {},

    /**
     * Search recipes
     */
    search_recipes: function() {

      $('.search-form-recipes').submit(function(event) {
        event.preventDefault();

        let formData = $(this).serialize();

        $.ajax({
          type: 'POST',
          url: ajax_object.ajax_url,
          data: formData + '&action=recipe_search',
          success: function(response) {
            $('.searching').html(response);
          }
        });
      });

    },

    /**
     * Filter recipes by category
     */
    filter_recipes_by_category: function() {

      let paged = 1;
    
      $('#recipes-filtration .category-checkbox').change(function() {
        paged = 1;
        loadRecipes();
    
        if ($(this).is(':checked')) {
          $(this).closest('.category-filter__label').addClass('category-filter__label_checked');
        } else {
          $(this).closest('.category-filter__label').removeClass('category-filter__label_checked');
        }
      });
    
      function loadRecipes(page) {
        let categoryValues = [],
            loader = $('#recipes-filtration .loader');
    
        if (!loader.length) { 
          loader = $('<div class="loader"></div>');
          $('#recipes-filtration .filtration__list').append(loader);
        }
    
        $('#recipes-filtration .category-checkbox:checked').each(function() {
          categoryValues.push($(this).val());
        });
    
        $.ajax({
          type: 'POST',
          url: ajax_object.ajax_url,
          data: {
            action: 'load_recipes_by_category',
            category_filter_values: categoryValues,
            paged: page,
          },
          success: function(response) {
            loader.remove();
            $('#recipes-filtration .filtration__list').html(response);
          }
        });
    
        $(document).on('click', '#recipes-filtration .pagination a', function(e) {
          e.preventDefault();
          let page = $(this).attr('href').split('paged=')[1];
          loadRecipes(page);
        });
      }
    
      loadRecipes();
    
    }
    

  }

  /**
   * Init for section Intro
   */
  $(document).ready(function() {
    IntroSection.init()
  });

});