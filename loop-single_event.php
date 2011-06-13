<div class="content">

    <div class="post post-type-event">
        
        <?php if (have_posts()) : while ( have_posts()) : the_post(); ?>
            	        
    		<h2><?php the_title() ?></h2>

			<?php if ( !empty( $post->post_excerpt ) ): ?>
			<div class="excerpt">
				<?php the_excerpt(); ?>
			</div>
			<?php endif; ?>
        
			<div class="entry">
            	<?php the_content(); ?>
			</div>
        
            <div class="buttons">
            
                <button>Book tickets</button>
                <button>Add to Calendar</button>
        
            </div>
        
        <?php endwhile; else: ?>
            
            <div class="message info">Sorry, no posts matched your criteria.</div>
        
        <?php endif; ?>
    
    </div><!-- END .post -->
    
    <div class="clear-both"></div>
    
</div><!-- END .content -->