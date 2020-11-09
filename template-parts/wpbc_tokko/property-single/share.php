<?php

$property = $args;

$address = $property->get_field('address');

$social_defaults = array( 
	array(
		'id' => 'email',
		'icon_html' => '<i class="icon-enveope"></i> Email', 
		'title'=> 'Email'
	),
	array(
		'id' => 'facebook',
		'icon_html' => '<i class="icon-facebook"></i> Facebook', 
		'title'=> 'Facebook'
	),
	array(
		'id' => 'twitter',
		'icon_html' => '<i class="icon-twitter"></i> Twitter', 
		'title'=> 'Twitter'
	),
	/**/
	array(
		'id' => 'pinterest',
		'icon_html' => '<i class="icon-pinterest"></i> Pinterest',
		'title'=> 'Pinterest'
	),
	  
);
$social_defaults = apply_filters('wpbc/filter/post/share/defaults', $social_defaults);   
$share_args = array( 
	'class' => '',
	'switch_label' => '<i class="text-primary gmb-2">Share</i>', 
	'switch_icon' => '<i class="icon-share text-primary"></i>', 
	'switch_class' => 'd-none',
	'item_class' => 'btn btn-social mb-3',
	'item_input_class' => 'form-control border-secondary mb-3 w-100 p-2',
	'share_buttons_class' => '',
	'social_defaults' => $social_defaults,

	/* 2020 */
	'share_buttons_before' => '<p>Share</p><h2 class="gmb-2">'.$address.'</h2>',

	'type' => 'default', // default || modal
	// 'modal_title' => $this_args['title'],
	// 'modal_body_class' => 'modal-body gpb-2',
); 

/*

	Also can use this filters to get the permlink and title used on share links:

	$the_permalink = get_permalink();
		$the_permalink = apply_filters('wpbc/filter/post/share/permalink',$the_permalink);
	$the_title = get_the_title();
		$the_permalink = apply_filters('wpbc/filter/post/share/title',$the_title);

*/
?>
<div data-clone="#modal-property-share-clone" class="d-none">
	<?php WPBC_post_share( $share_args );  ?>
</div>

<button data-toggle="modal" data-modal-title="Compartir: <?php echo $property->get_field('address'); ?>" data-target="#modal-share" class="btn btn-link text-primary"><i class="icon-share mr-1"></i> <i>Compartir</i></button>