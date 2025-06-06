<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body <?php body_class(); ?>>
<?php
$preloader_image = get_theme_mod('yoake_preloader_image');
if ($preloader_image) : ?>
  <div id="preloader">
    <img src="<?php echo esc_url($preloader_image); ?>" alt="Preloader">
  </div>
<?php endif; ?>
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
