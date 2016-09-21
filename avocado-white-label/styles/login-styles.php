<?php
/**
 * Avocado Theme Options
 *
 * Load Theme related dynamic css
 *
 * @package Avocado
 * @since Avocado 1.0
 */
 
 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 
 /*****************************************************
  * 
  * LOGIN STYLES
  * 
  ****************************************************/
  
  $avocado_global = avocado_global();
  
  ?>
  
    body.login {
       background-color:<?php echo $avocado_global['avocado_login_color_background']['background-color']?>; 
       <?php if ( $avocado_global['avocado_login_color_background']['background-image'] !== '') {?> 
       background-image:url(<?php echo $avocado_global['avocado_login_color_background']['background-image']?>); 
       <?php } if ( $avocado_global['avocado_login_color_background']['background-repeat'] !== '') { ?>
       background-repeat:<?php echo $avocado_global['avocado_login_color_background']['background-repeat']?>; 
       <?php } if ( $avocado_global['avocado_login_color_background']['background-position'] !== '') { ?>
       background-position:<?php echo $avocado_global['avocado_login_color_background']['background-position']?>; 
       <?php } if ( $avocado_global['avocado_login_color_background']['background-size'] !== '') { ?>
       background-size:<?php echo $avocado_global['avocado_login_color_background']['background-size']?>;
       <?php } if ( $avocado_global['avocado_login_color_background']['background-attachment'] !== '') { ?>
       background-attachment:<?php echo $avocado_global['avocado_login_color_background']['background-attachment']?>;
       <?php } ?>
    } 
    
    body.login div#login {
            background: <?php echo $avocado_global['avocado_logform_bg']['rgba']; echo '!important;'; ?>;
    }   
    
    
    
@media only screen and (min-width: 320px) and (max-width: 568px) {
    
    body.login {
       background-color:<?php echo $avocado_global['avocado_login_color_background']['background-color']?>; 
       <?php if ( $avocado_global['avocado_login_color_background']['background-image'] !== '') {?> 
       background-image:url(<?php echo $avocado_global['avocado_login_color_background']['background-image']?>); 
       <?php } if ( $avocado_global['avocado_login_color_background']['background-repeat'] !== '') { ?>
       background-repeat:<?php echo $avocado_global['avocado_login_color_background']['background-repeat']?>; 
       <?php } if ( $avocado_global['avocado_login_color_background']['background-position'] !== '') { ?>
       background-position:<?php echo $avocado_global['avocado_login_color_background']['background-position']?>; 
       <?php } if ( $avocado_global['avocado_login_color_background']['background-size'] !== '') { ?>
       background-size:<?php echo $avocado_global['avocado_login_color_background']['background-size']?>;
       <?php } if ( $avocado_global['avocado_login_color_background']['background-attachment'] !== '') { ?>
       background-attachment:<?php echo $avocado_global['avocado_login_color_background']['background-attachment']?>;
       <?php } ?>
    } 
    
    body.login div#login {
            background: <?php echo $avocado_global['avocado_logform_bg']['rgba']; echo '!important;'; ?>;
    }
    
}