<?php
if (!defined('ABSPATH')) {
    exit;
}

$thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
$title = get_the_title();
$excerpt = get_the_excerpt();

$post_id = get_the_ID();
$fields = get_fields($post_id);
?>
<a class="post-card" href="<?php echo get_permalink() ?>">
  
  <?php if ($thumbnail_url) { ?>
    <div class="post-card__image">
      <img src="<?php echo $thumbnail_url ?>" 
        alt="" 
        width="450"
        height="300"/>
    </div>
  <?php } else if ($fields['main_image']) { ?>
    <div class="post-card__image">
      <img src="<?php echo $fields['main_image']['url']; ?>" 
        alt="" 
        width="450"
        height="300"/>
    </div>
  <?php } else { ?>
    <div class="post-card__plug">
      <?php 
      $image = get_field('card_plug_post', 'option');
      if( !empty( $image ) ) { ?>
          <img src="<?php echo esc_url($image['url']); ?>" 
               alt="<?php echo esc_attr($image['alt']); ?>" 
               width="450"
               height="300"/>
      <?php } ?>
    </div>
  <?php } ?>
  <div class="post-card__box">
    <div class="post-card__content post-card__content_main">
      <div class="post-card__header">
        <div class="post-card__inner post-card__inner_title">
          <h3 class="post-card__title">
            <?php echo $title ?>
          </h3>
        </div>
        <div class="post-card__inner post-card__inner_excerpt">
          <p class="post-card__excerpt">
            <?php echo $excerpt ?>
          </p>
        </div>
      </div>
      <div class="post-card__date"><?php the_time('d.m.Y'); ?></div>
    </div>
  </div>
</a>