<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
/**
 * Header Template
 *
 * @package WordPress
 * @subpackage Custom Theme by Bayraktar Serge
 * @since V1.2
 *
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png" />
    <link rel="manifest" href="/site.webmanifest" />

    <style>
      html {
        margin: 0 !important;
      }
    </style>
</head>
<body <?php body_class(); ?>>

<header class="header" id="header">
    <div class="container header__container">
      <div class="header__row">
        <div class="header__col header__col_left">
          <a href="<?php echo get_home_url(); ?>" class="header__logo" aria-label="На главную"></a>
        </div>
        <div class="header__col header__col_right">
          <?php if (!is_user_logged_in()) { ?>
            <button class="login-signin" id="login-signin"></button>
          <?php } ?>
          <?php if (is_user_logged_in()) { ?>

            <button class="to-write"></button>
            
            <div class="bookmark">
              <?php echo do_shortcode('[user_favorite_count]'); ?>
            </div>
          <?php } ?>
          <button class="header__burger" aria-label="Открыть меню" id="burger-menu"></button>
        </div>
      </div>

      <nav class="main-menu">
        <?php 
        $args = array(
            'menu' => 'main-menu',
            'theme_location' => 'header',
            'depth' => 0,
            'fallback_cb' => false,
        );

        $menu_items = wp_get_nav_menu_items($args['menu']);

        if ($menu_items) {
          foreach ($menu_items as $menu_item) {
              echo '<a href="' . esc_url($menu_item->url) . '" class="menu-item">' . esc_html($menu_item->title) . '</a>';
          }
        }
        ?>
      </nav>
      
      <?php if (is_user_logged_in()) { ?>
        <div class="to-write-menu">
          <a href="<?php echo rcl_format_url(get_author_posts_url($user_ID),'tect_657976942a228'); ?>" class="" title="Написать рецепт">Написать рецепт</a>
          <a href="<?php echo rcl_format_url(get_author_posts_url($user_ID),'opublikovat_statyu_657d7f7bef3b1'); ?>" class="" title="Написать статью">Написать статью</a>
        </div>

        <div class="book-favorites">
          <?php 
          /**
            * Echo HTML List of User Favorites
            * @param $user_id int, defaults to current user
            * @param $site_id int, defaults to current blog/site
            * @param $include_links bool, whether to wrap the post title with the permalink
            * @param $filters array of post types/taxonomies
            * @param $include_button boolean, whether to include the favorite button for each item
            * @param $include_thumbnails boolean, whether to include the thumbnail for each item
            * @param $thumbnail_size string, the thumbnail size to display
            * @param $include_excerpt boolean, whether to include the excerpt for each item
            * @return html
            */
            the_user_favorites_list($user_id = null, $site_id = null, $include_links = true, $filters = null, $include_button = false, $include_thumbnails = false, $thumbnail_size = 'thumbnail', $include_excerpt = false); 
          ?>
        </div>
      <?php } ?>

</header>

<script>
  $(document).ready(function() {
    $('.rcl-loginform form').on('keydown', function(event) {
      if (event.key === 'Enter') {
        event.preventDefault();
        $(this).submit();
      }
    });
  });
</script>