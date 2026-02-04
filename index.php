<?php get_header(); ?>

<main id="primary" class="site-main">
    
    <?php if (is_home() && !is_paged()) : ?>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-bg"></div>
        <div class="hero-content">
            <h1 class="hero-title"><?php echo esc_html(get_theme_mod('hero_title', __('Welcome to Aether', 'aether'))); ?></h1>
            <p class="hero-subtitle"><?php echo esc_html(get_theme_mod('hero_subtitle', __('A modern WordPress theme for creative professionals', 'aether'))); ?></p>
            <a href="<?php echo esc_url(get_theme_mod('hero_cta_link', '#content')); ?>" class="cta-button">
                <?php echo esc_html(get_theme_mod('hero_cta_text', __('Explore Our Work', 'aether'))); ?>
            </a>
        </div>
    </section>
    <?php endif; ?>

    <div id="content" class="content-section">
        <?php if (have_posts()) : ?>
            
            <?php if (is_home() && !is_front_page()) : ?>
                <header class="section-title reveal">
                    <h1 class="page-title"><?php single_post_title(); ?></h1>
                </header>
            <?php endif; ?>

            <div class="grid-3 posts-grid">
                <?php 
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/content', 'card');
                endwhile; 
                ?>
            </div>

            <div class="pagination reveal">
                <?php
                the_posts_pagination(array(
                    'mid_size' => 2,
                    'prev_text' => __('← Previous', 'aether'),
                    'next_text' => __('Next →', 'aether'),
                ));
                ?>
            </div>

        <?php else : ?>
            <?php get_template_part('template-parts/content', 'none'); ?>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>