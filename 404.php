<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package F3RVA
 * @since 1.0.0
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <div class="content-area">
            <div class="primary-content">
                <section class="error-404 not-found">
                    <header class="page-header">
                        <h1 class="page-title"><?php _e('Oops! That page can&rsquo;t be found.', 'f3rva'); ?></h1>
                    </header>
                    
                    <div class="page-content">
                        <p><?php _e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'f3rva'); ?></p>
                        
                        <?php get_search_form(); ?>
                        
                        <div class="widget widget_recent_entries">
                            <h2 class="widget-title"><?php _e('Most Used Categories', 'f3rva'); ?></h2>
                            <ul>
                                <?php
                                wp_list_categories(array(
                                    'orderby'    => 'count',
                                    'order'      => 'DESC',
                                    'show_count' => 1,
                                    'title_li'   => '',
                                    'number'     => 10,
                                ));
                                ?>
                            </ul>
                        </div>
                        
                        <?php
                        // Only show the widget if site has multiple published authors
                        if (f3rva_get_multiple_authors()) :
                        ?>
                            <div class="widget widget_authors">
                                <h2 class="widget-title"><?php _e('Try looking in the monthly archives', 'f3rva'); ?></h2>
                                <ul>
                                    <?php
                                    wp_get_archives(array(
                                        'type'  => 'monthly',
                                        'limit' => 12,
                                    ));
                                    ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        
                        <div class="widget widget_tag_cloud">
                            <h2 class="widget-title"><?php _e('Tag Cloud', 'f3rva'); ?></h2>
                            <?php wp_tag_cloud(); ?>
                        </div>
                    </div>
                </section>
            </div>
            
            <?php get_sidebar(); ?>
        </div>
    </div>
</main>

<?php
/**
 * Check if site has multiple published authors
 */
function f3rva_get_multiple_authors() {
    $user_count = count_users();
    $published_authors = $user_count['avail_roles']['author'] + $user_count['avail_roles']['editor'] + $user_count['avail_roles']['administrator'];
    return $published_authors > 1;
}

get_footer(); ?>