<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<section class="intro">
  <div class="container">
    <div class="intro__inner">

      <h1 class="hero__title">Рецепты блюд на любой вкус</h1>

      <form class="search-form" action="<?php echo esc_url(admin_url('admin-ajax.php')); ?>" method="post">
        <input type="search" class="search-field" placeholder="Поиск рецептов" name="search_query" />
        <input type="submit" class="search-submit"></input>
      </form>
    </div>
  </div>
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