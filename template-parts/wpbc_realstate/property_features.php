<?php

$property_id = !empty($property->ID) ? $property->ID : get_the_ID();

$default_property_features = WPBC_default_property_features(); 
$features_args = WPBC_property_template_features_args();
$property_features = get_field('group_property_features', $property_id);

if(!empty($property_features)){

?>
<div class="property_features <?php echo $features_args['class']; ?>">
<?php
foreach ($default_property_features as $key => $value) {
	$meta_value = $property_features['property_features_'.$value['name'].''];
	$meta_value_append = !empty($value['append']) ? $value['append'] : (!empty($value['prepend']) ? $value['prepend'] : '');
	$meta_value = $meta_value.$meta_value_append;
	$meta_label = !empty($value['label']) ? $value['label'] : '';
	$meta_desc = !empty($value['instructions']) ? $value['instructions'] : '';
	$use_icons = !empty($features_args['use_icons']) ? $features_args['use_icons'] : false; 
	if($use_icons){
		$meta_icon_label = '<i data-id="'.$value['name'].'" class="icon-'.$value['name'].'"></i>';
		$meta_label = $meta_icon_label.$meta_label;
	}
	?>
	<div class="<?php echo $features_args['row_class']; ?>">
		<div class="<?php echo $features_args['row_head_class']; ?>">
			<?php if($meta_label) {?><div class="label <?php echo $features_args['row_label_class']; ?>"><?php echo $meta_label;?></div><?php } ?>
			<span class="meta <?php echo $features_args['row_meta_class']; ?>"><?php echo $meta_value;?></span>
		</div>
		<?php if($meta_desc) {?><small class="desc <?php echo $features_args['row_desc_class']; ?>"><?php echo $meta_desc;?></small><?php } ?>
	</div>
	<?php } ?>
</div>
<?php } ?>