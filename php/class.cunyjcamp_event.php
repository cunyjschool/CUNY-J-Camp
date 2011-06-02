<?php
/**
 * class cunyjcamp_event
 * Handles event custom post type for CUNY J-Camp theme
 * @author danielbachhuber
 */

if ( !class_exists( 'cunyjcamp_event' ) ) {
	
class cunyjcamp_event
{
	
	/**
	 * __construct()
	 */
	function __construct() {
		
		add_action( 'init', array( &$this, 'create_post_type' ) );
		
		// Load necessary scripts and stylesheets
		add_action( 'admin_enqueue_scripts', array( &$this, 'add_admin_scripts' ) );
		
		// Set up metabox and related actions
		add_action( 'admin_menu', array( &$this, 'add_post_meta_box' ) );
		add_action( 'save_post', array( &$this, 'save_post_meta_box' ) );
		add_action( 'edit_post', array( &$this, 'save_post_meta_box' ) );
		add_action( 'publish_post', array( &$this, 'save_post_meta_box' ) );			
		
	} // END __construct()
	
	function create_post_type() {

		register_post_type( 'cunyjcamp_event',
		    array(
				'labels' => array(
		        	'name' => 'Events',
					'singular_name' => 'Event',
						'add_new_item' => 'Add New Event',
						'edit_item' => 'Edit Event',
						'new_item' => 'New Event',
						'view' => 'View Event',
						'view_item' => 'View Event',
						'search_items' => 'Search Events',
						'not_found' => 'No events found',
						'not_found_in_trash' => 'No events found in Trash',
						'parent' => 'Parent Event'
				),
				'menu_position' => 6,
				'public' => true,
				'has_archive' => true,
				'rewrite' => array(
					'slug' => 'events',
					'feeds' => false,
					'with_front' => true
				),
				'supports' => array(
					'title',
					'editor',
					'comments',
					'excerpt',
					'thumbnail',
				),
				'taxonomies' => array(
				)
		    )
		);
		
	} // END create_post_type
	
	/**
	 * add_admin_scripts()
	 */
	function add_admin_scripts() {
		global $pagenow;
		
		// Only load scripts and styles on relevant pages in the WordPress admin
		if ( $pagenow == 'post.php' || $pagenow == 'post-new.php' || $pagenow == 'page.php' ) {
			wp_enqueue_script( 'jquery_selectlist', get_bloginfo( 'template_url' ) . '/js/jquery.selectlist.js', array( 'jquery' ), CUNYJCAMP_VERSION );
			wp_enqueue_script( 'cunyjcamp_event_admin_js', get_bloginfo( 'template_url' ) . '/js/event_admin.js', array( 'jquery', 'jquery_selectlist' ), CUNYJCAMP_VERSION );			
			wp_enqueue_style( 'cunyjcamp_event_admin_css', get_bloginfo( 'template_url' ) . '/css/event_admin.css', false, CUNYJCAMP_VERSION, 'all' );
		}
		
	} // END add_admin_scripts()
	
	/**
	 * add_post_meta_box()
	 * Add a post meta box to the post type
	 */
	function add_post_meta_box() {
		
		add_meta_box( 'cunyjcamp-event', 'Event Information', array( &$this, 'post_meta_box' ), 'cunyjcamp_event', 'normal', 'high');
		
	} // END add_post_meta_box()	
	
	/**
	 * post_meta_box()
	 */
	function post_meta_box() {
		global $post;
		
		$args = array(
			'fields' => 'ids',
		);
		$required_equipment_terms = wp_get_object_terms( $post->ID, 'cunyjcamp_equipment', $args );
		
		?>
		
		<div class="inner">
			
			<div class="date-time">
				
				<h4>Date &amp; Time</h4>
				
				<p>Start date <span class="required">*</span>: tk</p>
				
				<p>Start time <span class="required">*</span>: tk</p>
				
				<p>End date <span class="required">*</span>: tk</p>
				
				<p>End time <span class="required">*</span>: tk</p>
				
			</div>
				
				
				<p>Prerequisite Knowledge: tk</p>
				
			<div class="required-equipment-wrap option-item hide-if-no-js">
			
			<h4>Required Equipment</h4>
					
				<?php
					$args = array(
						'orderby' => 'name',
						'hide_empty' => false,
					);
					$equipment_terms = get_terms( 'cunyjcamp_equipment', $args );

				?>
				<?php if ( count( $equipment_terms ) ): ?>
				<select id="cunyjcamp-required-equipment" class="required-selector" multiple="multiple" name="cunyjcamp-required-equipment[]" title="-- Select equipment --">
				<?php foreach ( $equipment_terms as $equipment_term ): ?>
					<option value="<?php echo $equipment_term->slug; ?>"<?php if ( in_array( $equipment_term->term_id, $required_equipment_terms ) ) { echo ' selected="selected"'; } ?>><?php echo $equipment_term->name; ?></option>
				<?php endforeach; ?>
				</select>
				<?php else: ?>
				<div class="message info">You'll need to add equipment before you can require it to be used.</div>
				<?php endif; ?>
				
				<div class="clear-both"></div>
			
			</div><!-- END .required-equipment-wrap -->
				
			
			<div class="location">
				
				<h4>Location</h4>
				
			</div>
			
			<input type="hidden" id="cunyjcamp-event-nonce" name="cunyjcamp-event-nonce" value="<?php echo wp_create_nonce('cunyjcamp-event-nonce'); ?>" />
			
		</div><!-- END .inner -->
		
		<?php
		
	} // END post_meta_box()
	
	/**
	 * save_post_meta_box()
	 */
	function save_post_meta_box( $post_id ) {
		global $post, $cunyjcamp;
		
		if ( !wp_verify_nonce( $_POST['cunyjcamp-event-nonce'], 'cunyjcamp-event-nonce' ) ) {
			return $post_id;  
		}
		
		if ( !wp_is_post_revision( $post ) && !wp_is_post_autosave( $post ) ) {
			
			$required_equipment_terms = $_POST['cunyjcamp-required-equipment'];
			wp_set_object_terms( $post_id, $required_equipment_terms, 'cunyjcamp_equipment' );
			
			// @todo Save the data
		}		
		
	} // END save_post_meta_box()
	
} // END class cunyjcamp_event
	
} // END if ( !class_exists( 'cunyjcamp_event' ) )

?>