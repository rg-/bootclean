<?php 
$widget = get_sub_field('key__layout_widgets_row__content_'.'key__r_widgets_areas', $post_id);

if ( !empty($widget) && is_active_sidebar( $widget ) ){
	dynamic_sidebar( $widget );
}