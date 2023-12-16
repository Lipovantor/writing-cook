<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Recipe CPT
function create_recipe_cpt() {
  $labels = array(
    'name' => 'Рецепты',
    'singular_name' => 'Рецепт',
    'menu_name' => 'Рецепты',
    'add_new' => 'Добавить новый',
    'add_new_item' => 'Добавить новый рецепт',
    'edit' => 'Редактировать',
    'edit_item' => 'Редактировать рецепт',
    'new_item' => 'Новый рецепт',
    'view' => 'Просмотреть',
    'view_item' => 'Просмотреть рецепт',
    'search_items' => 'Искать рецепты',
    'not_found' => 'Рецепты не найдены',
    'not_found_in_trash' => 'Рецепты в корзине не найдены',
    'parent' => 'Родительский рецепт',
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'has_archive' => true,
    'publicly_queryable' => true,
    'query_var' => true,
    // 'rewrite' => false,
    'rewrite' => array('slug' => 'recipes', 'with_front' => false),
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => 4,
    'menu_icon' => 'dashicons-food',
    'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions'),
    'show_in_rest' => true,
  );

  register_post_type('recipes', $args);
}

add_action('init', 'create_recipe_cpt');

add_theme_support('post-thumbnails', array('recipes', 'post'));

function create_recipe_taxonomies() {
  $category_labels = array(
    'name' => 'Рубрики рецептов',
    'singular_name' => 'Рубрика рецептов',
    'search_items' => 'Искать рубрики рецептов',
    'all_items' => 'Все рубрики рецептов',
    'parent_item' => 'Родительская рубрика рецептов',
    'parent_item_colon' => 'Родительская рубрика рецептов:',
    'edit_item' => 'Редактировать рубрику рецептов',
    'update_item' => 'Обновить рубрику рецептов',
    'add_new_item' => 'Добавить новую рубрику рецептов',
    'new_item_name' => 'Новое имя рубрики рецептов',
    'menu_name' => 'Рубрики рецептов',
  );

  $category_args = array(
    'labels' => $category_labels,
    'hierarchical' => true,
    'public' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'rewrite' => array('slug' => 'recipe-category'),
  );

  register_taxonomy('recipe_category', 'recipes', $category_args);
}

add_action('init', 'create_recipe_taxonomies');

// Modify the permalink structure for 'recipes' post type.
// function change_recipe_permalink_structure($post_link, $post) {
//   if ($post->post_type === 'recipes' && is_object($post)) {
//       return home_url('/recipes/' . $post->post_name);
//   }
//   return $post_link;
// }
// add_filter('post_type_link', 'change_recipe_permalink_structure', 10, 2);

// function custom_rewrite_rules($rules) {
//   $new_rules = array(
//       '([^/]+)/?$' => 'index.php?name=$matches[1]',
//       'recipes/([^/]+)/?$' => 'index.php?recipes=$matches[1]',
//   );
//   return $new_rules + $rules;
// }
// add_filter('rewrite_rules_array', 'custom_rewrite_rules');



// Ingredients CPT
function create_ingredient_cpt() {
  $labels = array(
      'name' => 'Ингредиенты',
      'singular_name' => 'Ингредиент',
      'menu_name' => 'Ингредиенты',
      'add_new' => 'Добавить новый',
      'add_new_item' => 'Добавить новый ингредиент',
      'edit' => 'Редактировать',
      'edit_item' => 'Редактировать ингредиент',
      'new_item' => 'Новый ингредиент',
      'view' => 'Просмотреть',
      'view_item' => 'Просмотреть ингредиент',
      'search_items' => 'Искать ингредиенты',
      'not_found' => 'Ингредиенты не найдены',
      'not_found_in_trash' => 'Ингредиенты в корзине не найдены',
      'parent' => 'Родительский ингредиент',
  );

  $args = array(
      'labels' => $labels,
      'public' => true,
      'has_archive' => true,
      'publicly_queryable' => true,
      'query_var' => true,
      'rewrite' => array('slug' => 'ingredients'),
      'capability_type' => 'post',
      'hierarchical' => false,
      'menu_position' => 4,
      'menu_icon' => 'dashicons-carrot',
      'supports' => array('title', 'thumbnail'),
      'show_in_rest' => true,
  );

  register_post_type('ingredients', $args);
}

