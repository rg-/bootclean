<?php
$modal_args = $params; 

$modal_args = apply_filters('wpbc/filter/layout/modal/args', $modal_args);

$attrs = !empty($modal_args['modal-attrs']) ? $modal_args['modal-attrs'] : '';
$title = !empty($modal_args['modal-title']) ? $modal_args['modal-title'] : '';

$close_class = !empty($modal_args['modal-close']['class']) ? $modal_args['modal-close']['class'] : '';
$close_text = !empty($modal_args['modal-close']['text']) ? $modal_args['modal-close']['text'] : '<span aria-hidden="true">&times;</span>';
$close_label = !empty($modal_args['modal-close']['label']) ? $modal_args['modal-close']['label'] : _x('Close','bootclean');
$close_attrs = !empty($modal_args['modal-close']['attrs']) ? $modal_args['modal-close']['attrs'] : '';

/*
  modal > 
    // fade
  
  modal-dialog > 
    // modal-dialog-centered // modal-lg // modal-sm

*/

?>
<div id="<?php echo $modal_args['id']; ?>" class="modal <?php echo $modal_args['class']; ?>" tabindex="-1" role="dialog" aria-labelledby="<?php echo $modal_args['id']; ?>" aria-hidden="<?php echo $modal_args['aria-hidden']; ?>" <?php echo $attrs; ?>>
	<div class="modal-dialog <?php echo $modal_args['modal-dialog']['class']; ?>" role="document">
		<div class="modal-content <?php echo $modal_args['modal-content']['class']; ?>">
			 
			<?php echo $modal_args['modal-content']['before']; ?>

			<div class="modal-header <?php echo $modal_args['modal-header']['class']; ?>">
        <?php if( !empty($title) ) { ?>
          <h5 class="modal-title" id="<?php echo $modal_args['id']; ?>"><?php echo $title; ?></h5>
        <?php } ?>
        <button type="button" class="close <?php echo $close_class; ?>" data-dismiss="modal" aria-label="<?php echo $close_label; ?>" <?php echo $close_attrs; ?>>
          <?php echo $close_text; ?>
        </button>
      </div>

	    <div class="modal-body <?php echo $modal_args['modal-body']['class']; ?>">
      	<?php echo $modal_args['modal-body']['content']; ?>
      </div>

      <div class="modal-footer <?php echo $modal_args['modal-footer']['class']; ?>">
      	<?php echo $modal_args['modal-footer']['content']; ?>
      </div>

      <?php echo $modal_args['modal-content']['after']; ?>

		</div>
	</div>
</div>
<!--end normal modal-->