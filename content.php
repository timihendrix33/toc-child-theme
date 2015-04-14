<?php  
	global $index_post; 
	$post_class = '';
	if( $index_post %  3 == 0 ) { 
		$post_class = 'first'; 
	}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?> >
	<header class="entry-header">
		<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
		<div class="entry-thumbnail hover-thumb">
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', DW_TEXT_DOMAIN ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
			<?php the_post_thumbnail('thumbnail'); ?>
			</a>
		</div>
		<?php endif; ?>

		<div class="entry-meta meta-top">
			<?php dw_entry_meta(); ?>
		</div>

		<h2 class="entry-title">
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', DW_TEXT_DOMAIN ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
				<?php if ( is_search() ): ?>
					<?php search_title_highlight(); ?>
				<?php else: ?>
					<?php the_title(); ?>	
				<?php endif ?>
			</a>
		</h2>
	</header>

	<div class="entry-summary">
		<?php if ( is_search() ): ?>
			<?php search_excerpt_highlight(); ?>
			<div class="addtoany_share_save_container addtoany_content_bottom">
				 <?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { ADDTOANY_SHARE_SAVE_KIT(); } ?>
			</div>	 
		<?php else: ?>
			<?php the_excerpt(); ?>
		<?php endif ?>
	</div>
</article>