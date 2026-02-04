<article id="post-<?php the_ID(); ?>" <?php post_class('blog-card glass-card reveal'); ?>>
    <?php if (has_post_thumbnail()) : ?>
        <a href="<?php the_permalink(); ?>" class="image-link" style="display: block; overflow: hidden; border-radius: 16px;">
            <?php the_post_thumbnail('aether-card', array('class' => 'blog-card-image')); ?>
        </a>
    <?php endif; ?>

    <div class="card-content">
        <div class="blog-card-meta">
            <span><?php echo get_the_date(); ?></span>
            <?php if (has_category()) : ?>
                <span style="margin: 0 0.5rem;">•</span>
                <span><?php the_category(', '); ?></span>
            <?php endif; ?>
        </div>

        <h2 class="blog-card-title">
            <a href="<?php the_permalink(); ?>" style="color: inherit;">
                <?php the_title(); ?>
            </a>
        </h2>

        <div class="blog-card-excerpt">
            <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
        </div>

        <a href="<?php the_permalink(); ?>" class="read-more">
            <?php _e('Read Article', 'aether'); ?>
        </a>
    </div>
</article>