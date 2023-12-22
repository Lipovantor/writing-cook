<?php
if (!defined('ABSPATH')) {
    exit;
}

$thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
$title = get_the_title();
$excerpt = get_the_excerpt();

$post_id = get_the_ID();
$fields = get_fields($post_id);

$gallery = $fields['gallery'];
?>

<a class="recipe-card" href="<?php echo get_permalink() ?>">
  
  <?php if ($thumbnail_url) { ?>
    <div class="recipe-card__image">
      <img src="<?php echo $thumbnail_url ?>" 
        alt="" 
        width="360"
        height="250"/>
    </div>
    <?php } elseif(!$thumbnail_url && !empty($gallery[0])) { ?>
      <div class="recipe-card__image">
        <?php $image_url = wp_get_attachment_image_url($gallery[0], 'large');
          if ($image_url) { ?>
          <img src="<?php echo $image_url; ?>" 
              alt="" 
              width="360"
              height="250"/>
        <?php } ?>
      </div>
    <?php } else { ?>
    <div class="recipe-card__plug">
      <?php $image = get_field('card_plug', 'option');
      if( !empty( $image ) ) { ?>
          <img src="<?php echo esc_url($image['url']); ?>" 
                alt="<?php echo esc_attr($image['alt']); ?>" 
                width="360"
                height="250"/>
      <?php } ?>
    </div>
  <?php } ?>
  <div class="recipe-card__box">
    <div class="recipe-card__content recipe-card__content_main">
      <div class="recipe-card__header">
        <div class="recipe-card__inner recipe-card__inner_title">
          <h3 class="recipe-card__title">
            <?php echo $title ?>
          </h3>
        </div>
        <div class="recipe-card__inner recipe-card__inner_excerpt">
          <p class="recipe-card__excerpt">
            <?php echo $excerpt ?>
          </p>
        </div>
      </div>
    </div>
    
    <button class="recipe-card__button" aria-label="Развернуть-свернуть карточку рецепта">
      <img src="<?php echo WRC_THEME_URI . '/dist/img/icons/arrow-down.svg'; ?>" alt="" width="13" height="9">
    </button>
    <div class="recipe-card__content recipe-card__content_second">
      <div class="recipe-card__ingredients">
        <?php if($fields['timing']) { ?>
          <div class="recipe-card__ingredients-timing-time">Время приготовления: <?php echo $fields['timing']; ?></div>
        <?php } ?>
        <p class="recipe-card__ingredients-title">Ингредиенты:</p>
        <?php if( have_rows('ingredients_list', $post_id) ) { ?>
          <ul class="recipe-card__ingredients-list">
            <?php while( have_rows('ingredients_list', $post_id) ) {
              the_row(); ?>
              <li class="recipe-card__ingredients-item">
                <?php 
                $user_ingredient = get_sub_field('user_ingredient');
                $ingredient = get_sub_field('ingredient');
                $ingredient_count = get_sub_field('ingredient_count');
                $unit = get_sub_field('unit');
                ?>
                <div class="ingredients__item-name">
                  <?php if(get_sub_field('add_user_ingredient') == false) {
                    echo esc_html($ingredient->post_title); 
                  } else {
                    echo $user_ingredient;
                  }
                  ?>
                </div>
              </li>
            <?php } ?>
          </ul> 
        <?php } ?>
      </div>
      <div class="recipe-card__meta">
        <div class="recipe-card__author">
          <?php 
          $author_id = get_the_author_meta('ID');
          $author_avatar = get_avatar($author_id, 40);
          ?>
          <div class="recipe-card__author-avatar">
            <?php echo $author_avatar; ?>
          </div>
          <div class="recipe-card__author-name">
            <?php echo get_the_author(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</a>