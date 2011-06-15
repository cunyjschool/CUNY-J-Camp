<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<meta name="copyright" content="Copyright <?php echo time( 'Y' ); ?> City University of New York Graduate School of Journalism" />
	<meta http-equiv="content-language" content="en" />

	<?php cunyjcamp_head_title(); // Generates the <title> tag ?>
	
	<?php
	/**
	 * All stylesheets are enqueued in functions.php
	 */
	?>

  	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/img/favicon.ico" type="image/x-icon" />

	<?php wp_head(); ?>
  
</head>

<body <?php body_class(); ?>>

<div class="header">
	
	<div class="wrap">
		
		<div class="branding">
			
			<?php if ( $header_email_signup = cunyjcamp_get_theme_option( 'header_email_signup' ) ): ?>
			<a class="email-newsletter-signup float-right button primary-button" target="blank" href="<?php echo $header_email_signup; ?>">Sign up for updates</a>
			<?php endif; ?>
			
			<div class="logo float-left">
				<h1><a href="<?php bloginfo('url'); ?>"><span>CUNY</span>JCamp</a></h1>
			</div>
			<div class="tagline float-left"><?php bloginfo( 'description' ); ?>&nbsp;<a class="learn-more" href="<?php bloginfo('url'); ?>/about/">Learn more &rarr;</a></div>
			
			<div class="clear-both"></div>
			
		</div><!-- END .logo-and-tagline -->
		
		<?php
    		$args = array(
    			'theme_location' => 'primary-navigation',
    			'container_class' => 'primary-navigation-container',
    			'menu_class' => 'primary-navigation inline-navigation',
				'fallback_cb' => false,
    		);
    		wp_nav_menu( $args ); 
    	?>

    	<div class="clear-both"></div>
		
	</div><!-- END .wrap -->
	
</div><!-- END .header -->