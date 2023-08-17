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
      <section class="gallary">
        <?php
        $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'large');

        if ($thumbnail_url) { ?>
          <img src="<?php echo $thumbnail_url ?>" 
            alt="" 
            width="770"
            height="500"/>
        <?php } else { ?>
          <?php 
          $image = get_field('card_plug', 'option');
          if( !empty( $image ) ) { ?>
              <img src="<?php echo esc_url($image['url']); ?>" 
                    alt="<?php echo esc_attr($image['alt']); ?>" 
                    width="770"
                    height="500"/>
          <?php } ?>
        <?php } ?>
      </section>
      <section class="details">
        <?php if(!empty($fields['timing'])) { ?>
          <div class="details__timing">
            <img width="27" height="27" src="<?php echo WRC_THEME_URI . '/dist/img/icons/cooking-time.svg'; ?>" alt="" class="details__timing-icon">
            <div class="extra-text details__timing-time">Время приготовления: <?php echo $fields['timing']; ?></div>
          </div>
        <?php } ?>
        <div class="ingridients">
          <div class="extra-text ingridients__title">Ингредиенты и инвентарь</div>
          <div class="extra-text">на 4 порции:</div>
          <ul class="ingridients__list">
            <li class="body-text ingridients__item">Соль</li>
            <li class="body-text ingridients__item">Соль</li>
          </ul>
        </div>
      </section>
    </article>
    <aside class="sidebar">
      <div class="sidebar__ingredients">
        <header class="sidebar__header">
          <div class="sidebar__title extra-text">Ингридиенты</div>
          <div class="sidebar__subtitle extra-text">на 4 порции</div>
        </header>
        <div class="sidebar__list">

        </div>
      </div>
    </aside>
  </div>
</main>

<?php get_footer();
