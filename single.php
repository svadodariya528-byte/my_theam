<?php get_header(); ?>

<main id="primary" class="site-main">
    <article class="single-post-container">
        <?php while (have_posts()) : the_post(); ?>
            
            <header class="post-header reveal" style="text-align: center; padding: 4rem 2rem; max-width: 800px; margin: 0 auto;">
                <?php the_category(', '); ?>
                <h1 class="entry-title" style="margin: 1rem 0; font-size: 3rem;"><?php the_title(); ?></h1>
                <div class="post-meta" style="color: var(--text-light);">
                    <span><?php echo get_the_date(); ?></span>
                    <span style="margin: 0 0.5rem;">•</span>
                    <span><?php echo get_the_author(); ?></span>
                </div>
            </header>

            <?php if (has_post_thumbnail()) : ?>
                <div class="featured-image reveal" style="max-width: 1200px; margin: 0 auto 3rem; padding: 0 2rem;">
                    <?php the_post_thumbnail('aether-hero', array('class' => 'glass-card', 'style' => 'width: 100%; height: auto;')); ?>
                </div>
            <?php endif; ?>

            <div class="post-content reveal" style="max-width: 800px; margin: 0 auto; padding: 0 2rem 4rem;">
                <div class="entry-content" style="font-size: 1.125rem; line-height: 1.8; color: var(--text-light);">
                    <?php
                    the_content();
                    
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . __('Pages:', 'aether'),
                        'after'  => '</div>',
                    ));
                    ?>
                </div>

                <div class="post-tags" style="margin-top: 3rem;">
                    <?php the_tags('<span style="font-weight: 600; color: var(--text-dark); margin-right: 1rem;">Tags:</span> ', ', '); ?>
                </div>
            </div>

            <nav class="post-navigation reveal" style="max-width: 800px; margin: 0 auto 4rem; padding: 0 2rem; display: flex; justify-content: space-between;">
                <?php
                previous_post_link('<div class="nav-previous">%link</div>', '<span style="display: block; font-size: 0.875rem; color: var(--text-light); margin-bottom: 0.5rem;">← Previous</span><span style="font-weight: 600; color: var(--text-dark);">%title</span>');
                next_post_link('<div class="nav-next" style="text-align: right;">%link</div>', '<span style="display: block; font-size: 0.875rem; color: var(--text-light); margin-bottom: 0.5rem;">Next →</span><span style="font-weight: 600; color: var(--text-dark);">%title</span>');
                ?>
            </nav>

            <?php
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            ?>

        <?php endwhile; ?>
    </article>
</main>

<?php get_footer(); ?>