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
</head>
<body <?php body_class(); ?>>

<header class="header">
    <?php 
    // $args = array(
    //     'menu' => 'main-menu',
    //     'theme_location' => 'header',
    //     'depth'	=> 0,
    //     'container' => 'nav',
    //     'container_class'   => 'main-menu',
    //     'fallback_cb' => false
    // );
        
    // wp_nav_menu( $args );
    ?>
    <div class="container">
      <div class="header__row">
        <div class="header__col">
          <a href="<?php echo get_home_url(); ?>" class="header__logo">
            <img src="<?php echo WRC_THEME_URI . '/dist/img/icons/logo-light.svg'; ?>" alt="" width="100" height="40">
          </a>
        </div>
        <div class="header__col">
          <button class="header__burger">
            <img src="<?php echo WRC_THEME_URI . '/dist/img/icons/burger.svg'; ?>" alt="" width="40" height="40">
          </button>
        </div>
      </div>
    </div>
</header>

<main class="main">
