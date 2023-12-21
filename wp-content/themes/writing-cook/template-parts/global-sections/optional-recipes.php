<?php
if (!defined('ABSPATH')) {
    exit;
}

$title = get_sub_field('title');
$text = get_sub_field('text');

$recipe = get_sub_field('recipe');
$recipe2 = get_sub_field('recipe_2');
?>

<section class="optional-recipes">
  <div class="container">
    <div class="optional-recipes__header">
      <?php if (!empty($title)) { ?>
        <h2 class="optional-recipes__title">
          <?php echo $title; ?>
        </h2>
      <?php } ?>
      <?php if (!empty($text)) { ?>
        <p class="optional-recipes__text extra-text">
          <?php echo $text; ?>
        </p>
      <?php } ?>
    </div>
  </div>
  <div class="optional-recipes__slider optional-recipes__slider_standart">
    <?php
    if ($recipe) {
      foreach ($recipe as $post) {
        setup_postdata($post);

        $recipe_permalink = get_permalink();
        $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
        $gallery = get_field('gallery'); 
        $excerpt = get_the_excerpt();
        ?>
        <a href="<?php echo esc_url($recipe_permalink); ?>" class="optional-recipe" title="<?php the_title(); ?>">
          
          <?php if ($thumbnail_url || !empty($gallery)) { ?>
            <div class="optional-recipe__image">
              <?php
              if ($thumbnail_url) {
                ?>
                <img src="<?php echo $thumbnail_url; ?>" 
                    alt="<?php echo get_the_title(); ?>" 
                    width="360"
                    height="250"/>
                <?php
              } elseif (!empty($gallery[0])) {
                $image_url = wp_get_attachment_image_url($gallery[0], 'large');
                if ($image_url) {
                  ?>
                  <img src="<?php echo $image_url; ?>" 
                      alt="<?php echo get_the_title(); ?>" 
                      width="360"
                      height="250"/>
                  <?php
                }
              }
              ?>
            </div>
          <?php } else {
            $plug_image = get_field('card_plug', 'option');
            if (!empty($plug_image)) {
              ?>
              <div class="optional-recipe__image">
                <img src="<?php echo esc_url($plug_image['url']); ?>" 
                    alt="<?php echo esc_attr($plug_image['alt']); ?>" 
                    width="360"
                    height="250"/>
              </div>
              <?php
            }
          } ?>

          <h2 class="optional-recipe__title"><?php the_title(); ?></h2>

          <?php if ($excerpt) { ?>
            <div class="optional-recipe__excerpt">
              <?php echo $excerpt; ?>
            </div>
          <?php } ?>
          
        </a>

        <?php
      }
      wp_reset_postdata();
    }
    ?>
  </div>
  <div class="optional-recipes__slider optional-recipes__slider_rtl" dir="rtl">
    <?php
    if ($recipe2) {
      foreach ($recipe2 as $post) {
        setup_postdata($post);

        $recipe_permalink = get_permalink();
        $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
        $gallery = get_field('gallery'); 
        $excerpt = get_the_excerpt();
        ?>
        <a href="<?php echo esc_url($recipe_permalink); ?>" class="optional-recipe" title="<?php the_title(); ?>" dir="ltr">
          
          <?php if ($thumbnail_url || !empty($gallery)) { ?>
            <div class="optional-recipe__image">
              <?php
              if ($thumbnail_url) {
                ?>
                <img src="<?php echo $thumbnail_url; ?>" 
                    alt="<?php echo get_the_title(); ?>" 
                    width="360"
                    height="250"/>
                <?php
              } elseif (!empty($gallery[0])) {
                $image_url = wp_get_attachment_image_url($gallery[0], 'large');
                if ($image_url) {
                  ?>
                  <img src="<?php echo $image_url; ?>" 
                      alt="<?php echo get_the_title(); ?>" 
                      width="360"
                      height="250"/>
                  <?php
                }
              }
              ?>
            </div>
          <?php } else {
            $plug_image = get_field('card_plug', 'option');
            if (!empty($plug_image)) {
              ?>
              <div class="optional-recipe__image">
                <img src="<?php echo esc_url($plug_image['url']); ?>" 
                    alt="<?php echo esc_attr($plug_image['alt']); ?>" 
                    width="360"
                    height="250"/>
              </div>
              <?php
            }
          } ?>

          <h2 class="optional-recipe__title"><?php the_title(); ?></h2>

          <?php if ($excerpt) { ?>
            <div class="optional-recipe__excerpt">
              <?php echo $excerpt; ?>
            </div>
          <?php } ?>
          
        </a>

        <?php
      }
      wp_reset_postdata();
    }
    ?>
  </div>
</section>