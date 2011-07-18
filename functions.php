<?php

define( 'CUNYJCAMP_VERSION', '0.7a' );

// Require necessary files
require_once( 'php/class.cunyjcamp_event.php' );

if ( !class_exists( 'cunyjcamp' ) ) {
	
class cunyjcamp
{
	
	var $theme_taxonomies = array();
	var $options_group = 'cunyjcamp_';
	var $options_group_name = 'cunyjcamp_options';
	var $settings_page = 'cunyjcamp_settings';
	
	/**
	 * __construct()
	 */
	function __construct() {
		
		$this->options = get_option( $this->options_group_name );	
		$this->events = new cunyjcamp_event();	
		
		add_action( 'after_setup_theme', array( &$this, 'init' ) );

		add_action( 'init', array( &$this, 'create_taxonomies' ) );
		add_action( 'init', array( &$this, 'enqueue_resources' ) );
		add_action( 'init', array( &$this, 'register_menus' ) );
		
		add_action( 'admin_init', array( &$this, 'admin_init' ) );
		
		// @todo Register any image sizes we need
		
	} // END __construct()
	
	/**
	 * init()
	 */
	function init() {

		add_theme_support( 'post-thumbnails' );
		add_image_size( 'home-thumbnail', 220, 140, true );

		if ( is_admin() ) {
			add_action( 'admin_menu', array( &$this, 'add_admin_menu_items' ) );
			add_action( 'admin_menu', array( &$this, 'remove_metaboxes' ) );
		}

	} // END init()
	
	/**
	 * register_menus()
	 * Register menus
	 */
	function register_menus() {
		
		$args = array( 
			'page_navigation' => 'Page Navigation',
		);
		register_nav_menus( $args );
		
	} // END register_menus()
	
	/**
	 * admin_init()
	 */
	function admin_init() {

		$this->register_settings();

	} // END admin_init()
	
	/**
	 * add_admin_menu_items()
	 * Any admin menu items we need
	 */
	function add_admin_menu_items() {

		add_submenu_page( 'themes.php', 'CUNY J-Camp Theme Options', 'Theme Options', 'manage_options', 'cunyjcamp_options', array( &$this, 'options_page' ) );			

	} // END add_admin_menu_items()
	
	/**
	 * enqueue_resources()
	 * Enqueue any resources we need
	 */
	function enqueue_resources() {
		
		if ( !is_admin() ) {
			wp_enqueue_style( 'cunyjcamp_primary_css', get_bloginfo( 'template_directory' ) . '/style.css', false, CUNYJCAMP_VERSION );
			wp_enqueue_style( 'google_droid_sans', 'http://fonts.googleapis.com/css?family=Droid+Sans:regular,bold' );
			
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'jquery_masonry', get_bloginfo( 'template_directory' ) . '/js/jquery.masonry.min.js', array( 'jquery' ), CUNYJCAMP_VERSION );			
			wp_enqueue_script( 'cunyjcamp_primary_js', get_bloginfo( 'template_directory' ) . '/js/primary.js', array( 'jquery' ), CUNYJCAMP_VERSION );			
		}
		
	} // END enqueue_resources()
	
	/**
	 * create_taxonomies()
	 * Register taxonomies for all of our post types
	 */
	function create_taxonomies() {
		
		// @todo Register any taxonomies we need. Skills?
		
		// Register the Instructors taxonomy
		$args = array(
			'label' => 'Instructors',
			'labels' => array(
				'name' => 'Instructors',
				'singular_name' => 'Instructor',
				'search_items' =>  'Search Instructors',
				'popular_items' => 'Popular Instructors',
				'all_items' => 'All Instructors',
				'parent_item' => 'Parent Instructor',
				'parent_item_colon' => 'Parent Instructor:',
				'edit_item' => 'Edit Instructor', 
				'update_item' => 'Update Instructor',
				'add_new_item' => 'Add New Instructor',
				'new_item_name' => 'New Instructor',
				'separate_items_with_commas' => 'Separate instructors with commas',
				'add_or_remove_items' => 'Add or remove instructors',
				'choose_from_most_used' => 'Choose from the most common instructors',
				'menu_name' => 'Instructors',
			),
			'show_tagcloud' => false,		
			'rewrite' => array(
				'slug' => 'instructors',
				'hierarchical' => true,
			),
		);

		$post_types = array(
			'cunyjcamp_event',
		);
		register_taxonomy( 'cunyjcamp_instructors', $post_types, $args );
		$this->theme_taxonomies[] = 'cunyjcamp_instructors';
		
		// Register the Equipment taxonomy
		$args = array(
			'label' => 'Equipment',
			'labels' => array(
				'name' => 'Equipment',
				'singular_name' => 'Equipment',
				'search_items' =>  'Search Equipment',
				'popular_items' => 'Popular Equipment',
				'all_items' => 'All Equipment',
				'parent_item' => 'Parent Equipment',
				'parent_item_colon' => 'Parent Equipment:',
				'edit_item' => 'Edit Equipment', 
				'update_item' => 'Update Equipment',
				'add_new_item' => 'Add New Equipment',
				'new_item_name' => 'New Equipment',
				'separate_items_with_commas' => 'Separate equipment with commas',
				'add_or_remove_items' => 'Add or remove equipment',
				'choose_from_most_used' => 'Choose from the most common equipment',
				'menu_name' => 'Equipment',
			),
			'show_tagcloud' => false,		
			'rewrite' => array(
				'slug' => 'equipment',
				'hierarchical' => true,
			),
		);

		$post_types = array(
			'cunyjcamp_event',
		);
		register_taxonomy( 'cunyjcamp_equipment', $post_types, $args );
		$this->theme_taxonomies[] = 'cunyjcamp_equipment';
		
		// Register the Location taxonomy
		$args = array(
			'label' => 'Locations',
			'labels' => array(
				'name' => 'Locations',
				'singular_name' => 'Location',
				'search_items' =>  'Search Locations',
				'popular_items' => 'Popular Locations',
				'all_items' => 'All Locations',
				'parent_item' => 'Parent Location',
				'parent_item_colon' => 'Parent Location:',
				'edit_item' => 'Edit Location', 
				'update_item' => 'Update Location',
				'add_new_item' => 'Add New Location',
				'new_item_name' => 'New Location',
				'separate_items_with_commas' => 'Separate locations with commas',
				'add_or_remove_items' => 'Add or remove locations',
				'choose_from_most_used' => 'Choose from the most common locations',
				'menu_name' => 'Locations',
			),
			'show_tagcloud' => false,
			'hierarchical' => true,		
			'rewrite' => array(
				'slug' => 'locations',
				'hierarchical' => true,
			),
		);

		$post_types = array(
			'cunyjcamp_event',
		);
		register_taxonomy( 'cunyjcamp_locations', $post_types, $args );
		$this->theme_taxonomies[] = 'cunyjcamp_locations';
		
	} // END create_taxonomies()
	
	/**
	 * remove_metaboxes
	 */
	function remove_metaboxes() {
		
		// Remove taxonomy metaboxes
		remove_meta_box( 'tagsdiv-cunyjcamp_instructors', 'cunyjcamp_event', 'side' );
		remove_meta_box( 'tagsdiv-cunyjcamp_equipment', 'cunyjcamp_event', 'side' );	
		remove_meta_box( 'tagsdiv-cunyjcamp_locations', 'cunyjcamp_event', 'side' );		
		
	} // END remove_metaboxes()
	
	/**
	 * register_settings()
	 */
	function register_settings() {

		register_setting( $this->options_group, $this->options_group_name, array( &$this, 'settings_validate' ) );
		
		// @todo Register any settings we need
		// Home section
		add_settings_section( 'cunyjcamp_home', 'Home', array(&$this, 'settings_home_section'), $this->settings_page );
		add_settings_field( 'header_email_signup', 'Email Newsletter Signup URL', array(&$this, 'settings_header_email_signup_option'), $this->settings_page, 'cunyjcamp_home' );		
		add_settings_field( 'home_introduction_text', 'Introductory Text', array(&$this, 'settings_home_introduction_text_option'), $this->settings_page, 'cunyjcamp_home' );

	} // END register_settings()
	
	/**
	 * settings_header_email_signup_option()
	 */
	function settings_header_email_signup_option() {

		$options = $this->options;

		echo '<input id="header_email_signup" name="' . $this->options_group_name . '[header_email_signup]" type="input" size="80"';
		if ( isset( $options['header_email_signup'] ) && $options['header_email_signup'] ) {
			echo ' value="' . $options['header_email_signup'] . '"';
		}
		echo ' />';
		echo '<p class="description">Please add a link to the email newsletter signup form.</p>';

	} // END settings_header_email_signup_option()
	
	/**
	 * settings_home_introduction_text_option()
	 */
	function settings_home_introduction_text_option() {

		$options = $this->options;
		$allowed_tags = htmlentities( '<b><strong><em><i><span><a><br><ol><li><ul><p><blockquote>' );

		echo '<textarea id="home_introduction_text" name="' . $this->options_group_name . '[home_introduction_text]" cols="80" rows="6">';
		if ( isset( $options['home_introduction_text'] ) && $options['home_introduction_text'] ) {
			echo $options['home_introduction_text'];
		}
		echo '</textarea>';
		echo '<p class="description">The following tags are permitted: ' . $allowed_tags . '</p>';

	} // END settings_home_introduction_text_option()
	
	/**
	 * settings_validate()
	 * Validation and sanitization on the settings field
	 */
	function settings_validate( $input ) {
		
		$allowed_tags = htmlentities( '<b><strong><em><i><span><a><br><ol><li><ul><p><blockquote>' );
		
		$input['header_email_signup'] = strip_tags( $input['header_email_signup'] );
		$input['home_introduction_text'] = strip_tags( $input['home_introduction_text'], $allowed_tags );

		return $input;

	} // END settings_validate()
	
	/**
	 * Options page for the theme
	 */
	function options_page() {
		?>                                   
		<div class="wrap">
			<div class="icon32" id="icon-options-general"><br/></div>

			<h2>CUNY J-Camp Theme Options</h2>

			<form action="options.php" method="post">

				<?php settings_fields( $this->options_group ); ?>
				<?php do_settings_sections( $this->settings_page ); ?>

				<p class="submit"><input name="submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" /></p>

			</form>
		</div>
		<?php
	} // END options_page()	
	
} // END class cunyjcamp	
	
} // END if ( !class_exists( 'cunyjcamp' ) )

