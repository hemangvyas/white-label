<?php
defined('ABSPATH') || die;
error_reporting(E_ALL);
ini_set("display_errors","On");

 /******************************************************************
 * 
 * Login Page Related Functions
 * 
 * 
 *****************************************************************/

if (!class_exists('Avocado_Custom_Login')) {
	
	class Avocado_Custom_Login {
	
		protected $avocado_opts;
		
		public function __construct() {
		
		add_action( 'login_form', array($this, 'avocado_add_video_background'));
		
		add_action( 'login_enqueue_scripts', array($this, 'avocado_login_logo'));
		
		add_action( 'login_form', array($this, 'avocado_login_content'));
		
		add_filter( 'login_headertitle', array($this, 'avocado_login_title'));
		
		add_filter( 'login_headerurl', array($this, 'avocado_login_logo_url'));

		
		}	
    
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
    
    
    function avocado_login_title() {
    
    global $avocado_opts;
    
    return  esc_attr__($avocado_opts['avocado_login_title'], 'avocado');
        
    }


    function avocado_login_logo_url() {
    
    return home_url();
    }
    
	}
	
}
$Avocado_Custom_Login = new Avocado_Custom_Login();
