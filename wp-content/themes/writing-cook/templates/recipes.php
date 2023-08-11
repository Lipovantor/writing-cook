<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
/*
Template Name: Recipes
*/
/**
 * Recipes Template
 *
 * @package WordPress
 * @subpackage Custom Theme by Bayraktar Serge
 * @since V0.1
 *
 */
// add_action('wp_enqueue_scripts', function () {
//     wp_enqueue_script('slick-js', TEST_ASSETS_URI . 'slick/slick.min.js', 'jquery', null, 1);
//     wp_enqueue_script('recipes', TT_DIST_JS_URI . 'pages/recipes.min.js', 'jquery', null, 1);
    
//     wp_enqueue_style('slick-css', TEST_ASSETS_URI . 'slick/slick.css');
//     wp_enqueue_style('slick-theme-css', TEST_ASSETS_URI . 'slick/slick-theme.css');
//     wp_enqueue_style('recipes', TT_DIST_CSS_URI . 'pages/recipes.min.css');
// },200);

get_header();

the_content();


echo get_template_part(TEST_TEMPLATES_DIR . 'sections/hero');

echo get_template_part(TEST_TEMPLATES_DIR . 'sections/categories-list');

echo get_template_part(TEST_TEMPLATES_DIR . 'sections/slider-posts');
?>


<?php
get_footer();