<?php 

function _tokko_acf_choices_operation_types(){
	$available_operation_types = WPBC_tokko_get_available_operation_types();
	$temp = array();
	$temp[0] = __('All','bootclean');
	foreach ($available_operation_types as $key => $value) {
		$temp[$value['id']] = $value['name'];
	}
	return $temp;
}

function _tokko_acf_choices_property_types(){
	$available_property_types = WPBC_tokko_get_available_property_types();
	$temp = array();
	$temp[0] = __('All','bootclean');
	foreach ($available_property_types as $key => $value) {
		$temp[$value['id']] = $value['name'];
	}
	return $temp;
}

function _tokko_acf_choices_localizations(){
	$available_property_types = WPBC_tokko_get_available_localizations();
	$temp = array();
	$temp[0] = __('All','bootclean');
	foreach ($available_property_types as $key => $value) {
		$temp[$value['id']] = $value['name'];
	}
	return $temp;
}

include('builder/ui-tokko-developments.php');
include('builder/ui-tokko-properties.php'); 
include('builder/ui-tokko-searchform.php'); 

add_action('admin_head',function(){
	$check = array(
		'ui-tokko-developments',
		'ui-tokko-properties',
		'ui-tokko-searchform',
	);
	?>
<style>
<?php foreach ($check as $value) { ?>
	.acf-tooltip [data-layout="<?php echo $value; ?>"] .dot-badge{
		background-color:#222;
		width: 10px;
		height: 10px;
		display: inline-block;
		border-radius: 100%;
		margin-right: 4px;
		border: 1px solid #fff;
		vertical-align: -1px;
	}  
	[data-layout="<?php echo $value; ?>"].-collapsed .acf-fc-layout-handle svg path{
		fill:#333333 !important;
	}
<?php } ?>
</style>
	<?php
}); 