add_action('init', 'create_ingredient_cpt');

function create_ingredient_taxonomies() {
  $category_labels = array(
      'name' => 'Категории ингредиентов',
      'singular_name' => 'Категория ингредиентов',
      'search_items' => 'Искать категории ингредиентов',
      'all_items' => 'Все категории ингредиентов',
      'edit_item' => 'Редактировать категорию ингредиентов',
      'update_item' => 'Обновить категорию ингредиентов',
      'add_new_item' => 'Добавить новую категорию ингредиентов',
      'new_item_name' => 'Новое имя категории ингредиентов',
      'menu_name' => 'Категории ингредиентов',
  );

  $category_args = array(
      'labels' => $category_labels,
      'hierarchical' => true,
      'public' => true,
      'show_in_rest' => true,
      'show_admin_column' => true,
      'rewrite' => array('slug' => 'ingredient-category'),
  );

  register_taxonomy('ingredient_category', 'ingredients', $category_args);

  $tag_labels = array(
      'name' => 'Метки ингредиентов',
      'singular_name' => 'Метка ингредиентов',
      'search_items' => 'Искать метки ингредиентов',
      'all_items' => 'Все метки ингредиентов',
      'edit_item' => 'Редактировать метку ингредиентов',
      'update_item' => 'Обновить метку ингредиентов',
      'add_new_item' => 'Добавить новую метку ингредиентов',
      'new_item_name' => 'Новое имя метки ингредиентов',
      'menu_name' => 'Метки ингредиентов',
  );

  $tag_args = array(
      'labels' => $tag_labels,
      'hierarchical' => false,
      'public' => true,
      'show_in_rest' => true,
      'show_admin_column' => true,
      'rewrite' => array('slug' => 'ingredient-tag'),
  );

  register_taxonomy('ingredient_tag', 'ingredients', $tag_args);
}

add_action('init', 'create_ingredient_taxonomies');


// Units CPT
function create_units_cpt() {
  $labels = array(
      'name' => 'Единицы измерения',
      'singular_name' => 'Единица измерения',
      'menu_name' => 'Ед. измерения',
      'add_new' => 'Добавить новую',
      'add_new_item' => 'Добавить новую единицу измерения',
      'edit' => 'Редактировать',
      'edit_item' => 'Редактировать единицу измерения',
      'new_item' => 'Новая единица измерения',
      'view' => 'Просмотреть',
      'view_item' => 'Просмотреть единицу измерения',
      'search_items' => 'Искать единицы измерения',
      'not_found' => 'Единицы измерения не найдены',
      'not_found_in_trash' => 'Единицы измерения в корзине не найдены',
      'parent' => 'Родительская единица измерения',
  );

  $args = array(
      'labels' => $labels,
      'public' => true,
      'has_archive' => true,
      'publicly_queryable' => true,
      'query_var' => true,
      'rewrite' => array('slug' => 'unit'),
      'capability_type' => 'post',
      'hierarchical' => false,
      'menu_position' => 5,
      'menu_icon' => 'dashicons-filter',
      'supports' => array('title'),
      'show_in_rest' => true,
  );

  register_post_type('unit', $args);
}

add_action('init', 'create_units_cpt');


// Theme Settings
if (!function_exists('investors_acf_op_init')) {
  function investors_acf_op_init()
  {
      // Check function exists.
      if (function_exists('acf_add_options_page')) {

          // Register options page.
          acf_add_options_page(array(
              'page_title' => __('Настройки сайта'),
              'menu_title' => __('Настройки сайта'),
              'menu_slug' => 'theme-general-settings',
              'capability' => 'edit_posts',
              'redirect' => false
          ));
      }
  }
}
add_action('init', 'investors_acf_op_init');