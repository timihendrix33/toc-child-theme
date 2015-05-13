<?php get_header(); ?>
<div id="primary">
    <div id="content">
        <div id="side-content">
            <?php get_template_part( 'navigation' ); ?>
        </div>

        <div id="main-content">
            <div id="main-content-inner">
                <div class="nextpost">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'content-single', get_post_format() ); ?>
                    <?php endwhile; ?>

                    <?php
                        $tags = wp_get_post_tags( get_the_ID() );

                        if ($tags) :
                            $tag_ids = array();
                            foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
                            $args=array(
                            'tag__in' => $tag_ids,
                            'post__not_in' => array($post->ID),
                            'posts_per_page'=>3, // Number of related posts to display.
                            'ignore_sticky_posts'=>1
                            );
                            $related_query = new  WP_Query( $args );
                            if ( $related_query->have_posts() ) :
                    ?>
                                <div class="related-post">
                                    <?php if (get_the_author_meta('description') == ''): ?>
                                    <div class="line"></div>
                                    <?php endif; ?>

                                    <h2 class="related-title"><?php _e('You might also like' ,DW_TEXT_DOMAIN) ?></h2>
                                    <div class="related-content display-grid display-grid-content">
                                    <?php $i = 0; ?>
                                    <?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
                                    <?php global $related_post_class; ?>
                                    <?php $related_post_class = ($i%3==0) ? "first" : ""; ?>
                                    <?php get_template_part( 'content', 'related' ); ?>
                                    <?php $i++; endwhile; ?>
                                    </div>
                                </div>
                    <?php 
                            endif;
                        endif; 
                    ?>

                    <?php while ( have_posts() ) : the_post(); ?>
                    <?php comments_template(); ?>
                    <?php endwhile; ?>
                </div>
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