<?php
/**
 * front-page.php
 * Yoake テーマ標準
 */
$preloader_image = get_theme_mod('yoake_preloader_image');
if ( $preloader_image ) : ?>
  <div id="preloader">
    <img src="<?php echo esc_url($preloader_image); ?>" alt="Preloader">
  </div>
<?php endif; ?>

<?php get_header(); ?>

<?php
$heading_font = get_theme_mod('yoake_heading_font', 'default');

// メインビジュアル用の各種設定
$fv_video           = get_theme_mod('yoake_fv_video');
$fv_image           = get_theme_mod('yoake_fv_image');
$fv_text            = get_theme_mod('yoake_fv_text');
$fv_text_size       = get_theme_mod('yoake_fv_text_size', 'medium');
$fv_text_position   = get_theme_mod('yoake_fv_text_position', 'center');
$fv_text_animation  = get_theme_mod('yoake_fv_text_animation', 'fade');
$fv_text_font       = get_theme_mod('yoake_fv_text_font', 'default');
$fv_text_line_height= get_theme_mod('yoake_fv_text_line_height', '1.5');
$overlay_classes    = 'fv-overlay fv-text-size-' . esc_attr($fv_text_size)
                      . ' fv-text-position-' . esc_attr($fv_text_position)
                      . ' fv-text-animation-' . esc_attr($fv_text_animation)
                      . ' fv-text-font-' . esc_attr($fv_text_font);
?>

<!-- メインビジュアルセクション -->
<section id="fv">
  <?php if ( $fv_video ) : ?>
    <video id="fv-video" autoplay muted loop playsinline>
      <source src="<?php echo esc_url($fv_video); ?>" type="video/mp4">
    </video>
  <?php elseif ( $fv_image ) : ?>
    <img id="fv-image" src="<?php echo esc_url($fv_image); ?>" alt="<?php bloginfo('name'); ?>">
  <?php else : ?>
    <p>※ メインビジュアルの動画または画像が設定されていません。</p>
  <?php endif; ?>
  <div class="<?php echo $overlay_classes; ?>" style="line-height: <?php echo esc_attr($fv_text_line_height); ?>;">
    <?php if ( $fv_text ) : ?>
      <h1><?php echo nl2br(esc_html($fv_text)); ?></h1>
    <?php endif; ?>
  </div>
  <!-- スクロールボタン -->
  <button id="skip-button">
    <span class="skip-text">Scroll</span>
    <span class="skip-arrow">&#x2193;</span>
  </button>
</section>

<!-- お知らせエリア -->
<section id="information-posts" class="animate">
  <?php
    $info_heading    = get_theme_mod('yoake_heading_information', 'Information');
    $info_tagline    = get_theme_mod('yoake_heading_information_tagline', '');
    $info_tagline_visible = get_theme_mod('yoake_heading_information_tagline_visible', false);
  ?>
  <header class="section-header" style="font-family: <?php echo esc_attr($heading_font); ?>;">
    <?php if ( $info_tagline_visible && $info_tagline ) : ?>
      <p class="heading-tagline"><?php echo esc_html($info_tagline); ?></p>
    <?php endif; ?>
    <h2><?php echo esc_html($info_heading); ?></h2>
  </header>
  <div class="information-container">
    <div class="information-list">
      <?php
      $info_query = new WP_Query(array(
          'post_type'      => 'information',
          'posts_per_page' => 3,
      ));
      if ( $info_query->have_posts() ) :
          while ( $info_query->have_posts() ) : $info_query->the_post();
              $tags = get_the_terms(get_the_ID(), 'post_tag');
      ?>
          <article class="information-item">
            <div class="information-date"><?php echo get_the_date(); ?></div>
            <?php if ($tags && !is_wp_error($tags)) : ?>
              <div class="information-tag">
                <?php foreach ($tags as $tag) : ?>
                  <span class="tag"><?php echo esc_html($tag->name); ?></span>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
            <h3 class="information-title">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>
          </article>
      <?php endwhile; wp_reset_postdata(); else : ?>
          <p>お知らせはありません。</p>
      <?php endif; ?>
    </div>
    <div class="information-more">
      <a href="<?php echo home_url('/information/'); ?>">一覧を見る</a>
    </div>
  </div>
</section>

