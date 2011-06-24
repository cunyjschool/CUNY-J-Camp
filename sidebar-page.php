<div class="sidebar page-meta float-right">
	
	<div class="sidebar-item">
	<?php 
	$args = array(
		'theme_location' => 'page_navigation',
		'fallback_cb' => false,
		'container' => false,
	);
	wp_nav_menu( $args );
	?>
	</div>

</div><!-- END .sidebar -->