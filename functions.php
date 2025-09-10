<?php
/**
 * Theme functions and definitions
 * 
 * @package F3RVA
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Setup theme defaults and register features
 */
function f3rva_setup() {
    // Add theme support for various features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    add_theme_support('editor-styles');
    add_theme_support('responsive-embeds');
    
    // Register navigation menu
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'f3rva'),
    ));
    
    // Set content width
    $GLOBALS['content_width'] = apply_filters('f3rva_content_width', 800);
}
add_action('after_setup_theme', 'f3rva_setup');

/**
 * Enqueue scripts and styles
 */
function f3rva_scripts() {
    // Theme stylesheet
    wp_enqueue_style(
        'f3rva-style',
        get_stylesheet_uri(),
        array(),
        wp_get_theme()->get('Version')
    );
    
    // Add responsive font loading
    wp_enqueue_style(
        'f3rva-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap',
        array(),
        null
    );
    
    // Theme script (if needed)
    wp_enqueue_script(
        'f3rva-script',
        get_template_directory_uri() . '/js/theme.js',
        array(),
        wp_get_theme()->get('Version'),
        true
    );
    
    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'f3rva_scripts');

/**
 * Custom excerpt length
 */
function f3rva_excerpt_length($length) {
    return 30;
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
 * Add custom body classes
 */
function f3rva_body_classes($classes) {
    // Add class for single posts
    if (is_single()) {
        $classes[] = 'single-post';
    }
    
    // Add class for post archives
    if (is_home() || is_archive()) {
        $classes[] = 'post-archive';
    }
    
    return $classes;
}
add_filter('body_class', 'f3rva_body_classes');

/**
 * Customize post meta display
 */
function f3rva_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if (get_the_time('U') !== get_the_modified_time('U')) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf($time_string,
        esc_attr(get_the_date(DATE_W3C)),
        esc_html(get_the_date()),
        esc_attr(get_the_modified_date(DATE_W3C)),
        esc_html(get_the_modified_date())
    );

    $posted_on = sprintf(
        /* translators: %s: post date. */
        esc_html_x('Posted on %s', 'post date', 'f3rva'),
        '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
    );

    echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Display post categories
 */
function f3rva_posted_in() {
    $categories_list = get_the_category_list(esc_html__(', ', 'f3rva'));
    if ($categories_list) {
        /* translators: 1: list of categories. */
        printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'f3rva') . '</span>', $categories_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
}

/**
 * Display post tags
 */
function f3rva_posted_tags() {
    $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'f3rva'));
    if ($tags_list) {
        /* translators: 1: list of tags. */
        printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'f3rva') . '</span>', $tags_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
}

/**
 * Add editor styles
 */
function f3rva_add_editor_styles() {
    add_editor_style('editor-style.css');
}
add_action('admin_init', 'f3rva_add_editor_styles');

/**
 * Custom comment callback
 */
function f3rva_comment_callback($comment, $args, $depth) {
    if ('div' === $args['style']) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo $tag; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?> id="comment-<?php comment_ID(); ?>">
    <?php if ('div' !== $args['style']) : ?>
        <div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
    <?php endif; ?>
    
    <div class="comment-author vcard">
        <?php if (0 !== $args['avatar_size']) echo get_avatar($comment, $args['avatar_size']); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        <?php printf('<cite class="fn">%s</cite>', get_comment_author_link()); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
    </div>
    
    <?php if ('0' === $comment->comment_approved) : ?>
        <em class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'f3rva'); ?></em>
        <br />
    <?php endif; ?>

    <div class="comment-meta commentmetadata">
        <a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
            <?php printf(esc_html__('%1$s at %2$s', 'f3rva'), get_comment_date(), get_comment_time()); ?>
        </a>
        <?php edit_comment_link(esc_html__('(Edit)', 'f3rva'), '  ', ''); ?>
    </div>

    <?php comment_text(); ?>

    <div class="reply">
        <?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
    </div>
    
    <?php if ('div' !== $args['style']) : ?>
        </div>
    <?php endif; ?>
    <?php
}

/**
 * Remove unnecessary WordPress features for a minimal theme
 */
function f3rva_cleanup() {
    // Remove emoji scripts
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    
    // Remove WordPress generator tag
    remove_action('wp_head', 'wp_generator');
    
    // Remove REST API link
    remove_action('wp_head', 'rest_output_link_wp_head');
    
    // Remove shortlink
    remove_action('wp_head', 'wp_shortlink_wp_head');
}
add_action('init', 'f3rva_cleanup');

/**
 * Improve performance by removing unused scripts
 */
function f3rva_performance_tweaks() {
    // Remove block library CSS on non-admin pages if not needed
    if (!is_admin()) {
        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('wp-block-library-theme');
        wp_dequeue_style('wc-block-style'); // WooCommerce blocks
    }
}
add_action('wp_enqueue_scripts', 'f3rva_performance_tweaks', 100);