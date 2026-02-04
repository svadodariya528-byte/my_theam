<?php get_header(); ?>

<main id="primary" class="site-main">
    <?php while (have_posts()) : the_post(); ?>
        
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="page-header reveal" style="text-align: center; padding: 6rem 2rem 4rem; background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);">
                <h1 class="entry-title" style="font-size: 3.5rem; margin-bottom: 1rem;"><?php the_title(); ?></h1>
                <?php if (has_excerpt()) : ?>
                    <p class="page-description" style="font-size: 1.25rem; color: var(--text-light); max-width: 600px; margin: 0 auto;">
                        <?php echo get_the_excerpt(); ?>
                    </p>
                <?php endif; ?>
            </header>

            <div class="page-content reveal" style="max-width: 900px; margin: 0 auto; padding: 4rem 2rem;">
                <?php
                the_content();
                
                wp_link_pages(array(
                    'before' => '<div class="page-links">' . __('Pages:', 'aether'),
                    'after'  => '</div>',
                ));
                ?>
            </div>
        </article>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>