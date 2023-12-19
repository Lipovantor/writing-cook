<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<section class="open-form">
  <div class="container">
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
      <?php echo do_shortcode('[contact-form-7 id="ebfe59c" title="Contact form 1"]'); ?>
    </div>
  </div>
</section>