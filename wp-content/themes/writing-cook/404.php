<?php
if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}
/**
* The template for displaying 404 pages (Not Found)
*
* @package WordPress
* @subpackage Custom Theme by Bayraktar Sergey
* @since V1.2
*
*/


header("HTTP/1.1 404 Not Found");


function template_page_scripts()
{
  wp_enqueue_style('page-404', WRC_THEME_URI . '/dist/css/page-404.min.css');
}
add_action('wp_enqueue_scripts', 'template_page_scripts', 200);

get_header();
?>

<main class="error-404">
  <div class="container error-404__container">
    <div class="error-404__body">
      <div class="error-404__content">
        <div class="error-404__col">
          <p class="body-text">Что-то пошло не так раз Вы тут оказались...</p>
          <p class="body-text">Такой страницы не существует</p>
          <p class="body-text">Попробуйте ввести верный url или вернитесь на <a href="<?php echo home_url(); ?>" title="Главная">Главную</a></p>
        </div>
        <div class="error-404__col">
          <div class="error-404__text">404</div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php
get_footer();