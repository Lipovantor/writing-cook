<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
/*
Template Name: Policy Page
*/
add_action('wp_enqueue_scripts', function () {
  wp_enqueue_style('policy-page', WRC_THEME_URI . '/dist/css/policy-page.min.css');
},200);

get_header();
?>

<main class="policy">
  <section class="policy__intro">
    <div class="container">
      <h1 class="policy__title">
        <?php the_title(); ?>
      </h1>
    </div>
  </section>
  <section class="policy__content">
    <div class="container">
      <?php the_content(); ?>
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