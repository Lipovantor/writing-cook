jQuery(function ($) {

  'use strict';

  /******************************************************************
   * Single Post
   * @type {{init: SinglePost.init, install: SinglePost.install}}
   * @since 1.0
   * @author Serge Bayraktar
   * @date 16.12.2023
   */
  const SinglePost = {

    /**
     * Init
     */
    init: function () {

      this.install = this.install(this)
      this.create_anchor_on_list = this.create_anchor_on_list(this)
      this.smooth_scrolling_to_anchor = this.smooth_scrolling_to_anchor(this)
      this.call_sidebar = this.call_sidebar(this)
      
    },

    /**
     * Install
     */
    install: function () {},

    create_anchor_on_list: function() {
      $(document).ready(function () {
          $('.post-page-content__body').find('h1, h2, h3, h4, h5, h6').each(function (index) {
              let id = 'section-' + index;
              $(this).attr('id', id);
              let headingLevel = $(this).prop('tagName').toLowerCase();
              $('.sidebar__list').append('<li class="sidebar-item sidebar-item-' + headingLevel + '"><a href="#' + id + '">' + $(this).text() + '</a></li>');
          });
  
          $('.sidebar__list a').on('click', function(event) {
              event.preventDefault();
  
              let targetId = $(this).attr('href'),
                  targetOffset = $(targetId).offset().top - 100;
  
              $('html, body').animate({
                  scrollTop: targetOffset
              }, 800);
          });
      });
  },
  

    /**
     * Smooth scrolling to anchor
     */
    smooth_scrolling_to_anchor: function() {
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
          e.preventDefault();
  
          document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
          });
        });
      });
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
    SinglePost.init()
  });

});