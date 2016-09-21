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
  * ADMIN STYLES
  * 
  ****************************************************/
  
  $avocado_global = avocado_global();
  
  ?>

    
    .avocado-site-name {
            background-image: url('<?php echo $avocado_global['avocado_adminbar_logo']['url']; ?>')<?php  echo '!important'; ?>
    }
    
