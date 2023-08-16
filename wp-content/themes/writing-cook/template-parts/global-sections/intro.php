<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

wp_enqueue_script('intro', WRC_THEME_URI . '/dist/js/sections/intro.min.js', 'jquery');
wp_localize_script('intro', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
?>

<section class="intro" 
         style="<?php if (!empty(get_sub_field('bg_image'))) { echo 'background-image: url(' . get_sub_field('bg_image') . ')'; } ?>">
  <div class="container">

    <?php if (!empty(get_sub_field('title'))) { ?>
      <h1 class="intro__title">
        <?php echo get_sub_field('title'); ?>
      </h1>
    <?php } ?>

    <form class="search-form search-form-recipes" action="<?php echo esc_url(admin_url('admin-ajax.php')); ?>" method="post">
      <input type="search" class="search-form-recipes__field" placeholder="Поиск рецептов" name="search_query" />
      <input type="submit" class="search-form-recipes__submit" value="Найти">
    </form>

  </div>
</section>

<section class="searching" id="recipes-searching"></section>

<section class="filtration" id="recipes-filtration">
  <div class="container">
    <div class="category-filter">
      <?php
      $categories = get_terms(array(
        'taxonomy' => 'recipe_category',
        'orderby' => 'name',
        'order' => 'ASC',
      ));

      $counter = 0;

      foreach ($categories as $category) {
        $counter++;
        $input_id = 'category-checkbox-' . $counter;
        ?>
        <label for="<?php echo esc_attr($input_id); ?>" class="category-filter__label">
          <input type="checkbox" id="<?php echo esc_attr($input_id); ?>" class="category-checkbox" value="<?php echo esc_attr($category->term_id); ?>">
          <?php echo esc_html($category->name); ?>
        </label>
      <?php } ?>
    </div>
    <div class="filtration__list results-list"></div>
  </div>
</section>







