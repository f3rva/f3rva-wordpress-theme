<?php
/**
 * The sidebar containing the main widget area
 *
 * @package F3RVA
 * @since 1.0.0
 */

if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<aside id="secondary" class="widget-area">
    <h2 class="screen-reader-text"><?php _e('Sidebar', 'f3rva'); ?></h2>
    <?php dynamic_sidebar('sidebar-1'); ?>
</aside><!-- #secondary -->