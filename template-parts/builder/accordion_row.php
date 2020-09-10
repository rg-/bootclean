<?php
$row = get_row();
$acf_fc_layout = $row['acf_fc_layout']; 
$prefix = 'field_'.$acf_fc_layout;
$section = WPBC_get_section_row_args($row, $prefix); 
if(!empty($section['section_options']['visible'])) return;  
?>

<?php do_action('wpbc/flexible-layout-row/start', $section, $acf_fc_layout ); ?>

	<div id="accordion-<?php echo $section['section_id']; ?>">

		<?php if(!empty($row['field_accordion_row_items'])){

			$field_accordion_row_items = $row['field_accordion_row_items'];
			foreach ($field_accordion_row_items as $key => $value) {
				$title = $value['field_accordion_row_item_title'];
				$content = $value['field_accordion_row_item_content'];
				?>
				<div class="accordion-item">
			    <div class="accordion-item-header" id="heading-<?php echo $key; ?>">
			      <h5 class="mb-0"> 
			        <button class="btn btn-accordion font-rubik collapsed" data-toggle="collapse" data-target="#collapse-<?php echo $key; ?>" aria-expanded="false" aria-controls="collapse-<?php echo $key; ?>">
			          <?php echo $title; ?>
			        </button>
			      </h5>
			    </div>

			    <div id="collapse-<?php echo $key; ?>" class="collapse" aria-labelledby="heading-<?php echo $key; ?>" data-parent="#accordion-<?php echo $section['section_id']; ?>">
			      <div class="accordion-item-body">
			        <?php echo $content; ?>
			      </div>
			    </div>
			  </div>
				<?php
			}
			?>

		<?php } ?>

	</div>

<?php do_action('wpbc/flexible-layout-row/end', $section, $acf_fc_layout ); ?>