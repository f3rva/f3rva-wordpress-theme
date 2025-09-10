<?php
/**
 * The template for displaying archive pages
 *
 * @package F3RVA
 * @since 1.0.0
 */

get_header();
?>

<?php if (have_posts()) : ?>

    <header class="page-header">
        <?php
        the_archive_title('<h1 class="page-title">', '</h1>');
        the_archive_description('<div class="archive-description">', '</div>');
        ?>
    </header><!-- .page-header -->

    <?php
    // Start the Loop.
    while (have_posts()) :
        the_post();
    ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
            <header class="entry-header">
                <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>

                <div class="entry-meta">
                    <?php f3rva_posted_on(); ?>
                    <?php if (get_the_category_list()) : ?>
                        <span class="meta-separator"> • </span>
                        <?php f3rva_posted_in(); ?>
                    <?php endif; ?>
                </div><!-- .entry-meta -->
            </header><!-- .entry-header -->

            <div class="entry-content">
                <div class="entry-summary">
                    <?php the_excerpt(); ?>
                    <a href="<?php echo esc_url(get_permalink()); ?>" class="read-more">
                        <?php esc_html_e('Read more', 'f3rva'); ?>
                    </a>
                </div><!-- .entry-summary -->
            </div><!-- .entry-content -->
        </article><!-- #post-<?php the_ID(); ?> -->

    <?php
    endwhile;

    // Navigation for archive pages
    the_posts_pagination(array(
        'mid_size'  => 2,
        'prev_text' => esc_html__('Previous', 'f3rva'),
        'next_text' => esc_html__('Next', 'f3rva'),
    ));

else :
    ?>
    <section class="no-results not-found">
        <header class="page-header">
            <h1 class="page-title"><?php esc_html_e('Nothing here', 'f3rva'); ?></h1>
        </header><!-- .page-header -->

        <div class="page-content">
            <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'f3rva'); ?></p>
            <?php get_search_form(); ?>
        </div><!-- .page-content -->
    </section><!-- .no-results -->
<?php endif; ?>

<?php
get_footer();