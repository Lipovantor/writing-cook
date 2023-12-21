<?php
if (!defined('ABSPATH')) {
    exit;
}

$title = get_sub_field('title');
$text = get_sub_field('text');
?>

<section class="new-recipes">
  <div class="container">
    <div class="new-recipes__header">
      <?php if (!empty($title)) { ?>
        <h2 class="new-recipes__title">
          <?php echo $title; ?>
        </h2>
      <?php } ?>
      <?php if (!empty($text)) { ?>
        <p class="new-recipes__text extra-text">
          <?php echo $text; ?>
        </p>
      <?php } ?>
    </div>
    <div class="new-recipes__list">
      <?php
      $args = array(
        'post_type' => 'recipes',
        'posts_per_page' => 4,
        'post_status' => 'publish',
      );

      $posts_query = new WP_Query($args);

      if ($posts_query->have_posts()) :
        while ($posts_query->have_posts()) :
          $posts_query->the_post();

          get_template_part('template-parts/layouts/recipe-card');

        endwhile;
        wp_reset_postdata();
      else :
        echo 'Нет новых постов';
      endif;
      ?>
    </div>
  </div>
</section>