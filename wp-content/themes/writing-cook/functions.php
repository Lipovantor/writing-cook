<?php
if (!defined('ABSPATH')) {
    exit;
}

// Root theme
define('WRC_THEME_URI', get_stylesheet_directory_uri());

// Path to templates
define('WRC_TEMPLATES_DIR', '/template-parts/');

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('jquery', WRC_THEME_URI . '/dist/js/jquery-3.5.1.min.js');
    wp_enqueue_script('general', WRC_THEME_URI . '/dist/js/general.min.js', 'jquery');
    
    wp_enqueue_style('general', WRC_THEME_URI . '/dist/css/general.min.css');
},200);

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
require get_template_directory() . '/inc/actions.php';

/**
 * Menus
 */
add_theme_support('menus');










