<?php
/*  
 * RB Photo Gallery
 * Version:           1.0.2 - 47271
 * Author:            RBS
 * Date:              Tue, 06 Jun 2017 14:06:16 GMT
 */

if( !defined('WPINC') || !defined("ABSPATH") ){
	die();
}


class RB_Photo_Gallery {

	private $options;
	private $options_name = 'rb_photo_gallery';


	public function __construct() {
		$this->options = get_option( $this->options_name , array() );
		$this->hooks();
		$this->widget();
	}


	private function hooks() {
		add_action( 'plugins_loaded', array( $this, 'register_text_domain' ) );

		register_activation_hook( __FILE__, 	array($this, 'install_photo_gallery') );
		register_deactivation_hook( __FILE__, 	array($this, 'uninstall_photo_gallery') );

		add_action( 'wp_loaded', array( $this, 'wp_load_hooks' ) );

	}

	private function save_options() {
		update_option( $this->options_name, $this->options );
	}

	public function register_text_domain() {
		load_plugin_textdomain( 'photo-gallery-rb', false, RB_PHOTO_GALLERY_PATH . 'languages' );
	}

	public static function install_photo_gallery(){ 	
		add_option( 'photo_gallery_rb_install', 1 );  	
	}
	
	public static function uninstall_photo_gallery(){ 
		delete_option('photo_gallery_rb_install');		
	}

	public function widget() {
		include( RB_PHOTO_GALLERY_PATH .'widget.php');
	}


	public function wp_load_hooks(){
		if( is_admin() ) {
			add_action( 'admin_menu', array( $this, 'settings_menu' ) );
			add_filter( 'plugin_action_links', array( $this, 'plugin_actions_links'), 10, 2 );
		}
	}

	public function plugin_actions_links( $links, $file ) {
		static $plugin;

		if( $file == 'photo-gallery-rb/photo-gallery-rb.php' && current_user_can('manage_options') ) {
			array_unshift(
				$links,
				sprintf( '<a href="%s">%s</a>', esc_attr( $this->settings_page_url() ), __( 'Settings' ) )
			);
		}

		return $links;
	}
	
	private function settings_page_url() {
		return add_query_arg( 'page', 'rb_disable_comments_settings', admin_url( 'options-general.php' ) );
	}

	public function settings_menu() {
		$title = __( 'Rb Photo Gallery', 'photo-gallery-rb' );
		add_submenu_page( 'options-general.php', $title, $title, 'manage_options', 'rb_photo_gallery_settings', array( $this, 'options' ) );
	}


	public function options() {
		include( RB_PHOTO_GALLERY_PATH .'options.php');
	}
}