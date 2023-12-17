<?php
if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}

$post_id = get_the_ID();
$fields = get_fields($post_id);
?>

<div class="modal-video">
  <div class="modal-video__frame">
    <div class="modal-video__video"> 
      <?php echo $fields['video']; ?>
    </div>
    <button class="modal-video__close" aria-label="Закрыть модальное окно">
      <img src="<?php echo WRC_THEME_URI . '/dist/img/icons/close-white.svg'; ?>" alt="Закрыть" width="24" height="24">
    </button>
  </div>
</div>