        <footer id="colophon" class="site-footer">
            <div class="container">
                <div class="footer-content">
                    <?php if (is_active_sidebar('footer-widgets')) : ?>
                        <div class="footer-widgets">
                            <?php dynamic_sidebar('footer-widgets'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="site-info">
                        <p><?php echo f3rva_get_footer_text(); ?></p>
                        
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'footer',
                            'menu_class'     => 'footer-menu',
                            'container'      => 'nav',
                            'container_class'=> 'footer-navigation',
                            'depth'          => 1,
                            'fallback_cb'    => false,
                        ));
                        ?>
                    </div>
                </div>
            </div>
        </footer>
    </div><!-- #page -->
    
    <?php wp_footer(); ?>
</body>
</html>