<?php

error_reporting(E_ALL);
ini_set("display_errors","On");
 /******************************************************************
 * 
 * Login Page Related Functions
 * 
 * 
 *****************************************************************/

/*** Login Page Video Background ***/

    add_action( 'login_form', 'avocado_add_video_background' );

    function avocado_add_video_background() { 

    global $avocado_opts; ?>
  
    <script type="text/javascript"> 
  
    $('body').AvocadoVideo({
      
      <?php if ($avocado_opts['avocado_bg_source'] == 'youtube') { ?>
      
    youTube: {  
      
    videoId: '<?php echo $avocado_opts['avocado_youtube_id'] ?>',
    
    },
  
    <?php } elseif ($avocado_opts['avocado_bg_source'] == 'vimeo') { ?>
  
    youTube: {  
      
    videoId: '<?php echo $avocado_opts['avocado_vimeo_id'] ?>',
    
    },
  
    <?php } else { ?>
  
   html5: { 
       
    src: '<?php echo $avocado_opts['avocado_custom_video']['url']; ?>',
    
    },
  
    <?php } ?>
  
    overlay: {color: '<?php echo $avocado_opts['avocado_video_overlay']['rgba'] ?>'},
  
    <?php if ($avocado_opts['avocado_custom_poster']['url'] !== '') { ?>
  
    poster: '<?php echo $avocado_opts['avocado_custom_poster']['url'] ?>',
  
    <?php } ?>
  
    transitionIn: <?php echo $avocado_opts['avocado_video_transition'] ?>,
  
    autoplay: <?php echo $avocado_opts['avocado_video_autoplay'] ?>,
  
    loop: <?php echo $avocado_opts['avocado_video_loop'] ?>,
  
    muted: <?php echo $avocado_opts['avocado_video_muted'] ?>,
  
    controls: <?php echo $avocado_opts['avocado_video_controls'] ?>,
  
    ratio: 16 / 9,
  
    fitContainer: true,
  
    forceAspect: false,
  
    });

    </script>

    <?php }

 /**
  * Change Login Logo
  */
  
    function avocado_login_logo() { 
    
    global $avocado_opts; ?>
    
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo $avocado_opts['avocado_login_logo']['url']; ?>);
            width: 100%;
            background-size: contain;
        }
    </style>
    
    <?php }

    add_action( 'login_enqueue_scripts', 'avocado_login_logo' );

    function avocado_login_content() {
    
    global $avocado_opts; 
  
        $post = get_post($avocado_opts['avocado_login_content'] ); 
  
        $permalink = get_post_permalink($post); ?>
        
    <script type="text/javascript">
    jQuery(document).ready(function($) {
    $('body.login div#login').after($('<div class ="login-content"></div>'));
    $(".login-content").load("<?php echo $permalink ?> article");
    });
    </script>
    
    <?php }

    add_action( 'login_form', 'avocado_login_content' );

    function avocado_login_title() {
    
    global $avocado_opts;
    
    return  esc_attr__($avocado_opts['avocado_login_title'], 'avocado');
        
    }

    add_filter( 'login_headertitle', 'avocado_login_title' );

    function avocado_login_logo_url() {
    
    return home_url();
    }

    add_filter( 'login_headerurl', 'avocado_login_logo_url' );

    /******************************************************************
     * 
     * Desable unwanted dashboard widgets.
     * 
     *****************************************************************/
     
    function avocado_disable_default_dashboard_widgets() {
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
    
    add_action( 'wp_dashboard_setup', 'avocado_disable_default_dashboard_widgets', 999 );

    /****************************************************************
    * 
    *  Remove WordPress Logo from dashboard.
    * 
    ***************************************************************/
  
    add_action( 'admin_bar_menu', 'avocado_remove_wp_logo', 999 );
        
        function avocado_remove_wp_logo( $wp_admin_bar ) {
            
    	$wp_admin_bar->remove_node( 'wp-logo' );
    	
        }

   

    add_action( 'admin_bar_menu', 'add_homepage_admin_bar_link', 10 );

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
