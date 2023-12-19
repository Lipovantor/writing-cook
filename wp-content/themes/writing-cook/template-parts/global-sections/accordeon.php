<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<section class="accordeon">
  <div class="container">
    <?php if(!empty(get_sub_field('subtitle'))) { ?>
      <h2 class="accordeon__title">
        <?php echo get_sub_field('subtitle'); ?>
      </h2>
    <?php } ?>
    <?php if( have_rows('accordeon') ) { ?>
      <div class="accordeon__list">
        <?php while( have_rows('accordeon') ): the_row(); ?>
          <div class="accordeon__item">
            <div class="accordeon__header">
              <h3 class="accordeon__question">
                <?php echo get_sub_field('question'); ?>
              </h3>
              <div class="accordeon__open-close">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                  <path d="M-1.47557e-06 12.8131L-1.75417e-06 19.1869L12.8788 19.1869L12.8788 32L19.1211 32L19.1211 19.1869L32 19.1869L32 12.8131L19.1211 12.8131L19.1211 -5.62953e-07L12.8788 -8.35812e-07L12.8788 12.8131L-1.47557e-06 12.8131Z" fill="#D6D6D6"/>
                </svg>
              </div>
            </div>
            <div class="accordeon__answer">
              <?php echo get_sub_field('answer'); ?>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    <?php } ?>
  </div>
</section>


<script>
  $(document).ready(function () {
    // Скрываем все ответы при загрузке страницы
    $('.accordeon__answer').hide();

    // Обработка клика по заголовку аккордеона
    $('.accordeon__header').click(function () {
      // Закрываем/открываем только тот ответ, который соответствует заголовку
      $(this).next('.accordeon__answer').slideToggle();

      // Добавляем/удаляем стиль активности к текущему элементу
      $(this).closest('.accordeon__item').toggleClass('accordeon__item_active');
    });

    // Проверяем, есть ли активный элемент при загрузке страницы
    $('.accordeon__item_active .accordeon__answer').show();
  });
</script>


