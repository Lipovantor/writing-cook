<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<section class="hero">
  <div class="hero__darken">
    <h1 class="hero__title">Рецепты плюс</h1>
  </div>
  <?php if (is_page(14) || is_page(19)) { ?>
    <div class="recipe-search">
      <form class="search-form" action="<?php echo esc_url(admin_url('admin-ajax.php')); ?>" method="post">
        <input type="search" class="search-field" placeholder="Поиск рецептов" name="search_query" />
        <button type="submit" class="search-submit"></button>
      </form>
    </div>
  <?php } ?>
</section>

<section class="search-results"></section>

<script>
// Обработчик отправки AJAX запроса на поиск рецептов
jQuery(document).ready(function($) {
  $('.search-form').submit(function(event) {
    event.preventDefault(); // Предотвращаем отправку формы
    
    var formData = $(this).serialize(); // Получаем данные формы
    
    $.ajax({
      type: 'POST',
      url: '<?php echo esc_url(admin_url('admin-ajax.php')); ?>',
      data: formData + '&action=recipe_search',
      success: function(response) {
        $('.search-results').html(response); // Выводим результаты поиска в контейнере
      }
    });
  });
});
</script>