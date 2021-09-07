<?php
/**
 * @package  gaBlockerDetector
 */
/*
Plugin Name: GA Blocker Detector
Plugin URI: https://punchsalad.com
Description: This plugin detects that GA is blocked and sends an event to your GA to notify you.
Version: 1.0.0
Author: Robert from TipsWithPunch
Author URI: https://punchsalad.com
License: GPLv2 or later
Text Domain: gaBlockerDetector-plugin
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
Copyright 2005-2015 Automattic, Inc.
*/

defined( 'ABSPATH' ) or die( 'Hey, what are you doing here? You silly human!' );



class gaBlockerDetector
{

	function register(){
		// for front end
		add_action('wp_enqueue_scripts', array( $this, 'enqueue' ) );	
		
		add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );
		
        add_action( 'admin_init', array( $this, 'register_gbd_general_settings' ) );
        
	}
	
	public function add_admin_pages() {
		add_submenu_page( 'options-general.php', 'GA Blocker Detector Plugin', 'GA Blocker Detector', 'manage_options', 'gbd_plugin', array( $this, 'admin_index' ), 110 );
	}
	
	public function admin_index() {
		require_once plugin_dir_path( __FILE__ ) . 'templates/admin.php';
	}


	public function custom_post_type() {
		register_post_type( 'book', ['public' => true, 'label' => 'Books'] );
	}

	public function enqueue(){

		wp_enqueue_script('my_custom_script', plugins_url( '/ga-blocked-tracking.js' , __FILE__ ) );
	}
	
	
	public function register_gbd_general_settings(){
		//registers all settings for general settings page
		register_setting( 'gbdcustomsettings', 'uaId' );
	}

}

if ( class_exists( 'gaBlockerDetector' ) ) {
	$gaBlockerDetector = new gaBlockerDetector();
	$gaBlockerDetector->register();
}

// activation
register_activation_hook( __FILE__, array( $gaBlockerDetector, 'activate' ) );

// deactivation
register_deactivation_hook( __FILE__, array( $gaBlockerDetector, 'deactivate' ) );