<?php
/**
 * Search form template
 *
 * @package F3RVA
 * @since 1.0.0
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label for="search-field-<?php echo esc_attr(uniqid()); ?>" class="screen-reader-text">
        <?php echo esc_html_x('Search for:', 'label', 'f3rva'); ?>
    </label>
    <input type="search" 
           id="search-field-<?php echo esc_attr(uniqid()); ?>" 
           class="search-field" 
           placeholder="<?php echo esc_attr_x('Search...', 'placeholder', 'f3rva'); ?>" 
           value="<?php echo get_search_query(); ?>" 
           name="s" />
    <button type="submit" class="search-submit">
        <span class="screen-reader-text"><?php echo esc_html_x('Search', 'submit button', 'f3rva'); ?></span>
        <span aria-hidden="true">🔍</span>
    </button>
</form>