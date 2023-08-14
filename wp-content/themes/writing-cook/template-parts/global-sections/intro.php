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

<script>
jQuery(document).ready(function($) {
    let selectedCategories = []; // Инициализация массива для выбранных категорий
    
    // Обработчик изменения чекбоксов
    $('.category-checkbox').on('change', function() {
        selectedCategories = $('.category-checkbox:checked')
            .map(function() {
                return $(this).val();
            })
            .get();
        updateRecipes(selectedCategories);
    });

    // Обработчик клика по пагинации
    $(document).on('click', '.searching-results__pagination a', function(e) {
    e.preventDefault(); // Предотвращаем стандартное поведение ссылок
    if ($(this).hasClass('current')) return; // Если кнопка уже активная, ничего не делаем
    const page = parseInt($(this).text()); // Получаем номер страницы из текста кнопки
    updateRecipes(selectedCategories, page);
});

    
    // Функция обновления рецептов через AJAX
    function updateRecipes(selectedCategories, page = 1) {
    $.ajax({
        url: '<?php echo esc_url(admin_url('admin-ajax.php')); ?>',
        type: 'POST',
        data: {
            action: 'filter_recipes',
            categories: selectedCategories.join(','), // Преобразование массива в строку
            page: page
        },
        success: function(response) {
            $('.searching-results__list').html(response);
            $(window).scrollTop(0); // Прокручиваем страницу вверх после обновления
        }
    });
}
});

</script>
<!-- Filter recipes END -->

<?php
// $paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
$paged = max( 1, intval(get_query_var('paged')) );


$args = array(
    'post_type' => 'recipes',
    'post_status' => 'publish',
    'posts_per_page' => 8,
    'paged' => $paged,
);

$query = new WP_Query($args);

if ($query->have_posts()) { ?> 

  <section>
    <div class="container">
      <div class="searching-results__list">
        <?php
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
        <?php } ?>
        <!-- Pagination -->
        <div class="searching-results__pagination">
          <?php echo paginate_links( [
            'current' => max( 1, $paged ),
            'total'   => $query->max_num_pages,
            'prev_next' => false,
          ] ); ?>
        </div>
        <!-- Pagination END -->
        <?php wp_reset_postdata(); ?>
      </div>
    </div>
  </section>
<?php } else {
  echo '<div class="container">Рецепты не найдены</div>';
} 
?>


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