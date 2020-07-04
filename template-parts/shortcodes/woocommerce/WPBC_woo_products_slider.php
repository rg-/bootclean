<?php
$args = $args['params']; // passed from shortcode

$slick_args = array(
	'dots' => true,
	'arrows' => false,
	'slidesToShow' => 3,
	'slidesToScroll' => 3,
);
$breakpoint_height = array(
	'xs' => array(
		'default' => '100wh',
	),
); 
$this_args = array(
	"id" => (!empty($args['id'])) ? $args['id'] : 'wpbc-woo-products-slider-'.uniqid(),
	"container_class" => '',   
	"container_item_class" => '', 
	"slick" => json_encode($slick_args,true), 
	"template_items_id"=> '',
	"breakpoint_height"=> json_encode($breakpoint_height,true),
);

?>
<?php 
	/*   
	{"xs":{"default":"200px"},"sm":{"default":"300px"},"md":{"default":"400px"},"lg":{"default":"100%","min":"400px","max":"1400px"},"xl":{"default":"100%","min":"500px","max":"1400px"}}  
	*/ 
	
	$breakpoint_height = !empty($breakpoint_height) ? json_decode($breakpoint_height,true) : ''; 
?>
<?php

$template_items = '';
$args = array(
  'post_type' => 'product',
  'posts_per_page' => $args['posts_per_page'],
  );
$loop = new WP_Query( $args );
ob_start(); 
if ( $loop->have_posts() ) {
  while ( $loop->have_posts() ) : $loop->the_post();
    global $product;
    if ( empty( $product ) || ! $product->is_visible() ) {
      return;
    }
    ?><div <?php wc_product_class( 'item', $product ); ?>><?php
    do_action( 'woocommerce_before_shop_loop_item' );
    do_action( 'woocommerce_before_shop_loop_item_title' );
    do_action( 'woocommerce_shop_loop_item_title' );
    //do_action( 'woocommerce_after_shop_loop_item_title' );
    // do_action( 'woocommerce_after_shop_loop_item' );
    ?></div><?php
  endwhile;
} else {
  echo __( 'No products found' );
}
wp_reset_postdata(); 
$template_items = ob_get_clean(); 

if(!empty($template_items)){
	BC_get_component('slick', array(
		'id'=> $this_args['id'], 
		'container_class'=> $this_args['container_class'], 
		'container_item_class'=> $this_args['container_item_class'], 
		'slick'=> $this_args['slick'], 
		'items_html'=> $template_items, 
		'breakpoint-height' => $this_args['breakpoint_height'], 
	));
}