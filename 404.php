<?php
  /*Template Name: Error*/
?>

<?php get_header(); ?>

<div class="entry-content">
    <?php dynamic_sidebar( 'not_found' ); ?>
</div>
<div id="primary"> 
    <div id="content"> 
        <div id="side-content">
            <?php get_template_part( 'navigation' ); ?>
        </div>
        <div id="main-content">
            <div id="main-content-inner">
                <?php 
                    $page_var = 'paged';
                    if( is_404() ) {
                        $page_var = 'page';
                    }
                    $paged = get_query_var( $page_var ) ? get_query_var( $page_var ) : 1;
                    $featuredtag = get_tag_id_by_name('featured');
                    $videocat = get_cat_ID( 'video' );
                    $eventcat = get_cat_ID( 'events' );
                    $args=array(
                    'tag__not_in' => array($featuredtag),
                    'post_type=post&paged='.$paged,
                    'category__not_in' => array($eventcat,$videocat),
                    'paged' => $paged
                    );
                    $wp_query = new WP_Query($args);
                ?>
                <?php if ( $wp_query->have_posts() ) : ?>
                    <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
                        <?php get_template_part( 'content', get_post_format() ); ?>
                    <?php endwhile; ?>
                    <?php dw_paging_nav(); ?>
                <?php else : ?>
                    <?php get_template_part( 'content', 'none' ); ?>
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
</div>
<div id="secondary">
    <div class="secondary-inner">
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>