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

		<a class="post post-type-event event-box float-left<?php if ( !has_post_thumbnail() ) { echo ' no-thumbnail'; } ?>" href="<?php the_permalink(); ?>">
			
		<?php
			$start_timestamp = get_post_meta( get_the_id(), '_cunyjcamp_start_timestamp', true );
			$event_month = date( 'M', $start_timestamp );
			$event_day = date( 'd', $start_timestamp );			
		?>
		<span class="event-date align-right"><?php echo $event_month; ?><br /><?php echo $event_day; ?></span>
			

		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'home-thumbnail' ); ?>
		<?php endif; ?>

			<h4><?php the_title() ?></h4>
			
			<?php
				$args = array(
					'orderby' => 'name',
				);
				$instructors = wp_get_object_terms( get_the_id(), 'cunyjcamp_instructors', $args );
			?>
			<?php if ( !empty( $instructors) ) {
				$html = '<div class="instructors event-meta"><em>with</em> <span>';
				foreach ( $instructors as $instructor ) {
					$html .= $instructor->name . ', ';
				}
				echo rtrim( $html, ', ' ) . '</span></div>';
			} ?>
			
			<div class="entry">
				<?php the_excerpt(); ?>
			</div>
			
			<span class="learn-more"><em class="hidden-text">Learn more</em> &rarr;</span>

		</a><!-- END .post.event-box -->

	<?php endwhile; ?>
	
		<div class="clear-both"></div>

		</div><!-- END .events-table -->

	<?php else: ?>

		<div class="message info">There aren't any upcoming events yet. Why don't you sign up for our email newsletter?</div>

	<?php endif; ?>
	
	</div><!-- END .wrap -->

</div><!-- END .main -->

<?php get_footer(); ?>