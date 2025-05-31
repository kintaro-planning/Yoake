<footer>
  <div class="footer-inner">
    <div class="footer-branding">
      <?php if (has_custom_logo()) : ?>
        <div class="footer-logo"><?php the_custom_logo(); ?></div>
      <?php else: ?>
        <span class="footer-title"><?php bloginfo('name'); ?></span>
      <?php endif; ?>
    </div>
    <nav class="footer-nav">
      <?php
        wp_nav_menu(array(
          'theme_location' => 'primary', // メインメニューを使い回し。必要ならfooter専用でもOK
          'container' => false,
          'menu_class' => '',
          'depth' => 1,
        ));
      ?>
    </nav>
    <div class="footer-social">
      <?php if ($url = get_theme_mod('yoake_footer_twitter')): ?>
        <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener"><i class="fab fa-twitter"></i></a>
      <?php endif; ?>
      <?php if ($url = get_theme_mod('yoake_footer_facebook')): ?>
        <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener"><i class="fab fa-facebook"></i></a>
      <?php endif; ?>
      <?php if ($url = get_theme_mod('yoake_footer_instagram')): ?>
        <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a>
      <?php endif; ?>
    </div>
    <?php if ($map = get_theme_mod('yoake_footer_map_embed')): ?>
      <div class="footer-map">
        <?php echo $map; ?>
      </div>
    <?php endif; ?>
    <div class="footer-copy">
      &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>