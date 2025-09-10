<?php
/**
 * The template for displaying single posts
 *
 * @package F3RVA
 * @since 1.0.0
 */

get_header(); ?>

<main id="main" class="site-main">
    <div class="container">
        <div class="content-area">
            <div class="primary-content">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
                            <h1 class="entry-title"><?php the_title(); ?></h1>
                            
                            <div class="entry-meta">
                                <span class="posted-on">
                                    <time class="entry-date published" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                        <?php echo get_the_date(); ?>
                                    </time>
                                </span>
                                
                                <?php if (get_the_author()) : ?>
                                    <span class="byline">
                                        <?php _e('by', 'f3rva'); ?> 
                                        <span class="author vcard">
                                            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                                <?php the_author(); ?>
                                            </a>
                                        </span>
                                    </span>
                                <?php endif; ?>
                                
                                <?php if (has_category()) : ?>
                                    <span class="cat-links">
                                        <?php _e('in', 'f3rva'); ?> <?php the_category(', '); ?>
                                    </span>
                                <?php endif; ?>
                                
                                <?php if (has_tag()) : ?>
                                    <span class="tags-links">
                                        <?php the_tags(__('Tags: ', 'f3rva'), ', ', ''); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </header>
                        
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="post-thumbnail">
                                <?php the_post_thumbnail('large'); ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="entry-content">
                            <?php
                            the_content();
                            
                            wp_link_pages(array(
                                'before' => '<div class="page-links">' . __('Pages:', 'f3rva'),
                                'after'  => '</div>',
                            ));
                            ?>
                        </div>
                        
                        <footer class="entry-footer">
                            <?php if (wp_get_post_tags(get_the_ID())) : ?>
                                <div class="tag-links">
                                    <?php the_tags(__('Tagged with: ', 'f3rva'), ', ', ''); ?>
                                </div>
                            <?php endif; ?>
                        </footer>
                    </article>
                    
                    <?php
                    // Post navigation
                    $prev_post = get_previous_post();
                    $next_post = get_next_post();
                    
                    if ($prev_post || $next_post) : ?>
                        <nav class="post-navigation">
                            <h2 class="screen-reader-text"><?php _e('Post navigation', 'f3rva'); ?></h2>
                            <div class="nav-links">
                                <?php if ($prev_post) : ?>
                                    <div class="nav-previous">
                                        <a href="<?php echo esc_url(get_permalink($prev_post)); ?>">
                                            <span class="nav-subtitle"><?php _e('Previous:', 'f3rva'); ?></span>
                                            <span class="nav-title"><?php echo esc_html(get_the_title($prev_post)); ?></span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if ($next_post) : ?>
                                    <div class="nav-next">
                                        <a href="<?php echo esc_url(get_permalink($next_post)); ?>">
                                            <span class="nav-subtitle"><?php _e('Next:', 'f3rva'); ?></span>
                                            <span class="nav-title"><?php echo esc_html(get_the_title($next_post)); ?></span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </nav>
                    <?php endif; ?>
                    
                    <?php
                    // If comments are open or we have at least one comment, load up the comment template
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                    ?>
                    
                <?php endwhile; ?>
            </div>
            
            <?php get_sidebar(); ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>