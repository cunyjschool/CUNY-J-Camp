<?php get_header(); ?>

<div class="main">
	
	<div class="wrap">
		
		<?php get_sidebar(); ?>
		
		<?php get_template_part( 'loop', 'single_event' ); ?>
		
	</div><!-- END .wrap -->

</div><!-- END .main -->

<?php get_footer(); ?>