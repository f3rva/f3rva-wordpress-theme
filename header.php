<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'f3rva'); ?></a>

    <header id="masthead" class="site-header">
        <div class="container">
            <div class="site-branding">
                <?php if (is_front_page() && is_home()) : ?>
                    <h1 class="site-title">
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                            <?php bloginfo('name'); ?>
                        </a>
                    </h1>
                <?php else : ?>
                    <p class="site-title">
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                            <?php bloginfo('name'); ?>
                        </a>
                    </p>
                <?php endif; ?>

                <?php
                $f3rva_description = get_bloginfo('description', 'display');
                if ($f3rva_description || is_customize_preview()) :
                ?>
                    <p class="site-description"><?php echo $f3rva_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                <?php endif; ?>
            </div><!-- .site-branding -->

            <nav id="site-navigation" class="main-navigation">
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <span class="screen-reader-text"><?php esc_html_e('Primary Menu', 'f3rva'); ?></span>
                    <span class="menu-icon">☰</span>
                </button>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'fallback_cb'    => false,
                ));
                ?>
            </nav><!-- #site-navigation -->
        </div>
    </header><!-- #masthead -->

    <main id="primary" class="site-main">
        <div class="container">