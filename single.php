<?php
/**
 * The template for displaying single posts
 *
 * @package F3RVA
 * @since 1.0.0
 */

get_header();
?>

<?php
while (have_posts()) :
    the_post();
?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>

            <div class="entry-meta">
                <?php f3rva_posted_on(); ?>
                <?php if (get_the_category_list()) : ?>
                    <span class="meta-separator"> • </span>
                    <?php f3rva_posted_in(); ?>
                <?php endif; ?>
            </div><!-- .entry-meta -->
        </header><!-- .entry-header -->

        <div class="entry-content">
            <?php
            the_content(sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. */
                    __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'f3rva'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                wp_kses_post(get_the_title())
            ));

            wp_link_pages(array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'f3rva'),
                'after'  => '</div>',
            ));
            ?>
        </div><!-- .entry-content -->

        <footer class="entry-footer">
            <div class="entry-meta">
                <?php f3rva_posted_tags(); ?>
            </div>
        </footer><!-- .entry-footer -->
    </article><!-- #post-<?php the_ID(); ?> -->

    <?php
    // Post navigation
    the_post_navigation(array(
        'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous:', 'f3rva') . '</span> <span class="nav-title">%title</span>',
        'next_text' => '<span class="nav-subtitle">' . esc_html__('Next:', 'f3rva') . '</span> <span class="nav-title">%title</span>',
    ));

    // If comments are open or we have at least one comment, load up the comment template.
    if (comments_open() || get_comments_number()) :
        comments_template();
    endif;

endwhile; // End of the loop.
?>

<?php
get_footer();