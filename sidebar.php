<?php if( ( is_post_type_archive( 'download' ) || is_tax( 'download_category' ) || is_tax( 'download_tag') || is_singular( 'download' ) ) && is_active_sidebar( 'shop-sidebar' ) ): ?>
    <?php dynamic_sidebar( 'shop-sidebar' ); ?>
<?php elseif( is_archive() && is_active_sidebar( 'archive-sidebar' ) ) : ?>
    <?php dynamic_sidebar( 'archive-sidebar' ); ?>
<?php elseif( is_single() && is_active_sidebar( 'single-sidebar' ) ) : ?>
    <?php dynamic_sidebar( 'single-sidebar' ); ?>
<?php else : ?>
    <?php if ( ! is_active_sidebar( 'main-sidebar' ) ) : ?>
    <aside id="meta" class="widget">
        <h3 class="widget-title"><?php _e( 'Meta', 'designwall' ); ?></h3>
        <ul>
            <?php wp_register(); ?>
            <li><?php wp_loginout(); ?></li>
            <?php wp_meta(); ?>
      </ul>
    </aside>
    
    <?php the_widget('WP_Widget_Calendar'); ?> 

    <?php else : ?>
        <?php dynamic_sidebar( 'main-sidebar' ); ?>
    <?php endif; ?>
<?php endif; ?>
<?php toc_footer(); ?>