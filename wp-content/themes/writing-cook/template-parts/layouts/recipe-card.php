<?php
if (!defined('ABSPATH')) {
    exit;
}

$thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
$title = get_the_title();
$excerpt = get_the_excerpt();
?>
<a class="recipe-card" href="<?php echo get_permalink() ?>">
  
  <?php if ($thumbnail_url) { ?>
    <div class="recipe-card__image">
      <img src="<?php echo $thumbnail_url ?>" 
        alt="" 
        width="360"
        height="250"/>
    </div>
  <?php } else { ?>
    <div class="recipe-card__plug">
    <?php 
      $image = get_field('card_plug', 'option');
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
      <script>
        function truncateText() {
          const card = $('.recipe-card');
          const text = $('.recipe-card__title');
          const cardHeight = card.height();

          while (text[0].scrollHeight > cardHeight) {
            text.text(function (index, text) {
              return text.replace(/\W*\s(\S)*$/, '...');
            });
          }
        }

        $(window).on('load resize', truncateText);
      </script>
    </div>
    
    <button class="recipe-card__button" aria-label="Развернуть-свернуть карточку рецепта">
      <img src="<?php echo WRC_THEME_URI . '/dist/img/icons/arrow-down.svg'; ?>" alt="" width="13" height="9">
    </button>
    <div class="recipe-card__content recipe-card__content_second">
      <div class="recipe-card__ingredients">
        <p class="recipe-card__ingredients-title">Ингредиенты и инвентарь</p>
        <p class="recipe-card__ingredients-title">на 4 порции</p>
        <ul class="recipe-card__ingredients-list">
          <li class="recipe-card__ingredients-item">Горох</li>
          <li class="recipe-card__ingredients-item">Вода</li>
          <li class="recipe-card__ingredients-item">Сухари</li>
          <li class="recipe-card__ingredients-item">Петрушка</li>
          <li class="recipe-card__ingredients-item">Морковь</li>
          <li class="recipe-card__ingredients-item">Горох</li>
          <li class="recipe-card__ingredients-item">Вода</li>
          <li class="recipe-card__ingredients-item">Сухари</li>
          <li class="recipe-card__ingredients-item">Петрушка</li>
          <li class="recipe-card__ingredients-item">Морковь</li>
        </ul>
      </div>
      <div class="recipe-card__meta">
        <div class="recipe-card__author">
          <?php echo get_the_author(); ?>
        </div>
        <div class="recipe-card__bookmark">
          3
        </div>
        <div class="recipe-card__like">
          +
        </div>
      </div>
    </div>
  </div>
</a>