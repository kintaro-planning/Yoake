<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header>
  <div class="header-container">
    <div class="site-branding">
      <?php
      if ( function_exists('the_custom_logo') && has_custom_logo() ) {
          echo '<div class="site-logo">';
          the_custom_logo();
          echo '</div>';
      } else {
          echo '<div class="site-title"><a href="' . esc_url(home_url('/')) . '">' . get_bloginfo('name') . '</a></div>';
      }
      ?>
    </div>
    <button id="menu-toggle" aria-label="メニューを開く">
      <span></span>
      <span></span>
      <span></span>
    </button>
    <nav id="primary-menu">
      <?php wp_nav_menu( array(
          'theme_location' => 'primary',
          'container'      => false,
      )); ?>
    </nav>
  </div>
</header>
