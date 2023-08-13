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