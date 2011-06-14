<div class="sidebar page-meta float-right">
	
	<div class="sidebar-item">
	<h3>Pages</h3>
	<ul>
	<?php 
		$args = array(
			'title_li' => false,
			'sort_column' => 'menu_order',
		);
		wp_list_pages( $args ); 
	?>
	</ul>
	</div>

</div><!-- END .sidebar -->