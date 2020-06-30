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

		// layout locations NOT USED

		'layout' => array(

			'is_shop' => array(
				'structure' => 'a1',
			),

			'is_product_category' => array(
				'structure' => 'a1',
			),

		),

	);
	$wpbc_woocommerce_config = apply_filters('wpbc/filter/woocommerce/config', $wpbc_woocommerce_config);
	return $wpbc_woocommerce_config;
}

function WPBC_woocommerce_get_layout($is){
	$wpbc_woocommerce_config = WPBC_woocommerce_get_config();
	return $wpbc_woocommerce_config['layout'][$is];
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

	$woocommerce_widgetsX[] = array(
		'name'          => 'Woocommerce Shop',
		'id'            => 'widget_area_woocommerce',
		'description'   => '',
		'class'         => 'wpbc-widget', // ?? This one is a myst?
		'before_widget' => $before_widget,
		'after_widget'  => $after_widget,
		'before_title'  => $before_title,
		'after_title'   => $after_title,
	);

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

*/

function WPBC_layout_struture__woocommerce_shop_start(){
?>
<div id="main-container-areas" class="a2-ml container">
	<div id="main-container-row" class="a2-ml row">
		<?php if(WPBC_if_woocommerce_use_cols()){ ?>
		<div id="main-content-area" class="a2-ml col-md-8">
		<?php } else { // WPBC_if_woocommerce_use_cols() END ?>
		<div id="main-content-area" class="a2-ml col-12">
		<?php } ?>
<?php
}
function WPBC_layout_struture__woocommerce_shop_end(){
	if(WPBC_if_woocommerce_use_cols()){ ?>
		</div>
		<div id="area-1" class="a2-ml col-md-4">
			<?php
			echo do_shortcode('[WPBC_get_template name="layout/secondary-content" args="name:area-1"/]');
			?>
		</div>
		<?php } // WPBC_if_woocommerce_use_cols() END ?>
		</div>
	</div>
</div>
<?php
}

function WPBC_if_woocommerce_use_cols(){ 
	// https://docs.woocommerce.com/document/conditional-tags/ 
	if(is_shop() || is_product_category() ){
		return true;
	}else{
		return false;
	}
}

function WPBC_if_woocommerce_wrap_template(){ 
	// https://docs.woocommerce.com/document/conditional-tags/
	$post_type = get_post_type();
	if( is_shop() || $post_type == 'product' || is_product_category() ){
		return true;
	}else{
		return false;
	}
}

function WPBC_if_woocommerce_secondary_content(){ 
	// https://docs.woocommerce.com/document/conditional-tags/
	$post_type = get_post_type();
	if( is_shop() || $post_type == 'product' || is_product_category() ){
		return true;
	}else{
		return false;
	}
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
		if( WPBC_if_woocommerce_wrap_template() ){ // SHOULD BE is_woocommerce directly ? 
			add_action('wpbc/layout/body/start', 'action__wpbc_layout_start__container_block_start',30);
			WPBC_layout_struture__main_navbar();
			WPBC_layout_struture__main_pageheader();
			WPBC_layout_struture__main_content_wrap();

			// This one is the woo part
			WPBC_layout_struture__woocommerce_shop_start();

// TESTING START 
$is_layout = WPBC_woocommerce_get_layout('is_shop');  
$main_container_args = WPBC_get_layout_structure_main_container($is_layout['structure']); 

if(!empty($main_container_args)){
	$ar = $main_container_args;
	$id = $ar['id'];
	$tag = $ar['tag'];
	$attrs = $ar['attrs'];
	$class = $ar['class']; 

	if(!empty( $ar['container_type'] )){
		$container_type = $ar['container_type'];
		if($container_type == 'fluid'){
			$class .= ' container-fluid';
		}
		if($container_type == 'fixed'){
			$class .= ' container';
		}
		if($container_type == 'fixed-left'){
			$class .= ' container container-left';
		}
		if($container_type == 'fixed-right'){
			$class .= ' container container-right';
		}
		if($container_type == 'none'){
			$class .= '';
		}
		$class .= ' container-type-'.$container_type;
	} 

	$content = $ar['content'];
	if(!empty( $content )){

	}
}
// TESTING END 

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

add_filter('wpbc/filter/layout/locations', function($locations){
	if( is_account_page() ){
		$locations['page']['id'] = 'a1'; 
		$locations['page']['args']['container_type'] = 'fixed'; 
	}
	if( is_cart() || is_checkout() ){
		$locations['page']['id'] = 'a1';  
	} 
	return $locations;  
}, 20, 1 );

add_filter('wpbc/filter/layout/secondary-content/post_id',function($post_id){ 
	if( WPBC_if_woocommerce_secondary_content() ){
		$post_id = get_option( 'woocommerce_shop_page_id' ); 
	}
	return $post_id;
});  


/* my-account.php */

add_action( 'woocommerce_account_navigation',function(){
	
},0 );
add_action( 'woocommerce_account_content',function(){

	if( is_wc_endpoint_url( 'orders' ) ){
		$text = __('Orders','woocommerce');
	}
	if( is_wc_endpoint_url( 'downloads' ) ){
		$text = __('Downloads','woocommerce');
	}
	if( is_wc_endpoint_url( 'edit-address' ) ){
		$text = __('Addresses','woocommerce');
	}
	if( is_wc_endpoint_url( 'edit-account' ) ){
		$text = __('Account details','woocommerce');
	}
	?>
	<h2 class="section-title"><?php echo $text; ?></h2>
	<?php
},0 );


add_filter('wpbc/body/class', 'woocommerce_body_class',10,1 ); 
function woocommerce_body_class($class){
	if( is_account_page() && !is_user_logged_in() ){
		$class .= ' woocommerce-not_logged ';
	}
	if(is_cart()){
		$class .= ' woocommerce-is_cart ';
	}
	if(is_checkout()){
		$class .= ' woocommerce-is_checkout ';
	}
	return $class;
}