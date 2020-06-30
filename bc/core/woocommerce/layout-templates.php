<?php

/**
 * Change number or products per row to 3
 */
add_filter('loop_shop_columns', 'loop_columns', 999);
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}

/**
 * Filter woocommerce_loop_add_to_cart_link
 */
add_filter( 'woocommerce_loop_add_to_cart_link', function($link, $product, $args){ 
	return $link;
},10, 3);




/*

	Add WooCommerce Cart Icon to Menu with Cart Item Count

*/ 

/**
 * Add WooCommerce Cart Menu Item Shortcode to particular menu
 * See [WPBC_woo_cart_btn] shorcode
 */  
add_filter('wp_nav_menu_items', 'WPBC_woo_cart_btn__nav', 10, 2);
function WPBC_woo_cart_btn__nav($items, $args){
    if( $args->theme_location == 'primary' ){
        $items .=  '[WPBC_woo_cart_btn]';
    }
    return $items;
}




/* content-product.php */

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action('woocommerce_before_shop_loop_item_title', 'WPBC_woo_product_thumbnail',10);
function WPBC_woo_product_thumbnail(){
	global $product;
	$post_thumbnail_id = $product->get_image_id();
	$full_size = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
	$full_src = wp_get_attachment_image_src( $post_thumbnail_id, $full_size ); 
	?>
<span class="embed-responsive embed-responsive-1by1">
<span class="embed-responsive-item image-cover" style="background-image: url(<?php echo $full_src[0]; ?>);"></span>
</span>
	<?php
}