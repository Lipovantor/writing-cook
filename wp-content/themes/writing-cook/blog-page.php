<?php
if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}
/*
Template Name: Blog page
*/
add_action('wp_enqueue_scripts', function () {
  
  // wp_enqueue_script('blog-page', WRC_THEME_URI . '/dist/js/pages/blog-page.min.js', 'jquery');

  wp_enqueue_style('blog-page', WRC_THEME_URI . '/dist/css/blog-page.min.css');
},200);

get_header();
?>

<main class="blog-page">
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