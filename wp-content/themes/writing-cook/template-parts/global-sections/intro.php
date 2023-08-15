<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
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

<section class="searching-results"></section>

<!-- JS Search -->
<script>
jQuery(document).ready(function($) {
  $('.search-form-recipes').submit(function(event) {
    event.preventDefault();
    
    let formData = $(this).serialize();
    
    $.ajax({
      type: 'POST',
      url: '<?php echo esc_url(admin_url('admin-ajax.php')); ?>',
      data: formData + '&action=recipe_search',
      success: function(response) {
        $('.searching-results').html(response);
      }
    });
  });
});
</script>
<!-- JS Search END -->

<!-- Filter recipes -->
<div class="category-filter">
    <?php
    $categories = get_terms(array(
        'taxonomy' => 'recipe_category',
        'orderby' => 'name',
        'order' => 'ASC',
    ));

    foreach ($categories as $category) {
        echo '<label><input type="checkbox" class="category-checkbox" value="' . esc_attr($category->term_id) . '"> ' . esc_html($category->name) . '</label>';
    }
    ?>
    <input type="hidden" id="category-filter-values" name="category_filter_values" value="">
</div>

<section>
      <div class="container">
        <div class="searching-results__list">
  </div>
  </div>
  </section>

<!-- AJAX скрипт -->
<script>
jQuery(document).ready(function($) {
    var paged = 1;

    $('.category-checkbox').change(function() {
        paged = 1; // Сброс страницы при изменении фильтра
        loadRecipes();
    });

    function loadRecipes() {
        var categoryValues = [];
        $('.category-checkbox:checked').each(function() {
            categoryValues.push($(this).val());
        });

        $.ajax({
            type: 'POST',
            url: '<?php echo esc_url(admin_url('admin-ajax.php')); ?>', // WordPress AJAX URL
            data: {
                action: 'load_recipes_by_category',
                category_filter_values: categoryValues,
                paged: paged,
            },
            success: function(response) {
                $('.searching-results__list').html(response);
            }
        });
    }

    // Инициализация при загрузке страницы
    loadRecipes();
});
</script>
<!-- Filter recipes END -->




<script>
  $('.recipe-card__button').on('click', function(e) {
    e.preventDefault();
    let button = $(this),
        card = button.closest('.recipe-card'),
        cardContent = card.find('.recipe-card__content_second');
    cardContent.slideToggle();
    button.toggleClass('recipe-card__button_active')
    card.toggleClass('recipe-card_active')
  });
</script>