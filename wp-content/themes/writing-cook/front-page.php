<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
/*
Template Name: Front Page
*/
/**
 * Front Page Template
 *
 * @package WordPress
 * @subpackage Custom Theme by Bayraktar Sergey
 * @since V0.1
 *
 */

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('slick-js', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', 'jquery');
    
    wp_enqueue_script('front-page', WRC_THEME_URI . '/dist/js/pages/front-page.min.js', 'jquery');
    
    wp_enqueue_style('slick-css', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');

    wp_enqueue_style('front-page', WRC_THEME_URI . '/dist/css/front-page.min.css');
},200);

get_header();
?>

<main class="home">
  <?php
  if (have_rows('page_layout')):
      while (have_rows('page_layout')):
          the_row();
          get_template_part('template-parts/page_layout');
      endwhile;
  endif;
  ?>
</main>

<?php

get_footer();