<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Single post template
 */

add_action('wp_enqueue_scripts', function () {
  wp_enqueue_style('post-page', WRC_THEME_URI . '/dist/css/single.min.css');

  wp_enqueue_script('single-post', WRC_THEME_URI . '/dist/js/pages/single-post.min.js', 'jquery');
},200);

get_header();

$thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'large');

$post_id = get_the_ID();
$fields = get_fields($post_id);

// Author
$author_id = get_post_field('post_author', get_the_ID());
$author_name = get_the_author_meta('display_name', $author_id);
$author_description = get_the_author_meta('description', $author_id);
$author_avatar = get_avatar($author_id, 40);
?>

<main class="post-page">
  <?php while ( have_posts() ) : the_post(); ?>

    <section class="post-page-intro">
      <div class="container">

        <div class="post-breadcrumbs">
          <a class="post-breadcrumbs__home" href="<?php echo home_url(); ?>">Главная</a>
          <span class="post-breadcrumbs__separator">/</span>
          <a class="post-breadcrumbs__blog" href="<?php echo get_field('blog_address', 'option') ?>">Блог</a>
          <span class="post-breadcrumbs__separator">/</span>
          <span class="post-breadcrumbs__post"><?php the_title(); ?></span>
        </div>
        
        <h1 class="post-page-intro__title"><?php the_title(); ?></h1>
      </div>
    </section>

    <div class="container post-page__container">
      <article class="post-page-content content">
        <div class="post-page-content__header">
          <?php if ($thumbnail_url) { ?>
            <div class="post-page-content__header-image">
              <img src="<?php echo $thumbnail_url ?>" 
                alt="" 
                width="1000"
                height="550"/>
            </div>
          <?php } else if ($fields['main_image']) { ?>
            <div class="post-page-content__header-image">
              <img src="<?php echo $fields['main_image']['url']; ?>" 
                alt="" 
                width="1000"
                height="550"/>
            </div>
          <?php } else { ?>
            <div class="post-page-content__header-plug">
              <?php 
              $image = get_field('card_plug_post', 'option');
              if( !empty( $image ) ) { ?>
                  <img src="<?php echo esc_url($image['url']); ?>" 
                      alt="<?php echo esc_attr($image['alt']); ?>" 
                      width="1000"
                      height="550"/>
              <?php } ?>
            </div>
          <?php } ?>
        </div>
        <div class="post-page-content__meta">
          <div class="post-page-content__meta-date">
            <span class="post-page-content__meta-date-text">Опубликовано:</span>
            <span class="post-page-content__meta-date-time"><?php the_time('d.m.Y'); ?></span>
          </div>
          <a href="#post-page-content-comments" class="post-page-content__meta-to-comments">
            <img src="<?php echo WRC_THEME_URI . '/dist/img/icons/comment-icon.svg'; ?>" 
                 alt="Комментировать" 
                 width="28" height="25">
            <span>Комментировать</span>
          </a>
        </div>
        <div class="post-page-content__body">
          <?php the_content(); ?>
        </div>
        <section class="comments" id="post-page-content-comments">
          <?php
            if (comments_open() || get_comments_number()) {
              comments_template();
            }
          ?>
          <script>
            $(document).ready(function() {
              $('#comments').text('Комментарии');
              $('.comments .must-log-in').text('Для отправки комментария вам необходимо авторизоваться.');
              $('#reply-title').hide();
              $('.comment-meta').each(function() {
                $(this).closest('.comment').find('.comment-author').append($(this));
              });         
            })

            $(document).ready(function () {
              var textarea = $('#comment');
              var placeholderText = 'Напишите Ваш комментарий';

              textarea.val(placeholderText);

              textarea.on('focus', function () {
                if (textarea.val() === placeholderText) {
                  textarea.val('');
                }
              });

              textarea.on('blur', function () {
                if (textarea.val() === '') {
                  textarea.val(placeholderText);
                }
              });
            });

            $(document).ready(function () {
              var submitButton = $('#submit');
              var newButtonText = 'Отправить';

              submitButton.text(newButtonText);
              submitButton.val(newButtonText);
            });

          </script>
        </section>
      </article>

      <button class="call-sidebar">
        <img src="<?php echo WRC_THEME_URI . '/dist/img/icons/call_heading_sidebar.svg'; ?>" 
            alt="Открыть сайдбар" 
            width="13" height="9">
      </button>

      <aside class="post-page-sidebar sidebar">
        <button class="sidebar__close">
          <img src="<?php echo WRC_THEME_URI . '/dist/img/icons/close-white.svg'; ?>" alt="Закрыть" width="10" height="10">
        </button>
        <div class="sidebar__body">
          <div class="sidebar__title">Содержание</div>
          <div class="sidebar__list"></div>
        </div>
        <div class="meta">
          <a class="meta__author" href="<?php echo esc_url(get_author_posts_url($author_id)); ?>">
            <div class="meta__author-avatar">
              <?php echo $author_avatar; ?>
            </div>
            <div class="meta__author-name">
              <?php echo esc_html($author_name); ?>
            </div>
          </a>
          <button class="share-button" aria-label="Открыть Поделиться"></button>

          <div class="share-popup">
            <?php echo do_shortcode('[addtoany]'); ?>
            <button class="share-popup__close" aria-label="Закрыть Поделиться"></button>
          </div>     
        </div>
      </aside>
    </div>

  <?php endwhile; ?>
</main>
<?php

get_footer();