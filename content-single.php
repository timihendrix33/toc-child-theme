<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
	<div class="entry-inner">
			<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<div class="entry-meta meta-top clearfix">
				<div class="pull-left">
					<span class="categories-links">
					<?php //dw_entry_meta(); ?>
					<?php
					$categories = get_the_category();
					$separator = ' ';
					$output = '';
					if($categories){
						if(count($categories) > 2) {
							$first = true;
							$output_tip_start = '';
							$output_tip_end = '';
							$output_tip_start .= '<div class="cat_tip">';
							$output_tip_end   .= '</div>';
							$output_tip = '';
							foreach($categories as $category) {
								if($first) {
									$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s", DW_TEXT_DOMAIN ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
									$output .= '<a class="cat_view_more" href="#" title="' . __( "View More", DW_TEXT_DOMAIN ) . '"><i class="icon-chevron-down"></i></a>'.$separator;
									$first = false;
								} else {

									$output_tip .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s", DW_TEXT_DOMAIN ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
								}
							}
							echo trim($output, $separator);
							echo trim($output_tip_start.$output_tip.$output_tip_end, $separator);
						} else {
							foreach($categories as $category) {
								$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s", DW_TEXT_DOMAIN ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
							}
							echo trim($output, $separator);
						}
					}
					?>
					</span>
					<?php 
					if ( 'post' == get_post_type() ) {
					    printf( '<span class="author vcard">By <a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
					      esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					      esc_attr( sprintf( __( 'View all posts by %s', DW_TEXT_DOMAIN ), get_the_author() ) ),
					      get_the_author()
					    );
				  	}
				  	if ( 'post' == get_post_type()  ) {
				  		echo '<span class="sep"> / </span>';
				  	} 
					echo '<time class="entry-date" datetime="' . esc_attr( get_the_date( 'c' ) ) . '">' . esc_html( get_the_date() ) . '</time>';
					?>
				</div>
				<div class="pull-right">
					<div class="post-navigation">
						<a class="btn btn-inverse nex" href="#"><span><?php _e('Next Article',DW_TEXT_DOMAIN) ?></span><i class="icon-angle-right"></i></a>
						<div class="nav-tip visible-desktop"><?php _e('Use &larr; &rarr; keys to navigate',DW_TEXT_DOMAIN) ?></div>	
					</div>
					<ul class="unstyled entry-actions">
						<li><a href="javscript:void(0)" onclick="window.print();"><i class="icon-print"></i></a></li>
						<li><a href="mailto:<?php echo get_option( 'admin_email' ); ?>?Subject=<?php echo urlencode( get_the_title() ); ?>"><i class="icon-envelope-alt"></i></a></li>
						<li>
							<a href="#" class="font-size-plus"> A+ </a>
							<a href="#" class="font-size-minus"> A-</a>
						</li>
					</ul>
				</div>
			</div>
			<?php 
				if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail
				the_post_thumbnail('large');
				} 
			?>
		</header>
		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', DW_TEXT_DOMAIN ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', DW_TEXT_DOMAIN ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
		</div>
		<footer class="entry-meta meta-bottom">
			<?php $tags_list = get_the_tag_list( '', __( ', ', DW_TEXT_DOMAIN ) ); if ( $tags_list ) : ?>
		    <div class="entry-tags">
		    	<div class="tag-action">
			    	<strong><?php _e('Tags:',DW_TEXT_DOMAIN) ?></strong>
			    	<span class="tags-links"><?php printf( __( '%1$s', DW_TEXT_DOMAIN ), $tags_list ); ?></span>
		        </div>
		    </div>
		    <?php endif; ?>
			<?php  
				$desc = get_the_author_meta('description');
			?>
			<?php if ( $desc != ''): ?>
		    <div class="author-info">
	        	<div class="author-avatar">
					<?php echo get_avatar( get_the_author_meta( 'user_email' ), 100 ); ?>
				</div>
				<h2 class="author-name"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php echo get_the_author(); ?></a></h2>
				<div class="author-description"><?php echo $desc; ?></div>
	        </div>
	        <?php endif ?>
		</footer>
	</div>
</article>