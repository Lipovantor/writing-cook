<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Single post template
 */

add_action('wp_enqueue_scripts', function () {

},200);

get_header();
the_title();
the_content();
get_footer();