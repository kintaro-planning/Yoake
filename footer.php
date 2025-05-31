<?php get_sidebar(); ?>
<footer>
    <div class="social-links">
        <?php if ( $twitter = get_theme_mod('yoake_twitter_url') ) : ?>
            <a href="<?php echo esc_url( $twitter ); ?>" target="_blank" rel="noopener"><i class="fab fa-twitter"></i></a>
        <?php endif; ?>
        <?php if ( $facebook = get_theme_mod('yoake_facebook_url') ) : ?>
            <a href="<?php echo esc_url( $facebook ); ?>" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a>
        <?php endif; ?>
        <?php if ( $instagram = get_theme_mod('yoake_instagram_url') ) : ?>
            <a href="<?php echo esc_url( $instagram ); ?>" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a>
        <?php endif; ?>
        <?php if ( $linkedin = get_theme_mod('yoake_linkedin_url') ) : ?>
            <a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i></a>
        <?php endif; ?>
    </div>
    <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
</footer>
<?php wp_footer(); ?>
</body>
</html>