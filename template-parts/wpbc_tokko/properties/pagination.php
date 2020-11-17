<?php

$search = $args['search'];
$use_query_vars = $args['use_query_vars'];  

$pagination_args = tokko_config('pagination');

	$max_show = $pagination_args['max_show'];
	$pagination_nav_class = 'gmy-1';
	$pagination_ul_class = 'pagination d-flex justify-content-center';
	$pagination_item_class = 'page-item';
	$pagination_item_active_class = 'page-item active';
	$pagination_item_link_class = 'page-link';
	$pagination_item_link_active_class = 'page-link';
	$pagination_item_link_attrs = ''; 

	$prev_label = '<';
	$next_label = '>';
?>
<nav data-ajax="pagination" class="gmy-1">
	<ul class="pagination d-flex justify-content-center">
<?php  
$ajax_get_properties = tokko_config('templates')['ajax_get_properties'];
if(!$use_query_vars){
	$anchor_data = 'data-ajax-load="replace" data-ajax-target="#ajax-loader" data-no-swup="true"';
	$prev_url = $ajax_get_properties.$search->get_url_for_page($search->get_previous_page_or_null(), false);
	$next_url = $ajax_get_properties.$search->get_url_for_page($search->get_next_page_or_null(), false);
}else{
	$anchor_data = '';
	$prev_url = $search->get_url_for_page($search->get_previous_page_or_null())."&use_query_vars=1";
	$next_url = $search->get_url_for_page($search->get_next_page_or_null())."&use_query_vars=1";
}
?>
<?php if ($search->get_previous_page_or_null()){?>
	<li class="<?php echo $pagination_item_class; ?>"><a <?php echo $anchor_data; ?> class="<?php echo $pagination_item_link_class; ?>" href='<?php echo $prev_url;?>'>
		<?php echo $prev_label; ?>
	</a></li>
<?php } ?>
<?php 
	$current_page = $search->get_current_page();
	$total_pages = $search->get_result_page_count(); 
	if($total_pages>1){
		for ($i=1; $i < $total_pages+1; $i++) {  
			if(!$use_query_vars){
				$anchor_data = 'data-ajax-load="replace" data-ajax-target="#ajax-loader" data-no-swup="true"';
				$link = $ajax_get_properties.$search->get_url_for_page($i, false);
			}else{
				$anchor_data = '';
				$link = $search->get_url_for_page($i)."&use_query_vars=1";
			} 
			$class = '';
			if($i>$max_show/2 && $i<$total_pages-($max_show/2)+1){
				$class = 'd-none';
				if($i==($max_show/2)+1){
					?>
					<li class="<?php echo $pagination_item_class; ?>"><span class="<?php echo $pagination_item_link_class; ?> pagination-separator">...</span></li>
					<?php
				}
			}
			?>
			<li class="<?php echo $class; ?> <?php echo ($i==$current_page) ? $pagination_item_active_class : $pagination_item_class;?>"><a <?php echo $anchor_data; ?> class="<?php echo ($i==$current_page) ? $pagination_item_link_active_class : $pagination_item_link_class; ?>" href='<?php echo $link; ?>'><?php echo $i; ?></a></li>
			<?php
		}
	}
?>
<?php if ($search->get_next_page_or_null()){ ?>
	<li class="<?php echo $pagination_item_class; ?>"><a <?php echo $anchor_data; ?> class="<?php echo $pagination_item_link_class; ?>" href='<?php echo $next_url; ?>'>
		<?php echo $next_label; ?>
	</a></li>
<?php } ?>
	</ul>
</nav>