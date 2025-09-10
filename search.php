<?php
/**
 * The template for displaying search results pages
 *
 * @package F3RVA
 * @since 1.0.0
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <div class="content-area">
            <div class="primary-content">
                <?php if (have_posts()) : ?>
                    <header class="page-header">
                        <h1 class="page-title">
                            <?php
                            /* translators: %s: search query. */
                            printf(__('Search Results for: %s', 'f3rva'), '<span>' . get_search_query() . '</span>');
                            ?>
                        </h1>
                    </header>
                    
                    <?php while (have_posts()) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <header class="entry-header">
                                <h2 class="entry-title">
                                    <a href="<?php the_permalink(); ?>" rel="bookmark">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>
                                
                                <?php if ('post' === get_post_type()) : ?>
                                    <div class="entry-meta">
                                        <span class="posted-on">
                                            <?php echo get_the_date(); ?>
                                        </span>
                                        <?php if (get_the_author()) : ?>
                                            <span class="byline">
                                                <?php _e('by', 'f3rva'); ?> 
                                                <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                                    <?php the_author(); ?>
                                                </a>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </header>
                            
                            <div class="entry-summary">
                                <?php the_excerpt(); ?>
                            </div>
                            
                            <footer class="entry-footer">
                                <a href="<?php the_permalink(); ?>" class="read-more">
                                    <?php _e('Read More', 'f3rva'); ?>
                                </a>
                            </footer>
                        </article>
                    <?php endwhile; ?>
                    
                    <?php
                    the_posts_pagination(array(
                        'prev_text' => __('Previous', 'f3rva'),
                        'next_text' => __('Next', 'f3rva'),
                    ));
                    ?>
                    
                <?php else : ?>
                    <section class="no-results not-found">
                        <header class="page-header">
                            <h1 class="page-title"><?php _e('Nothing Found', 'f3rva'); ?></h1>
                        </header>
                        
                        <div class="page-content">
                            <p><?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'f3rva'); ?></p>
                            <?php get_search_form(); ?>
                        </div>
                    </section>
                <?php endif; ?>
            </div>
            
            <?php get_sidebar(); ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>