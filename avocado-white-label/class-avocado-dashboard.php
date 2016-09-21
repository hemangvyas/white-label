<?php

defined('ABSPATH') || die;

error_reporting(E_ALL);
ini_set("display_errors","On");
 /******************************************************************
 * 
 * Dashboard Theming
 * 
 * 
 *****************************************************************/

if (!class_exists('Avocado_Custom_Dashboard')) {
    
    
	
	class Avocado_Custom_Dashboard {
	
		
		public function __construct() {

		add_action( 'admin_bar_menu', array($this, 'avocado_remove_wp_logo'), 999 );
		
		add_action( 'admin_bar_menu', array($this, 'add_homepage_admin_bar_link'), 10);
		
		add_action( 'wp_dashboard_setup', array($this, 'avocado_disable_default_dashboard_widgets'), 999);
		
		}	
		
		
    
    public function avocado_disable_default_dashboard_widgets() {
	global $wp_meta_boxes, $avocado_opts;
	// wp..
	if ($avocado_opts['avocado_dashboard_activity'] == 'unset') { unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity'] ); } 
	if ($avocado_opts['avocado_dashboard_activity'] == 'unset') { unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'] ); } 
	unset( $wp_meta_boxes['dashboard']['side']['high']['redux_dashboard_widget'] ); 
	if ($avocado_opts['avocado_dashboard_woo_reviews'] == 'unset') { unset( $wp_meta_boxes['dashboard']['normal']['core']['woocommerce_dashboard_recent_reviews'] ); }
	if ($avocado_opts['avocado_dashboard_woo_status'] == 'unset') { unset( $wp_meta_boxes['dashboard']['normal']['core']['woocommerce_dashboard_status'] ); }
	if ($avocado_opts['avocado_dashboard_comments'] == 'unset') { unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments'] ); }// Recent Comments
	if ($avocado_opts['avocado_dashboard_links'] == 'unset') { unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links'] ); }  // Incoming Links
	if ($avocado_opts['avocado_dashboard_plugins'] == 'unset') { unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins'] ); }
	if ($avocado_opts['avocado_dashboard_primary'] == 'unset') { unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'] ); }
	if ($avocado_opts['avocado_dashboard_secondary'] == 'unset') { unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary'] ); }
	if ($avocado_opts['avocado_dashboard_press'] == 'unset') { unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press'] ); }        // Quick Press
	if ($avocado_opts['avocado_dashboard_drafts'] == 'unset') { unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts'] ); }       // Recent Drafts

    }
	
	public function avocado_remove_wp_logo( $wp_admin_bar ) {
            
    	$wp_admin_bar->remove_node( 'wp-logo' );
    	
        }
        
    function add_homepage_admin_bar_link( $wp_admin_bar ) {
    global $avocado_opts;
    if ($avocado_opts['avocado_adminbar_logo'] !== '') {
    $blog_title = '';
    } else {$blog_title == get_bloginfo( 'name' );}
    $args = array(
    'id' => 'homepage-link',
    'title' => $blog_title,
    'href' => home_url(),
    'meta' => array(
            'class' => 'avocado-site-name'
        )
    );

    $wp_admin_bar->add_node($args);
    }
    
	}
}	
new Avocado_Custom_Dashboard();
