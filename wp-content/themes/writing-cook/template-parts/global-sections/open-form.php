<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<section class="open-form" style="<?php if(!empty(get_sub_field('bg_image'))) echo 'background-image: url(' . get_sub_field('bg_image') . ');'; ?>">
  <div class="open-form__bg-filter"></div>
  <div class="container open-form__container">
    <div class="open-form__content">
      <?php if (!empty(get_sub_field('title'))) { ?>
        <h2 class="open-form__title">
          <?php echo get_sub_field('title'); ?>
        </h2>
      <?php } ?>
      <?php if (!empty(get_sub_field('text'))) { ?>
        <p class="open-form__text extra-text">
          <?php echo get_sub_field('text'); ?>
        </p>
      <?php } ?>

      <div class="open-form__wrap">
        <?php 
        if(is_user_logged_in()) { ?>
          <div class="open-form__form">
            <?php if(!empty(get_sub_field('form_id'))) echo do_shortcode('[contact-form-7 id="' . get_sub_field('form_id') . '"]'); ?>
          </div>
        <?php } else { ?>
          <p class="open-form__condition">Чтобы тут появилась форма связи, пожалуйста 
            <button class="open-log-in">войдите</button> или 
            <button class="open-sign-in">зарегистрируйтесь</button>
          </p>
        <?php } ?>
      </div>
    </div>
  </div>
</section>