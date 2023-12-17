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

// Gallery
$gallery = $fields['gallery'];

$size_image_gallery_big = 'large';
$size_image_gallery_small = 'medium';

// Author
$author_id = get_post_field('post_author', get_the_ID());
$author_name = get_the_author_meta('display_name', $author_id);
$author_description = get_the_author_meta('description', $author_id);
$author_avatar = get_avatar($author_id, 40);
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
          <div class="extra-text">на 
            <span class="ingredients__portions"><?php echo $fields['portion'] ?></span>&nbsp;
            <span class="portion-label">порции</span>:
          </div>
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
                  <?php if(get_sub_field('taste')) { ?>
                    <div class="ingredients__item-taste">&nbsp;по вкусу</div>
                  <?php } else { ?>
                    <div class="ingredients__item-count">&nbsp;<?php echo $ingredient_count; ?></div>
                    <div class="ingredients__item-unit">&nbsp;<?php echo esc_html($unit->post_title); ?></div>
                  <?php } ?>
                </li>
              <?php } ?>
                <?php if( have_rows('inventory_list', $post_id) ) { 
                  while( have_rows('inventory_list', $post_id) ) { 
                  the_row();?>
                  <li class="body-text ingredients__item inventory-item">
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

        <?php if($fields['add_info'] == true && !empty($fields['info_text'])) { ?>       
          <div class="info-board info-board_<?php echo $fields['info_type'] ?>">
            <header class="info-board__header">
              <?php if($fields['info_type'] == 'info') { ?>
                <img 
                width="56" height="56" 
                src="<?php echo WRC_THEME_URI . '/dist/img/icons/icon-info.svg'; ?>" 
                alt="Info" 
                class="details__timing-icon">
              <?php } elseif($fields['info_type'] == 'warning') { ?>
                <img 
                width="56" height="56" 
                src="<?php echo WRC_THEME_URI . '/dist/img/icons/icon-warning.svg'; ?>" 
                alt="Warning" 
                class="details__timing-icon">
              <?php } elseif($fields['info_type'] == 'idea') { ?>
                <img 
                width="56" height="56" 
                src="<?php echo WRC_THEME_URI . '/dist/img/icons/icon-idea.svg'; ?>" 
                alt="Idea" 
                class="details__timing-icon">
              <?php } ?>       
              <p class="extra-text"><?= !empty($fields['info_title']) ? $fields['info_title'] : ''; ?></p>
            </header>
            <div class="info-board__text"><?= !empty($fields['info_text']) ? $fields['info_text'] : ''; ?></div>
            <button class="info-board__button" aria-label="Развернуть-свернуть информационную панель" title="Раскрыть">
              <img src="<?php echo WRC_THEME_URI . '/dist/img/icons/arrow-down.svg'; ?>" alt="" width="13" height="9">
            </button>
          </div>
        <?php } ?>
      </section>

      <?php if($fields['add_steps_recipe'] == true) { ?>
        <?php if(!empty($fields['steps_recipe_title']) || have_rows('steps_recipe_list', $post_id)) { ?>
          <section class="steps-recipe">
            <?php if(!empty($fields['steps_recipe_title'])) { ?>
              <h2 class="steps-recipe__title">
                <?php echo $fields['steps_recipe_title'] ?>
              </h2>
            <?php } ?>
            <?php
            $count = 1; 
            if( have_rows('steps_recipe_list', $post_id) ) { ?>
              <div class="steps-recipe__list">
                <?php 
                while( have_rows('steps_recipe_list', $post_id) ) { 
                  the_row(); ?>
                  <div class="step">
                    <div class="step__count extra-text">
                      Шаг&nbsp;<?php echo $count; ?>
                    </div>
                    <div class="step__content">
                      <?php if(!empty(get_sub_field('text'))) { ?>
                        <div class="step__text">
                          <?php echo get_sub_field('text'); ?>
                        </div>
                      <?php } ?>
                      <?php if(!empty(get_sub_field('image'))) { ?>
                        <div class="step__image">
                          <img src="<?php echo get_sub_field('image') ?>" 
                              alt="<?php echo the_title(); ?> - Шаг<?php echo $count; ?>" 
                              width="334"
                              height="227"/>
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                <? 
                $count++;
                } ?>
              </div>
            <?php } ?>

            <?php if($fields['steps_add_info'] == true && !empty($fields['steps_info_text'])) { ?>       
              <div class="info-board info-board_<?php echo $fields['steps_info_type'] ?>">
                <header class="info-board__header">
                  <?php if($fields['steps_info_type'] == 'info') { ?>
                    <img 
                    width="56" height="56" 
                    src="<?php echo WRC_THEME_URI . '/dist/img/icons/icon-info.svg'; ?>" 
                    alt="Info" 
                    class="details__timing-icon">
                  <?php } elseif($fields['steps_info_type'] == 'warning') { ?>
                    <img 
                    width="56" height="56" 
                    src="<?php echo WRC_THEME_URI . '/dist/img/icons/icon-warning.svg'; ?>" 
                    alt="Warning" 
                    class="details__timing-icon">
                  <?php } elseif($fields['steps_info_type'] == 'idea') { ?>
                    <img 
                    width="56" height="56" 
                    src="<?php echo WRC_THEME_URI . '/dist/img/icons/icon-idea.svg'; ?>" 
                    alt="Idea" 
                    class="details__timing-icon">
                  <?php } ?>       
                  <p class="extra-text"><?= !empty($fields['steps_info_title']) ? $fields['steps_info_title'] : ''; ?></p>
                </header>
                <div class="info-board__text"><?= !empty($fields['steps_info_text']) ? $fields['steps_info_text'] : ''; ?></div>
                <button class="info-board__button" aria-label="Развернуть-свернуть информационную панель" title="Раскрыть">
                  <img src="<?php echo WRC_THEME_URI . '/dist/img/icons/arrow-down.svg'; ?>" alt="Вниз" width="13" height="9">
                </button>
              </div>
            <?php } ?>
          </section>
        <?php } ?>
      <?php } ?>

      <?php if(!empty($fields['simple_recipe'])) { ?>
        <section class="simple-recipe">
          <?php if(!empty($fields['simple_recipe_title'])) { ?>
            <h2 class="simple-recipe__title">
              <?php echo $fields['simple_recipe_title'] ?>
            </h2>
          <?php } ?>
          <div class="simple-recipe__content">
            <?php echo $fields['simple_recipe'] ?>
          </div>
          <?php if($fields['simple_add_info'] == true && !empty($fields['simple_info_text'])) { ?>       
            <div class="info-board info-board_<?php echo $fields['simple_info_type'] ?>">
              <header class="info-board__header">
                <?php if($fields['simple_info_type'] == 'info') { ?>
                  <img 
                  width="56" height="56" 
                  src="<?php echo WRC_THEME_URI . '/dist/img/icons/icon-info.svg'; ?>" 
                  alt="Info" 
                  class="details__timing-icon">
                <?php } elseif($fields['simple_info_type'] == 'warning') { ?>
                  <img 
                  width="56" height="56" 
                  src="<?php echo WRC_THEME_URI . '/dist/img/icons/icon-warning.svg'; ?>" 
                  alt="Warning" 
                  class="details__timing-icon">
                <?php } elseif($fields['simple_info_type'] == 'idea') { ?>
                  <img 
                  width="56" height="56" 
                  src="<?php echo WRC_THEME_URI . '/dist/img/icons/icon-idea.svg'; ?>" 
                  alt="Idea" 
                  class="details__timing-icon">
                <?php } ?>       
                <p class="extra-text"><?= !empty($fields['simple_info_title']) ? $fields['simple_info_title'] : ''; ?></p>
              </header>
              <div class="info-board__text"><?= !empty($fields['simple_info_text']) ? $fields['simple_info_text'] : ''; ?></div>
              <button class="info-board__button" aria-label="Развернуть-свернуть информационную панель" title="Раскрыть">
                <img src="<?php echo WRC_THEME_URI . '/dist/img/icons/arrow-down.svg'; ?>" alt="Вниз" width="13" height="9">
              </button>
            </div>
          <?php } ?>
        </section>
      <?php } ?>

      <?php if(!empty(get_field('related_recipes'))) { ?>
        <section class="related-recipes">
          <h2>Связанные рецепты</h2>
          <?php if(!empty(get_field('text_above_related_recipes'))) { ?>
            <p class="related-recipes__text">
              <?php echo get_field('text_above_related_recipes'); ?>
            </p>
          <?php } ?>
          <?php
          $related_recipes = get_field('related_recipes');

          if ($related_recipes) {
            foreach ($related_recipes as $post) {
              setup_postdata($post);
              ?>
              <a href="<?php echo esc_url(get_permalink()); ?>" 
                title="<?php the_title(); ?>"
                class="related-recipes-link">
                <?php if (has_post_thumbnail()) : ?>
                  <div class="related-recipes-link__thumbnail">
                    <?php the_post_thumbnail('thumbnail'); ?>
                  </div>
                <?php endif; ?>
                <div class="related-recipes-link__content">
                  <h2 class="related-recipes-link__title">
                    <?php the_title(); ?>
                  </h2>
                  <div class="related-recipes-link__excerpt">
                    <?php the_excerpt();?>
                    
                  </div>
                </div>
              </a>
            <?php } 
              wp_reset_postdata(); 
            } ?>
        </section>
      <?php } ?>

      <section class="comments">
        <?php
          if (comments_open() || get_comments_number()) {
            comments_template();
          }
        ?>
        <script>
          $(document).ready(function() {
            $('#comments').text('Комментарии');
            $('.comments .must-log-in').text('Для отправки комментария вам необходимо авторизоваться.');
            $('#reply-title').hide();
            $('.comment-meta').each(function() {
              $(this).closest('.comment').find('.comment-author').append($(this));
            });         
          })

          $(document).ready(function () {
            var textarea = $('#comment');
            var placeholderText = 'Напишите Ваш комментарий';

            textarea.val(placeholderText);

            textarea.on('focus', function () {
              if (textarea.val() === placeholderText) {
                textarea.val('');
              }
            });

            textarea.on('blur', function () {
              if (textarea.val() === '') {
                textarea.val(placeholderText);
              }
            });
          });

          $(document).ready(function () {
            var submitButton = $('#submit');
            var newButtonText = 'Отправить';

            submitButton.text(newButtonText);
            submitButton.val(newButtonText);
          });

        </script>
      </section>

    </article>

    <button class="call-sidebar">
      <img src="<?php echo WRC_THEME_URI . '/dist/img/icons/call_sidebar.svg'; ?>" 
           alt="Открыть калькулятор" 
           width="13" height="9">
    </button>

    <aside class="sidebar">
      <button class="sidebar__close">
        <img src="<?php echo WRC_THEME_URI . '/dist/img/icons/close-white.svg'; ?>" alt="Закрыть" width="10" height="10">
      </button>
      <div class="sidebar__ingredients">
        <header class="sidebar__header">
          <div class="sidebar__title extra-text">Ингредиенты</div>
          <div class="sidebar__subtitle extra-text">на &nbsp; 
            <div class="portion-controls">
              <button class="portion-controls__button portion-controls__button_minus">
                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="2" viewBox="0 0 10 2" fill="none">
                  <path d="M0 1H10" stroke="#403D56"/>
                </svg>
              </button>
              <input class="portion-controls__input" type="number" min="1" max="99" readonly>
              <button class="portion-controls__button portion-controls__button_plus">
                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                  <path d="M0 5H10" stroke="#403D56"/>
                  <path d="M5 10V0" stroke="#403D56"/>
                </svg>
              </button>
            </div>
            &nbsp;<span class="portion-label"></span></div>
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

                $ingredient_count_for_one_portion = is_numeric($ingredient_count) ? $ingredient_count / $portion : $ingredient_count;

                $unit = get_sub_field('unit');
                ?>
                <div class="sidebar__ingredients-name text-18-mid">
                  <?php if(get_sub_field('add_user_ingredient') == false) {
                    echo esc_html($ingredient->post_title); 
                  } else {
                    echo $user_ingredient;
                  }
                  ?>
                </div>
                <div class="sidebar__ingredients-right">
                  <?php if(get_sub_field('taste')) { ?>
                    <div class="sidebar__ingredients-taste text-18-mid">&nbsp;по вкусу</div>
                  <?php } else { ?>
                    <div class="sidebar__ingredients-count text-18-mid" data-ingredient="<?php echo $ingredient_count_for_one_portion; ?>">&nbsp;<?php echo $ingredient_count; ?></div>
                    <div class="sidebar__ingredients-unit text-18-mid">&nbsp;<?php echo esc_html($unit->post_title); ?></div> 
                  <?php } ?>
                </div>
              </li>
            <?php } ?>
          </ul> 
        <?php } ?>
      </div>
      <div class="meta">
        <a class="meta__author" href="<?php echo esc_url(get_author_posts_url($author_id)); ?>">
          <div class="meta__author-avatar">
            <?php echo $author_avatar; ?>
          </div>
          <div class="meta__author-name">
            <?php echo esc_html($author_name); ?>
          </div>
        </a> 

        <div class="add-bookmark meta__add-bookmark">
          <?php 
          /**
          * Echo the favorite button for a specified post
          * Post ID not required if inside the loop
          * @param $post_id int, defaults to current post
          * @param $site_id int, defaults to current blog/site
          */ 
          the_favorites_button($post_id);
          ?>
        </div>

        <div class="likes">
          <?php global $post; ?>
          <?php echo rcl_get_html_post_rating($post->ID,'custom-type',$post->post_author);?>   
        </div>
      </div>
    </aside>
  </div>
</main>

<?php get_footer();
