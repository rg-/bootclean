<?php
$modal_args = $params; 

$modal_args = apply_filters('wpbc/filter/layout/modal/args', $modal_args);

$modal_id = $modal_args['id'];
$modal_class = $modal_args['class'];
$modal_attrs = !empty($modal_args['modal-attrs']) ? $modal_args['modal-attrs'] : '';

$close_class = !empty($modal_args['modal-close']['class']) ? $modal_args['modal-close']['class'] : '';
$close_text = !empty($modal_args['modal-close']['text']) ? $modal_args['modal-close']['text'] : '<span aria-hidden="true">&times;</span>';
$close_label = !empty($modal_args['modal-close']['label']) ? $modal_args['modal-close']['label'] : _x('Close','bootclean');
$close_attrs = !empty($modal_args['modal-close']['attrs']) ? $modal_args['modal-close']['attrs'] : '';

$modal_dialog_class = !empty($modal_args['modal-dialog']['class']) ? $modal_args['modal-dialog']['class'] : '';
$modal_content_class = !empty($modal_args['modal-content']['class']) ? $modal_args['modal-content']['class'] : '';
$modal_body_class = !empty($modal_args['modal-body']['class']) ? $modal_args['modal-body']['class'] : '';
$modal_footer_class = !empty($modal_args['modal-footer']['class']) ? $modal_args['modal-footer']['class'] : '';

$modal_content_before = !empty($modal_args['modal-content']['before']) ? $modal_args['modal-content']['before'] : '';
$modal_content_after = !empty($modal_args['modal-content']['after']) ? $modal_args['modal-content']['after'] : '';


$modal_title = !empty($modal_args['modal-title']) ? $modal_args['modal-title'] : '';
$modal_body_content = !empty($modal_args['modal-body']['content']) ? $modal_args['modal-body']['content'] : '';

$modal_footer_content = !empty($modal_args['modal-footer']['content']) ? $modal_args['modal-footer']['content'] : '';
/*
  modal > 
    // fade
  
  modal-dialog > 
    // modal-dialog-centered // modal-lg // modal-sm

*/

?>
<div id="<?php echo $modal_id; ?>" class="modal <?php echo $modal_class; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $modal_id; ?>" aria-hidden="<?php echo $modal_args['aria-hidden']; ?>" <?php echo $modal_attrs; ?>>
	<div class="modal-dialog <?php echo $modal_dialog_class; ?>" role="document">
		<div class="modal-content <?php echo $modal_content_class; ?>">
			 
			<?php echo do_shortcode($modal_content_before); ?>

			<div class="modal-header <?php echo $modal_args['modal-header']['class']; ?>">
        <?php if( !empty($modal_title) ) { ?>
          <h5 class="modal-title" id="<?php echo $modal_id; ?>"><?php echo $modal_title; ?></h5>
        <?php } ?>
        <button type="button" class="close <?php echo $close_class; ?>" data-dismiss="modal" aria-label="<?php echo $close_label; ?>" <?php echo $close_attrs; ?>>
          <?php echo $close_text; ?>
        </button>
      </div>

	    <div class="modal-body <?php echo $modal_body_class; ?>">
      	<?php echo do_shortcode($modal_body_content); ?>
      </div>

      <div class="modal-footer <?php echo $modal_footer_class; ?>">
      	<?php echo do_shortcode($modal_footer_content); ?>
      </div>

      <?php echo do_shortcode($modal_content_after); ?>

		</div>
	</div>
</div>
<!--end normal modal-->