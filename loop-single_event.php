<div class="content">

    <div class="post post-type-event">
        
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	
			<div class="float-right share-buttons">
				<div class="share-button share-facebook">
					<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=191589374223478&amp;xfbml=1"></script><fb:like href="" send="false" layout="button_count" width="150" show_faces="false" font=""></fb:like>
				</div>
				<div class="share-button share-twitter">
					<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
				</div>
			</div>	
            	        
    		<h2><?php the_title(); ?></h2>

			<?php if ( !empty( $post->post_excerpt ) ): ?>
			<div class="excerpt">
				<?php the_excerpt(); ?>
			</div>
			<?php endif; ?>
			
			<div class="sidebar event-meta float-right">
				
				<?php if ( $registration_form_link = get_post_meta( get_the_id(), '_cunyjcamp_registration_form_link', true ) ): ?>
				<div class="sidebar-item">
					<a class="event-registration button" href="<?php echo $registration_form_link; ?>">Register</a>				
				</div>
				<?php endif; ?>
				
				<div class="sidebar-item">
					<h3>Date &amp; Time</h3>
					
					<?php if ( $date_time = cunyjcamp_get_date_time( 'long_both' ) ): ?>
					<h4><?php echo $date_time; ?></h4>
					<?php endif; ?>
					
				</div>
				
				<?php
					$args = array(
						'orderby' => 'term_order',
					);
					$locations = wp_get_object_terms( get_the_id(), 'cunyjcamp_locations', $args );
				?>
				<?php if ( !empty( $locations ) ): ?>
				<div class="sidebar-item instructor">
					<h3>Location</h3>
					<?php
						foreach ( $locations as $location ) {
							echo '<div class="location-item';
							if ( $location->parent ) {
								echo ' indent';
							}
							echo '">';
							echo '<h4>' . $location->name . '</h4>';
							if ( !empty( $location->description ) ) {
								echo '<p class="location-description">';
								echo $location->description . '</p>';
							}
							echo '</div>';
						}
					?>
				</div>
				<?php endif; ?>
				
				<?php
					$args = array(
						'orderby' => 'name',
					);
					$instructors = wp_get_object_terms( get_the_id(), 'cunyjcamp_instructors', $args );
				?>
				<?php if ( !empty( $instructors) ): ?>
				<div class="sidebar-item instructors">
					<h3>Instructor<?php if ( count( $instructors ) > 1 ) { echo 's'; } ?></h3>
					<?php
						foreach ( $instructors as $instructor ) {
							echo '<div class="instructor-item">';
							echo '<h4>' . $instructor->name . '</h4>';
							if ( !empty( $instructor->description ) ) {
								echo '<p class="instructor-bio">';
								// Search the string for an email address so we can try to get an avatar
								$address_pattern = "/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i";
								preg_match( $address_pattern, $instructor->description, $email_address );
								if ( !empty( $email_address ) )
									echo get_avatar( $email_address[0], 48 );
								echo $instructor->description . '</p>';
							}
							echo '</div>';
						}
					?>
				</div>
				<?php endif; ?>
				
			</div>
        
			<div class="entry">
            	<?php the_content(); ?>
				<?php if ( $eventbrite_id = get_post_meta( get_the_id(), '_cunyjcamp_eventbrite_id', true ) ) : ?>
				<p><iframe src="https://www.eventbrite.com/tickets-external?eid=<?php echo (int)$eventbrite_id; ?>&amp;ref=etckt" frameborder="0" marginwidth="5" marginheight="5" scrolling="auto" width="100%" height="275"></iframe></p>
				<?php endif; ?>
			</div>
        
        <?php endwhile; else: ?>
            
            <div class="message info">Sorry, no posts matched your criteria.</div>
        
        <?php endif; ?>
    
    </div><!-- END .post -->
    
    <div class="clear-both"></div>
    
</div><!-- END .content -->