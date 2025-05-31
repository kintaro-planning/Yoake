<?php
/**
 * functions.php
 * Yoake Theme Functions (最適化リファクタ版)
 */

// =====================
// テーマセットアップ
// =====================
function yoake_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'yoake'),
    ));
}
add_action('after_setup_theme', 'yoake_setup');

// =====================
// CSS・JSの読み込み
// =====================
function yoake_scripts() {
    wp_enqueue_style('yoake-style', get_stylesheet_uri(), array(), filemtime(get_stylesheet_directory() . '/style.css'));
    wp_enqueue_script('yoake-main', get_template_directory_uri() . '/main.js', array('jquery'), '1.0', true);

    // Slick Slider
    wp_enqueue_style('slick-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css');
    wp_enqueue_style('slick-theme-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css');
    wp_enqueue_script('slick-js', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', array('jquery'), '1.8.1', true);
}
add_action('wp_enqueue_scripts', 'yoake_scripts');

// =====================
// Google Fonts の読み込み
// =====================
function yoake_enqueue_google_fonts() {
    wp_enqueue_style(
        'yoake-google-fonts',
        'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Lato:wght@300;400;700&family=Roboto:wght@400;700&family=Open+Sans:wght@400;700&display=swap',
        array(),
        null
    );
}
add_action('wp_enqueue_scripts', 'yoake_enqueue_google_fonts');

// =====================
// カスタム投稿タイプ（お知らせ）
// =====================
function yoake_register_information_cpt() {
    $labels = array(
        'name'               => 'お知らせ',
        'singular_name'      => 'お知らせ',
        'menu_name'          => 'お知らせ',
        'add_new'            => '新規追加',
        'edit_item'          => 'お知らせを編集',
        'view_item'          => 'お知らせを表示',
        'all_items'          => 'すべてのお知らせ',
    );
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'rewrite'            => array('slug' => 'information'),
        'has_archive'        => true,
        'menu_position'      => 5,
        'taxonomies'         => array('post_tag'),
        'supports'           => array('title', 'editor', 'excerpt', 'thumbnail'),
    );
    register_post_type('information', $args);
}
add_action('init', 'yoake_register_information_cpt');

// =====================
// カスタム投稿タイプ（会社概要）→「1件運用」推奨
// =====================
function yoake_register_company_cpt() {
    $labels = array(
        'name'               => '会社概要',
        'singular_name'      => '会社概要',
        'menu_name'          => '会社概要',
        'add_new'            => '新規追加',
        'edit_item'          => '会社概要を編集',
        'view_item'          => '会社概要を表示',
        'all_items'          => 'すべての会社概要',
    );
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'rewrite'            => array('slug' => 'company'),
        'has_archive'        => false,
        'menu_position'      => 6,
        'supports'           => array('title', 'editor', 'thumbnail'),
    );
    register_post_type('company', $args);
}
add_action('init', 'yoake_register_company_cpt');

