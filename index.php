<?php get_header(); ?>
<main>
  <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>
      <article <?php post_class(); ?>>
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <div class="post-meta">
          <span><?php the_time('Y/m/d'); ?></span>
        </div>
        <div class="post-content">
          <?php the_excerpt(); ?>
        </div>
      </article>
    <?php endwhile; ?>
  <?php else : ?>
    <p><?php _e('投稿が見つかりませんでした。', 'yoake'); ?></p>
  <?php endif; ?>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
