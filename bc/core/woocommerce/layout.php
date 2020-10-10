<?php

/*

	bootclean
	> woocommerce
		> layout


	This file try to mimic the same layouts used on WPBC template system.

*/

function WPBC_woocommerce_get_config(){
	$wpbc_woocommerce_config = array(

		// widgets
		'widgets' => array(
			'widget_area_woocommerce' => array(
				'name' => 'Woocommerce Shop',
				'id' => 'widget_area_woocommerce',
				'description' => 'Use this widget area for the shop page/s.',
			),
			'widget_area_woocommerce_products' => array(
				'name' => 'Woocommerce Products',
				'id' => 'widget_area_woocommerce_products',
				'description' => 'Use this widget area for the product page.',
			)
		),

		// layout for templates

		'layout' => array(
 
			'shop' => array(
				'main_container_areas_class' => 'container',
				'main_container_row_class' => 'row',
				'content_areas_cols' => array(
					'main_class' => 'col-md-8',
					'col_class' => 'col-md-4',
					'col_content' => do_shortcode('[WPBC_get_template name="layout/secondary-content" args="name:area-1"/]'),
				),
				'content_areas_single' => array(
					'main_class' => 'col-12', 
				),
			),

			'product' => array(
				'class' => 'col-images-md-4 col-summary-md-8',
				'tab_class' => 'w-100',
				'upsell_class' => 'w-100',
				'related_class' => 'w-100',
			),

			'myaccount' => array(
				'class' => 'col-navigation-md-4 col-content-md-8 col-navigation-order-1 col-content-order-2 col-navigation-order-md-2 col-content-order-md-1',
			), 

			'cart' => array(
				'class' => '',
			),

			'checkout' => array(
				'class' => '',
			),

		), 

		'single_product' => array(

				// TODOING
				/*
				Setear si usa zoom, galeria, slider, default para el page header, etc...
				tabs, descripcion, custom fields, 
				mapa?
				etc
				*/

		),

	);
	$wpbc_woocommerce_config = apply_filters('wpbc/filter/woocommerce/config', $wpbc_woocommerce_config);
	return $wpbc_woocommerce_config;
} 

/*

	WOO widgets

*/

function WPBC_woocommerce_widgets_init() {
	
	$before_title = apply_filters('wpbc/filter/widgets/before_title', '<h4 class="section-title">');
	$after_title = apply_filters('wpbc/filter/widgets/after_title', '</h4>');

	$before_widget = apply_filters('wpbc/filter/widgets/custom_fields/before_widget', '<div class="widget-box [VAL]">');
	$after_widget = apply_filters('wpbc/filter/widgets/custom_fields/after_widget', '</div>');

	$woocommerce_get_config = WPBC_woocommerce_get_config();
	$woocommerce_widgets = $woocommerce_get_config['widgets'];
	$widgets_temp = array();
	if(!empty($woocommerce_widgets)){
		foreach($woocommerce_widgets as $k=>$v){
			if(!empty($v['name']) && !empty($v['id'])){ 
				$widgets_temp[] = array(
					'name'          => $v['name'],
					'id'            => $v['id'],
					'description'   => (!empty($v['description'])) ? $v['description'] : '',
					'class'         => 'wpbc-widget', // ?? This one is a myst?
					'before_widget' => $before_widget,
					'after_widget'  => $after_widget,
					'before_title'  => $before_title,
					'after_title'   => $after_title,
				);
			}
		}
	} 

	$widgets_temp = apply_filters('wpbc/filter/woocommerce/woocommerce_widgets', $widgets_temp);

	if(!empty($widgets_temp)){
		foreach($widgets_temp as $w){
			register_sidebar( $w ); 
		}
	}

	
}
add_action( 'widgets_init', 'WPBC_woocommerce_widgets_init',99 );


/*

	Make Bootclean template compatible

	Calleable functions

*/

function WPBC_woocommerce_get_layout(){
	$wpbc_woocommerce_config = WPBC_woocommerce_get_config(); 
	$layout = apply_filters('wpbc/filter/woocommerce/layout', $wpbc_woocommerce_config['layout']);
	return $layout;
}


