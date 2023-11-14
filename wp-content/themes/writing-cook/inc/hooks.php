<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Function for `document_title` filter-hook
 */ 
add_filter( 'document_title', 'wp_document_title_filter' );

function wp_document_title_filter( $title ){
	return $title;
}

/**
 * Search by recipe name
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
      <div class="searching__header">
        <h2 class="searching__title">Найдено рецептов: <?php echo $count ?></h2>
        <p class="searching__find extra-text">По запросу: "<?php echo $search_query ?>"</p>
      </div>
      <div class="searching__list results-list">
        <?php
        while ($query->have_posts()) {
          $query->the_post();
          
          get_template_part('template-parts/layouts/recipe-card');
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


/**
 * Filter by recipe category
 */ 
function load_recipes_by_category() {
  $category_filter_values = isset($_POST['category_filter_values']) ? $_POST['category_filter_values'] : array();
  $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;

  $args = array(
    'post_type' => 'recipes',
    'posts_per_page' => 8,
    'paged' => $paged,
    'post_status'    => 'publish',
    // 'orderby' => 'rand',
  );

  if (!empty($category_filter_values)) {
    $args['tax_query'] = array(
      array(
        'taxonomy' => 'recipe_category',
        'field' => 'term_id',
        'terms' => $category_filter_values,
      ),
    );
  }

  $query = new WP_Query($args);

  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
      
      get_template_part('template-parts/layouts/recipe-card');

    }
  } else {
    echo 'Нет рецептов для отображения.';
  }

  $pagination = paginate_links(array(
    'total' => $query->max_num_pages,
    'current' => $paged,
    'format' => '?paged=%#%',
    'show_all' => false,
    'prev_text' => '&laquo;',
    'next_text' => '&raquo;',
  ));
  
  if ($pagination) {
    echo '<div class="results-list__pagination pagination">' . $pagination . '</div>';
  }

  wp_reset_postdata();
  wp_die(); 
}

add_action('wp_ajax_load_recipes_by_category', 'load_recipes_by_category');
add_action('wp_ajax_nopriv_load_recipes_by_category', 'load_recipes_by_category');

