<?php
/**
 * single.php
 *
 * ブログ記事の詳細ページテンプレート
 */

get_header();
?>

<main id="main" role="main">

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
      <!-- 共通のセクション見出しスタイルを流用 -->
      <header class="section-header">
        <h2><?php the_title(); ?></h2>
        <div class="post-meta">
          <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
            <?php echo esc_html( get_the_date() ); ?>
          </time>
          <?php if ( get_the_tag_list() ) : ?>
            <div class="tags"><?php echo get_the_tag_list('',', '); ?></div>
          <?php endif; ?>
        </div>
      </header>

      <!-- アイキャッチ -->
      <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-featured-image">
          <?php the_post_thumbnail('full'); ?>
        </div>
      <?php endif; ?>

      <!-- 本文 -->
      <div class="post-content">
        <?php
          the_content();
          wp_link_pages(array(
            'before' => '<nav class="page-links">',
            'after'  => '</nav>',
          ));
        ?>
      </div>
    </article>
  <?php endwhile; endif; ?>

</main>

<?php get_footer(); ?>