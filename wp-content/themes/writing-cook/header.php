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

</header>