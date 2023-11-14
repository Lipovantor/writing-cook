<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<section class="promo">
  <div class="container promo__container">

    <div class="promo__col">
      <?php if (!empty(get_sub_field('title'))) { ?>
        <h2 class="promo__title">
          <?php echo get_sub_field('title'); ?>
        </h2>
      <?php } ?>
      <?php if (!empty(get_sub_field('text'))) { ?>
        <div class="promo__text extra-text">
          <?php echo get_sub_field('text'); ?>
        </div>
      <?php } ?>
      <?php 
      $link = get_sub_field('button');
      if( $link ) {
          $link_url = $link['url'];
          $link_title = $link['title'];
          $link_target = $link['target'] ? $link['target'] : '_self';
          ?>
          <a class="promo__button" 
             href="<?php echo esc_url( $link_url ); ?>" 
             target="<?php echo esc_attr( $link_target ); ?>">
              <?php echo esc_html( $link_title ); ?>
          </a>
      <?php } ?>
    </div>

    <div class="promo__col">
      <?php $image = get_sub_field('image');
        if( !empty( $image ) ) { ?>
          <img class="promo__image" 
               src="<?php echo esc_url($image['url']); ?>" 
               alt="<?php echo esc_attr($image['alt']); ?>" 
               width="800" height="400"/>
      <?php } ?>
    </div>

  </div>
</section>

