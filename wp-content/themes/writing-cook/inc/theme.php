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

/**
 * WP-Recall Rating for recipes
 */
add_action('init','rcl_register_rating_custom_type',10);
function rcl_register_rating_custom_type(){
    
  rcl_register_rating_type(
    array(
      'post_type'=>'custom-type',
      'type_name'=>__('Рецепты'),
      'style'=>true,
      'data_type'=>true,
      'icon'=>'fa-thumbs-o-up'
    )
  );
}

add_action('init','rcl_register_rating_comments_custom_type',10);
function rcl_register_rating_comments_custom_type(){
    
  rcl_register_rating_type(
    array(
      'post_type'=>'custom-type',
      'type_name'=>__('Рейтинг Комментарии рецептов'),
      'style'=>true,
      'data_type'=>true,
      'icon'=>'fa-thumbs-o-up'
    )
  );
}