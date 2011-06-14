<div class="content">

    <div class="post post-type-page">
        
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            	        
    		<h2><?php the_title() ?></h2>
        
			<div class="entry">
            	<?php the_content(); ?>
			</div>
        
        <?php endwhile; else: ?>
            
            <div class="message info">Sorry, no posts matched your criteria.</div>
        
        <?php endif; ?>
    
    </div><!-- END .post -->
    
    <div class="clear-both"></div>
    
</div><!-- END .content -->