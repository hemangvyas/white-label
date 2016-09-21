<?php
/*
Plugin Name: Avocado White Label
Plugin URI: http://avocadotheme.com/
Description: Turn default WordPress dashboard and login styles into white label.
Version: 1.0.0
Author: Avocadotheme
Author URI: http://avocadotheme.com
*/


define( 'AVOCADO_WHITE_LABEL_VERSION' , '1.0.0' );

define('AVOCADO_WHITE_LABEL_DIR', plugin_dir_url( __FILE__ ));



 /******************************************************************
 * 
 * Load Admin Scripts & Styles
 * 
 * 
 *****************************************************************/

    
    function avocado_login_scripts() {
    
    wp_enqueue_style( 'custom-login', AVOCADO_WHITE_LABEL_DIR. '/assets/css/login.css' );
    
    wp_enqueue_script('jquery');
    wp_enqueue_script( 'custom-login-jquery', AVOCADO_WHITE_LABEL_DIR. '/assets/js/jquery.js', array(),  false );
    wp_enqueue_script( 'custom-login-script', AVOCADO_WHITE_LABEL_DIR. '/assets/js/login.js', array(),  true );
    
    }
    add_action( 'login_enqueue_scripts', 'avocado_login_scripts' );
    
    function avocado_admin_scripts() {
      
      wp_enqueue_script('avocado_admin_login_scripts', AVOCADO_WHITE_LABEL_DIR . '/assets/js/admin-scripts.js');

      wp_enqueue_style('avocado_admin_custom_styles', AVOCADO_WHITE_LABEL_DIR . '/assets/css/admin-styles.css');
    }
    
    add_action('admin_enqueue_scripts', 'avocado_admin_scripts');

 
    if( ! function_exists( 'avocado_login_inline_styles' ) ) {
        
	    function avocado_login_inline_styles() {
	        
		echo '<style type="text/css" id="avocado_login_styles">'."\n";

			ob_start();

			{
				include_once AVOCADO_WHITE_LABEL_DIR . 'styles/login-styles.php';
				
			}

			$custom_login_css = ob_get_contents();
			
			ob_get_clean();
			
			echo minify_inline_css($custom_login_css);
	
		echo '</style>'."\n";
	    }
    }
    
    add_action( 'login_head', 'avocado_login_inline_styles' );
    
    if( ! function_exists( 'avocado_admin_inline_styles' ) ) {
        
	    function avocado_admin_inline_styles() {
	        
		echo '<style type="text/css" id="avocado_admin_styles">'."\n";

			ob_start();

			{
				include_once AVOCADO_WHITE_LABEL_DIR . 'styles/admin-styles.php';
			}

			$custom_admin_css = ob_get_contents();
			
			ob_get_clean();
			
			echo minify_inline_css($custom_admin_css);
	
		echo '</style>'."\n";
	    }
    }
    
    add_action( 'admin_head', 'avocado_admin_inline_styles' );
    
    
include_once AVOCADO_WHITE_LABEL_DIR . 'class-avocado-dashboard.php';

include_once AVOCADO_WHITE_LABEL_DIR . 'class-avocado-login.php';

