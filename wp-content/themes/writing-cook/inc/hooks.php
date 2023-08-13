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
                <h2 class="searching-results__title">Поиск по запросу: <?php echo $search_query ?></h2>
                <p class="searching-results__find-count">Найдено рецептов: <?php echo $count ?></p>
            </div>
            <div class="searching-results__list">
                <?php
                while ($query->have_posts()) {
                    $query->the_post();
                    $thumbnail = get_the_post_thumbnail(get_the_ID(), 'large');
                    $title = get_the_title();
                    $excerpt = get_the_excerpt();
                    ?>
                    <a class="" href="<?php echo get_permalink() ?>">
                        <?php if ($thumbnail) { ?>
                          <div class=""><?php echo $thumbnail ?></div>
                        <?php } else { ?>
                          <div style="width:500px; height:300px; background:grey;">Тут будет картинка</div>
                        <?php } ?>
                        <h3 class=""><?php echo $title ?></h3>
                        <p class=""><?php echo $excerpt ?></p>
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