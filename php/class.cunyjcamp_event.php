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
			wp_enqueue_script( 'cunyjcamp_jquery_ui_custom_js', get_bloginfo( 'template_url' ) . '/js/jquery-ui-1.8.13.custom.min.js', array( 'jquery', 'jquery-ui-core' ), CUNYJCAMP_VERSION );
			wp_enqueue_script( 'cunyjcamp_jquery_timepicker_js', get_bloginfo( 'template_url' ) . '/js/jquery-ui-timepicker.0.9.5.js', array( 'jquery', 'jquery-ui-core', 'cunyjcamp_jquery_ui_custom_js' ), CUNYJCAMP_VERSION );
			wp_enqueue_script( 'cunyjcamp_event_admin_js', get_bloginfo( 'template_url' ) . '/js/event_admin.js', array( 'jquery', 'jquery_selectlist' ), CUNYJCAMP_VERSION );			
			wp_enqueue_style( 'cunyjcamp_event_admin_css', get_bloginfo( 'template_url' ) . '/css/event_admin.css', false, CUNYJCAMP_VERSION, 'all' );
			wp_enqueue_style( 'cunyjcamp_jquery_ui_custom_css', get_bloginfo( 'template_url' ) . '/css/jquery-ui-1.8.13.custom.css', false, CUNYJCAMP_VERSION, 'all' );			
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
		
		$date_time_format = 'm/d/y g:i A';
		$start_timestamp = get_post_meta( $post->ID, '_cunyjcamp_start_timestamp', true );
		if ( $start_timestamp )
			$start_date_time = date( $date_time_format, $start_timestamp );
		else
			$start_date_time = '';
			
		$end_timestamp = get_post_meta( $post->ID, '_cunyjcamp_end_timestamp', true );
		if ( $end_timestamp )
			$end_date_time = date( $date_time_format, $end_timestamp );
		else
			$end_date_time = '';
		
		$args = array(
			'fields' => 'ids',
		);
		$required_equipment_terms = wp_get_object_terms( $post->ID, 'cunyjcamp_equipment', $args );
		$event_instructors = wp_get_object_terms( $post->ID, 'cunyjcamp_instructors', $args );
		$event_locations = wp_get_object_terms( $post->ID, 'cunyjcamp_locations', $args );		
		if ( !empty( $event_locations ) )
			$event_location = $event_locations[0];
		else
			$event_location = false;
		?>
		
		<div class="inner">
			
			<div class="date-time-wrap option-item hide-if-no-js">
				
				<h4>Date &amp; Time</h4>
				
				<div class="float-left">
				<label for="cunyjcamp-start-date-time">Please specify a starting date &amp; time <span class="required">*</span></label>
				<input id="cunyjcamp-start-date-time" name="cunyjcamp-start-date-time" class="cunyjcamp-date-time-picker" size="25" value="<?php echo $start_date_time; ?>" />
				</div>
				
				<div>
				<label for="cunyjcamp-end-date-time">Please specify an ending date &amp; time <span class="required">*</span></label>
				<input id="cunyjcamp-end-date-time" name="cunyjcamp-end-date-time" class="cunyjcamp-date-time-picker" size="25" value="<?php echo $end_date_time; ?>" />
				</div>
				
				<div class="clear-both"></div>
				
			</div>
			
			<div class="prerequisite-knowledge-wrap option-item hide-if-no-js">

				<h4>Prerequisite Knowledge</h4>
				
				tk
				
			</div>
				
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
				<select id="cunyjcamp-required-equipment" class="term-selector" multiple="multiple" name="cunyjcamp-required-equipment[]" title="-- Select equipment --">
				<?php foreach ( $equipment_terms as $equipment_term ): ?>
					<option value="<?php echo $equipment_term->slug; ?>"<?php if ( in_array( $equipment_term->term_id, $required_equipment_terms ) ) { echo ' selected="selected"'; } ?>><?php echo $equipment_term->name; ?></option>
				<?php endforeach; ?>
				</select>
				<?php else: ?>
				<div class="message info">You'll need to add equipment before you can require it to be used.</div>
				<?php endif; ?>
				
				<div class="clear-both"></div>
			
			</div><!-- END .required-equipment-wrap -->
			
			<div class="instructors-wrap option-item hide-if-no-js">
			
			<h4>Instructor(s)</h4>
					
				<?php
					$args = array(
						'orderby' => 'term_group',
						'hide_empty' => false,
					);
					$instructor_terms = get_terms( 'cunyjcamp_instructors', $args );

				?>
				<?php if ( count( $instructor_terms ) ): ?>
				<select id="cunyjcamp-instructors" class="term-selector" multiple="multiple" name="cunyjcamp-instructors[]" title="-- Select instructor(s) --">
				<?php foreach ( $instructor_terms as $instructor_term ): ?>
					<option value="<?php echo $instructor_term->slug; ?>"<?php if ( in_array( $instructor_term->term_id, $event_instructors ) ) { echo ' selected="selected"'; } ?>><?php echo $instructor_term->name; ?></option>
				<?php endforeach; ?>
				</select>
				<?php else: ?>
				<div class="message info">You'll need to add instructors to the database before you can select them.</div>
				<?php endif; ?>
				
				<div class="clear-both"></div>
			
			</div><!-- END .instructors-wrap -->
				
			
			<div class="location">
				
				<h4>Location</h4>
				
				<?php
					$args = array(
						'hide_empty' => false,
						'taxonomy' => 'cunyjcamp_locations',
						'name' => 'cunyjcamp-locations[]',
						'id' => 'cunyjcamp-locations',
						'hierarchical' => true,
						'depth' => 2,
						'class' => 'term-selector',
						'selected' => $event_location,
						'echo' => true,
					);
					wp_dropdown_categories( $args );
				?>
				
				<div class="clear-both"></div>
				
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
			
			$start_timestamp = strtotime( $_POST['cunyjcamp-start-date-time'] );
			update_post_meta( $post_id, '_cunyjcamp_start_timestamp', $start_timestamp );
			
			$end_timestamp = strtotime( $_POST['cunyjcamp-end-date-time'] );
			update_post_meta( $post_id, '_cunyjcamp_end_timestamp', $end_timestamp );			
			
			$required_equipment_terms = $_POST['cunyjcamp-required-equipment'];
			wp_set_object_terms( $post_id, $required_equipment_terms, 'cunyjcamp_equipment' );			
			
			$event_instructors = $_POST['cunyjcamp-instructors'];
			wp_set_object_terms( $post_id, $event_instructors, 'cunyjcamp_instructors' );
		
		} // END if ( !wp_is_post_revision( $post ) && !wp_is_post_autosave( $post ) )
		
	} // END save_post_meta_box()
	
} // END class cunyjcamp_event
	
} // END if ( !class_exists( 'cunyjcamp_event' ) )

?>