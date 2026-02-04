<section class="no-results not-found reveal" style="text-align: center; padding: 4rem 2rem;">
    <header class="page-header">
        <h1 class="page-title"><?php _e('Nothing Found', 'aether'); ?></h1>
    </header>

    <div class="page-content" style="max-width: 600px; margin: 0 auto;">
        <?php if (is_search()) : ?>
            <p><?php _e('Sorry, but nothing matched your search terms. Please try again with different keywords.', 'aether'); ?></p>
            <?php get_search_form(); ?>
        <?php else : ?>
            <p><?php _e('It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'aether'); ?></p>
            <?php get_search_form(); ?>
        <?php endif; ?>
    </div>
</section>