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
            <div class="recipe-card__content">
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