(function($) {
	
	// JS here  

	// console.log(builder_defaults.builder.container);
	var default_classes = builder_defaults.defaults.container;
	var builder_classes = builder_defaults.builder.container; 

	$(document).on('change', '#page_template', function(){
 
		var container_class = $('#acf-field_layout_main_content_container_class'); 
		var row_class = $('#acf-field_layout_main_content_container_row_class');
		var col_content_class = $('#acf-field_layout_main_content_container_col_content_class');
		var col_sidebar_class = $('#acf-field_layout_main_content_container_col_sidebar_class');
			
			if( !container_class.attr('data-original-value') ){
				container_class.attr('data-original-value', container_class.attr('value') );
				row_class.attr('data-original-value', row_class.attr('value') );
				col_content_class.attr('data-original-value', col_content_class.attr('value') );
				col_sidebar_class.attr('data-original-value', col_sidebar_class.attr('value') );
			}  
 		
		if( '_template_builder.php' == $(this).val() ){

			container_class.val( builder_classes.class );
			row_class.val( builder_classes.row );
			col_content_class.val(  builder_classes.col_content );
			col_sidebar_class.val( builder_classes.col_sidebar );

		}else{

			container_class.val( container_class.data('original-value') );
			row_class.val( row_class.data('original-value') );
			col_content_class.val( col_content_class.data('original-value') );
			col_sidebar_class.val( col_sidebar_class.data('original-value') );

		}
 
	    
	});

})(jQuery);	