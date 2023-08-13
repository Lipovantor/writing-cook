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
        'rewrite' => array('slug' => 'recipes'),
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => 3,
        'menu_icon' => 'dashicons-carrot',
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions'),
        'show_in_rest' => true,
    );

    register_post_type('recipes', $args);
}

add_action('init', 'create_recipe_cpt');

add_theme_support('post-thumbnails', array('recipes'));

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

    $tag_labels = array(
        'name' => 'Метки рецептов',
        'singular_name' => 'Метка рецептов',
        'search_items' => 'Искать метки рецептов',
        'all_items' => 'Все метки рецептов',
        'edit_item' => 'Редактировать метку рецептов',
        'update_item' => 'Обновить метку рецептов',
        'add_new_item' => 'Добавить новую метку рецептов',
        'new_item_name' => 'Новое имя метки рецептов',
        'menu_name' => 'Метки рецептов',
    );

    $tag_args = array(
        'labels' => $tag_labels,
        'hierarchical' => false,
        'public' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'rewrite' => array('slug' => 'recipe-tag'),
    );

    register_taxonomy('recipe_tag', 'recipes', $tag_args);
}

add_action('init', 'create_recipe_taxonomies');

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