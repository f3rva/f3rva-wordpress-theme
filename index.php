<?php
/**
 * The main template file for the F3RVA theme.
 *
 * This displays the blog index and a simple front-page hero when viewing the
 * site home. It falls back to the standard loop for archives.
 *
 * @package F3RVA
 */

get_header();
?>

<?php if (is_front_page() && is_home()) : ?>
    <section class="site-hero">
        <div class="container">
            <?php if (function_exists('the_custom_logo') && has_custom_logo()) : ?>
                <div class="site-logo"><?php the_custom_logo(); ?></div>
            <?php endif; ?>

            <h1 class="hero-title"><?php bloginfo('name'); ?></h1>
            <p class="hero-subtitle"><?php bloginfo('description'); ?></p>

            <div class="hero-cta">
                <a class="btn btn-primary" href="<?php echo esc_url(home_url('/schedule')); ?>"><?php esc_html_e('Find a Workout', 'f3rva'); ?></a>
                <a class="btn btn-outline" href="<?php echo esc_url(home_url('/about')); ?>"><?php esc_html_e('Learn More', 'f3rva'); ?></a>
            </div>
        </div>
    </section>
<?php endif; ?>

<main id="primary" class="site-main">
    <div class="container">
        <?php if (have_posts()) : ?>

            <?php /* Start the Loop */ ?>
            <?php while (have_posts()) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail">
                            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
                        </div>
                    <?php endif; ?>

                    <header class="entry-header">
                        <?php the_title(sprintf('<h2 class="entry-title"><a href="%s">', esc_url(get_permalink())), '</a></h2>'); ?>
                        <div class="entry-meta">
                            <?php if (function_exists('f3rva_posted_on')) { f3rva_posted_on(); } ?>
                            <?php if (function_exists('f3rva_posted_in')) { echo ' &middot; '; f3rva_posted_in(); } ?>
                        </div>
                    </header>

                    <div class="entry-summary">
                        <?php the_excerpt(); ?>
                        <p><a class="read-more" href="<?php the_permalink(); ?>"><?php esc_html_e('Read more', 'f3rva'); ?></a></p>
                    </div>
                </article>

            <?php endwhile; ?>

            <div class="pagination">
                <?php
                the_posts_pagination(array(
                    'mid_size' => 2,
                    'prev_text' => __('« Prev', 'f3rva'),
                    'next_text' => __('Next »', 'f3rva'),
                ));
                ?>
            </div>

        <?php else : ?>

            <article class="post-item">
                <header class="entry-header">
                    <h2 class="entry-title"><?php esc_html_e('Nothing Found', 'f3rva'); ?></h2>
                </header>
                <div class="entry-content">
                    <p><?php esc_html_e('It seems we can’t find what you’re looking for. Perhaps searching can help.', 'f3rva'); ?></p>
                    <?php get_search_form(); ?>
                </div>
            </article>

        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
