<?php
if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}
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
$size_image_gallery_big = 'large';
$size_image_gallery_small = 'medium';
?>

<?php echo get_template_part('template-parts/layouts/modal-video'); ?>

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
                 class="gallery__plug-img"
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
                     class="slider-for__slide-image"
                     width="770"
                     height="500"/>
              </div>
            <?php } ?>
            <?php foreach( $gallery as $image_id ): ?>
              <div class="slider-for__slide">
                <?php echo wp_get_attachment_image( $image_id, $size_image_gallery_big, 
                  false, array( 'class' => 'slider-for__slide-image', 'alt' => get_the_title() ) ); ?>
              </div>
            <?php endforeach; ?>
          </div>
        <?php } ?>

        <?php if(!empty($gallery)) { ?>
          <div class="gallary__slider slider-nav">
            <?php if ($thumbnail_url) { ?>
              <div class="slider-nav__slide">
                <img src="<?php echo $thumbnail_url ?>" 
                     alt="<?php echo the_title(); ?>" 
                     width="204"
                     height="152"/>
              </div>
            <?php } ?>
            <?php foreach( $gallery as $image_id ): ?>
              <div class="slider-nav__slide">
                <?php echo wp_get_attachment_image( $image_id, $size_image_gallery_small, 
                  false, array( 'class' => 'slider-nav__slide-image', 'alt' => get_the_title() ) ); ?>
              </div>
            <?php endforeach; ?>
          </div>
          <button class="slider-nav__button slider-nav__button_prev">
            <img src="<?php echo WRC_THEME_URI . '/dist/img/icons/arrow-down-dark.svg'; ?>" 
                 alt="Галерея предыдущая" 
                 width="13" height="9">
          </button>
          <button class="slider-nav__button slider-nav__button_next">
            <img src="<?php echo WRC_THEME_URI . '/dist/img/icons/arrow-down-dark.svg'; ?>" 
                 alt="Галерея следующая" 
                 width="13" height="9">
          </button>
        <?php } ?>
      </section>

      <?php if($fields['add_video'] == true && !empty($fields['video'])) { ?>
        <button class="video-button" aria-label="Смотреть видео">
          <svg width="24" height="23" viewBox="0 0 24 23" fill="none">
            <path d="M0.595215 1.23844C0.595215 0.554989 1.15109 0 1.83564 0H21.8398C22.5243 0 23.0802 0.554989 23.0802 1.23844V21.2105C23.0799 21.5389 22.9491 21.8537 22.7165 22.0859C22.484 22.3181 22.1686 22.4487 21.8398 22.449H1.83564C1.50666 22.449 1.19115 22.3185 0.958526 22.0863C0.725902 21.854 0.595215 21.539 0.595215 21.2105V1.23844ZM3.09354 2.49433V19.9546H20.5819V2.49433H3.09354ZM10.1164 6.7534L16.211 10.8092C16.2796 10.8547 16.3358 10.9165 16.3746 10.9889C16.4135 11.0614 16.4339 11.1423 16.4339 11.2245C16.4339 11.3067 16.4135 11.3876 16.3746 11.4601C16.3358 11.5325 16.2796 11.5943 16.211 11.6398L10.1151 15.6956C10.0399 15.7453 9.95269 15.7738 9.86261 15.7781C9.77253 15.7823 9.68298 15.7622 9.60345 15.7197C9.52393 15.6773 9.45739 15.6141 9.4109 15.537C9.3644 15.4598 9.33969 15.3716 9.33937 15.2815V7.16746C9.33954 7.07723 9.36421 6.98873 9.41077 6.91139C9.45733 6.83406 9.52402 6.77077 9.60375 6.72829C9.68348 6.6858 9.77326 6.66569 9.86353 6.67012C9.9538 6.67454 10.0412 6.70332 10.1164 6.7534Z" fill="#DDB888"/>
          </svg>
          <span class="video-button__text extra-text">Смотреть видео</span>
        </button>
      <?php } ?>

      <section class="details">
        <?php if(!empty($fields['timing'])) { ?>
          <div class="details__timing">
            <img width="27" height="27" src="<?php echo WRC_THEME_URI . '/dist/img/icons/cooking-time.svg'; ?>" alt="" class="details__timing-icon">
            <div class="extra-text details__timing-time">Время приготовления: <?php echo $fields['timing']; ?></div>
          </div>
        <?php } ?>
        <div class="ingredients">
          <div class="extra-text ingredients__title">Ингредиенты и инвентарь</div>
          <div class="extra-text">на <span class="ingredients__portions"><?php echo $fields['portion'] ?></span> порции:</div>

          <?php if( have_rows('ingredients_list', $post_id) ) { ?>
            <ul class="ingredients__list">
              <?php while( have_rows('ingredients_list', $post_id) ) {
                the_row(); ?>
                <li class="body-text ingredients__item">
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
                  <div class="ingredients__item-count">&nbsp;<?php echo $ingredient_count; ?></div>
                  <div class="ingredients__item-unit">&nbsp;<?php echo esc_html($unit->post_title); ?></div>
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
          <div class="sidebar__subtitle extra-text">на 
            <div class="portion-controls">
              <button class="minus-portion-button">-</button>
              <input class="portion-input" type="number">
              <button class="plus-portion-button">+</button>
            </div>
             порции</div>
        </header>
        <?php if( have_rows('ingredients_list', $post_id) ) { ?>
          <ul class="sidebar__ingredients-list">
            <?php while( have_rows('ingredients_list', $post_id) ) {
              the_row(); ?>
              <li class="body-text sidebar__ingredients-item">
                <?php 
                $user_ingredient = get_sub_field('user_ingredient');
                $ingredient = get_sub_field('ingredient');
                $portion = $fields['portion'];
                
                $ingredient_count = get_sub_field('ingredient_count');

                $ingredient_count_for_one_portion = $ingredient_count / $portion;

                $unit = get_sub_field('unit');
                ?>
                <div class="sidebar__ingredients-name">
                  <?php if(get_sub_field('add_user_ingredient') == false) {
                    echo esc_html($ingredient->post_title); 
                  } else {
                    echo $user_ingredient;
                  }
                  ?>
                </div>
                <div class="sidebar__ingredients-count">&nbsp;<?php echo $ingredient_count; ?></div>
                <div class="sidebar__ingredients-unit">&nbsp;<?php echo esc_html($unit->post_title); ?></div>
              </li>
            <?php } ?>
          </ul> 
        <?php } ?>
      </div>
    </aside>
  </div>
</main>

<script>
  $(document).ready(function() {

    let portion = parseFloat($('.ingredients__portions').text())
    $('.portion-input').val(portion)
    let newPortion = portion;

    $('.minus-portion-button').on('click', function() {
      newPortion = newPortion - 1
      $('.portion-input').val(newPortion)
      renderIngredients()
      console.log(newPortion);
    })

    $('.plus-portion-button').on('click', function() {
      newPortion = newPortion + 1
      $('.portion-input').val(newPortion)
      renderIngredients()
      console.log(newPortion);
    })

    function renderIngredients() {
      $('.sidebar__ingredients-item').each(function() {
        const count = $(this).find('.sidebar__ingredients-count');
        const countValue = parseInt(count.text().trim());
        const countForOnePortion = countValue / portion;
        count.text(countForOnePortion * newPortion)
      })
    }

  });
</script>

<?php get_footer();
