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
			'meta_query' => array(
				array(
					'key' => '_cunyjcamp_event_active',
					'value' => 'on',					
					'compare' => '=',
				),
			),
		);
		$all_events = new WP_Query( $args );
		
		$total_events = $all_events->post_count;
		$index = 1;
		$promo_shown = false;
	?>
	
	<?php if ( $all_events->have_posts() ) : ?>
	
	<div class="events-table">

	<?php while ( $all_events->have_posts() ) : $all_events->the_post(); ?>
		
		<?php if ( ( $index == $total_events || $index == 2 ) && !$promo_shown ): ?>
			
			<div class="promo-video event-box float-left">

				<iframe src="http://player.vimeo.com/video/25087510?title=0&amp;byline=0&amp;portrait=0" width="500" height="281" frameborder="0"></iframe>

				<?php if ( $promo_text = cunyjcamp_get_theme_option( 'home_introduction_text' ) ): ?>
				<div class="promo-text entry">
					<?php echo wpautop( $promo_text ); ?>
				</div>
				<?php endif; ?>

			</div><!-- END .promo-video -->
			<?php $promo_shown = true; ?>
			
		<?php endif; ?>

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
			
			<?php if ( $date_time = cunyjcamp_get_date_time( 'short_time' ) ): ?>
			<span class="date-time"><?php echo $date_time; ?></span>
			<?php endif; ?>
			
			<span class="learn-more"><em class="hidden-text">Details</em> &rarr;</span>

		</a><!-- END .post.event-box -->
		
		<?php $index++; ?>

	<?php endwhile; ?>
	
		<div class="clear-both"></div>

		</div><!-- END .events-table -->

	<?php else: ?>

		<div class="message info">There aren't any upcoming events yet. Why don't you sign up for our email newsletter?</div>

	<?php endif; ?>
	
	</div><!-- END .wrap -->

</div><!-- END .main -->

<?php get_footer(); ?>