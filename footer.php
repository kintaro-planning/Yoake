<footer class="site-footer">
  <div class="footer-inner">
    <div class="footer-top">
      <!-- ブランド -->
      <div class="footer-branding">
        <?php if (has_custom_logo()) : ?>
          <div class="footer-logo"><?php the_custom_logo(); ?></div>
        <?php else: ?>
          <span class="footer-title"><?php bloginfo('name'); ?></span>
        <?php endif; ?>
      </div>

      <!-- SNS -->
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
      <!-- メインメニュー -->
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

      <!-- カスタマイザーカラム -->
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

<style>
/* Yoake footer layout refresh */
.site-footer {
  padding: 48px 24px 22px;
}
.site-footer .footer-inner {
  max-width: 960px;
  width: 100%;
  align-items: stretch;
}
.site-footer .footer-top {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 24px;
  width: 100%;
  padding-bottom: 28px;
  margin-bottom: 28px;
  border-bottom: 1px solid rgba(255,255,255,.22);
}
.site-footer .footer-branding {
  margin: 0;
}
.site-footer .footer-logo img {
  width: auto;
  height: auto;
  max-width: 180px;
  max-height: 64px;
  margin: 0;
  object-fit: contain;
}
.site-footer .footer-social {
  margin: 0;
  gap: 20px;
}
.site-footer .footer-social a {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  height: 40px;
  font-size: 1.45rem;
}
.site-footer .footer-sections {
  justify-content: flex-start;
  gap: 48px;
  margin-bottom: 32px;
}
.site-footer .footer-nav {
  flex: 0 0 180px;
}
.site-footer .footer-columns {
  flex: 1 1 auto;
  display: grid;
  grid-template-columns: repeat(4, minmax(0, 1fr));
  gap: 28px;
}
.site-footer .footer-col {
  min-width: 0;
}
.site-footer .footer-nav li,
.site-footer .footer-col li {
  margin-bottom: 9px;
}
.site-footer .footer-nav a,
.site-footer .footer-col a {
  line-height: 1.6;
}
.site-footer .footer-copy {
  width: 100%;
  margin-top: 0;
  padding-top: 20px;
  border-top: 1px solid rgba(255,255,255,.16);
  text-align: center;
}

@media (max-width: 768px) {
  .site-footer {
    padding: 34px 24px 20px;
  }
  .site-footer .footer-top {
    flex-direction: column;
    align-items: flex-start;
    gap: 22px;
    padding-bottom: 24px;
    margin-bottom: 24px;
  }
  .site-footer .footer-logo img {
    max-width: 170px;
    max-height: 60px;
  }
  .site-footer .footer-social {
    width: 100%;
    justify-content: flex-start;
  }
  .site-footer .footer-sections {
    display: block;
    margin-bottom: 26px;
  }
  .site-footer .footer-nav {
    margin-bottom: 28px;
  }
  .site-footer .footer-nav ul {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    column-gap: 24px;
    row-gap: 2px;
  }
  .site-footer .footer-columns {
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 24px 28px;
  }
  .site-footer .footer-col {
    min-width: 0;
  }
  .site-footer .footer-copy {
    font-size: .78rem;
    line-height: 1.6;
    letter-spacing: .04em;
  }
}

@media (max-width: 420px) {
  .site-footer .footer-columns {
    grid-template-columns: 1fr 1fr;
  }
}
</style>

<?php wp_footer(); ?>
</body>
</html>