(function( $ ) {
	"use strict";
	 
	
	if(customizer_colors){ 
		jQuery.each(customizer_colors, $.proxy(function(index, item) {  
			wp.customize( 'WPBC_color__'+index, function( control ) { 
				control.bind( function( to ) {    
					$( '.bg-'+index ).attr('style', 'background-color:'+to+'!important;' );
					$( '.text-'+index ).attr('style', 'color:'+to+'!important;' );
					//$( 'a' ).attr('style', 'color:'+to+'!important;' );
				} );
			}); 
			
		}, this)); 
	}  
	
	wp.customize( 'WPBC_advanced_options_main_navbar', function( control ) { 
			control.bind( function( to ) {    
				//console.log(to);
			} );
		}); 
	
})( jQuery );