// =====================
// カスタマイザー設定
// =====================
function yoake_customize_register( $wp_customize ) {

    /* --- メインビジュアル設定 --- */
    $wp_customize->add_section('yoake_fv_section', array(
        'title'    => __('メインビジュアル設定', 'yoake'),
        'priority' => 30,
    ));
    // 動画
    $wp_customize->add_setting('yoake_fv_video', array(
        'default'           => '',
        'sanitize_callback' => 'yoake_sanitize_media',
    ));
    $wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'yoake_fv_video', array(
        'label'    => __('メインビジュアル動画', 'yoake'),
        'section'  => 'yoake_fv_section',
        'mime_type'=> 'video',
    )));
    // 画像
    $wp_customize->add_setting('yoake_fv_image', array(
        'default'           => '',
        'sanitize_callback' => 'yoake_sanitize_media',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'yoake_fv_image', array(
        'label'    => __('メインビジュアル画像', 'yoake'),
        'section'  => 'yoake_fv_section',
    )));
    // テキスト
    $wp_customize->add_setting('yoake_fv_text', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('yoake_fv_text', array(
        'label'    => __('メインビジュアルテキスト', 'yoake'),
        'section'  => 'yoake_fv_section',
        'type'     => 'text',
    ));
    // テキストサイズ
    $wp_customize->add_setting('yoake_fv_text_size', array(
        'default'           => 'medium',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('yoake_fv_text_size', array(
        'label'    => __('テキストサイズ', 'yoake'),
        'section'  => 'yoake_fv_section',
        'type'     => 'select',
        'choices'  => array(
            'small'  => '小',
            'medium' => '中',
            'large'  => '大',
        ),
    ));
    // テキスト位置
    $wp_customize->add_setting('yoake_fv_text_position', array(
        'default'           => 'center',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('yoake_fv_text_position', array(
        'label'    => __('テキスト位置', 'yoake'),
        'section'  => 'yoake_fv_section',
        'type'     => 'select',
        'choices'  => array(
            'top-left'       => '左上',
            'top-center'     => '中央上',
            'top-right'      => '右上',
            'middle-left'    => '左中',
            'center'         => '中央',
            'middle-right'   => '右中',
            'bottom-left'    => '左下',
            'bottom-center'  => '中央下',
            'bottom-right'   => '右下',
        ),
    ));
    // テキストアニメーション
    $wp_customize->add_setting('yoake_fv_text_animation', array(
        'default'           => 'fade',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('yoake_fv_text_animation', array(
        'label'    => __('テキストアニメーション', 'yoake'),
        'section'  => 'yoake_fv_section',
        'type'     => 'select',
        'choices'  => array(
            'fade'        => 'フェードイン',
            'typewriter'  => 'タイプライター',
            'pixel'       => 'ピクセル風',
            'stylish'     => 'スタイリッシュ',
        ),
    ));
    // テキストフォント
    $wp_customize->add_setting('yoake_fv_text_font', array(
        'default'           => 'default',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('yoake_fv_text_font', array(
        'label'    => __('テキストフォント', 'yoake'),
        'section'  => 'yoake_fv_section',
        'type'     => 'select',
        'choices'  => array(
            'default'     => 'デフォルト',
            'serif'       => 'セリフ体',
            'sans'        => 'サンセリフ',
            'roboto'      => 'Roboto',
            'open-sans'   => 'Open Sans',
            'montserrat'  => 'Montserrat',
            'lato'        => 'Lato',
        ),
    ));
    // テキスト行間
    $wp_customize->add_setting('yoake_fv_text_line_height', array(
        'default'           => '1.5',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('yoake_fv_text_line_height', array(
        'label'    => __('テキスト行間', 'yoake'),
        'section'  => 'yoake_fv_section',
        'type'     => 'text',
    ));

    /* --- コンテンツセクション設定 --- */
    $wp_customize->add_section('yoake_content_sections', array(
        'title'    => __('コンテンツセクション', 'yoake'),
        'priority' => 40,
    ));
    // メッセージエリア見出し
    $wp_customize->add_setting('yoake_heading_message', array(
        'default'           => 'メッセージ',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('yoake_heading_message', array(
        'label'    => __('メッセージエリア見出し', 'yoake'),
        'section'  => 'yoake_content_sections',
        'type'     => 'text',
    ));
    // メッセージエリアタイトル（本文上に表示）
    $wp_customize->add_setting('yoake_message_area_title', array(
        'default'           => 'メッセージタイトル',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('yoake_message_area_title', array(
        'label'    => __('メッセージエリア タイトル', 'yoake'),
        'section'  => 'yoake_content_sections',
        'type'     => 'text',
    ));
    $wp_customize->add_setting('yoake_message_image', array(
        'default'           => '',
        'sanitize_callback' => 'yoake_sanitize_media',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'yoake_message_image', array(
        'label'    => __('メッセージエリア画像', 'yoake'),
        'section'  => 'yoake_content_sections',
    )));
    $wp_customize->add_setting('yoake_message_text', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('yoake_message_text', array(
        'label'    => __('メッセージ本文', 'yoake'),
        'section'  => 'yoake_content_sections',
        'type'     => 'textarea',
    ));

    // お知らせ見出し設定
    $wp_customize->add_setting('yoake_heading_information', array(
        'default'           => 'Information',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('yoake_heading_information', array(
        'label'    => __('お知らせ見出し', 'yoake'),
        'section'  => 'yoake_content_sections',
        'type'     => 'text',
    ));

    // 関連記事見出し設定
    $wp_customize->add_setting('yoake_heading_latest', array(
        'default'           => 'Latest Posts',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('yoake_heading_latest', array(
        'label'    => __('関連記事見出し', 'yoake'),
        'section'  => 'yoake_content_sections',
        'type'     => 'text',
    ));

    // サービスエリア見出し設定
    $wp_customize->add_setting('yoake_heading_service', array(
        'default'           => 'Facility',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('yoake_heading_service', array(
        'label'    => __('サービスエリア見出し', 'yoake'),
        'section'  => 'yoake_content_sections',
        'type'     => 'text',
    ));
    $wp_customize->add_setting('yoake_heading_service_tagline', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('yoake_heading_service_tagline', array(
        'label'    => __('サービスエリアタグライン', 'yoake'),
        'section'  => 'yoake_content_sections',
        'type'     => 'text',
    ));
    $wp_customize->add_setting('yoake_heading_service_tagline_visible', array(
        'default'           => false,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    $wp_customize->add_control('yoake_heading_service_tagline_visible', array(
        'label'    => __('サービスエリアタグライン表示', 'yoake'),
        'section'  => 'yoake_content_sections',
        'type'     => 'checkbox',
    ));
    // サービス（事業内容）エリア：最大9件まで
    for ($i = 1; $i <= 9; $i++) {
        $wp_customize->add_setting("yoake_service_{$i}_visible", array(
            'default'           => false,
            'sanitize_callback' => 'wp_validate_boolean',
        ));
        $wp_customize->add_control("yoake_service_{$i}_visible", array(
            'label'    => "サービス{$i} 表示",
            'section'  => 'yoake_content_sections',
            'type'     => 'checkbox',
        ));
        $wp_customize->add_setting("yoake_service_{$i}_title", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("yoake_service_{$i}_title", array(
            'label'    => "サービス{$i} タイトル",
            'section'  => 'yoake_content_sections',
            'type'     => 'text',
        ));
        $wp_customize->add_setting("yoake_service_{$i}_desc", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_textarea_field',
        ));
        $wp_customize->add_control("yoake_service_{$i}_desc", array(
            'label'    => "サービス{$i} 説明",
            'section'  => 'yoake_content_sections',
            'type'     => 'textarea',
        ));
        $wp_customize->add_setting("yoake_service_{$i}_image", array(
            'default'           => '',
            'sanitize_callback' => 'yoake_sanitize_media',
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "yoake_service_{$i}_image", array(
            'label'    => "サービス{$i} 画像",
            'section'  => 'yoake_content_sections',
        )));
        // ★ここから追加：リンク設定★
        $wp_customize->add_setting("yoake_service_{$i}_link", array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control("yoake_service_{$i}_link", array(
            'label'    => "サービス{$i} 詳細リンクURL（空欄なら非表示）",
            'section'  => 'yoake_content_sections',
            'type'     => 'url',
        ));
    }

    // --- ギャラリーエリア設定 ---
    $wp_customize->add_section('yoake_gallery_section', array(
        'title'    => __('ギャラリーエリア設定', 'yoake'),
        'priority' => 45,
    ));
    $wp_customize->add_setting('yoake_gallery_visible', array(
        'default'           => false,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    $wp_customize->add_control('yoake_gallery_visible', array(
        'label'    => __('ギャラリーエリアを表示する', 'yoake'),
        'section'  => 'yoake_gallery_section',
        'type'     => 'checkbox',
    ));
    $wp_customize->add_setting('yoake_heading_gallery', array(
        'default'           => 'ギャラリー',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('yoake_heading_gallery', array(
        'label'    => __('ギャラリーエリア見出し', 'yoake'),
        'section'  => 'yoake_gallery_section',
        'type'     => 'text',
    ));
    $wp_customize->add_setting('yoake_heading_gallery_tagline', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('yoake_heading_gallery_tagline', array(
        'label'    => __('ギャラリーエリア タグライン', 'yoake'),
        'section'  => 'yoake_gallery_section',
        'type'     => 'text',
    ));
    $wp_customize->add_setting('yoake_heading_gallery_tagline_visible', array(
        'default'           => false,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    $wp_customize->add_control('yoake_heading_gallery_tagline_visible', array(
        'label'    => __('ギャラリーエリア タグライン表示', 'yoake'),
        'section'  => 'yoake_gallery_section',
        'type'     => 'checkbox',
    ));
    for ($i = 1; $i <= 20; $i++) {
        $wp_customize->add_setting("yoake_gallery_image_{$i}", array(
            'default'           => '',
            'sanitize_callback' => 'yoake_sanitize_media',
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "yoake_gallery_image_{$i}", array(
            'label'    => __("ギャラリー画像 {$i}", 'yoake'),
            'section'  => 'yoake_gallery_section',
        )));
        $wp_customize->add_setting("yoake_gallery_caption_{$i}", array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("yoake_gallery_caption_{$i}", array(
            'label'    => __("ギャラリーキャプション {$i}", 'yoake'),
            'section'  => 'yoake_gallery_section',
            'type'     => 'text',
        ));
    }

    // --- 見出し設定（タグライン・フォント） ---
    $wp_customize->add_section('yoake_headings_section', array(
        'title'    => __('見出し設定', 'yoake'),
        'priority' => 50,
    ));
    $wp_customize->add_setting('yoake_heading_font', array(
        'default'           => 'default',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('yoake_heading_font', array(
        'label'    => __('見出しフォント', 'yoake'),
        'section'  => 'yoake_headings_section',
        'type'     => 'select',
        'choices'  => array(
            'default'     => 'デフォルト',
            'serif'       => 'セリフ体',
            'sans'        => 'サンセリフ',
            'roboto'      => 'Roboto',
            'open-sans'   => 'Open Sans',
            'montserrat'  => 'Montserrat',
            'lato'        => 'Lato',
        ),
    ));
    $wp_customize->add_setting('yoake_heading_information_tagline', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('yoake_heading_information_tagline', array(
        'label'    => __('お知らせ見出し タグライン', 'yoake'),
        'section'  => 'yoake_headings_section',
        'type'     => 'text',
    ));
    $wp_customize->add_setting('yoake_heading_information_tagline_visible', array(
        'default'           => false,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    $wp_customize->add_control('yoake_heading_information_tagline_visible', array(
        'label'    => __('お知らせ見出し タグライン表示', 'yoake'),
        'section'  => 'yoake_headings_section',
        'type'     => 'checkbox',
    ));
    $wp_customize->add_setting('yoake_heading_message_tagline', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('yoake_heading_message_tagline', array(
        'label'    => __('メッセージ見出し タグライン', 'yoake'),
        'section'  => 'yoake_headings_section',
        'type'     => 'text',
    ));
    $wp_customize->add_setting('yoake_heading_message_tagline_visible', array(
        'default'           => false,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    $wp_customize->add_control('yoake_heading_message_tagline_visible', array(
        'label'    => __('メッセージ見出し タグライン表示', 'yoake'),
        'section'  => 'yoake_headings_section',
        'type'     => 'checkbox',
    ));
    $wp_customize->add_setting('yoake_heading_service_tagline', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('yoake_heading_service_tagline', array(
        'label'    => __('サービス見出し タグライン', 'yoake'),
        'section'  => 'yoake_headings_section',
        'type'     => 'text',
    ));
    $wp_customize->add_setting('yoake_heading_service_tagline_visible', array(
        'default'           => false,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    $wp_customize->add_control('yoake_heading_service_tagline_visible', array(
        'label'    => __('サービス見出し タグライン表示', 'yoake'),
        'section'  => 'yoake_headings_section',
        'type'     => 'checkbox',
    ));
    $wp_customize->add_setting('yoake_heading_latest_tagline', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('yoake_heading_latest_tagline', array(
        'label'    => __('関連記事見出し タグライン', 'yoake'),
        'section'  => 'yoake_headings_section',
        'type'     => 'text',
    ));
    $wp_customize->add_setting('yoake_heading_latest_tagline_visible', array(
        'default'           => false,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    $wp_customize->add_control('yoake_heading_latest_tagline_visible', array(
        'label'    => __('関連記事見出し タグライン表示', 'yoake'),
        'section'  => 'yoake_headings_section',
        'type'     => 'checkbox',
    ));

    // =====================
    // 会社概要（カスタマイザー）
    // =====================
    $wp_customize->add_section('yoake_company_section', array(
        'title'    => __('会社（事業者）情報', 'yoake'),
        'priority' => 60,
    ));
    // 会社情報：リピーター配列（JSON保存）
    $wp_customize->add_setting('yoake_company_details', array(
        'default'           => json_encode([]),
        'sanitize_callback' => function($input){
            $arr = json_decode($input, true);
            if(!is_array($arr)) return json_encode([]);
            // サニタイズ
            foreach($arr as &$row){
                $row['label'] = sanitize_text_field($row['label'] ?? '');
                $row['value'] = sanitize_text_field($row['value'] ?? '');
            }
            return json_encode($arr);
        }
    ));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'yoake_company_details',
        array(
            'label' => '会社（事業者）情報リスト（例：会社名、屋号、代表者、所在地…）',
            'section' => 'yoake_company_section',
            'type' => 'textarea', // ★JSONを直接入力（あとでUI拡張可）
            'description' => '例: [{"label":"会社名","value":"〇〇株式会社"},{"label":"所在地","value":"東京都〇〇区"}]'
        )
    ));
} // ←ここでカスタマイザーの関数を閉じる

add_action('customize_register', 'yoake_customize_register');

define('YOAKE_GALLERY_MAX', 10); // 最大10件に

// =====================
// メディアURL/IDサニタイズ用ヘルパー
// =====================
function yoake_sanitize_media( $input ) {
    if ( is_numeric($input) ) {
        $url = wp_get_attachment_url( intval($input) );
        return $url ? esc_url_raw($url) : '';
    }
    return esc_url_raw($input);
}