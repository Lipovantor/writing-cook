<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<section class="intro" 
         style="<?php if (!empty(get_sub_field('bg_image'))) { echo 'background-image: url(' . get_sub_field('bg_image') . ')'; } ?>">
  <div class="container">

    <?php if (!empty(get_sub_field('title'))) { ?>
      <h1 class="intro__title">
        <?php echo get_sub_field('title'); ?>
      </h1>
    <?php } ?>

    <form class="search-form search-form-recipes" action="<?php echo esc_url(admin_url('admin-ajax.php')); ?>" method="post">
      <input type="search" class="search-form-recipes__field" placeholder="Поиск рецептов" name="search_query" />
      <input type="submit" class="search-form-recipes__submit" value="Найти">
    </form>

  </div>
</section>

<section class="searching-results"></section>

<script>
jQuery(document).ready(function($) {
  $('.search-form-recipes').submit(function(event) {
    event.preventDefault();
    
    let formData = $(this).serialize();
    
    $.ajax({
      type: 'POST',
      url: '<?php echo esc_url(admin_url('admin-ajax.php')); ?>',
      data: formData + '&action=recipe_search',
      success: function(response) {
        $('.searching-results').html(response);
      }
    });
  });
});
</script>

<?php
$args = array(
    'post_type' => 'recipes',
    'post_status' => 'publish',
    'posts_per_page' => -1,
  );
  
  $query = new WP_Query($args);
  
  if ($query->have_posts()) { 
    $count = $query->found_posts; ?> 

    <section>
      <div class="container">
        <div class="searching-results__list">
          <?php
          while ($query->have_posts()) {
            $query->the_post();
            $thumbnail = get_the_post_thumbnail(get_the_ID(), 'large');
            $title = get_the_title();
            $excerpt = get_the_excerpt();
            ?>
            <a class="recipe-card" href="<?php echo get_permalink() ?>">
              
              <?php if ($thumbnail) { ?>
                <div class="recipe-card__image">
                  <?php echo $thumbnail ?>
                </div>
              <?php } else { ?>
                <div class="recipe-card__plug">
                <?php 
                  $image = get_field('card_plug', 'option');
                  if( !empty( $image ) ) { ?>
                      <img src="<?php echo esc_url($image['url']); ?>" 
                            alt="<?php echo esc_attr($image['alt']); ?>" 
                            width="360"
                            height="250"/>
                  <?php } ?>
                </div>
              <?php } ?>
              <div class="recipe-card__box">
                <div class="recipe-card__content recipe-card__content_main">
                  <div class="recipe-card__header">
                    <div class="recipe-card__inner recipe-card__inner_title">
                      <h3 class="recipe-card__title">
                        <?php echo $title ?>
                      </h3>
                    </div>
                    <div class="recipe-card__inner recipe-card__inner_excerpt">
                      <p class="recipe-card__excerpt">
                        <?php echo $excerpt ?>
                      </p>
                    </div>
                  </div>
                  <script>
                    function truncateText() {
                      const card = $('.recipe-card');
                      const text = $('.recipe-card__title');
                      const cardHeight = card.height();

                      while (text[0].scrollHeight > cardHeight) {
                        text.text(function (index, text) {
                          return text.replace(/\W*\s(\S)*$/, '...');
                        });
                      }
                    }

                    $(window).on('load resize', truncateText);
                  </script>
                </div>
                
                <button class="recipe-card__button">
                  <img src="<?php echo WRC_THEME_URI . '/dist/img/icons/arrow-down.svg'; ?>" alt="">
                </button>
                <div class="recipe-card__content recipe-card__content_second">
                  <div class="recipe-card__ingredients">
                    <p class="recipe-card__ingredients-title">Ингредиенты и инвентарь</p>
                    <p class="recipe-card__ingredients-title">на 4 порции</p>
                    <ul class="recipe-card__ingredients-list">
                      <li class="recipe-card__ingredients-item">Горох</li>
                      <li class="recipe-card__ingredients-item">Вода</li>
                      <li class="recipe-card__ingredients-item">Сухари</li>
                      <li class="recipe-card__ingredients-item">Петрушка</li>
                      <li class="recipe-card__ingredients-item">Морковь</li>
                      <li class="recipe-card__ingredients-item">Горох</li>
                      <li class="recipe-card__ingredients-item">Вода</li>
                      <li class="recipe-card__ingredients-item">Сухари</li>
                      <li class="recipe-card__ingredients-item">Петрушка</li>
                      <li class="recipe-card__ingredients-item">Морковь</li>
                    </ul>
                  </div>
                  <div class="recipe-card__meta">
                    <div class="recipe-card__author">
                      <?php echo get_the_author(); ?>
                    </div>
                    <div class="recipe-card__bookmark">
                      3
                    </div>
                    <div class="recipe-card__like">
                      +
                    </div>
                  </div>
                </div>

                
              </div>
            </a>
            <?php
          }
          wp_reset_postdata();
          ?>
        </div>
      </div>
    </section>
  <?php } else {
    echo '<div class="container">Рецепты не найдены</div>';
  } ?>

