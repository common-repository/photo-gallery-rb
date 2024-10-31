<?php
/*
Plugin Name: Photo Gallery RB
Plugin URI: https://profiles.wordpress.org/rbplugins#content-plugins
Description: Photo gallery plugin with wide range of configuration option. Simple image management tools. Customizable thumbnails layout.
Version: 1.0.10
Author: rbplugins
Author URI: https://profiles.wordpress.org/rbplugins
License: GPL2
Text Domain: photo-gallery-rb
Domain Path: /languages/
*/

if( !defined('WPINC') || !defined("ABSPATH") ) die();

define("RB_PHOTO_GALLERY_PATH", 	plugin_dir_path( __FILE__ ) );
define("RB_PHOTO_GALLERY_VERSION", 	'1.0.10' );
define("RB_PHOTO_GALLERY_URL", 		plugin_dir_url( __FILE__ ) );

include_once( RB_PHOTO_GALLERY_PATH .'class_rb_photo-gallery.php');

$rb_PhotoGallery = new RB_Photo_Gallery();