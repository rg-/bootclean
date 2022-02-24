<?php

/*
	see https://stackoverflow.com/questions/65793717/ajax-add-to-cart-for-simple-and-variable-products-on-woocommerce-single-products
*/

/*
 *
 * WPBC > WOO > ajax_add_to_cart
 *
*/

add_filter( 'woocommerce_add_to_cart_fragments', 'ace_ajax_add_to_cart_add_fragments' );
function ace_ajax_add_to_cart_add_fragments( $fragments ){

	$product_id = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );
	$quantity = empty( $_POST['quantity'] ) ? 1 : apply_filters( 'woocommerce_stock_amount', $_POST['quantity'] );
	$variation_id = $_POST['variation_id'];		

	$fragments['notices_html'] = $variation_id;

	return $fragments; 
}

add_action( 'wp_footer', 'single_product_ajax_add_to_cart_js_script' );
function single_product_ajax_add_to_cart_js_script() {
    ?>
    <script>
    
    	/* Wc add to cart version 2.2 */
jQuery( function( $ ) {

	// wc_add_to_cart_params is required to continue, ensure the object exists
	if ( typeof wc_add_to_cart_params === 'undefined' )
		return false;
		
		// Ajax add to cart
		$( document ).on( 'click', '.variations_form .single_add_to_cart_button', function(e) {
				
				e.preventDefault();
				
				$variation_form = $( this ).closest( '.variations_form' );
				var var_id = $variation_form.find( 'input[name=variation_id]' ).val();
				var product_id = $variation_form.find( 'input[name=product_id]' ).val();
				var quantity = $variation_form.find( 'input[name=quantity]' ).val();
				
				//attributes = [];
				$( '.ajaxerrors' ).remove();
				var item = {},
					check = true;
					
					variations = $variation_form.find( 'select[name^=attribute]' );
					
					/* Updated code to work with radio button - mantish - WC Variations Radio Buttons - 8manos */ 
					if ( !variations.length) {
						variations = $variation_form.find( '[name^=attribute]:checked' );
					}
					
					/* Backup Code for getting input variable */
					if ( !variations.length) {
		    			variations = $variation_form.find( 'input[name^=attribute]' );
					}
				
				variations.each( function() {
				
					var $this = $( this ),
						attributeName = $this.attr( 'name' ),
						attributevalue = $this.val(),
						index,
						attributeTaxName;
				
					$this.removeClass( 'error' );
				
					if ( attributevalue.length === 0 ) {
						index = attributeName.lastIndexOf( '_' );
						attributeTaxName = attributeName.substring( index + 1 );
				
						$this
							.addClass( 'required error' )
							.before( '<div class="ajaxerrors"><p>Please select ' + attributeTaxName + '</p></div>' )
				
						check = false;
					} else {
						item[attributeName] = attributevalue;
					}
				
				} );
				
				if ( !check ) {
					return false;
				}
				
				var $thisbutton = $( this );

				if ( $thisbutton.is( '.variations_form .single_add_to_cart_button' ) ) {

					$thisbutton.removeClass( 'added' );
					$thisbutton.addClass( 'loading' );

					var data = {
						action: 'woocommerce_add_to_cart_variable_rc',
					};

					$variation_form.serializeArray().map(function (attr) {
						if (attr.name !== 'add-to-cart') {
						    if (attr.name.endsWith('[]')) {
						        let name = attr.name.substring(0, attr.name.length - 2);
						        if (!(name in data)) {
						            data[name] = [];
						        }
						        data[name].push(attr.value);
						    } else {
						        data[attr.name] = attr.value;
						    }
						}
					});

					// Trigger event
					$( 'body' ).trigger( 'adding_to_cart', [ $thisbutton, data ] );

					// Ajax action
					$.post( wc_add_to_cart_params.ajax_url, data, function( response ) {

						if ( ! response ) {
							return;
						}

						if ( response.error && response.product_url ) {
							window.location = response.product_url;
							return;
						}

						// Redirect to cart option
						if ( wc_add_to_cart_params.cart_redirect_after_add === 'yes' ) {
							window.location = wc_add_to_cart_params.cart_url;
							return;
						}
						
						//console.log(response);

						//$('.woocommerce-notices-wrapper').html(response.fragments.notices_html);

						// Trigger event so themes can refresh other areas.
						$( document.body ).trigger( 'added_to_cart', [ response.fragments, response.cart_hash, $thisbutton ] );

					});

					return false;

				} else {
					
					return true;
				}

			});

		});


    </script>
    <?php
}

/* AJAX add to cart variable added by Rishi Mehta - rishi@rcreators.com */
add_action( 'wp_ajax_woocommerce_add_to_cart_variable_rc', 'woocommerce_add_to_cart_variable_rc_callback' );
add_action( 'wp_ajax_nopriv_woocommerce_add_to_cart_variable_rc', 'woocommerce_add_to_cart_variable_rc_callback' );

function woocommerce_add_to_cart_variable_rc_callback() {
	ob_start();
	
	$product_id = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );
	$quantity = empty( $_POST['quantity'] ) ? 1 : apply_filters( 'woocommerce_stock_amount', $_POST['quantity'] );
	$variation_id = $_POST['variation_id'];		

	$cart_item_data = $_POST;
	unset($cart_item_data['quantity']);
	
	$variation = array();

	foreach ($cart_item_data as $key => $value) {
		if (preg_match("/^attribute*/", $key)) {
			$variation[$key] = $value;
		}
	}
	
	foreach ($variation as $key=>$value) { $variation[$key] = stripslashes($value); }
	$passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );

	if ( $passed_validation && WC()->cart->add_to_cart( $product_id, $quantity, $variation_id, $variation, $cart_item_data  ) ) {
		do_action( 'woocommerce_ajax_added_to_cart', $product_id );
		if ( get_option( 'woocommerce_cart_redirect_after_add' ) == 'yes' ) {
			wc_add_to_cart_message( $product_id );
		}
		global $woocommerce;
		$items = $woocommerce->cart->get_cart();
		wc_setcookie( 'woocommerce_items_in_cart', count( $items ) );
    wc_setcookie( 'woocommerce_cart_hash', md5( json_encode( $items ) ) );
    do_action( 'woocommerce_set_cart_cookies', true );
		// Return fragments
		WC_AJAX::get_refreshed_fragments(); 
	
	} else {

		// If there was an error adding to the cart, redirect to the product page to show any errors
		$data = array(
			'error' => true,
			'product_url' => apply_filters( 'woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id )
		);
		wp_send_json_error( $data );
	}
}  
