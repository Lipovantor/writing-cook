<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
/**
 * Footer Template
 *
 * @package WordPress
 * @subpackage Custom Theme by Bayraktar Sergey
 * @since V1.2
 *
 */
?>

<footer class="footer">
  <div class="container footer__container">
    <div class="footer__top">
      <a href="<?php echo get_home_url(); ?>" class="header__logo" aria-label="На главную">
        <img src="<?php echo WRC_THEME_URI . '/dist/img/icons/logo-gold.svg'; ?>" alt="" width="100" height="40">
      </a>

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
    </div>
    <div class="footer__bottom">
      <div class="footer__copyright">
        ©Copyright <?php echo date("Y"); ?>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>