global $cunyjcamp;
$cunyjcamp = new cunyjcamp();

/**
 * cunyjcamp_head_title()
 */
function cunyjcamp_head_title() {
	
	$title = get_bloginfo('name') . ' | ' . get_bloginfo('description');
	
	if ( is_single() ) {
		global $post;
		$title = get_the_title( $post->ID );
	} else if ( is_tax() ) {
		$title = single_term_title( false, false ) . ' | ' . get_bloginfo('name');
	}
	
	echo '<title>' . $title . '</title>';
	
} // END cunyjcamp_head_title()

/**
 * cunyjcamp_get_theme_option()
 */ 
function cunyjcamp_get_theme_option( $key ) {
	global $cunyjcamp;
	
	if ( isset( $cunyjcamp->options[$key] ) )
		return $cunyjcamp->options[$key];
	else
		return false;
 	
} // END cunyjcamp_get_theme_option()

/**
 * Produce the date and time according to our style guide
 */
function cunyjcamp_get_date_time( $type, $markup = true ) {
	global $post;
	
	if ( !isset( $post ) )
		return '';

	$all_day_event = get_post_meta( $post->ID, '_cunyjcamp_all_day_event', true );	
	$start_timestamp = get_post_meta( $post->ID, '_cunyjcamp_start_timestamp', true );
	$end_timestamp = get_post_meta( $post->ID, '_cunyjcamp_end_timestamp', true );
	
	if ( !$start_timestamp || !$end_timestamp )
		return '';
		
	$html = '';	
	if ( $type == 'short' ) {
		$date_format = 'm/d/y';
		$time_format = 'g:i A';
		// @todo complete
	} else if ( $type == 'short_time' ) {
		$time_format = 'g:i A';
		$start_time = date( $time_format, $start_timestamp );
		$end_time = date( $time_format, $end_timestamp );		
		if ( $all_day_event == 'on' || $start_time == $end_time )
			$html .= 'All day';
		else
			$html .= $start_time . ' to ' . $end_time;
	} else if ( $type == 'long_both' ) {
		$date_format = 'l, F jS';
		$time_format = 'g:i A';
		
		$start_date = date( $date_format, $start_timestamp );
		$start_time = date( $time_format, $start_timestamp );
		
		$end_date = date( $date_format, $end_timestamp );
		$end_time = date( $time_format, $end_timestamp );
		
		// We're just adding line breaks if they're needed
		if ( $markup )
			$markup = '<br />';
		else
			$markup = ' ';
		
		if ( $start_date != $end_date && $all_day_event == 'on' )
			$html = $start_date . $markup . 'to ' . $end_date;

		if ( $start_date != $end_date && $all_day_event != 'on' )
			$html = $start_date . ' at ' . $start_time . $markup . 'to ' . $end_date . ' at ' . $end_time;
		
		if ( $start_date == $end_date && $all_day_event == 'on' )
			$html = $start_date;

		if ( $start_date == $end_date && $all_day_event != 'on' )
			$html = $start_date . $markup . 'from ' . $start_time . ' to ' . $end_time;
		
		
	}
	return $html;
	
} // END cunyjcamp_get_date_time()

?>