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
			wp_enqueue_script( 'cunyjcamp_events_admin_js', get_bloginfo( 'template_url' ) . '/js/events_admin.js', array('jquery'), CUNYJCAMP_VERSION, true );
			wp_enqueue_style( 'cunyjcamp_events_admin_css', get_bloginfo( 'template_url' ) . '/css/events_admin.css', false, CUNYJCAMP_VERSION, 'all' );
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
		
		// @todo build the meta box
		
	} // END post_meta_box()
	
	/**
	 * save_post_meta_box()
	 */
	function save_post_meta_box( $post_id ) {
		global $post;
		
		if ( !wp_verify_nonce( $_POST['cunyj_events-nonce'], 'cunyj_events-nonce' ) ) {
			return $post_id;  
		}
		
		if ( !wp_is_post_revision( $post ) && !wp_is_post_autosave( $post ) ) {
			
			// @todo Save the data
		}		
		
	} // END save_post_meta_box()
	
} // END class cunyjcamp_event
	
} // END if ( !class_exists( 'cunyjcamp_event' ) )

?>