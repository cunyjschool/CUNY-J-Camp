<div class="sidebar page-meta float-right">
	
	<div class="sidebar-item">
		<h3>Upcoming Events</h3>
	<?php 
		$args = array(
			'posts_per_page' => 5,
			'post_type' => 'cunyjcamp_event',
			'orderby' => 'meta_value_num',
			'order' => 'asc',		
			'meta_key' => '_cunyjcamp_end_timestamp',
		);
		$all_events = new WP_Query( $args );
	?>
	<?php if ( $all_events->have_posts() ): ?>
		<ul>
		<?php while( $all_events->have_posts() ): $all_events->the_post(); ?>
			<li>
				<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
			</li>
		<?php endwhile; ?>	
		</ul>
	<?php else: ?>
		<div class="message info">There are no upcoming events at this time.</div>
	<?php endif; ?>
	</div>

</div><!-- END .sidebar -->