<!DOCTYPE html>
<!--[if IE 8]>
  <html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if gt IE 9]>
  <html class="no-js" <?php language_attributes(); ?>>
<![endif]-->

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php wp_head(); ?>
	<!-- Google Analytics -->
    <script type="text/javascript">_bizo_data_partner_id = "7638";</script>
    <script type="text/javascript">
    (function() {
      var s = document.getElementsByTagName("script")[0];
      var b = document.createElement("script");
      b.type = "text/javascript";
      b.async = true;
      b.src = (window.location.protocol === "https:" ? "https://sjs" : "http://js") + ".bizographics.com/insight.min.js";
      s.parentNode.insertBefore(b, s);
    })();
    </script>
    <noscript><img height="1" width="1" alt="" style="display:none;" src="//www.bizographics.com/collect/?pid=7638&fmt=gif" /></noscript>
	<!-- End Google Analytics -->
</head>

<body <?php body_class(); ?>>
<div id="page">
	<header id="mashhead" class="navbar navbar-inverse navbar-fixed-top" role="banner">
		<div class="navbar-inner">
			<div class="container">
				<div class="inner-container">
					<?php 
                        $tagline        = get_bloginfo( 'description' );
                    ?>
                    <div class="toc-logo">
                        <?php dw_argo_logo(); ?>
                        <span class="tagline"><?php echo $tagline; ?></span>
                    </div>
					<?php 
                            wp_nav_menu( array( 
                                'theme_location' => 'primary', 
                                'menu_class'     => 'nav nav-offcanvas',
                                'container'      => false, 
                            'fallback_cb'    =>  create_function( '', '
                        ?>
                        <ul class="nav">
                            <li><a href="'.site_url().'">'.__('Home',DW_TEXT_DOMAIN).'</a></li>
                            <li><a href="'.admin_url( 'nav-menus.php').'">'.__('Setting your menu', DW_TEXT_DOMAIN).'</a></li>
                        </ul>
                        <?php
                        '),
                        'walker'         => new dw_Walker_nav_menu()
                        ) );
                        ?>
                    <div class="nav-right">
                        <div class="navbar-search pull-right">
                            <i class="icon-search"></i>
                            <?php get_search_form(); ?>
                        </div>
						<?php 
                            wp_nav_menu( array( 
                                'theme_location' => 'social_links', 
                                'menu_class'     => 'nav nav-offcanvas',
								'walker'         => new dw_Walker_nav_menu(),
								'container'      => false
                        ) );
                        ?>
                        <span class="presented-by">Presented by <strong>IBM</strong></span>
                    </div>
				</div>
            </div>
		</div>
	</header>
	<div class="handheld-header navbar navbar-inverse navbar-fixed-top">
		<button class="button-show-nav">
			<i class="icon-reorder"></i>
		</button>
		<?php dw_argo_logo(); ?>
		<button class="button-show-sidebar">
			<i class="icon-cog"></i>
		</button>
	</div>
	<div id="main" class="site-main">
		<?php do_action( 'dw_argo_top_sidebar' ); ?>
		<div class="container">