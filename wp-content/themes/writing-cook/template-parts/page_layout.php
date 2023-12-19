<?php
if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}

switch (get_row_layout()) {
  case 'intro':
    get_template_part('template-parts/global-sections/intro');
    break;
  case 'new-recipes':
    get_template_part('template-parts/global-sections/new-recipes');
    break;
  case 'promo':
    get_template_part('template-parts/global-sections/promo');
    break;
  case 'intro_blog':
    get_template_part('template-parts/global-sections/intro-blog');
    break;
  case 'accordeon':
    get_template_part('template-parts/global-sections/accordeon');
    break;
}