if(!function_exists('WPBC_layout_struture__woocommerce_shop_start')){
	function WPBC_layout_struture__woocommerce_shop_start(){ 

		/*
		'main_container_areas_class' => 'container',
			'main_container_row_class' => 'row',
			'content_areas_cols' => array(
				'main_class' => 'col-md-8',
				'col_class' => 'col-md-4'
			),
			'content_areas_single' => array(
				'main_class' => 'col-12', 
			),
		*/


		$args = WPBC_woocommerce_get_layout();  

		$args['before_woo-main-container-area'] = !empty($args['before_woo-main-container-area']) ? $args['before_woo-main-container-area'] : '';
		$args['before_woo-main-container-row'] = !empty($args['before_woo-main-container-row']) ? $args['before_woo-main-container-row'] : '';
		$args['before_woo-main-content-area'] = !empty($args['before_woo-main-content-area']) ? $args['before_woo-main-content-area'] : '';

		$args['after_woo-main-container-area'] = !empty($args['after_woo-main-container-area']) ? $args['before_woo-main-container-area'] : '';
		$args['after_woo-main-container-row'] = !empty($args['after_woo-main-container-row']) ? $args['before_woo-main-container-row'] : '';
		$args['after_woo-main-content-area'] = !empty($args['after_woo-main-content-area']) ? $args['before_woo-main-content-area'] : '';

		
	?>

	<?php echo $args['before_woo-main-container-area']; ?>

	<?php do_action( 'wpbc/woo/layout/before/main-container-areas', $args ); ?>

	<div id="main-container-areas" class="wpbc-woo-container-area <?php echo $args['shop']['main_container_areas_class'];?>">

		<?php echo $args['before_woo-main-container-row']; ?>

		<div id="main-container-row" class="wpbc-woo-container-row <?php echo $args['shop']['main_container_row_class'];?>">

			<?php echo $args['before_woo-main-content-area']; ?>

			<?php if(WPBC_if_woocommerce_use_cols()){ ?>

			<div id="main-content-area" class="wpbc-woo-main-content-area <?php echo $args['shop']['content_areas_cols']['main_class'];?>">

			<?php } else { // WPBC_if_woocommerce_use_cols() END ?>

			<div id="main-content-area" class="wpbc-woo-main-content-area <?php echo $args['shop']['content_areas_single']['main_class'];?>">

			<?php } ?>
	<?php
	}
}
if(!function_exists('WPBC_layout_struture__woocommerce_shop_end')){
	function WPBC_layout_struture__woocommerce_shop_end(){
		$args = WPBC_woocommerce_get_layout();
		if(WPBC_if_woocommerce_use_cols()){
			$content = $args['shop']['content_areas_cols']['col_content'];
			?>
			</div>
			<div id="area-1" class="wpbc-woo-main-content-area-1 <?php echo $args['shop']['content_areas_cols']['col_class'];?>">
				<?php
				echo $content;
				?>
			</div>
			<?php } // WPBC_if_woocommerce_use_cols() END ?>
			
			</div><!-- .wpbc-woo-main-content-area end -->
			
			<?php echo $args['after_woo-main-content-area']; ?>

		</div><!-- .wpbc-woo-container-row end -->

		<?php echo $args['after_woo-main-container-row']; ?>

	</div><!-- .wpbc-woo-container-area end -->

	<?php do_action( 'wpbc/woo/layout/after/main-container-areas', $args ); ?>

	<?php echo $args['after_woo-main-container-area']; ?>

	<?php
	}
}

function WPBC_if_woocommerce_use_cols(){  
	if(is_shop() || is_product_category() ){
		$use_cols = true;
	}else{
		$use_cols = false;
	} 
	return apply_filters('wpbc/filter/woocommerce/layout/use_cols', $use_cols);
}

function WPBC_if_woocommerce_wrap_template(){ 
	// https://docs.woocommerce.com/document/conditional-tags/
	$post_type = get_post_type();
	if( is_shop() || $post_type == 'product' || is_product_category() ){
		$wrap_template = true;
	}else{
		$wrap_template = false;
	}
	if(is_search()){
		$wrap_template = false;
	}
	if(is_search() && isset($_GET['post_type']) && $_GET['post_type']=='product'){
		$wrap_template = true;
	}
	return apply_filters('wpbc/filter/woocommerce/layout/wrap_template', $wrap_template);
}

function WPBC_if_woocommerce_secondary_content(){ 
	// https://docs.woocommerce.com/document/conditional-tags/
	$post_type = get_post_type();
	if( is_shop() || $post_type == 'product' || is_product_category() ){
		$secondary_content = true;
	}else{
		$secondary_content = false;
	}
	return apply_filters('wpbc/filter/woocommerce/layout/secondary_content', $secondary_content);
}

add_action('init', function(){ 

	/*

	@hooked action__wpbc_layout_start__container_block_start - 1  
	@hooked WPBC_layout_struture__main_navbar - 10
	@hooked WPBC_layout_struture__main_pageheader - 20
	@hooked WPBC_layout_struture__main_content_wrap - 30
	>>>> @hooked WPBC_layout_struture__main_container - 40
	@hooked WPBC_layout_struture__main_footer - 50
	@hooked WPBC_layout_struture__main_content_wrap_end - 60

	*/

	add_action('wpbc/layout/body/start', function(){   
		$args = WPBC_woocommerce_get_layout();  
		if( WPBC_if_woocommerce_wrap_template() ){ // SHOULD BE is_woocommerce directly ? 
			add_action('wpbc/layout/body/start', 'action__wpbc_layout_start__container_block_start',30);
			WPBC_layout_struture__main_navbar();
			WPBC_layout_struture__main_pageheader();
			WPBC_layout_struture__main_content_wrap(); 
			// This one is the woo part
			WPBC_layout_struture__woocommerce_shop_start(); 

		}
	},50);

	add_action('wpbc/layout/body/end', function(){  
		if( WPBC_if_woocommerce_wrap_template() ){

			// This one is the woo part
			WPBC_layout_struture__woocommerce_shop_end();

			WPBC_layout_struture__main_footer(); 
			add_action('wpbc/layout/body/end', 'WPBC_layout_struture__main_content_wrap_end',20);
		}
	},10); 

});

 


