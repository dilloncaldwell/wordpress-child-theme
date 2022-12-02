<div class="page-wrapper">
    <div class="page-contents">
        <?php if( have_posts() ): while( have_posts() ): the_post(); ?>
            <?php the_content(); ?>
        <?php endwhile; else: endif; ?>
        <?php wp_reset_query(); ?>
    </div>
</div>