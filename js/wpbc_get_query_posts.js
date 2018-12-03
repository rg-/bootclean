$.fn.selectpicker.Constructor.BootstrapVersion = '4'; 

+function ($) {
    'use strict';

    function wpbc_do_selectpicker(item){
    	var select = item;
    	item.selectpicker();

	select.on('hidden.bs.select', function (e, relatedTarget, clickedIndex, isSelected, previousValue) {
		var me = $(relatedTarget.relatedTarget); 
			wpbc_get_query_posts_select_fix(me); 
	});

	select.on('loaded.bs.select', function (e, clickedIndex, isSelected, previousValue) {
		var me = $(e.currentTarget).parent().find('.dropdown-toggle'); 
			wpbc_get_query_posts_select_fix(me); 
	});
    }

    	// https://developer.snapappointments.com/bootstrap-select
	var wpbc_get_query_posts_select = $('.wpbc_get_query_posts_select');
	var wpbc_get_query_posts_select_args = {};

	function wpbc_get_query_posts_select_fix(select){
		var $html = select.find('.filter-option-inner-inner').html(); 
		$html = $html.replace(/&nbsp;/g, '');
		select.attr('title',$html);
		select.find('.filter-option-inner-inner').html($html);
	}

	if(wpbc_get_query_posts_select.length>0){
		/*
		wpbc_get_query_posts_select.selectpicker( {
			liveSearch : true,
			showTick : true,
			style: 'btn-light',
		} );
		*/
		wpbc_get_query_posts_select.selectpicker();

		wpbc_get_query_posts_select.on('hidden.bs.select', function (e, relatedTarget, clickedIndex, isSelected, previousValue) {
			var select = $(relatedTarget.relatedTarget); 
 			wpbc_get_query_posts_select_fix(select); 
		});

		wpbc_get_query_posts_select.on('loaded.bs.select', function (e, clickedIndex, isSelected, previousValue) {
			var select = $(e.currentTarget).parent().find('.dropdown-toggle'); 
 			wpbc_get_query_posts_select_fix(select); 
		});
	}

    $('[data-swap-preview]').each(function(){
    	
    	var target = $(this).data('swap-preview'); 

    	$(this).find('.preview_thumbs').on('click', function(){  
		$(target).find('article .property-meta').css('display','none');   
		$(target).find('article .property-excerpt').css('display','none'); 
		return false;
	});

	$(this).find('.preview_large').on('click', function(){  
		$(target).find('article .property-meta').css('display','');   
		$(target).find('article .property-excerpt').css('display',''); 
		$.cookie("preview", "large");  
	});

    });

    

    $('[data-select-all]').on('click', function(){ 
		var me = $(this);
		var input = me.data('select-all');
		var type = me.data('type');

		if(type=='checkbox'){
			$(input).prop('checked', true); 
		}

		return false;
	});
    $('[data-select-reset]').on('click', function(){ 
		var me = $(this);
		var input = me.data('select-reset');
		var type = me.data('type');
		if(type=='text'){ 
			$(input).val('');
		} 
		if(type=='radio'){ 
			$(input).prop('checked', false); 
			$(input+'[data-current]').trigger('click');
		} 
		if(type=='checkbox'){
			$(input).prop('checked', false); 
			$(input+'[data-current]').trigger('click');
		} 
		if(type=='dropdown'){ 
			if( $('[data-input-target="'+input+'"]').find('[data-current]').length>0 ){
				$('[data-input-target="'+input+'"]').find('[data-current]').trigger('click');
			}else{
				$('[data-input-target="'+input+'"]').find('[data-all]').trigger('click');
			}
		}
		if(type=='select'){ 
			$(input).val('-1').change();
		}
		return false;
	});

    $('[data-range-clear]').on('click', function(){ 
		var me = $(this); 
		var range = $(me.data('range-clear')).find('.slider-range').get(0); 
      	if(range){
	      	var range_args = $(me.data('range-clear')).data('range-args'); 
	      	range.noUiSlider.set([range_args.range.min[0], range_args.range.max[0]]);
      	}
		return false;
	});

	$('[data-check-all]').on('click', function(){ 
		var me = $(this);
		var input = me.data('check-all');
		$(input).prop('checked', true);
		return false;
	});
	$('[data-check-none]').on('click', function(){ 
		var me = $(this);
		var input = me.data('check-none');
		$(input).prop('checked', false);
		return false;
	});
	$('[data-select-none]').on('click', function(){ 
		var me = $(this);
		var input = me.data('select-none');
		$('[data-input-target="'+input+'"]').find('[data-all]').trigger('click');
		return false;
	});
	


    	// dropdown-selects ....  
    	$(".dropdown-select .dropdown-menu .dropdown-item").on('click', function(){
	  
		var selText = $(this).text();
		var valueText = $(this).data('value'); 
		var me = $(this).closest('.dropdown-select'); 
		var inputTarget = me.data('input-target'); 
		$(inputTarget).val(valueText);
		me.find('.active').removeClass('active');
		$(this).addClass('active');
		me.find('.dropdown-select-value').data('value',valueText);
		me.find('.dropdown-select-value').html(selText); 

		// Close this or any other opened...
		$('.dropdown-select.show .dropdown-toggle').trigger('click');

		return false;

	});

	/* Property Form Ajax functions */

      $(document).on( 'load', '[data-ajax-form]', function( event ) {
		// var serialize = $(this).serialize();
		// console.log("serialize");
		// console.log(serialize);
	});

	function wpbc_reset_all_form(form){  
      	
      	/*
	
		This button will reset all fields on form to none or all or similar.

      	*/

      	form.find('.dropdown-select [data-all]').trigger('click');  
      	
      	var range = form.find('.form-slider-range .slider-range').get(0); 
      	if(range){
	      	var range_args = form.find('.form-slider-range').data('range-args'); 
	      	range.noUiSlider.set([range_args.range.min[0], range_args.range.max[0]]);
      	}

      	form.find('.form-check-input').prop('checked', false); 

      	form.find('input[text="text"]').val('');
      }

      function wpbc_reset_form(form){  
      	
      	/*
		This button will re-select the values passed on page load
		So it´s like a reset to defaults button
      	*/

      	//console.log("wpbc_reset_form");
      	//console.log(form);

      	form.find('.dropdown-select [data-all]').trigger('click'); 
      	form.find('.dropdown-select [data-current]').trigger('click'); 
      	
      	var range = form.find('.form-slider-range .slider-range').get(0); 
      	if(range){
      		// TODO, reset to current if searched
	      	var range_args = form.find('.form-slider-range').data('range-args'); 
	      	range.noUiSlider.set([range_args.range.min[0], range_args.range.max[0]]);
      	}

      	form.find('.form-check-input').prop('checked', false);
      	form.find('.form-check-input[data-current]').prop('checked', true);

      	form.find('input[type="text"]').each(function(){
      		var current = $(this).data('current') ? $(this).data('current') : ''; 
      		$(this).val(current);
      		console.log("curr: "+current);
      		console.log($(this));
      	});
      	
      }

      // Ajax form search button
      function removeURLParameter(url, parameter) {
	    //prefer to use l.search if you have a location/link object
	    var urlparts= url.split('?');   
	    if (urlparts.length>=2) {

	        var prefix= encodeURIComponent(parameter)+'=';
	        var pars= urlparts[1].split(/[&;]/g);

	        //reverse iteration as may be destructive
	        for (var i= pars.length; i-- > 0;) {    
	            //idiom for string.startsWith
	            if (pars[i].lastIndexOf(prefix, 0) !== -1) {  
	                pars.splice(i, 1);
	            }
	        }

	        url= urlparts[0] + (pars.length > 0 ? '?' + pars.join('&') : "");
	        return url;
	    } else {
	        return url;
	    }
	}

	$(document).on( 'click', '[data-ajax-form-btn]', function( event ) {
		var me = $(this);
		
		var form_id = me.data('ajax-target-form');
		var form = $(form_id);
		// alert($(form).attr('action')); 
		
		// var form_action_url = $('[data-ajax-form]').attr('action');
		
		if( me.data('ajax-form-btn') == 'reset' ){ 
			wpbc_reset_form( form );
		}
		if( me.data('ajax-form-btn') == 'reset-all' ){ 
			wpbc_reset_all_form( form );
		}

		var target_url = form.attr('action') + "?" + form.serialize(); 
		
		if(form.attr("method")=="get"){
			//return;
		}
		var target_url_history = form.data('action-url') ? form.data('action-url') : 0;
		if( target_url_history ){
			var target_url_string = form.data('action-url') + "?" + form.serialize(); 
			var target_url_params = removeURLParameter(target_url_string, 'action');
			target_url_params = removeURLParameter(target_url_params, 'post_type'); 
			window.history.pushState(null, null, target_url_params);

			/*
		
			TODO_10:
			see this: https://css-tricks.com/examples/State/app.js

			in order to make back history to fire the function again and reload

			*/
		}

		/* This generates the url for the get_query_form ajax call like:

			wp-admin/admin-ajax.php/?action=get_query_form&use_as_search=1

			Can be used for re-load the entire form using ajax
		*/
		var target_form_url = form.attr('action') + "?" + form.serialize();
		var action_form = form.data('ajax-form');
		target_form_url = removeURLParameter(target_form_url, 'action');
		target_form_url = target_form_url+'&action='+action_form+'&use_as_search=1'; 

		var get_target = me.data('ajax-load');
		var nav_target = me.data('ajax-nav');
		var this_target = $(get_target);
		var this_nav_target = $(nav_target);   

		if(!this_nav_target){
			x = nav_target.replace("#","");
			$('<nav id="'+ x +'"/>').insertAfter(this_target);
		}
		
		// this_nav_target.html('');
		form.addClass('loading');
		this_nav_target.addClass('loading');
		me.addClass('loading');
		this_target.addClass('loading'); 
		this_target.append('<div id="get-loading-overlay" class="loading-overlay"></div>');

		//$("<div id='get-loading-loader' class='get-loading-loader'><span class='loader-icon'></span></div>").insertAfter(get_target);

		var loader = $('#get-loading-loader');
		var loader_overlay = $('#get-loading-overlay'); 

		// # ME QUEDE ACA 8 nov 18
		// TODO_10
		$('#property-map').html(target_url); // if debug div on html
		
		// For the loop ajax url with params
		console.log(target_url);
		// For the form ajax url with params
		console.log(target_form_url);


		/*

		Ajax re-loading for the form

		Idea here is to re-build form elements based on params, like:

			if some taxonomy, filter some meta if not posts sharing both....

		*/
		$("<div id='get-loading-form-temp' class='d-none'></div>").insertAfter(form);
		var form_temp = $('#get-loading-form-temp');

		form_temp.load(target_form_url, function(responseTxt, statusTxt, xhr) {
			
			var new_form_html = form_temp.find('form').html();
			form.html(new_form_html);

			// apply some functions for elements loaded
			var select = form.find('.wpbc_get_query_posts_select');
			wpbc_do_selectpicker(select);
			var slider_range = form.find('.form-slider-range');
			wpbc_do_slider_range(slider_range);

			// remove temp div
			form_temp.remove(); 

		});

		/*
	
		Ajax re-loading for the query loop

		*/
		$("<div id='get-loading-temp'></div>").insertAfter(get_target);
		var temp = $('#get-loading-temp');

		temp.load(target_url, function(responseTxt, statusTxt, xhr) { 

			// new contents
			var content = temp.find(get_target).html();
			var content_nav = temp.find(nav_target).html(); 

			// manipulating classes
			form.removeClass('loading');
			this_target.removeClass('loading');
			me.removeClass('loading'); 
			this_nav_target.removeClass('loading');

			// blur me, i´m a button
			me.trigger( "blur" );

			// remove loader things
			loader.remove(); 
			loader_overlay.remove(); 
			
			// replace new html into elements
			this_target.html(content); 
			this_nav_target.html(content_nav); 
			
			// remove temp div
			temp.remove(); 

			// apply some functions for elements loaded
			this_target.find('[data-inview]:not(.inview-me)').inview();
			$(window).trigger('resize'); 

			// if debug div on html(optional on html template)
			$('#ajax-debug').html(target_url);  
		});

		// console.log(target_url);
		return false;
	});

	// Ajax load more loop button
	$(document).on( 'click', '[data-shortcode-load]', function( event ) {
		var me = $(this);
		var target_url = me.attr('href');
		var get_target = me.data('shortcode-load');
		var nav_target = me.data('shortcode-nav');
		var this_target = $(get_target);
		var this_nav_target = $(nav_target);

		me.addClass('loading');
		this_target.addClass('loading');

		$("<div id='get-loading-loader' class='get-loading-loader'><span class='loader-icon'></span></div>").insertAfter(get_target);

		var loader = $('#get-loading-loader');

		$("<div id='get-loading-temp'></div>").insertAfter(get_target);
		var temp = $('#get-loading-temp');
		temp.load(target_url, function(responseTxt, statusTxt, xhr) {
			this_target.removeClass('loading');
			me.removeClass('loading');
			loader.remove(); 
			this_target.append(temp.find(get_target).html());
			this_nav_target.html(temp.find(nav_target).html());
			
			var anchor_first = temp.find(get_target).find('*:first').attr('id');
			if(anchor_first){
				bs_scroll_to( '#'+anchor_first );
			}

			temp.remove(); 
			this_target.find('[data-inview]:not(.inview-me)').inview();
			$(window).trigger('resize'); 
			
		});

		return false;

	});

	/*

	Slider Range

	TODO_10:

		make data-* anything

	*/

	function wpbc_do_slider_range(range){
		var rangeSliderJQ = range.find('.slider-range');
	  	var rangeSlider = rangeSliderJQ.get(0); 

	  	var deffaults_moneyFormat = {
		    decimals: 0,
		    thousand: '.',
		    prefix: 'USD'
		  };

	  	var data_money_format = range.data('money-format') ? range.data('money-format') : deffaults_moneyFormat; 
	  	
	  	var moneyFormat = wNumb(data_money_format);

	  	var deffaults_sliderArgs = {
			    start: [500000, 1000000],
			    step: 1000,
			    range: {
			      'min': [100000],
			      'max': [1000000]
			    },
			    rangeLabels: {
			    	'min': 'Min:',
			    	'max': 'Max:'
			    },
			    hideRangeLabels: false,
			    format: moneyFormat,
			    connect: true
			  }; 

		var data_range_args = range.data('range-args'); 
		if(data_range_args){
			var sliderArgs = $.extend(deffaults_sliderArgs, data_range_args);
		}else{
			var sliderArgs = deffaults_sliderArgs;
		} 

	 
		if( sliderArgs.rangeLabels  && !sliderArgs.hideRangeLabels ){
			var labels = range.append('<div class="range-labels"/>');
			$.each(sliderArgs.range, function(e){ 
				var label = '<label><b>'+sliderArgs.rangeLabels[e]+' <span class="slider-range-'+ e +'"></span></b></label>'; 
				range.find('.range-labels').append( label );
		  	});
	  	} 
	  	var arr_range = Object.values(sliderArgs.range);
	  	var arr_rageLabels = Object.values(sliderArgs.rangeLabels);  

	  	noUiSlider.create(rangeSlider, sliderArgs); 
		 
		rangeSlider.noUiSlider.on('update', function(values, handle) { 

	  		$.each(values, function(e,v){   
		  		$.each(sliderArgs.range, function(index, obj){  
		  			var ii = arr_range.indexOf(obj); 
					if(ii == e){
						var output_values = '.slider-range-'+ index;
						range.find(output_values).html(v); 
						var output_inputs = range.data('input-'+index);
						$(output_inputs).val( moneyFormat.from(v) ); 
					}
			  	});
		  	}); 
		  
		  });
	}
	  
	$('.noUi-handle').on('click', function() {
		$(this).width(50);
	}); 
	var rangeSlider_group = $('.form-slider-range');  
	rangeSlider_group.each(function(){  
		var range = $(this);
		wpbc_do_slider_range(range); 
	});  

// THE END
}(jQuery);