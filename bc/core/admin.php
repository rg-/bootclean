<?php
function WPBC_admin_enqueue_inline_styles(){ 
	$css = '';
	$handle = 'wpbc-admin-inline-style';  
	wp_register_style( $handle, false );
    wp_enqueue_style( $handle );
	wp_add_inline_style( $handle  , $css ); 
	
} 
add_action( 'admin_enqueue_scripts', 'WPBC_admin_enqueue_inline_styles', 998 ); 


/*

	Update options using ajax !!

*/

function WPBC_get_notice__options_updated(){
	?><div class="notice notice-updated updated is-dismissible added-by-ajax"><p><?php _e( 'Option updated', 'bootclean'); ?></p></div><?php
}
function WPBC_get_notice__options_updated_fail(){
	?><div class="notice notice-error error is-dismissible added-by-ajax"><p><?php _e( 'Options not updated, something went wrong.', 'bootclean'); ?></p></div><?php
}

add_action( 'admin_footer', function(){
	?><script type="text/javascript">
		if (window.jQuery) {
			  
			jQuery(function($) {
				
				function WPBC_get_notice__options_updated(msg){
					out = '<div class="notice notice-updated updated is-dismissible added-by-ajax"><p><?php _e( 'Option updated', 'bootclean'); ?> ' + msg + '</p></div>';
					jQuery('#wpbody-content > .wrap > .wp-header-end').before(out);
				}
				
				function WPBC_ajax_post_data(postData){
					jQuery('#wpbody-content .notice.added-by-ajax').remove(); 
					$.ajax({
						type: "POST",
						data: postData,
						// dataType:"json",
						url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
						success: function (response) { 
							option = postData.option;
							option_update = postData.option_update;
							
							msg = ': name: <i><b>'+option+'</b></i> value: <b>'+option_update+'</b>';
							
							WPBC_get_notice__options_updated(msg);
							
							//jQuery('#wpbody-content > .wrap > .wp-header-end').before('<?php WPBC_get_notice__options_updated(); ?>'); 
						}
					}).fail(function (data) {  
						
					}); 
				}
				
				// Hook into the "notice-my-class" class we added to the notice, so
				// Only listen to YOUR notices being dismissed
				
				$( document ).on( 'click', '[data-option-update]', function (event) {
					
					// event.preventDefault();
					
					var el = $(this);
					var option = el.data( 'option' );
					var option_update = el.data( 'option-update' ); 
					var hide_notice = el.data('option-hide-notice');
					
					var postData = {
						action: 'wpbc_update_option', 
						option: option,
						option_update: option_update,
						hide_notice: hide_notice
					} 
					
					WPBC_ajax_post_data(postData); 
					
				} ); // on( 'click'... END 
				
			  });
		}
	</script>
	<?php
}, 998 ); // admin_enqueue_scripts is 10
 
add_action( 'wp_ajax_' . 'wpbc_update_option', 'WPBC_ajax_update_option' );
// add_action( 'wp_ajax_nopriv_' . 'wpbc_update_option', 'WPBC_ajax_update_option' );

function WPBC_ajax_update_option() { 
    //$type = $_POST["type"];
	$option = $_POST["option"];
	$option_update = $_POST["option_update"]; 
    	update_option( $option, $option_update ); 
	die(); 
}

