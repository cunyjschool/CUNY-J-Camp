<div class="content">
    
    <?php get_sidebar(); ?>

    <div class="entry float-left">
        
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            	        
    		<h3><?php the_title() ?></h3>
		
    		<div class="event-byline">Posted by Ceiling Cat</div>
        
            <?php the_content() ?>
        
            <div class="buttons">
            
                <button>Book tickets</button>
                <button>Add to Calendar</button>
        
            </div>
        
            <?php comments_template('', true); ?>
        
        <?php endwhile; else: ?>
            
            <div class="message info">Sorry, no posts matched your criteria.</div>
        
        <?php endif; ?>
    
    </div><!-- END .entry -->
    
    <div class="clear-both"></div>
    
</div><!-- END .content -->