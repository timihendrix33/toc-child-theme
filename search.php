<?php get_header(); ?>
<div id="primary">
    <div id="content">
            <?php if ( have_posts() ) : ?>
            <header class="archive-header">
                <h1 class="archive-title">
                    <?php printf( __( 'Search Results for: %s', 'twentythirteen' ), get_search_query() ); ?>
                </h1>
            </header>
            <div class="list-content">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'content', get_post_format() ); ?>
            <?php endwhile; ?>

            <?php dw_paging_nav(); ?>
            </div>

            <?php else : ?>
                <?php get_template_part( 'content', 'none' ); ?>
            <?php endif; ?>
    </div>
</div>
<div id="secondary">
    <div class="secondary-inner">
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>