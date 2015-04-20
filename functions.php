<?php
	add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
	function theme_enqueue_styles() {
		wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'child-style',
			get_stylesheet_directory_uri() . '/style-1.css',
			array('parent-style')
		);
	}
add_filter( 'get_the_author_user_url', 'nc_link' ); 
add_filter( 'the_author', 'nc_author' ); 
add_filter( 'get_the_author_display_name', 'nc_author' );

function nc_link($url) {
  global $post;
  $guest_url = get_post_meta( $post->ID, 'nc-link', true );
  if ( filter_var($guest_url, FILTER_VALIDATE_URL) ) {
    return $guest_url;
  } elseif ( get_post_meta( $post->ID, 'nc-author', true ) ) {
    return '#';
  }
  return $url;
}

function nc_author($name) {
  global $post;
  $guest_url = get_post_meta( $post->ID, 'nc-link', true );
  $guest_name = get_post_meta( $post->ID, 'nc-author', true );
  $source = get_post_meta( $post->ID, 'nc-source', true );
  if ( $guest_name && filter_var($guest_url, FILTER_VALIDATE_URL) ) {
    return '<a href="' . esc_url( $guest_url ) . '" title="' . esc_attr( sprintf(__("Visit %s&#8217;s website"), $guest_name) ) . '" rel="author external">' . $guest_name . '</a>' . ' / Source: ' .
	'<a href="' . esc_url( $guest_url ) . '" title="' . esc_attr( sprintf(__("Visit %s&#8217;s website"), $guest_name) ) . '" rel="author external" target="_blank">' . $source . '</a>';
  } elseif( $guest_name ) {
    return $guest_name;
  }
  return $name;
}

function guest_author_name( $name ) {
  global $post;
  $guest_name = get_post_meta( $post->ID, 'nc-author', true );
  if ( $guest_name ) return $guest_name;
  return $name;
}
function get_tag_id_by_name($tag_name) {
    global $wpdb;
    $tag_ID = $wpdb->get_var("SELECT * FROM ".$wpdb->terms." WHERE  `name` =  '".$tag_name."'");
    return $tag_ID;
}
register_nav_menus( array(
	'social_links' => 'Social Links Menu'
) );
function toc_footer() { ?>
<footer id="colophon" class="site-footer" role="contentinfo">
    <div class="site-footer-inner">
        <?php wp_nav_menu( array( 
            'theme_location' => 'footer', 
            'menu_class' => 'nav',
            'container' => false,
            'depth' => 1,
            'fallback_cb' =>  create_function( '', '
                ?>
                <ul class="nav">
                    <li><a href="'.site_url().'">'.__('Home',DW_TEXT_DOMAIN).'</a></li>
                    <li><a href="'.admin_url( 'nav-menus.php').'">'.__('Setting your menu', DW_TEXT_DOMAIN).'</a></li>
                </ul>
                <?php
            '),
        ) ); ?>
        <div class="site-info">
            <?php do_action( 'dw_credits' ); ?>
            Copyright &copy; <?php echo date("Y") ?> by <a href="http://www.ibm.com/cloud-computing/us/en/">IBM</a>.
            <br>
            <a href="<?php echo esc_url( __( 'http://wordpress.org/', DW_TEXT_DOMAIN ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', DW_TEXT_DOMAIN ); ?>"><?php printf( __( 'Proudly powered by %s.', DW_TEXT_DOMAIN ), 'WordPress' ); ?></a>
            <a href="<?php echo esc_url( __( 'http://www.designwall.com/', DW_TEXT_DOMAIN ) ); ?>" rel="nofollow" title="<?php esc_attr_e( 'Responsive WordPress Themes', DW_TEXT_DOMAIN ); ?>"><?php printf( __( 'Theme by %s', DW_TEXT_DOMAIN ), 'DesignWall' ); ?></a>.
        </div>
    </div>
</footer>
<?php }


/**
 * Post options
 */
function insert_featured_image_add_meta_box() {
  // get_post_types() only included in WP 2.9/3.0
  $post_types = ( function_exists( 'get_post_types' ) ) ? get_post_types( array( 'public' => true ) ) : array( 'post', 'page' ) ;
  
  $title = apply_filters( 'insert_featured_image_meta_box_title', __( 'Insert Featured Image in Article', 'insert-featured-image' ) );
  foreach( $post_types as $post_type ) {
    add_meta_box( 'insert_featured_image_meta', $title, 'insert_featured_image_meta_box_content', $post_type, 'advanced', 'high' );
  }
}

function insert_featured_image_meta_box_content( $post ) {
  do_action( 'start_insert_featured_image_meta_box_content', $post );

  $disabled = get_post_meta( $post->ID, 'insert_post_disabled', true ); ?> 

  <p>
    <label for="enable_post_insert_featured_image">
      <input type="checkbox" name="enable_post_insert_featured_image" id="enable_post_insert_featured_image" value="1" <?php checked( empty( $disabled ) ); ?>>
      <?php _e( 'Insert Featured Image into article body' , 'insert-featured-image'); ?>
    </label>
    <input type="hidden" name="insert_featured_image_status_hidden" value="1" />
  </p>

  <?php
  do_action( 'end_insert_featured_image_meta_box_content', $post );
}

function insert_featured_image_meta_box_save( $post_id ) {
  // If this is an autosave, this form has not been submitted, so we don't want to do anything.
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
    return $post_id;

  // Save insert_post_disabled if "Insert Featured Image into article body" checkbox is unchecked
  if ( isset( $_POST['post_type'] ) ) {
    if ( current_user_can( 'edit_post', $post_id ) ) {
      if ( isset( $_POST['insert_featured_image_status_hidden'] ) ) {
        if ( !isset( $_POST['enable_post_insert_featured_image'] ) ) {
          update_post_meta( $post_id, 'insert_post_disabled', 1 );
        } else {
          delete_post_meta( $post_id, 'insert_post_disabled' );
        }
      }
    }
  }

  return $post_id;
}

add_action( 'admin_init', 'insert_featured_image_add_meta_box' );
add_action( 'save_post', 'insert_featured_image_meta_box_save' );




?>