<?php
if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}

wp_enqueue_script('intro-blog', WRC_THEME_URI . '/dist/js/sections/intro-blog.min.js', 'jquery');
wp_localize_script('intro-blog', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));

$bg_image = get_sub_field('bg_image');
$title = get_sub_field('title');
$text = get_sub_field('text');
?>

<section class="intro-blog" 
         style="<?php if ( !empty( $bg_image ) ) { echo 'background-image: url(' . $bg_image . ')'; } ?>">
  <div class="container">

    <?php if ( !empty( $title ) ) { ?>
      <h1 class="intro-blog__title">
        <?php echo $title; ?>
      </h1>
    <?php } ?>

    <?php if ( !empty( $text ) ) { ?>
      <div class="intro-blog__text body-text">
        <?php echo $text; ?>
      </div>
    <?php } ?>

    <form class="search-form search-form-posts" action="<?php echo esc_url(admin_url('admin-ajax.php')); ?>" method="post">
      <input type="search" class="search-form-posts__field" placeholder="Поиск постов" name="search_query_posts" />
      <input type="submit" class="search-form-posts__submit" value="Найти">
    </form>

  </div>
</section>

<section class="searching" id="posts-searching"></section>

<section class="filtration" id="posts-filtration">
  <div class="container">
    <div class="category-filter">
      <?php
      $categories = get_terms(array(
        'taxonomy' => 'category',
        'orderby' => 'name',
        'order' => 'ASC',
        'exclude' => get_option('default_category')
      ));

      $counter = 0;

      foreach ($categories as $category) {
        $counter++;
        $input_id = 'category-checkbox-' . $counter;
        ?>
        <label for="<?php echo esc_attr($input_id); ?>" class="category-filter__label">
          <input type="checkbox" 
                 id="<?php echo esc_attr($input_id); ?>" 
                 class="category-checkbox" 
                 value="<?php echo esc_attr($category->term_id); ?>">
          <?php echo esc_html($category->name); ?>
        </label>
      <?php } ?>
    </div>
    <div class="filtration__list results-list"></div>
  </div>
</section>

