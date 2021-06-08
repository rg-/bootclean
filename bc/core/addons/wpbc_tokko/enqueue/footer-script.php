<script id="WPBC-tokko-footer-script" type="text/javascript">

	+function(t){  

		function tokko_selectpickers(method){

			if($('select.use_selectpicker').length>0){
				if(!method) {
					$('select.use_selectpicker').selectpicker();
				}else{
					$('select.use_selectpicker').selectpicker(method);
				}
			}  

		} 
		
		$('body').on('wpbc.swup.contentReplaced',function(){
			$('.use_selectpicker').selectpicker('refresh');
		});
		$(window).on('load.bs.select.data-api', function () {
	    $('.use_selectpicker').each(function () {
	    	$(this).selectpicker();
	    })
	  });

	  $(document).on('change','[data-tokko-form="change"][data-trigger-to]',function(e){
	  	var trigger_to = $(this).attr('data-trigger-to');
	  	var this_name = $(this).attr('data-name');
	  	var selected = $(this).val();
	  	var form_trigger_to = $('[data-linked-results-id="'+trigger_to+'"]').find('[data-name="'+this_name+'"]');
	  	form_trigger_to.val(selected).trigger('change'); 
	  	return false;
		});

		$(document).on('click','[data-tokko="searchform-controls"] [data-tokko-form="submit"]',function(e){
			var form = $('[data-tokko="searchform"]');
			var use_form = $(this).closest('[data-tokko="searchform-controls"]');
			if(use_form.attr('data-linked-results-id')){
				form =  $('#'+use_form.attr('data-linked-results-id')+'');
			} 
			form.find('[type="submit"]').trigger('click');
			return false;
			});
		/*
		
		[data-tokko-form="change"]

		*/
		$(document).on('change','[data-tokko="searchform-controls"] [data-tokko-form="change"]',function(e){

			var form = $('[data-tokko="searchform"]');

			var use_form = $(this).closest('[data-tokko="searchform-controls"]');
			if(use_form.attr('data-linked-results-id')){
				form =  $('#'+use_form.attr('data-linked-results-id')+'');
			} 
			
			var data = form.find('[name="data"]').val();  
			var data_json = JSON.parse(data); 

			if($(this).hasClass('ui-tokko-property_prices')){ 
				var val = $(this).val();
				var prices = val.split("|");
				var price_from = prices[0];
				var price_to = prices[1];
				//console.log( 'price_from '+price_from );
				//console.log( 'price_to '+price_to );
				data_json.price_from = price_from;
				data_json.price_to = price_to;
			}

			// property_types
			if($(this).hasClass('ui-tokko-property_types')){ 
				var value = $(this).val();  
				if( value!=0 ){ 
					if( $(this).prop('multiple') === false ){
						var splitted = value.split(',');  
					}else{
						var splitted = value;
					} 
					data_json.property_types = splitted;
				}else{
					data_json.property_types = [];
				} 
			}

			// operation_types
			if( $(this).hasClass('ui-tokko-operation_types') ){ 
 				var value = $(this).val();  
				if( value!=0 ){ 
					if( $(this).prop('multiple') === false ){
						var splitted = value.split(',');  
					}else{
						var splitted = value;
					} 
					data_json.operation_types = splitted;
				}else{
					data_json.operation_types = [];
				} 
			}

			// order_by
			if($(this).hasClass('ui-tokko-order_by')){ 
				form.find('[name="tk_order_by"]').val($(this).val()); 
			}
			// order
			if($(this).hasClass('ui-tokko-order')){ 
				form.find('[name="tk_order"]').val($(this).val()); 
			}

			// current_localization_id 
			if($(this).hasClass('ui-tokko-current_localization_id')){
 
				if( $(this).val()!=0 ){
					data_json.current_localization_type = 'division';
					data_json.current_localization_id = [$(this).val()];
				}else{
					data_json.current_localization_id = [];
					data_json.current_localization_type = 'country';
				}   

			}

			// filters
			var room_amount = false;
			if($(this).hasClass('ui-tokko-filter')){ 
 				
 				var filter_temp = [];
 				$('.ui-tokko-filter').each(function(){
 					var me = $(this);
 					if( me.val()!=0 ){

 						var cond = me.find('option:selected').attr('data-cond') ? me.find('option:selected').attr('data-cond') : '='; 
 						filter_temp.push([me.attr('data-name'), cond, me.val()]);
 					} 

 				}); 
				data_json.filters = filter_temp;
			} 

			var new_data = JSON.stringify(data_json); 
			form.find('[name="data"]').val(new_data);  

			form.find('[name="tk_page"]').val(1); 

			if($(this).attr('data-trigger')=='submit'){
				form.find('[type="submit"]').trigger('click');
			} 

		});

		/*
	
		[data-ajax-load]

		*/

		$(document).on('click', '[data-ajax-load]', function(ev){

			AjaxLoad_click($(this));

			return false;
			
		});

		function AjaxLoad_click(me){ 

	 		var url = me.attr('data-ajax-load') ? me.attr('href') : false; 
	 		var target = me.attr('data-ajax-target');
	 		var holder = me.parent(); 

	 		if(!url) return;

	 		AjaxLoad_start(me, target);  

	 		$.ajax({ type: "GET",   
			     url: url,   
			     success : function(text)
			     { 

			         AjaxLoad_success(me, target, text);  
			     }
			});
		}

		$(window).on('bc_inited', function () {
			
			var me = $('[data-ajax-onload]');
	 		var url = me.attr('data-ajax-onload'); 
	 		var target = me;
	 		var holder = me.parent();

	 		AjaxLoad_start(me, target);

	 		$.ajax({ type: "GET",   
			     url: url,   
			     success : function(text)
			     { 
			         AjaxLoad_success(me, target, text);  
			     }
			});
			 
		});

		function AjaxLoad_start(me, target){ 
	 		$( target ).removeClass('ajax-loaded');
	 		$( target ).addClass('ajax-loading');  
	 		me.addClass('ajax-loading');
	 		if( me.attr('data-ajax-scroll') ){ 
	 			// bs_scroll_to(me.attr('data-ajax-scroll'),0,me);
	 			scrollto_offset = $(me.attr('data-ajax-scroll')).offset().top; 
	 			$('html, body').animate({
					scrollTop: scrollto_offset
					} ); 
	 		}

	 	}

	 	function AjaxLoad_success(me, target, items){ 
	 		
	 		//$( target ).fadeOut(0);
	  	$( target ).removeClass('ajax-loading');
	  	$( target ).addClass('ajax-loaded');
	  	me.removeClass('ajax-loading'); 

	  	if(me.attr('data-ajax-load-remove') == 'me'){
		  	me.remove();
		  }

		  if(me.attr('data-ajax-load-method') == 'append'){ 
			 	$(target).append(items);
		  }
		  if(me.attr('data-ajax-load-method') == 'replace' || !me.attr('data-ajax-load-method') ){
		  	$( target ).html(items); 
		  }  
		  
	 	}

	}(jQuery); 

</script>