        </div>
    </main><!-- #primary -->

    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="site-info">
                <p>&copy; <?php echo esc_html(date('Y')); ?> <?php bloginfo('name'); ?>. 
                <?php
                /* translators: 1: Theme name, 2: Author name. */
                printf(esc_html__('Powered by %1$s theme.', 'f3rva'), 'F3RVA');
                ?>
                </p>
            </div><!-- .site-info -->
        </div>
    </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>