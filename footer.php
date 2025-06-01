<footer>
  <div class="footer-inner">
  <div class="footer-columns">
  <?php for ($col = 1; $col <= 4; $col++) :
    $title = get_theme_mod("yoake_footer_col{$col}_title");
    // 何か入力されていればカラム表示
    $has_links = false;
    for ($i = 1; $i <= 5; $i++) {
        if (get_theme_mod("yoake_footer_col{$col}_link{$i}_text") && get_theme_mod("yoake_footer_col{$col}_link{$i}_url")) {
            $has_links = true; break;
        }
    }
    if ($title || $has_links): ?>
      <div class="footer-col">
        <?php if ($title): ?>
          <div class="footer-col-title"><?php echo esc_html($title); ?></div>
        <?php endif; ?>
        <ul>
        <?php for ($i = 1; $i <= 5; $i++):
            $text = get_theme_mod("yoake_footer_col{$col}_link{$i}_text");
            $url  = get_theme_mod("yoake_footer_col{$col}_link{$i}_url");
            if ($text && $url): ?>
              <li><a href="<?php echo esc_url($url); ?>"><?php echo esc_html($text); ?></a></li>
            <?php endif;
        endfor; ?>
        </ul>
      </div>
  <?php endif; endfor; ?>
</div>
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