<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Функция для обработки AJAX запроса на поиск рецептов
function recipe_search_ajax_handler() {
  $search_query = sanitize_text_field($_POST['search_query']); // Получаем поисковой запрос из AJAX запроса
  
  $args = array(
      'post_type' => 'recipes',
      'post_status' => 'publish',
      's' => $search_query,
      'posts_per_page' => -1,
  );
  
  $query = new WP_Query($args);
  
  if ($query->have_posts()) { 
      $count = $query->found_posts; ?> 

      <div class="search-result">
          <div class="container container_xl">
              <div class="search-result__header">
                  <h2 class="search-result__title">Поиск по запросу: <?php echo $search_query ?></h2>
                  <p class="search-result__find-count">Найдено рецептов: <?php echo $count ?></p>
              </div>
              <div class="search-result__list">
                  <?php
                  while ($query->have_posts()) {
                      $query->the_post();
                      $thumbnail = get_the_post_thumbnail(get_the_ID(), 'large');
                      $title = get_the_title();
                      $excerpt = get_the_excerpt();
                      ?>
                          <a class="search-result-link" href="<?php echo get_permalink() ?>">
                              <?php if ($thumbnail) { ?>
                                  <div class="search-result-link__thumbnail"><?php echo $thumbnail ?></div>
                              <?php } ?>
                              <h3 class="search-result-link__title"><?php echo $title ?></h3>
                              <p class="search-result-link__excerpt"><?php echo $excerpt ?></p>
                          </a>
                      <?php
                  }
                  wp_reset_postdata();
                  ?>
              </div>
          </div>
      </div>

  <?php } else {
      echo '<div class="search-result">Рецепты не найдены</div>';
  }
  
  die(); // Важно завершить выполнение после отправки результатов
}
add_action('wp_ajax_recipe_search', 'recipe_search_ajax_handler');
add_action('wp_ajax_nopriv_recipe_search', 'recipe_search_ajax_handler');