<?php
    $metro_args = array();
    $metro_args['posts_per_page'] = 6;
    if(dw_get_theme_option('metro_order')) {
        $metro_args['orderby'] = dw_get_theme_option('metro_order');
        if($metro_args['orderby'] == 'title') {
            $metro_args['order'] = 'ASC';
        } else {
            $metro_args['order'] = 'DESC';
        }
    }
    $metro_cat = dw_get_theme_option('metro_cat');
    if( isset($metro_cat[0]) && $metro_cat[0] > 0 ) {
        $metro_args['category__in'] = $metro_cat;
    }
    $metro_tag = dw_get_theme_option('metro_tag');
    if( isset($metro_tag[0]) && $metro_tag[0] > 0 ) {
        $metro_args['tag__in'] = $metro_tag;
    }
    $metro_query = new WP_Query( $metro_args );
    if ( $metro_query->have_posts() ):
?>
<div class="feature">
    <div id="metro-slide">
        <?php
            $i = 0;
            while ( $metro_query->have_posts() ) : $metro_query->the_post(); 

            $class = "gradient gradient-".$i;

            if ($i < 2) {
                $thumbnail_size = 500;
                $class .= " hentry-big";
            } else {
                $thumbnail_size = 250;
                $class .= " hentry-small";
            }

            if ($i == 2) {
                $class .= " clear-left";
            }
        ?>
        <article id="post-<?php the_ID(); ?>" class="hentry-metro <?php echo $class ?>">
            <div class="entry-thumbnail gradient-tran-white" >
            <?php if(preg_match('/(?i)msie [1-8]/',$_SERVER['HTTP_USER_AGENT'])) : ?>
                <!--[if IE 8]>
                <div class="ie8-gradient-tran-white"></div>
                <![endif]-->
            <?php endif; ?>
            <?php if(has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('metro-thumb'); ?>
            <?php else : ?>
                <img alt="<?php echo esc_attr( sprintf( __( 'Permalink to %s', DW_TEXT_DOMAIN ), the_title_attribute( 'echo=0' ) ) ); ?>" src="http://placehold.it/<?php echo $thumbnail_size.'x'.$thumbnail_size; ?>" />
            <?php endif; ?>
            </div>
            <img class="placeholder" src="<?php echo get_template_directory_uri() ?>/assets/img/placeholder.png" alt="<?php echo esc_attr( sprintf( __( 'Permalink to %s', DW_TEXT_DOMAIN ), the_title_attribute( 'echo=0' ) ) ); ?>">
            <h2 class="entry-title">
                <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', DW_TEXT_DOMAIN ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><span class="entry-title-inner"><?php the_title(); ?><span></a>
            </h2>
            <?php if(preg_match('/(?i)msie [1-8]/',$_SERVER['HTTP_USER_AGENT'])) : ?>
            <!--[if IE 8]>
            <div class="<?php echo $class ?>">
                <div class="inner"></div>
            </div>
            <! [endif]-->
            <?php endif; ?>
        </article>
        <?php $i++; ?>
        <?php endwhile;

        wp_reset_postdata();
        ?>
    </div>
</div>
<?php endif ?>