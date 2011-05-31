<?php

define( 'CUNYJCAMP_VERSION', '0.0' );

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

		if ( is_admin() ) {
			add_action( 'admin_menu', array(&$this, 'add_admin_menu_items') );
		}

	} // END init()
	
	/**
	 * register_menus()
	 * Register menus
	 */
	function register_menus() {
		
		// @todo Register any navigation menus we need
		
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
		}
		
	} // END enqueue_resources()
	
	/**
	 * create_taxonomies()
	 * Register taxonomies for all of our post types
	 */
	function create_taxonomies() {
		
		// @todo Register any taxonomies we need. Skills?	
		
	} // END create_taxonomies()
	
	/**
	 * register_settings()
	 */
	function register_settings() {

		register_setting( $this->options_group, $this->options_group_name, array( &$this, 'settings_validate' ) );
		
		// @todo Register any settings we need

	} // END register_settings()
	
	/**
	 * settings_validate()
	 * Validation and sanitization on the settings field
	 */
	function settings_validate( $input ) {

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

?>