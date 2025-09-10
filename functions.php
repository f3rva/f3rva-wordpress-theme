<?php
/**
 * F3 RVA Theme Functions
 *
 * @package F3RVA
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme setup function
 */
function f3rva_setup() {
    // Add theme support for post thumbnails
    add_theme_support('post-thumbnails');
    
    // Add theme support for document title tag
    add_theme_support('title-tag');
    
    // Add theme support for HTML5 markup
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    
    // Add theme support for custom logo
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
    // Add theme support for custom background
    add_theme_support('custom-background', array(
        'default-color' => 'ffffff',
    ));
    
    // Add theme support for automatic feed links
    add_theme_support('automatic-feed-links');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Navigation', 'f3rva'),
        'footer'  => __('Footer Navigation', 'f3rva'),
    ));
    
    // Set content width
    if (!isset($content_width)) {
        $content_width = 800;
    }
}
add_action('after_setup_theme', 'f3rva_setup');

/**
 * Enqueue scripts and styles
 */
function f3rva_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style('f3rva-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Enqueue Google Fonts (optional)
    wp_enqueue_style('f3rva-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap', array(), null);
    
    // Enqueue comment reply script on single posts/pages with comments open
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    
    // Enqueue main theme JavaScript (if needed)
    wp_enqueue_script('f3rva-main', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'f3rva_scripts');

/**
 * Register widget areas
 */
function f3rva_widgets_init() {
    register_sidebar(array(
        'name'          => __('Primary Sidebar', 'f3rva'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here to appear in your sidebar.', 'f3rva'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer Widgets', 'f3rva'),
        'id'            => 'footer-widgets',
        'description'   => __('Add widgets here to appear in your footer.', 'f3rva'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'f3rva_widgets_init');

/**
 * Custom excerpt length
 */
function f3rva_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'f3rva_excerpt_length');

/**
 * Custom excerpt more text
 */
function f3rva_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'f3rva_excerpt_more');

/**
 * Add custom classes to body
 */
function f3rva_body_classes($classes) {
    // Add class for pages without sidebar
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }
    
    return $classes;
}
add_filter('body_class', 'f3rva_body_classes');

/**
 * Customizer settings
 */
function f3rva_customize_register($wp_customize) {
    // Add a section for theme options
    $wp_customize->add_section('f3rva_options', array(
        'title'    => __('F3 RVA Options', 'f3rva'),
        'priority' => 30,
    ));
    
    // Add setting for footer text
    $wp_customize->add_setting('f3rva_footer_text', array(
        'default'           => __('© 2025 F3 RVA. All rights reserved.', 'f3rva'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    // Add control for footer text
    $wp_customize->add_control('f3rva_footer_text', array(
        'label'    => __('Footer Text', 'f3rva'),
        'section'  => 'f3rva_options',
        'type'     => 'text',
    ));
}
add_action('customize_register', 'f3rva_customize_register');

/**
 * Get custom footer text
 */
function f3rva_get_footer_text() {
    return get_theme_mod('f3rva_footer_text', __('© 2025 F3 RVA. All rights reserved.', 'f3rva'));
}