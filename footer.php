<footer class="site-footer">
  <div class="footer-inner">
    <div class="footer-top">
      <div class="footer-branding">
        <?php if (has_custom_logo()) : ?>
          <div class="footer-logo footer-logo--inverse"><?php the_custom_logo(); ?></div>
        <?php else: ?>
          <span class="footer-title"><?php bloginfo('name'); ?></span>
        <?php endif; ?>
      </div>

      <div class="footer-social" aria-label="SNSリンク">
        <?php if ($url = get_theme_mod('yoake_footer_twitter')): ?>
          <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener" aria-label="X / Twitter"><i class="fab fa-twitter"></i></a>
        <?php endif; ?>
        <?php if ($url = get_theme_mod('yoake_footer_facebook')): ?>
          <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
        <?php endif; ?>
        <?php if ($url = get_theme_mod('yoake_footer_instagram')): ?>
          <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
        <?php endif; ?>
      </div>
    </div>

    <div class="footer-sections">
      <nav class="footer-nav" aria-label="フッターメニュー">
        <?php
          wp_nav_menu(array(
            'theme_location' => 'primary',
            'container'      => false,
            'menu_class'     => '',
            'depth'          => 1,
          ));
        ?>
      </nav>

      <div class="footer-columns">
        <?php for ($col = 1; $col <= 4; $col++) :
          $title = get_theme_mod("yoake_footer_col{$col}_title");
          $has_links = false;
          for ($i = 1; $i <= 5; $i++) {
            if (get_theme_mod("yoake_footer_col{$col}_link{$i}_text") && get_theme_mod("yoake_footer_col{$col}_link{$i}_url")) {
              $has_links = true;
              break;
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
          <?php endif;
        endfor; ?>
      </div>
    </div>

    <div class="footer-copy">
      &copy; <?php echo esc_html(wp_date('Y')); ?> <?php bloginfo('name'); ?>. All rights reserved.
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>