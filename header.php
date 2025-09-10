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
        <a class="skip-link screen-reader-text" href="#main">
            <?php _e('Skip to content', 'f3rva'); ?>
        </a>
        
        <header id="masthead" class="site-header">
            <div class="container">
                <div class="site-branding">
                    <?php if (has_custom_logo()) : ?>
                        <div class="site-logo">
                            <?php the_custom_logo(); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="site-info">
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
                        $description = get_bloginfo('description', 'display');
                        if ($description || is_customize_preview()) :
                        ?>
                            <p class="site-description"><?php echo $description; ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </header>
        
        <nav id="site-navigation" class="main-navigation">
            <div class="container">
                <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <span class="screen-reader-text"><?php _e('Primary Menu', 'f3rva'); ?></span>
                    <span class="menu-icon">&#9776;</span>
                </button>
                
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'menu_class'     => 'primary-menu',
                    'container'      => 'div',
                    'container_class'=> 'menu-container',
                    'fallback_cb'    => 'f3rva_fallback_menu',
                ));
                ?>
            </div>
        </nav>
    </div>
    
    <?php
    /**
     * Fallback menu function
     */
    function f3rva_fallback_menu() {
        ?>
        <div class="menu-container">
            <ul id="primary-menu" class="primary-menu">
                <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Home', 'f3rva'); ?></a></li>
                <?php if (get_option('show_on_front') == 'page') : ?>
                    <li><a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><?php _e('Blog', 'f3rva'); ?></a></li>
                <?php endif; ?>
            </ul>
        </div>
        <?php
    }
    ?>