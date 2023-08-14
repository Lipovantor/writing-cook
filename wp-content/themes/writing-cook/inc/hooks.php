<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Function for `document_title` filter-hook.
 */ 
add_filter( 'document_title', 'wp_document_title_filter' );

function wp_document_title_filter( $title ){
	return $title;
}

/**
 * Function to handle an AJAX request to search for recipes
 */ 

function recipe_search_ajax_handler() {
  $search_query = sanitize_text_field($_POST['search_query']);
  
  $args = array(
    'post_type' => 'recipes',
    'post_status' => 'publish',
    's' => $search_query,
    'posts_per_page' => -1,
  );
  
  $query = new WP_Query($args);
  
  if ($query->have_posts()) { 
    $count = $query->found_posts; ?> 

    <div class="container">
      <div class="searching-results__header">
        <h2 class="searching-results__title">Найдено рецептов: <?php echo $count ?></h2>
        <p class="searching-results__find extra-text">По запросу: "<?php echo $search_query ?>"</p>
      </div>
      <div class="searching-results__list">
        <?php
        while ($query->have_posts()) {
          $query->the_post();
          $thumbnail = get_the_post_thumbnail(get_the_ID(), 'large');
          $title = get_the_title();
          $excerpt = get_the_excerpt();
          ?>
          <a class="recipe-card" href="<?php echo get_permalink() ?>">
            <?php if ($thumbnail) { ?>
              <div class="recipe-card__image">
                <?php echo $thumbnail ?>
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
            
            <!-- <div class="recipe-card__content recipe-card__content_second">
              <div class="recipe-card__ingredients">
                <p>Состав:</p>
                <ul>
                  <li>Горох</li>
                  <li>Вода</li>
                  <li>Сухари</li>
                  <li>Петрушка</li>
                  <li>Морковь</li>
                </ul>
              </div>
            </div> -->

            <button class="recipe-card__button"></button>
            <script>
              $(document).ready(function() {
                $('.recipe-card__button').on('click', function(e) {
                  e.preventDefault();
                  console.log('test');
                });
              });
            </script>
          </a>
          <?php
        }
        wp_reset_postdata();
        ?>
      </div>
    </div>

  <?php } else {
    echo '<div class="container">Рецепты не найдены</div>';
  }
  
  die();
}
add_action('wp_ajax_recipe_search', 'recipe_search_ajax_handler');
add_action('wp_ajax_nopriv_recipe_search', 'recipe_search_ajax_handler');




// Фильтр
// Функция для обработки AJAX-запроса на фильтрацию рецептов
function filter_recipes() {
  $selected_categories = explode(',', sanitize_text_field($_POST['categories']));
  $page = max(1, intval($_POST['page'])); // Получаем номер страницы

  $args = array(
      'post_type' => 'recipes',
      'post_status' => 'publish',
      'posts_per_page' => 8,
      'paged' => $page,
      'tax_query' => array(
          array(
              'taxonomy' => 'recipe_category',
              'field' => 'term_id',
              'terms' => $selected_categories,
              'operator' => 'IN',
          ),
      ),
  );

  $query = new WP_Query($args);

  if ($query->have_posts()) {
      while ($query->have_posts()) {
          $query->the_post();
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
        <?php
      }

      echo '<div class="searching-results__pagination">';
      echo paginate_links(array(
          'current' => $page,
          'total' => $query->max_num_pages,
          'prev_next' => false,
      ));
      echo '</div>';

      wp_reset_postdata();
  } else {
      echo '<div class="container">Рецепты не найдены</div>';
  }

  die();
}

add_action('wp_ajax_filter_recipes', 'filter_recipes'); // Для зарегистрированных пользователей
add_action('wp_ajax_nopriv_filter_recipes', 'filter_recipes'); // Для незарегистрированных пользователей