<script>
  $('.recipe-card__button').on('click', function(e) {
    e.preventDefault();
    let button = $(this),
        card = button.closest('.recipe-card'),
        cardContent = card.find('.recipe-card__content_second');
    cardContent.slideToggle();
    button.toggleClass('recipe-card__button_active')
  });
</script>

<div>
  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex amet voluptatum commodi neque! Doloremque, nulla eveniet qui cupiditate magni porro, ut eos ipsa deserunt commodi cum, a amet iure laborum.
  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex amet voluptatum commodi neque! Doloremque, nulla eveniet qui cupiditate magni porro, ut eos ipsa deserunt commodi cum, a amet iure laborum.
  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex amet voluptatum commodi neque! Doloremque, nulla eveniet qui cupiditate magni porro, ut eos ipsa deserunt commodi cum, a amet iure laborum.
  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex amet voluptatum commodi neque! Doloremque, nulla eveniet qui cupiditate magni porro, ut eos ipsa deserunt commodi cum, a amet iure laborum.
  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex amet voluptatum commodi neque! Doloremque, nulla eveniet qui cupiditate magni porro, ut eos ipsa deserunt commodi cum, a amet iure laborum.
  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex amet voluptatum commodi neque! Doloremque, nulla eveniet qui cupiditate magni porro, ut eos ipsa deserunt commodi cum, a amet iure laborum.
  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex amet voluptatum commodi neque! Doloremque, nulla eveniet qui cupiditate magni porro, ut eos ipsa deserunt commodi cum, a amet iure laborum.
  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex amet voluptatum commodi neque! Doloremque, nulla eveniet qui cupiditate magni porro, ut eos ipsa deserunt commodi cum, a amet iure laborum.
  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex amet voluptatum commodi neque! Doloremque, nulla eveniet qui cupiditate magni porro, ut eos ipsa deserunt commodi cum, a amet iure laborum.
  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex amet voluptatum commodi neque! Doloremque, nulla eveniet qui cupiditate magni porro, ut eos ipsa deserunt commodi cum, a amet iure laborum.
  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex amet voluptatum commodi neque! Doloremque, nulla eveniet qui cupiditate magni porro, ut eos ipsa deserunt commodi cum, a amet iure laborum.
  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex amet voluptatum commodi neque! Doloremque, nulla eveniet qui cupiditate magni porro, ut eos ipsa deserunt commodi cum, a amet iure laborum.
  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex amet voluptatum commodi neque! Doloremque, nulla eveniet qui cupiditate magni porro, ut eos ipsa deserunt commodi cum, a amet iure laborum.
  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex amet voluptatum commodi neque! Doloremque, nulla eveniet qui cupiditate magni porro, ut eos ipsa deserunt commodi cum, a amet iure laborum.
  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex amet voluptatum commodi neque! Doloremque, nulla eveniet qui cupiditate magni porro, ut eos ipsa deserunt commodi cum, a amet iure laborum.
  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex amet voluptatum commodi neque! Doloremque, nulla eveniet qui cupiditate magni porro, ut eos ipsa deserunt commodi cum, a amet iure laborum.
  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex amet voluptatum commodi neque! Doloremque, nulla eveniet qui cupiditate magni porro, ut eos ipsa deserunt commodi cum, a amet iure laborum.
  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex amet voluptatum commodi neque! Doloremque, nulla eveniet qui cupiditate magni porro, ut eos ipsa deserunt commodi cum, a amet iure laborum.
  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex amet voluptatum commodi neque! Doloremque, nulla eveniet qui cupiditate magni porro, ut eos ipsa deserunt commodi cum, a amet iure laborum.
  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex amet voluptatum commodi neque! Doloremque, nulla eveniet qui cupiditate magni porro, ut eos ipsa deserunt commodi cum, a amet iure laborum.
  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex amet voluptatum commodi neque! Doloremque, nulla eveniet qui cupiditate magni porro, ut eos ipsa deserunt commodi cum, a amet iure laborum.
  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex amet voluptatum commodi neque! Doloremque, nulla eveniet qui cupiditate magni porro, ut eos ipsa deserunt commodi cum, a amet iure laborum.
  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex amet voluptatum commodi neque! Doloremque, nulla eveniet qui cupiditate magni porro, ut eos ipsa deserunt commodi cum, a amet iure laborum.
  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex amet voluptatum commodi neque! Doloremque, nulla eveniet qui cupiditate magni porro, ut eos ipsa deserunt commodi cum, a amet iure laborum.
  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex amet voluptatum commodi neque! Doloremque, nulla eveniet qui cupiditate magni porro, ut eos ipsa deserunt commodi cum, a amet iure laborum.
  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex amet voluptatum commodi neque! Doloremque, nulla eveniet qui cupiditate magni porro, ut eos ipsa deserunt commodi cum, a amet iure laborum.
  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex amet voluptatum commodi neque! Doloremque, nulla eveniet qui cupiditate magni porro, ut eos ipsa deserunt commodi cum, a amet iure laborum.
  Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ex amet voluptatum commodi neque! Doloremque, nulla eveniet qui cupiditate magni porro, ut eos ipsa deserunt commodi cum, a amet iure laborum.
</div>