<?php WPBC_flex_layout_start(); ?>

<?php 

	$columns = WPBC_get_flex_layout_field('columns');  

	if(!empty($columns)){

		?>
			<div class="row <?php echo $row_class; ?>">
			<?php

		foreach ($columns as $key => $value) {
			
			$columns_class = $value['columns_class'];
			$columns_wysiwyg = $value['columns_wysiwyg'];

			?>
			<div class="<?php echo $columns_class; ?>">
				<?php echo apply_filters('the_content',$columns_wysiwyg); ?>
			</div>
			<?php
		}

		?>
			</div>
		<?php
	}
?>

<?php WPBC_flex_layout_end(); ?>