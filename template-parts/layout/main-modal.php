<!--Start normal modal-->
<?php

	$modal_args = array(

		'class' => 'fade',
		'aria-hidden' => 'true',

		//'modal-title' => 'Main modal',
		//'modal-close' => '',

		'modal-dialog' => array(
			'class' => '', // modal-dialog-centered // modal-lg // modal-sm
		),
		'modal-content' => array(
			'class' => '',
			'before' => '',
			'after' => '',
		),
		'modal-header' => array(
			'class' => '', 
		),
		'modal-body' => array(
			'content' => 'Modal content.'
		),
		'modal-footer' => array( 
			'content' => '<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>'
		),

	);

	
	$modal_args['id'] = 'main-modal'; // Prevent to change ID from filter
	WPBC_get_component('modal', $modal_args);

	/*
	Adding modals..
	*/
?>