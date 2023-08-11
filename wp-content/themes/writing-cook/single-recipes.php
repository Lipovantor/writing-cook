<?php
/*
Template Name: Single Recipe
*/

// add_action('wp_enqueue_scripts', function () {
//     wp_enqueue_script('single-recipes', TT_DIST_JS_URI . 'single-recipes.min.js', 'jquery', null, 1);
//     wp_enqueue_script('slick-js', TEST_ASSETS_URI . 'slick/slick.min.js', 'jquery', null, 1);
    
//     wp_enqueue_style('single-recipes', TT_DIST_CSS_URI . 'single-recipes.min.css');
//     wp_enqueue_style('slick-css', TEST_ASSETS_URI . 'slick/slick.css');
//     wp_enqueue_style('slick-theme-css', TEST_ASSETS_URI . 'slick/slick-theme.css');
// },200);

// get_header();

// echo get_template_part(TEST_TEMPLATES_DIR . 'sections/recipe-hero');

?>

<?php

// the_title();

// if (have_posts()) {
//     while (have_posts()) {

//         the_post();

//         the_title();

//         if (has_post_thumbnail()) {
//             the_post_thumbnail();
//         }

//         the_content();
//     }
// }

get_footer();
?>
