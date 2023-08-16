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
}