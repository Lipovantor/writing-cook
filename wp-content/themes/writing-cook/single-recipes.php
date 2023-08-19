<?php
/*
Template Name: Single Recipe
*/

add_action('wp_enqueue_scripts', function () {
  wp_enqueue_script('slick-js', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', 'jquery');
  wp_enqueue_script('single-recipes', WRC_THEME_URI . '/dist/js/pages/single-recipes.min.js', 'jquery');
  
  wp_enqueue_style('slick-css', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
  wp_enqueue_style('single-recipes', WRC_THEME_URI . '/dist/css/single-recipes.min.css');
},200);

get_header();

$post_id = get_the_ID();
$fields = get_fields($post_id);

$thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
$plug_image = get_field('card_plug', 'option');

$gallery = $fields['gallery'];
$size_image_gallery = 'medium';
?>

<main class="recipe">
  <section class="intro">
    <div class="intro__container container">
      <h1 class="intro__title">
        <?php echo the_title(); ?>
      </h1>
      <div class="body-text intro__text">
        <?php echo strip_tags(get_the_excerpt()); ?>
      </div>
    </div>
  </section>

  <div class="container recipe__container">
    <article class="content">
      <section class="gallery">
        <?php if ($thumbnail_url && empty($gallery)) { ?>
          <div class="gallery__thumb">
            <img src="<?php echo $thumbnail_url ?>"
                 class="gallery__thumb-img"
                 alt="<?php echo the_title(); ?>" 
                 width="770"
                 height="500"/>
          </div>
        <?php } elseif(!$thumbnail_url && empty($gallery)) { ?>
          <div class="gallery__plug">
            <img src="<?php echo esc_url($plug_image['url']); ?>" 
                 alt="<?php echo esc_attr($plug_image['alt']); ?>" 
                 width="770"
                 height="500"/>
          </div>
        <?php } elseif(!empty($gallery)) { ?>
          <div class="gallery__slider slider-for">
            <?php if ($thumbnail_url) { ?>
              <div class="slider-for__slide">
                <img src="<?php echo $thumbnail_url ?>" 
                     alt="<?php echo the_title(); ?>" 
                     width="770"
                     height="500"/>
              </div>
            <?php } ?>
            <?php foreach( $gallery as $image_id ): ?>
              <div class="slider-for__slide">
                <?php echo wp_get_attachment_image( $image_id, $size_image_gallery, false, array( 'class' => 'custom-image-class', 'alt' => get_the_title() ) ); ?>
              </div>
            <?php endforeach; ?>
          </div>
        <?php } ?>

        <?php if(!empty($gallery)) { ?>
          <div class="gallary__slider slider-nav">
            <?php if ($thumbnail_url) { ?>
              <div class="slider-nav__slide">
                <img src="<?php echo $thumbnail_url ?>" 
                     alt="" 
                     width="204"
                     height="152"/>
              </div>
            <?php } ?>
            <?php foreach( $gallery as $image_id ): ?>
              <div class="slider-nav__slide">
                <?php echo wp_get_attachment_image( $image_id, $size_image_gallery, false, array( 'class' => 'custom-image-class', 'alt' => get_the_title() ) ); ?>
              </div>
            <?php endforeach; ?>
          </div>
        <?php } ?>

      </section>
      <section class="details">
        <?php if(!empty($fields['timing'])) { ?>
          <div class="details__timing">
            <img width="27" height="27" src="<?php echo WRC_THEME_URI . '/dist/img/icons/cooking-time.svg'; ?>" alt="" class="details__timing-icon">
            <div class="extra-text details__timing-time">Время приготовления: <?php echo $fields['timing']; ?></div>
          </div>
        <?php } ?>
        <div class="ingredients">
          <div class="extra-text ingredients__title">Ингредиенты и инвентарь</div>
          <div class="extra-text">на <?php echo $fields['portion'] ?> порции:</div>

          <?php if( have_rows('ingredients_list', $post_id) ) { ?>
            <ul class="ingredients__list">
              <?php while( have_rows('ingredients_list', $post_id) ) {
                the_row(); ?>
                <li class="body-text ingredients__item">
                  <?php 
                  $ingredient_name = get_sub_field('ingredient_name');
                  $ingredient_count = get_sub_field('ingredient_count');
                  $ingredient_unit = get_sub_field('ingredient_unit');
                  ?>
                  <div><?php echo $ingredient_name; ?></div>
                  <div><?php echo $ingredient_count; ?></div>
                  <div><?php echo $ingredient_unit; ?></div>
                </li>
              <?php } ?>
                <?php if( have_rows('inventory_list', $post_id) ) { 
                  while( have_rows('inventory_list', $post_id) ) { 
                  the_row();?>
                  <li class="body-text ingredients__item">
                    <?php 
                    $inventory_name = get_sub_field('inventory_name');
                    echo $inventory_name 
                    ?>
                  </li>
                <?php
                }
              } 
              ?>
            </ul> 
          <?php } ?>


        </div>
      </section>
    </article>
    <aside class="sidebar">
      <div class="sidebar__ingredients">
        <header class="sidebar__header">
          <div class="sidebar__title extra-text">Ингредиенты</div>
          <div class="sidebar__subtitle extra-text">на <?php echo $fields['portion'] ?> порции</div>
        </header>
        <div class="sidebar__list">
          <?php if( have_rows('ingredients_list', $post_id) ) { ?>
              <ul class="ingredients__list">
              <?php while( have_rows('ingredients_list', $post_id) ) {
                the_row(); ?>
                <li class="body-text ingredients__item">
                  <?php 
                  $ingredient_name = get_sub_field('ingredient_name');
                  ?>
                  <div><?php echo $ingredient_name; ?></div>
                </li>
              <?php 
              } 
            } ?>
        </div>
      </div>
    </aside>
  </div>
</main>

<?php get_footer();
