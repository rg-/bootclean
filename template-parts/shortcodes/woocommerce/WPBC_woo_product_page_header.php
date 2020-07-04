<?php
$args = $args['params']; // passed from shortcode 

$header_type = WPBC_get_field('field_woo_product_advanced_header_type', $args['post_id']);

$slick_args = array(
	'dots' => true,
	'arrows' => false,
	'slidesToShow' => 1,
	'slidesToScroll' => 1,
); 
$breakpoint_height = array(
	'xs' => array(
		'default' => '100wh',
	),
); 
$this_args = array(
	"id" =>  (!empty($args['id'])) ? $args['id'] : 'wpbc-woo-product-header',
	"container_class" => '',   
	"container_item_class" => '', 
	"slick" => json_encode($slick_args,true), 
	"template_items_id"=> '',
	"breakpoint_height"=> json_encode($breakpoint_height,true),
);

$items = array();

if($header_type=='custom'){

	$header_items = WPBC_get_field('field_woo_product_advanced_header_custom', $args['post_id']); 
	
	if(!empty($header_items)){ 
		  
		foreach ($header_items as $key => $value) {
			# code...
			$url = $value['url']; 
			$items[] = array(
				'content' => '',
				'background-image' => $url, 
				// 'background-color' => '',
				// 'content_class' => '',
			); 
		}
		 
	}
}

if(!empty($items)){
	BC_get_component('slick', array(
		'id'=> $this_args['id'], 
		'container_class'=> $this_args['container_class'], 
		'container_item_class' => $this_args['container_item_class'], 
		'slick'=> $this_args['slick'], 
		'items'=> $items, 
		'breakpoint-height' => $this_args['breakpoint_height'], 
	));
}?>

<div class="page-header-overlay">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<?php
				$product = wc_get_product( $args['post_id'] );
				?>
				<div class="gp-1 bg-white">
					<h2 class="section-title"><?php echo get_the_title($args['post_id']); ?></h2>
				</div>
			</div>
			<div class="col-md-2 ml-auto">
				<div class="gp-1">
					<?php if ( $price_html = $product->get_price_html() ) : ?>
						<span class="price badge badge-primary"><span class="h1"><?php echo $price_html; ?></span></span>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>