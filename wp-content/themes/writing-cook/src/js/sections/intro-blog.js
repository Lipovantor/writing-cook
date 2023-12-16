jQuery(function ($) {

  'use strict';

  /******************************************************************
   * IntroBlogSection
   * @type {{init: IntroBlogSection.init, install: IntroBlogSection.install}}
   * @since 1.0
   * @author Serge Bayraktar
   * @date 16.12.2023
   */
  const IntroBlogSection = {

    /**
     * Init
     */
    init: function () {

      this.install = this.install(this)
      this.search_posts = this.search_posts(this)
      this.filter_posts_by_category = this.filter_posts_by_category(this)

    },

    /**
     * Install
     */
    install: function () {
    },

    /**
     * Search posts
     */
    search_posts: function() {

      $('.search-form-posts').submit(function(event) {
        event.preventDefault();

        let formData = $(this).serialize();

        $.ajax({
          type: 'POST',
          url: ajax_object.ajax_url,
          data: formData + '&action=post_search',
          success: function(response) {
            $('.searching').html(response);
          }
        });
      });

    },

    /**
     * Filter posts by category
     */
    filter_posts_by_category: function() {

      let paged = 1;
    
      $('#posts-filtration .category-checkbox').change(function() {
        paged = 1;
        loadPosts();
    
        if ($(this).is(':checked')) {
          $(this).closest('.category-filter__label').addClass('category-filter__label_checked');
        } else {
          $(this).closest('.category-filter__label').removeClass('category-filter__label_checked');
        }
      });
    
      function loadPosts(page) {
        
        let categoryValues = [],
            loader = $('#posts-filtration .loader');
    
        if (!loader.length) { 
          loader = $('<div class="loader"></div>');
          $('#posts-filtration .filtration__list').append(loader);
        }
    
        $('#posts-filtration .category-checkbox:checked').each(function() {
          categoryValues.push($(this).val());
        });

        console.log(categoryValues);
    
        $.ajax({
          type: 'POST',
          url: ajax_object.ajax_url,
          data: {
            action: 'load_posts_by_category',
            category_filter_values: categoryValues,
            paged: page,
          },
          success: function(response) {
            loader.remove();
            $('#posts-filtration .filtration__list').html(response);
          }
        });
    
        $(document).on('click', '#posts-filtration .pagination a', function(e) {
          e.preventDefault();
          let page = $(this).attr('href').split('paged=')[1];
          loadPosts(page);
        });
      }
    
      loadPosts();
    
    }
    

  }

  /**
   * Init for section Intro-Blog
   */
  $(document).ready(function() {
    IntroBlogSection.init()
  });

});