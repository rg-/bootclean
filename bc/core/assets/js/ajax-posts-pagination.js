(function($) { 
	/*

		ajax-posts-pagination

		Related:
			
			@WPBC_ajax_post_pagination
			core/template-tags/WPBC_ajax_post_pagination
			@WPBC_advanced_posts_pagination
			core/template-tags/parts/WPBC_advanced_posts_pagination

	*/ 

	
	$(document).on( 'click', '[data-get-target]', function( event ) {

		var me = $(this);
		var get_target = me.data('get-target');
		var this_target = $(get_target);
		var target_url = me.attr('href') +' '+ get_target;
		var me_target_url = me.attr('href') +' '+ '#get-target-button';

		me.addClass('loading');
		this_target.addClass('loading');

		$("<div id='get-loading-loader' class='get-loading-loader'><span class='loader-icon'></span></div>").insertAfter(get_target);

		var loader = $('#get-loading-loader');

		$("<div id='get-loading-temp'></div>").insertAfter(get_target);
		$("<div id='get-loading-temp-button'></div>").insertAfter(get_target);
		
		var temp = $('#get-loading-temp');
		var temp_btn = $('#get-loading-temp-button');

		/**/
		temp_btn.load(me_target_url, function(responseTxt, statusTxt, xhr) {
			me.parent().parent().html(temp_btn.html());
			temp_btn.remove(); 
		});	
		temp.load(target_url, function(responseTxt, statusTxt, xhr) {
			this_target.removeClass('loading');
			me.removeClass('loading');
			loader.remove(); 
			this_target.append(temp.find(get_target).html());
 
			temp.remove();

			this_target.find('[data-inview]:not(.inview-me)').inview();
			$(window).trigger('resize');
		});
		 
		return false;
	});

	$(document).on( 'click', '[data-ajax-nav="more"]', function( event ) {
		var me = $(this);

		var ajax_item = me.data('ajax-item');
		var this_target = me.parent();
		var target_url = me.find('[data-ajax-href]').data('ajax-href');

		var ajax_overlay = $('<div class="ajax-nav-loader"></div>');
		me.html(ajax_overlay);
		
		this_target.addClass('loading');
		
		var temp = $('<div id="temp"/>');
		temp.load(target_url, function(responseTxt, statusTxt, xhr) {
			if(responseTxt=='success'){
				
			} 
			$(this).find(ajax_item).eq(0).addClass('first-loaded');
			var new_html = $(this).html();
			this_target.append(new_html);
			$(ajax_item).find('[data-inview]').inview(); 

			temp.remove();
			me.remove();
			this_target.removeClass('loading');

			$(window).trigger('resize'); 
			
			bs_scroll_to(this_target.find('.first-loaded'));
			this_target.find('.first-loaded').removeClass('first-loaded');
			console.log('data-ajax-nav loaded');
		});
		return false;
	});

	$(document).on( 'click', '[data-toggle="ajax-load"]', function( event ) {
		
		var me = $(this);
		var target = me.parent();
		event.preventDefault(); 

		var ajax_target = target.data('ajax-target');  // Refers to url with ajax response 
		var ajax_holder = $('<div class="ajax-holder"></div>');
		var ajax_loader = $('<div class="ajax-loader"></div>');
		var ajax_overlay = $('<div class="loading-overlay"></div>');
		 
		var min_height = target.data('min-height') ? target.data('min-height') : '';
		if(min_height=='100%'){
			min_height = windowSize('y');
		}
		var ajax_load = $('<div class="ajax-load"></div>'); 

		if( target.data('ajax-target-content') ){
			var target_content = $( target.data('ajax-target-content') ); 
			target_content.wrapInner( "<div class='remove-me'></div>");
			target_content.addClass('ajax-holder'); 
			var target_holder = target_content;
		}else{
			var target_content = target;
			target_content.append(ajax_holder); 
			var target_holder = target_content.find('.ajax-holder');
		}

		if(min_height){
			target_holder.css('min-height',min_height);
		}
		target_holder.append(ajax_loader); 
		target_holder.append(ajax_overlay); 
		target_holder.addClass('loading').append(ajax_load); 
		//me.fadeOut();
		me.remove();
		target_holder.find('.ajax-load').load(ajax_target, function(responseTxt, statusTxt, xhr) {
			if(responseTxt=='success'){
				
			} 
			target_holder.find('.ajax-loader').fadeOut(300,function(){

				target.remove();
				target_holder.find('.remove-me').remove();  
				target_holder.css('min-height','').removeClass('loading').addClass('loaded'); 
				
				target_holder.find('[data-inview]').inview();
				$(window).trigger('resize'); 

			});
			
		});

		return false;
	})

	$(document).on( 'click', '.ajax-posts-pagination a.ajax-more-link:not(.disabled)', function( event ) {
		
		var me = $(this);

		event.preventDefault(); 

		var data_ajax_error = 'error'; 
		var data_ajax_nav = me.data('ajax-nav');
		var data_current = me.data('current');
		var data_max = me.data('max-page');
		var data_query = me.data('query');
		var next = data_current + 1; 
		var last = false;
 		if(data_current>=data_max-1){
			//console.log("LAST"); 
			me.addClass('disabled'); 
			var last = true;
			me.remove();
		}
		//console.log("data_current "+data_current);
		//console.log("data_max "+data_max);
		//console.log("next "+ next);
		//console.log("next "+ data_ajax_nav[next]); 
		me.data('current', next);

		paged = next; 
		console.log('data_query');
		console.log(data_query);
		console.log('query_vars');
		console.log(wpbc_ajax_posts_pagination_data.query_vars);
		console.log('query_vars_test');
		console.log( jQuery.parseJSON(wpbc_ajax_posts_pagination_data.query_vars_test) );
		$.ajax({
			url: wpbc_ajax_posts_pagination_data.ajaxurl,
			type: 'post',
			data: {
				action: 'wpbc_ajax_posts_pagination',
				query_vars: wpbc_ajax_posts_pagination_data.query_vars,
				paged: paged, 
			},
			beforeSend: function() {
				me.addClass('loading');
				$('#ajax-loader').addClass('ajax-loading');
				$('#ajax-target').append( '<div id="ajax-loader" class="ajax-loader"></div>' );
			},
			success: function( html ) {
				var temp = $(html);
				temp.find('.hentry').fadeOut(0);
				$('#ajax-loader').remove();
				$('#ajax-target').append( $(temp).html() );
				$('#ajax-target .hentry').fadeIn(500);

				$('.ajax-posts-pagination').find('.current').removeClass('current');
				$('.ajax-posts-pagination').find('.active').removeClass('active');
				me.addClass('current');
				me.parent().addClass('active');
				me.removeClass('loading');

				if(last){
					$('.ajax-posts-pagination .ajax-no-more').removeClass('hidden');
				}
				//$('#test').append( html );
			},
			error: function(ms){
				me.removeClass('loading');
				me.parent().prepend('<div class="ajax-error">'+data_ajax_error+'</div>');
				me.remove();
			}
		})

		return false;
	})

})(jQuery);