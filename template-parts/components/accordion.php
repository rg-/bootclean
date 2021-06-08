<?php

/*

	use like 

	WPBC_get_template_part('components/accordion', array(

		'accordion_id' => $section_settings['id'].'-'.$row_index

	));

*/

$accordion_id = !empty($args['accordion_id']) ? $args['accordion_id'] : 'ui_accordion-'.uniqid();  
$accordion_items = !empty($args['accordion_items']) ? $args['accordion_items'] : array(); 
$collapse_parent = isset($args['collapse_parent']) ? $args['collapse_parent'] : false;

$count = count($accordion_items);

?>

<?php if(!empty($accordion_items)){ ?>

<div class="ui_accordion <?php echo ($count>1) ? 'accordion' : ''; ?>" id="<?php echo $accordion_id; ?>">

	<?php foreach ($accordion_items as $key => $value) {

		$collapse_id = $accordion_id . '-' . $key;
		$heading_id = 'heading-'.$collapse_id; 
		$parent = ( !empty($collapse_parent) ) ? 'data-parent="#'.$accordion_id.'"' : ''; 

		$title = !empty($value['headline']['title']) ? $value['headline']['title'] : '';
		$collapsed = !empty($value['headline']['settings']['settings_collapsed']) ? true : false; 
		$content = !empty($value['content']) ? $value['content'] : '';  

		$item = WPBC_get_template_part('components/accordion/item', array(

			'return' => true, 
			'collapse_id' => $collapse_id, 
			'heading_id' => $heading_id,
			'parent' => $parent,
			'title' => $title,
			'content' => $content,
			'collapsed' => $collapsed

		));

		echo $item;

	}

?>

</div>

<?php } ?>