<?php
/**
 * Plugin Name: CF7 Zica Mask
 * Plugin URI: https://github.com/lucascaires/cf7-telefone
 * Description: Plugin do WordPress que adiciona máscara nos campos de telefone do Contact Form 7.
 * Version: 1.0
 * Author: Jano Sousa
 * Author URI: https://profiles.wordpress.org/lucascaires
 * License: GPL version 2 or later - http://www.gnu.org/licenses/gpl-3.0.en.html
 */
defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );

function zica_mask_enqueue_masked_input(){
 
      if( is_page('solicite-um-orcamento') )  //vai carregar somente na pagina Contato.
            wp_enqueue_script('masked-input', plugin_dir_url( __FILE__ ) . '/js/jquery.mask.min.js', array('jquery'), '1.0.0');
 
}
add_action('wp_enqueue_scripts', 'zica_mask_enqueue_masked_input');

add_action('wp_footer', 'zica_mask_activate_masked_input');
 
function zica_mask_activate_masked_input(){
   if( is_page('solicite-um-orcamento') ){ //mais uma vez, feito isso, o script abaixo só aparecerá na página Contato.
?>
 
         <script type="text/javascript">
                 jQuery( function($){
            var SPMaskBehavior = function (val) {
               return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
               },
  spOptions = {
    onKeyPress: function(val, e, field, options) {
        field.mask(SPMaskBehavior.apply({}, arguments), options);
      }
  };
  $('#tel').mask(SPMaskBehavior, spOptions);
 
});
 
         </script>
 
<?php 
   }
}