<?php
/**
 * Aether Theme Functions
 */

if (!defined('ABSPATH')) {
    exit;
}

// Theme Setup
function aether_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
    add_theme_support('customize-selective-refresh-widgets');
    
    // Add image sizes
    add_image_size('aether-card', 600, 400, true);
    add_image_size('aether-hero', 1920, 1080, true);
    
    // Register menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'aether'),
        'footer' => __('Footer Menu', 'aether'),
    ));
}
add_action('after_setup_theme', 'aether_setup');

// Enqueue Scripts and Styles
function aether_scripts() {
    // Google Fonts
    wp_enqueue_style('aether-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap', array(), null);
    
    // Theme stylesheet
    wp_enqueue_style('aether-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Theme JavaScript
    wp_enqueue_script('aether-script', get_template_directory_uri() . '/js/aether.js', array(), '1.0.0', true);
    
    // Pass AJAX URL to script
    wp_localize_script('aether-script', 'aether_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('aether_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'aether_scripts');

// Register Widget Areas
function aether_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'aether'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here.', 'aether'),
        'before_widget' => '<section id="%1$s" class="widget glass-card %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer 1', 'aether'),
        'id'            => 'footer-1',
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer 2', 'aether'),
        'id'            => 'footer-2',
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer 3', 'aether'),
        'id'            => 'footer-3',
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'aether_widgets_init');

// Custom Excerpt Length
function aether_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'aether_excerpt_length', 999);

// Custom Excerpt More
function aether_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'aether_excerpt_more');

// Add custom class to navigation items
function aether_nav_menu_css_class($classes, $item, $args) {
    if ($args->theme_location === 'primary') {
        $classes[] = 'nav-item';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'aether_nav_menu_css_class', 10, 3);

// AJAX Load More Posts
function aether_load_more_posts() {
    check_ajax_referer('aether_nonce', 'nonce');
    
    $page = intval($_POST['page']);
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 6,
        'paged' => $page,
        'post_status' => 'publish'
    );
    
    $query = new WP_Query($args);
    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/content', 'card');
        }
    }
    
    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_aether_load_more', 'aether_load_more_posts');
add_action('wp_ajax_nopriv_aether_load_more', 'aether_load_more_posts');

// Customizer Settings
function aether_customize_register($wp_customize) {
    // Hero Section
    $wp_customize->add_section('aether_hero', array(
        'title' => __('Hero Section', 'aether'),
        'priority' => 30,
    ));
    
    $wp_customize->add_setting('hero_title', array(
        'default' => __('Welcome to Aether', 'aether'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_title', array(
        'label' => __('Hero Title', 'aether'),
        'section' => 'aether_hero',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('hero_subtitle', array(
        'default' => __('A modern WordPress theme for creative professionals', 'aether'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_subtitle', array(
        'label' => __('Hero Subtitle', 'aether'),
        'section' => 'aether_hero',
        'type' => 'textarea',
    ));
    
    $wp_customize->add_setting('hero_cta_text', array(
        'default' => __('Explore Our Work', 'aether'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_cta_text', array(
        'label' => __('CTA Button Text', 'aether'),
        'section' => 'aether_hero',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('hero_cta_link', array(
        'default' => '#portfolio',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('hero_cta_link', array(
        'label' => __('CTA Button Link', 'aether'),
        'section' => 'aether_hero',
        'type' => 'url',
    ));
}
add_action('customize_register', 'aether_customize_register');

// Disable WordPress default gallery styles
add_filter('use_default_gallery_style', '__return_false');

// Add defer attribute to scripts
function aether_defer_scripts($tag, $handle, $src) {
    if ('aether-script' === $handle) {
        return '<script src="' . $src . '" defer></script>';
    }
    return $tag;
}
add_filter('script_loader_tag', 'aether_defer_scripts', 10, 3);