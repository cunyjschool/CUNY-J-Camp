<?php get_header(); ?>

<div class="main">
	
	<div class="wrap">
		
    	<div class="content">
    	    
    	    <?php get_sidebar(); ?>

    	    <div class="entry float-left">
    	            	        
				<h3><?php the_title() ?></h3>
				
				<div class="event-byline">Posted by Ceiling Cat</div>
    	        
    	        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel.</p>
    	        
    	        <div class="buttons">
    	            
    	            <button>Book tickets</button>
    	            <button>Add to Calendar</button>
    	        
    	        </div>
    	        
    	        <?php comments_template('', true); ?>
    	    
    	    </div><!-- END .entry -->
    	    
    	    <div class="clear-both"></div>
    	    
    	</div><!-- END .content -->
		
	</div><!-- END .wrap -->

</div><!-- END .main -->

<?php get_footer(); ?>