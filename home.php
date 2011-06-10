<?php get_header(); ?>

<div class="main">
	
	<div class="wrap">
		
	<?php
		$args = array(
			'posts_per_page' => '-1',
			'post_type' => 'cunyjcamp_event',
			'orderby' => 'meta_value_num',
			'order' => 'asc',		
			'meta_key' => '_cunyjcamp_end_timestamp',
		);
		$all_events = new WP_Query( $args );
	?>
	
	<?php if ( $all_events->have_posts() ) : ?>
	
	<div class="events-table">

	<?php while ( $all_events->have_posts()) : $all_events->the_post(); ?>

		<div class="post post-type-event event-box float-left">

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="featured-image">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array( 220, 180 ) ); ?></a>
			</div>
		<?php endif; ?>
		
			<div class="inner">

				<h4><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h4>

				<div class="entry">
					<?php the_excerpt(); ?>
				</div>
			
			</div>

		</div><!-- END .post.event-box -->

	<?php endwhile; ?>
	
		<div class="clear-both"></div>

		</div><!-- END .events-table -->

	<?php else: ?>

		<div class="message info">There aren't any upcoming events yet. Why don't you sign up for our email newsletter?</div>

	<?php endif; ?>
	
	</div><!-- END .wrap -->

</div><!-- END .main -->

<?php get_footer(); ?>