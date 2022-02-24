<?php

/*

	@wpbc-megamenu template part

	$args passed like:

	array(
			'item' => $item,
			'depth' => $depth,
			'args' => $args,
		)

	From -> walker_nav_menu_start_el > WPBC_walker_nav_menu_start_el

*/

$item = $args['item'];

$megamenu_class = 'dropdown-megamenu-menu dropdown-menu animated fadeInDown';
$megamenu_class = apply_filters('wpbc/filter/megamenu/dropdown-class', $megamenu_class, $item);

$megamenu_args = 'data-animated-respond="lg" data-animation="megamenu" data-animation-delay=".6s" data-animation-duration=".6s"';
$megamenu_args = apply_filters('wpbc/filter/megamenu/args', $megamenu_args, $item);

$megamenu_dialog_class = 'megamenu-dialog';
$megamenu_dialog_class = apply_filters('wpbc/filter/megamenu/dialog/class', $megamenu_dialog_class, $item);

$megamenu_container_class = 'megamenu-dialog-container';
$megamenu_container_class = apply_filters('wpbc/filter/megamenu/container/class', $megamenu_container_class, $item);


$item_output .= '<div class="'.$megamenu_class.'" '.$megamenu_args.'>';
		$item_output .= '<div class="'.$megamenu_dialog_class.'">';
		$item_output .= '<div class="'.$megamenu_container_class.'">';
?>

<div class="<?php echo $megamenu_class; ?>" <?php echo $megamenu_args; ?>>
	<div class="<?php echo $megamenu_dialog_class; ?>">
		<div class="<?php echo $megamenu_container_class; ?>">

			<?php
			$type = WPBC_get_megamenu_type($item);

			if($type == 'menu'){
				$megamenu_menu = WPBC_get_megamenu_menu($item);
				echo do_shortcode('[WPBC_get_megamenu_menu id="'.$megamenu_menu.'"/]'); 
			}
			
			if($type == 'template'){
				$megamenu_id = WPBC_get_megamenu_template($item);
				echo do_shortcode('[WPBC_get_template id="'.$megamenu_id.'"/]');
			}
			if($type == 'template-part'){
				$megamenu_name = WPBC_get_megamenu_template_part($item);
				echo do_shortcode('[WPBC_get_template_theme name="'.$megamenu_name.'"/]');
			} 
			if($type == 'html'){
				$html = WPBC_get_megamenu_html($item);
				echo do_shortcode($html);
			} 
			?>

		</div>
	</div>
</div>