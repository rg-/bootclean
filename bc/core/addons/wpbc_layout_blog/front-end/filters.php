<?php 
/*

	$types OK

	When on page for posts for example
	

	$page_for_posts = get_option( 'page_for_posts' ); 

	$layout_header_templates = WPBC_layout_posts_page_templates();

	foreach ($layout_header_templates as $key => $value) {
		
		if( is_blog($value['template']) ){ 


*/   


add_filter('wpbc/filter/layout/template-path', 'WPBC_layout_posts_page__template_path',10,2);
add_filter('wpbc/filter/search/template-path', 'WPBC_layout_posts_page__template_path',10,2);
function WPBC_layout_posts_page__template_path($path, $post_type){
  
	$types = WPBC_get_layout_posts_post_types();

  foreach ($types as $type) {
		$WPBC_layout_posts_page = WPBC_get_layout_posts_page_settings($type); 

		if( WPBC_if_is_post_type_layout(false, $type) ){   
			$item_template = $WPBC_layout_posts_page['style_args']['item_template'];
			$path = 'template-parts/content/'.$item_template;
		}
	}

	return $path;

}

add_filter('wpbc/filter/layout/template-part', 'WPBC_layout_posts_page__template_part',10,2);
add_filter('wpbc/filter/search/template-part', 'WPBC_layout_posts_page__template_part',10,2);
function WPBC_layout_posts_page__template_part($part, $post_type){

	$types = WPBC_get_layout_posts_post_types();

  foreach ($types as $type) {
		$WPBC_layout_posts_page = WPBC_get_layout_posts_page_settings($type); 

		if( WPBC_if_is_post_type_layout(true, $type) ){
			$part = '';
		}
	}

	return $part;

}



add_filter('wpbc/filter/ui_layout_posts_advanced-item/id', function($id){
	
	$types = WPBC_get_layout_posts_post_types();

  foreach ($types as $post_type) {
		$WPBC_layout_posts_page = WPBC_get_layout_posts_page_settings($post_type); 

		if( is_blog('', $post_type) ){
			$id = get_the_ID();
		}
	}
	return $id;
},10,2);

add_filter('wpbc/filter/ui_layout_posts_advanced-item/style_args', function($style_args){ 

	$types = WPBC_get_layout_posts_post_types();

  foreach ($types as $post_type) {
		$WPBC_layout_posts_page = WPBC_get_layout_posts_page_settings($post_type); 

		if( is_blog('', $post_type) ){ 
			$style_args = $WPBC_layout_posts_page['style_args'];
		}
	}
	return $style_args;

},10,1); 

add_filter('wpbc/filter/layout/post_pagination', function($post_pagination){

	$types = WPBC_get_layout_posts_post_types();

  foreach ($types as $post_type) {
		$WPBC_layout_posts_page = WPBC_get_layout_posts_page_settings($post_type); 

		if( is_blog('', $post_type) ){

			if(!empty($WPBC_layout_posts_page['pagination']['pagination_type'])){
				$post_pagination = 'post_advanced_pagination';
			}else{
				$post_pagination = '';
			}

		}
	}

	return $post_pagination;

},10,1 );

add_filter('wpbc/filter/advanced_pagination/args', function($args){

	$types = WPBC_get_layout_posts_post_types();

  foreach ($types as $post_type) {
		$WPBC_layout_posts_page = WPBC_get_layout_posts_page_settings($post_type); 

		if( is_blog('', $post_type) ){  
		}
	}
	return $args;

},10,1);

add_filter('wpbc/filter/ui_layout_posts_advanced/pagination_args', function($args){
 	  
	return $args;

},10,1);


/*

	Pass to the query

*/

add_action( 'pre_get_posts', 'ui_layout_posts_advanced_pre_get_posts', 1 );

function ui_layout_posts_advanced_pre_get_posts($query){
	if( !is_admin() && $query->is_main_query() && !$query->is_single ) {

		$WPBC_layout_posts_page = WPBC_get_layout_posts_page_settings();
		if(!empty($WPBC_layout_posts_page['query'])){ 

			if( !empty($WPBC_layout_posts_page['query']['posts_per_page']) ){
				$query->set( 'posts_per_page', $WPBC_layout_posts_page['query']['posts_per_page'] );
			}
			if( !empty($WPBC_layout_posts_page['query']['order']) ){
				$query->set( 'order', $WPBC_layout_posts_page['query']['order'] );
			}
			if( !empty($WPBC_layout_posts_page['query']['orderby']) ){
				$query->set( 'orderby', $WPBC_layout_posts_page['query']['orderby'] ); 
			}       

		}

	}
}