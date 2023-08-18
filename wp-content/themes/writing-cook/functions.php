<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Root theme
 */ 
define('WRC_THEME_URI', get_stylesheet_directory_uri());

/**
 * Path to templates
 */
define('WRC_TEMPLATES_DIR', '/template-parts/');

/**
 * Disable jquery if not admin
 */
function remove_default_jquery() {
    if (!is_admin()) {
        wp_deregister_script('jquery');
    }
}
add_action('wp_enqueue_scripts', 'remove_default_jquery');

/**
 * Enqueue scripts and styles
 */
function wrc_enqueue_scripts() {
    wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.7.0.min.js');
    wp_enqueue_script('general', WRC_THEME_URI . '/dist/js/general.min.js', 'jquery');
    
    wp_enqueue_style('general', WRC_THEME_URI . '/dist/css/general.min.css');
}
add_action('wp_enqueue_scripts', 'wrc_enqueue_scripts');

/**
 * Redirect to 404
 */
function custom_404_template_redirect() {
    if (is_404()) {
        include(get_template_directory() . '/404.php');
        exit();
    }
}
add_action('template_redirect', 'custom_404_template_redirect');

/**
 * CPT
 */
require get_template_directory() . '/inc/cpt.php';

/**
 * Actions
 */
require get_template_directory() . '/inc/hooks.php';

/**
 * Web optimization
 */
require get_template_directory() . '/inc/web-optimization.php';

/**
 * Menus
 */
add_theme_support('menus');

/**
 * Title-tag
 */
add_theme_support( 'title-tag' );


// Функция не дает возможность опубликовать пост или рецепт без названия
function check_post_title( $post_id ) {
  // Получаем название поста
  $post_title = get_post_field( 'post_title', $post_id );

  // Проверяем, что название не пусто
  if ( empty( $post_title ) ) {
      // Название поста не указано, отменяем сохранение и выводим сообщение
      wp_die( 'Пожалуйста, укажите название поста!' );
  }
}
add_action( 'save_post', 'check_post_title' );