<!-- メッセージエリア -->
<section id="message-area" class="animate">
  <?php 
    $msg_heading          = get_theme_mod('yoake_heading_message', 'メッセージ');
    $msg_tagline          = get_theme_mod('yoake_heading_message_tagline', '');
    $msg_tagline_visible  = get_theme_mod('yoake_heading_message_tagline_visible', false);
    $msg_area_title       = get_theme_mod('yoake_message_area_title', 'メッセージタイトル');
    $msg_image            = get_theme_mod('yoake_message_image');
    $msg_text             = get_theme_mod('yoake_message_text', '');
  ?>
  <header class="section-header" style="font-family: <?php echo esc_attr($heading_font); ?>;">
    <?php if ($msg_tagline_visible && !empty($msg_tagline)) : ?>
      <p class="heading-tagline"><?php echo esc_html($msg_tagline); ?></p>
    <?php endif; ?>
    <h2><?php echo esc_html($msg_heading); ?></h2>
  </header>
  <div class="message-content">
    <!-- 左カラム：画像 -->
    <div class="message-left">
      <?php if ($msg_image) : ?>
        <img src="<?php echo esc_url($msg_image); ?>" alt="Message Image">
      <?php else : ?>
        <div class="message-placeholder">画像はありません</div>
      <?php endif; ?>
    </div>
    <!-- 右カラム：テキスト -->
    <div class="message-right">
      <div class="message-area-title">
        <h3><?php echo esc_html($msg_area_title); ?></h3>
      </div>
      <div class="message-text">
        <div class="part-1">
          <?php
            $limit = 80;
            $full_text = wp_kses_post(nl2br($msg_text));
            $text_part1 = mb_substr($full_text, 0, $limit);
            $text_part2 = mb_substr($full_text, $limit);
          ?>
          <?php echo $text_part1; ?>
        </div>
        <div class="part-2" style="display: none;">
          <?php echo $text_part2; ?>
        </div>
      </div>
      <div class="message-more">
        <span class="btn-more">続きを読む</span>
        <span class="btn-back" style="display:none;">閉じる</span>
      </div>
    </div>
  </div>
</section>

<!-- サービスエリア -->
<section id="service-area" class="animate">
  <?php
    $service_heading  = get_theme_mod('yoake_heading_service', 'Facility');
    $service_tagline  = get_theme_mod('yoake_heading_service_tagline', '');
    $service_tagline_visible = get_theme_mod('yoake_heading_service_tagline_visible', false);
  ?>
  <header class="section-header" style="font-family: <?php echo esc_attr($heading_font); ?>;">
    <?php if ( $service_tagline_visible && $service_tagline ) : ?>
      <p class="heading-tagline"><?php echo esc_html($service_tagline); ?></p>
    <?php endif; ?>
    <h2><?php echo esc_html($service_heading); ?></h2>
  </header>
  <div class="service-facility-list">
    <?php
    for ($i = 1; $i <= 9; $i++) :
        $service_visible = get_theme_mod("yoake_service_{$i}_visible", false);
        $service_title = get_theme_mod("yoake_service_{$i}_title", '');
        $service_desc  = get_theme_mod("yoake_service_{$i}_desc", '');
        $service_image = get_theme_mod("yoake_service_{$i}_image", '');
        $service_link  = get_theme_mod("yoake_service_{$i}_link", ''); // ←追加！
        if (!$service_visible || (empty($service_title) && empty($service_desc) && empty($service_image))) continue;
        $layout_class  = ($i % 2 === 1) ? 'image-left' : 'image-right';
    ?>
      <div class="service-facility-item <?php echo $layout_class; ?>">
        <?php if ($service_image) : ?>
          <div class="service-facility-image">
            <img src="<?php echo esc_url($service_image); ?>" alt="<?php echo esc_attr($service_title); ?>">
          </div>
        <?php else : ?>
          <div class="service-facility-image fallback">
            <?php 
              $custom_logo_id = get_theme_mod('custom_logo');
              if ($custom_logo_id) {
                echo wp_get_attachment_image($custom_logo_id, 'medium');
              }
            ?>
          </div>
        <?php endif; ?>
        <div class="service-facility-text">
          <?php if ($service_title) : ?>
            <h3><?php echo esc_html($service_title); ?></h3>
          <?php endif; ?>
          <?php if ($service_desc) : ?>
            <p><?php echo nl2br(esc_html($service_desc)); ?></p>
          <?php endif; ?>
          <?php if ($service_link): ?>
            <p>
              <a href="<?php echo esc_url($service_link); ?>" class="service-detail-link" target="_blank" rel="noopener">詳しくはこちら</a>
            </p>
          <?php endif; ?>
        </div>
      </div>
    <?php endfor; ?>
  </div>
