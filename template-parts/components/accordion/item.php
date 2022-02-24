<?php 

$item_defaults = array(
  'toggle_class' => 'gpx-1 py-3 btn btn-link btn-block text-left has-feedback feedback-right',
  'toggle_icon' => '<i class="icon fa fa-angle-up"></i>',
);

$toggle_collapsed_class = '';
$toggle_expanded = 'true';
$collapse_class = 'show'; 

if(empty($args['collapsed'])){
	$toggle_collapsed_class = 'collapsed';
  $toggle_expanded = 'false';
  $collapse_class = '';
}

$toggle_class = 'gpx-1 py-3 btn btn-link btn-block text-left has-feedback feedback-right';
$toggle_class .= ' '.$toggle_collapsed_class;


$toggle_icon = '<i data-collapsed style="--collapsed: \'\f107\'; --uncollapsed: \'\f106\';" class="icon fa"></i>'; 

$toggle_icon = '<i class="caret"></i>';

$toggle_icon = '<i class="icon wpbci-chevron-up"></i>';

$btn_toggle = '<span class="btn-feedback-icon collapse-icon rotate gpr-1">'.$toggle_icon.'</span>'; 

?>
<div class="ui_accordion-item card">

  <div class="ui_accordion-header card-header p-0" id="<?php echo $args['heading_id']; ?>">
    <h2 class="mb-0">
      <button class="<?php echo $toggle_class; ?>" type="button" data-toggle="collapse" data-target="#<?php echo $args['collapse_id']; ?>" aria-expanded="<?php echo $toggle_expanded; ?>" aria-controls="<?php echo $args['collapse_id']; ?>">
        <?php echo $args['title']; ?> <?php echo $btn_toggle; ?>
      </button>
    </h2>
  </div>

  <div id="<?php echo $args['collapse_id']; ?>" class="collapse <?php echo $collapse_class; ?>" aria-labelledby="<?php echo $args['heading_id']; ?>" <?php echo $args['parent']; ?>>
    <div class="card-body">
      <?php echo $args['content']; ?>
    </div>
  </div>

</div>