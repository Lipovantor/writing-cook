<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
/*
Template Name: FAQ Page
*/
add_action('wp_enqueue_scripts', function () {
  wp_enqueue_style('faq-page', WRC_THEME_URI . '/dist/css/faq-page.min.css');
},200);

get_header();
?>

<main class="faq">
  <section class="faq-intro">
    <div class="container">
      <h1 class="faq-intro__title">
        <?php the_title(); ?>
      </h1>
    </div>
  </section>

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