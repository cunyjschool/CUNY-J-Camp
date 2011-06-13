<div class="content">

    <div class="post post-type-event">
        
        <?php if (have_posts()) : while ( have_posts()) : the_post(); ?>
            	        
    		<h2><?php the_title() ?></h2>

			<div class="clear-right"></div>

			<?php if ( !empty( $post->post_excerpt ) ): ?>
			<div class="excerpt">
				<?php the_excerpt(); ?>
			</div>
			<?php endif; ?>
			
			<div class="sidebar event-meta float-right">
				
				<div class="sidebar-item">
					<a class="event-registration button" href="#">Register</a>	
				</div>
				
				<div class="sidebar-item">
					<h3>Date &amp; Time</h3>
					
				</div>
				
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
							if ( !empty( $instructor->description ) ) 
								echo '<p class="instructor-bio">' . $instructor->description . '</p>';
							echo '</div>';
						}
					?>
				</div>
				<?php endif; ?>
				
			</div>
        
			<div class="entry">
            	<?php the_content(); ?>
			</div>
        
        <?php endwhile; else: ?>
            
            <div class="message info">Sorry, no posts matched your criteria.</div>
        
        <?php endif; ?>
    
    </div><!-- END .post -->
    
    <div class="clear-both"></div>
    
</div><!-- END .content -->