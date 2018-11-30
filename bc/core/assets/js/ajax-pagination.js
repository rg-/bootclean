(function($) {
	
	function do_ajax(post_id, ajax_target, pushhistory){
		$.ajax({
			url: ajaxData.ajaxurl,
			type: 'post',
			//dataType : "json",
			data: {
				action: 'wpbc_ajax_pagination',
				post_id: post_id,
				// post_url: post_url,
				//post_href: post_href,
				//post_types: post_types,
				//template_part: template_part,
				//query_vars: ajaxData.query_vars,
				//page: page
			},
			beforeSend: function() {
				//console.log("beforeSend"); 
				$('#body-loader').addClass('ajax-loading');
				$('#body-loader').show();
				
			},
			success: function( html ) { 
				//console.log(post_url);
				ajax_target.fadeOut('fast',function(){ 
					$('#body-loader').hide(); 
					$('#body-loader').removeClass('ajax-loading');   
					wpbc_ajax_success(ajax_target, html, post_id, pushhistory); 
				});
				 
			},
			error: function(ms){
				//console.log(ms.responseText);
			}
		})
	}
	
	if(ajaxData.current_post && $('[data-ajax]').length > 0 ){
		var title = $(document).find('title').html();
		var url = $(document).find('[rel="canonical"]').attr('href');
		
		createView( {post_id: ajaxData.current_post, title:title, url:url, ajax_target: '#main' }, true );
	}
	
	$(document).on( 'click', '[data-ajax]', function( event ) {
		event.preventDefault();
		
		//console.log(ajaxData); 
		var ajax_target = $(this).data('ajax-target') ? $(this).data('ajax-target') : '#main'; 
			ajax_target = $(ajax_target);
		var post_types = $(this).data('ajax-post-types') ? $(this).data('ajax-post-types') : 'post,page';
		var post_id = $(this).data('ajax');
		var post_url = $(this).data('ajax-url');
		var post_href = $(this).attr('href');
		var template_part = $(this).data('ajax-template') ? $(this).data('ajax-template') : 'content';
		
		post_url = post_url ? post_url : post_href; 
		
		if( post_id && post_url ){ 
			
			do_ajax(post_id, ajax_target, true); 
			return false;
			
		} // if( post_id && post_url ){ END
		
	})
	
	function wpbc_ajax_success(ajax_target, html, post_id, pushhistory){
		
		ajax_target.html(html);
		
		var new_title = ajax_target.find('.hidden_ajax_data .title').html(); 
		var new_url = ajax_target.find('.hidden_ajax_data .url').html(); 
		
		$(document).find('title').html(new_title);
		
		ajax_target.fadeIn('fast');
		
		createView( {post_id: post_id, title:new_title, url:new_url, ajax_target: '#'+ajax_target.attr('id') }, pushhistory );
		// Todo, blind when user go back in history and apply the load
		// window.history.pushState( new_title , "Title", new_url);
		
	}  
	
	function createView(stateObject, pushHistory) {
		console.log(stateObject);
		//document.getElementById('contentBox').innerHTML = '<h1>'+stateObject.title+'</h1>'+boxcontent[stateObject.contentId];
		// currentPage = stateObject.contentId;
	 
		// Save state on history stack
		// - First argument is any object that will let you restore state
		// - Second argument is a title (not the page title, and not currently used)
		// - Third argument is the URL - this will appear in the browser address bar
		if (pushHistory) window.history.pushState(stateObject, stateObject.title, stateObject.url);
	}

	window.onpopstate = function(event) {
		//console.log(event.state);
		// We use false as the second argument below 
		// - state will already be on the stack when going Back/Forwards
		if(event.state){
			var ajax_target = $(event.state.ajax_target);
			do_ajax(event.state.post_id, ajax_target, false);
		}
		//createView(event.state, true);
		
		
	};
	
})(jQuery); 