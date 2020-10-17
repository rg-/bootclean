/*

	

*/


jQuery(function($) { 



	if( !$('body').hasClass('disable-woocommerce-selectpicker') ){

		if($('.woocommerce-ordering select').length>0){
			$('.woocommerce-ordering select').selectpicker(
				{
					liveSearch : false,
					showTick : true,
				}
			);
		} 
		
	} 

});