</section>

<!-- ギャラリーエリア -->
<?php 
  $gallery_visible = get_theme_mod('yoake_gallery_visible', false);
  if ($gallery_visible) :
      $gallery_heading = get_theme_mod('yoake_heading_gallery', 'ギャラリー');
      $gallery_tagline = get_theme_mod('yoake_heading_gallery_tagline', '');
      $gallery_tagline_visible = get_theme_mod('yoake_heading_gallery_tagline_visible', false);
?>
  <section id="gallery-area" class="animate">
    <header class="section-header" style="font-family: <?php echo esc_attr($heading_font); ?>;">
      <?php if ($gallery_tagline_visible && $gallery_tagline) : ?>
        <p class="heading-tagline"><?php echo esc_html($gallery_tagline); ?></p>
      <?php endif; ?>
      <h2><?php echo esc_html($gallery_heading); ?></h2>
    </header>
    <div class="gallery-slider">
      <?php 
      for ($i = 1; $i <= 20; $i++) {
         $gallery_image = get_theme_mod("yoake_gallery_image_{$i}");
         $gallery_caption = get_theme_mod("yoake_gallery_caption_{$i}");
         if ($gallery_image) {
             ?>
             <div class="gallery-card">
                 <div class="gallery-image-container">
                     <img src="<?php echo esc_url($gallery_image); ?>" alt="<?php echo esc_attr($gallery_caption); ?>">
                 </div>
                 <?php if ($gallery_caption): ?>
                    <p class="gallery-caption"><?php echo esc_html($gallery_caption); ?></p>
                 <?php endif; ?>
             </div>
             <?php
         }
      }
      ?>
    </div>
  </section>
<?php endif; ?>

<!-- 最新記事エリア -->
<section id="latest-posts" class="animate">
  <?php
    $latest_heading    = get_theme_mod('yoake_heading_latest', 'Latest Posts');
    $latest_tagline    = get_theme_mod('yoake_heading_latest_tagline', '');
    $latest_tagline_visible = get_theme_mod('yoake_heading_latest_tagline_visible', false);
  ?>
  <header class="section-header" style="font-family: <?php echo esc_attr($heading_font); ?>;">
    <?php if ($latest_tagline_visible && !empty($latest_tagline)) : ?>
      <p class="heading-tagline"><?php echo esc_html($latest_tagline); ?></p>
    <?php endif; ?>
    <h2><?php echo esc_html($latest_heading); ?></h2>
  </header>
  <div class="posts-slider">
    <?php
    $latest_posts = new WP_Query(array(
        'posts_per_page' => 3,
    ));
    if ($latest_posts->have_posts()) :
      while ($latest_posts->have_posts()) : $latest_posts->the_post(); ?>
          <a href="<?php the_permalink(); ?>" class="post-card">
              <?php if (has_post_thumbnail()) : ?>
                <div class="post-thumbnail">
                  <?php the_post_thumbnail('medium'); ?>
                </div>
              <?php else:
                $custom_logo_id = get_theme_mod('custom_logo');
                if ($custom_logo_id) : ?>
                  <div class="post-thumbnail fallback-logo">
                    <?php echo wp_get_attachment_image($custom_logo_id, 'medium'); ?>
                  </div>
              <?php endif; endif; ?>
              <h3><?php the_title(); ?></h3>
          </a>
    <?php endwhile; wp_reset_postdata(); endif; ?>
  </div>
</section>

<!-- 会社概要エリア -->
<section id="company-profile" class="animate">
  <div class="company-card">
    <div class="company-card-body">
      <dl class="company-details">
        <?php
          for($i=1; $i<=10; $i++) {
            $label = get_theme_mod("yoake_company_label_$i", '');
            $value = get_theme_mod("yoake_company_value_$i", '');
            if(!empty($label) || !empty($value)):
        ?>
          <div class="company-detail-item">
            <dt class="detail-label"><?php echo esc_html($label); ?></dt>
            <dd class="detail-value"><?php echo esc_html($value); ?></dd>
          </div>
        <?php
            endif;
          }
        ?>
      </dl>
    </div>
  </div>
</section>
?>

<?php get_footer(); ?>