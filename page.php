<?php get_header(); ?>
<main>
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article <?php post_class(); ?>>
      <h1><?php the_title(); ?></h1>
      <div class="page-content">
        <?php the_content(); ?>
      </div>
    </article>
  <?php endwhile; endif; ?>
</main>
<?php get_footer(); ?>