add_filter('wpbc/filter/layout/secondary-content/post_id',function($post_id){ 
	if( WPBC_if_woocommerce_secondary_content() ){
		$post_id = get_option( 'woocommerce_shop_page_id' ); 
	}
	return $post_id;
});   


add_filter('wpbc/body/class', 'woocommerce_body_class',10,1 ); 
function woocommerce_body_class($class){

	$args = WPBC_woocommerce_get_layout(); 

	// important for styles _source/bootclean/sass/wordpress/_woocommerce.scss

	if(is_woocommerce() || is_cart() || is_checkout() || is_account_page()){
		$class .= ' wpbc-woo ';
	}

	if( is_account_page() && !is_user_logged_in() ){
		$class .= ' woocommerce-not_logged ';
	}
	if(is_shop()){
		$class .= ' woocommerce-is_shop ';  
		$class .= $args['shop']['class']; 
	}
	if(is_cart()){
		$class .= ' woocommerce-is_cart ';
		$class .= $args['cart']['class'];
	}
	if(is_checkout()){
		$class .= ' woocommerce-is_checkout ';
		$class .= $args['checkout']['class'];
	}
	if(is_account_page()){ 
		$class .= ' woocommerce-is_account_page ';  
		$class .= $args['myaccount']['class'];

		$endpoints = array(
			'orders', 'edit-address', 'edit-account'
		);
		$endpoints = apply_filters('wpbc/filter/woocommerce/myaccount/endpoints', $endpoints);
		
		if(!empty($endpoints)){
			foreach ($endpoints as $endpoint) {
				if( is_wc_endpoint_url( $endpoint ) ){
					$class .= ' woocommerce-is_endpoint_'.$endpoint.' ';  
					$class .= !empty($args['myaccount']['endpoints'][$endpoint]['class']) ? $args['myaccount']['endpoints'][$endpoint]['class'] : '';
				} 
			}
		}  

	}
	if(is_product()){
		$class .= ' woocommerce-is_product ';
		$class .= $args['product']['class'];  
	}
	if(is_product_category()){
		$class .= ' woocommerce-is_product_category ';  
	}
	if(is_product_tag()){
		$class .= ' woocommerce-is_product_tag ';  
	}
	return $class;
}


/* My account wrappers */

add_action( 'woocommerce_before_account_navigation', 'WPBC_woocommerce_account_navigation_start', 0, 1);
function WPBC_woocommerce_account_navigation_start( $woocommerce_account_navigation ) { 
?>
<div class="wpbc-woocommerce-account-navigation">
<?php
};

add_action( 'woocommerce_after_account_navigation', 'WPBC_woocommerce_account_navigation_end', 0, 1);
function WPBC_woocommerce_account_navigation_end( $woocommerce_account_navigation ) { 
?>
</div>
<?php
};  


/* Single Product wrappers */ 

// tabs
add_action( 'woocommerce_after_single_product_summary', 'WPBC_woocommerce_single_product_tabs_start', 0, 1);
function WPBC_woocommerce_single_product_tabs_start( $product_summary ) { 
	$args = WPBC_woocommerce_get_layout();
?>
<div class="wpbc-woocommerce-single-product-tabs <?php echo $args['product']['tab_class'];?>">
<?php
};

// add_action( 'woocommerce_after_single_product_summary', 'WPBC_woocommerce_single_product_tabs_end', 13, 1);
function WPBC_woocommerce_single_product_tabs_end( $product_summary ) { 
?>
</div>
<?php
};

// upsell
// add_action( 'woocommerce_after_single_product_summary', 'WPBC_woocommerce_single_product_upsell_start', 14, 1);
function WPBC_woocommerce_single_product_upsell_start( $product_summary ) { 
	$args = WPBC_woocommerce_get_layout();
?>
<div class="wpbc-woocommerce-single-product-upsell <?php echo $args['product']['upsell_class'];?>">
<?php
};

add_action( 'woocommerce_after_single_product_summary', 'WPBC_woocommerce_single_product_upsell_end', 18, 1);
function WPBC_woocommerce_single_product_upsell_end( $product_summary ) { 
?>
</div>
<?php
};

// related
add_action( 'woocommerce_after_single_product_summary', 'WPBC_woocommerce_single_product_related_start', 18, 1);
function WPBC_woocommerce_single_product_related_start( $product_summary ) { 
	$args = WPBC_woocommerce_get_layout();
?>
<div class="wpbc-woocommerce-single-product-related <?php echo $args['product']['related_class'];?>">
<?php
};

add_action( 'woocommerce_after_single_product_summary', 'WPBC_woocommerce_single_product_related_end', 30, 1);
function WPBC_woocommerce_single_product_related_end( $product_summary ) { 
?>
</div>
<?php
};