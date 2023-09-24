<?php
if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}

/**
 * A function that does not allow you to publish a post or recipe without a title
 */
function check_post_title( $post_id ) {
  $post_title = get_post_field( 'post_title', $post_id );

  if ( empty( $post_title ) ) {
    wp_die( 'Пожалуйста, укажите название поста!' );
  }
}
add_action( 'save_post', 'check_post_title' );