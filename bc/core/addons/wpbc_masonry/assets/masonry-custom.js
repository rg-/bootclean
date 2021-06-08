/* 


	[data-wpbc-masonry] 
	

	"wpbc_masonry_custom_object" passed from PHP WPBC_get_masonry_settings() functions

	like: wpbc_masonry_custom_object.MasonryParams

*/

function WPBC_get_MasonryParams(MC){ 

	// TODO
	if(MC.attr('data-wpbc-masonry-params')){
		// replace/add custom parameters by data-* attrs
		// take a json, make it object, pass to settings
	}

	return wpbc_masonry_custom_object.MasonryParams;
}

function WPBC_start_Masonry(MC){ 
  MC.on('layoutComplete',function(){ });
	MC.masonry( WPBC_get_MasonryParams(MC) );  
 	$(window).trigger('resize');
}

function WPBC_update_Masonry(MC,items){
	var $content = $( items );
	MC.append( $content ).masonry( 'appended', $content );
	MC.on('layoutComplete',function(){  });
		MC.find('[data-is-inview]').is_inview(); 
 	$(window).trigger('resize');
}


+function(t){

	var MC = $('[data-wpbc-masonry]');  
	$(window).on('bc_inited', function () {
		WPBC_start_Masonry( MC );
	});

}(jQuery); 