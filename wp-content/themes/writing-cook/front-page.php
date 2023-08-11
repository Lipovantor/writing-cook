<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
/*
Template Name: Front Page
*/
/**
 * Front Page Template
 *
 * @package WordPress
 * @subpackage Custom Theme by Bayraktar Sergey
 * @since V0.1
 *
 */
function remove_default_jquery() {
    if (!is_admin()) {
        wp_deregister_script('jquery');
    }
}
add_action('wp_enqueue_scripts', 'remove_default_jquery');

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('slick-js', WRC_THEME_URI . '/assets/slick/slick.min.js', 'jquery');

    wp_enqueue_script('front-page', WRC_THEME_URI . '/dist/js/pages/front-page.min.js', 'jquery');
    
    wp_enqueue_style('slick-css', WRC_THEME_URI . '/assets/slick/slick.css');
    wp_enqueue_style('slick-theme-css', WRC_THEME_URI . '/assets/slick/slick-theme.css');

    wp_enqueue_style('front-page', WRC_THEME_URI . '/dist/css/front-page.min.css');
},200);

get_header();

the_content();

?>


<?php
get_footer();