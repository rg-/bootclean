/**
 * Custom scripts needed for the colorpicker, image button selectors,
 * and navigation tabs.
 */

jQuery(document).ready(function($) {
	
	// Reset to defaults
	
	var defaults_btn = $('.of-default-value');
	
	defaults_btn.each(function(){ 
		var me = $(this); 
		me.on('click',function(e){
			var target = $($(this).attr('href'));
			var def = $(this).attr('data-default'); 
			var type = $(this).attr('data-type');
			
			if(target.length<0) return false;

			// text and similars
			if(type=='test' || type=='text' || type=='number' ){ 
				target.find('.of-input').val(def);  
			}
			if(type=='images' ){ 
				target.find('.of-radio-img-img[data-value="'+def+'"]').trigger('click');  
			}
			if(type=='radio' ){ 
				target.find('[data-value="'+def+'"]').trigger('click');  
			}
			// Upload
			if(type=='upload'){ 
				target.find('.upload').val(def);
				target.find('.screenshot img').attr('src', def); 
			}
			// background
			if(type=='background'){ 
				// TODO, background type passing array into defaults, needs to be transformed into json or something.
				target.find('.of-color').wpColorPicker('color', def);  
			}
			// color
			if(type=='color'){ 
				target.find('.of-color').wpColorPicker('color', def);  
			}
			
			return false;
		});
		
	});

	// Loads tabbed sections if they exist
	if ( $('.nav-tab-wrapper').length > 0 ) {
		options_framework_tabs();
	}

	function options_framework_tabs() {

		var $group = $('.group'),
			$navtabs = $('.nav-tab-wrapper .of-menu-item a'),
			active_tab = '';

		// Hides all the .group sections to start
		$group.hide();
		 
		// Find if a selected tab is saved in localStorage
		if ( typeof(localStorage) != 'undefined' ) {
			active_tab = localStorage.getItem('active_tab');
		}

		// If active tab is saved and exists, load it's .group
		if ( active_tab != '' && $(active_tab).length ) {
			$(active_tab).fadeIn();
			$(active_tab + '-tab').addClass('nav-tab-active');
		} else {
			$('.group:first').fadeIn();
			$('.nav-tab-wrapper a:first').addClass('nav-tab-active');
		} 
		// Bind tabs clicks
		$navtabs.click(function(e) {

			e.preventDefault();
			 
			// Remove active class from all tabs
			$navtabs.removeClass('nav-tab-active');

			$(this).addClass('nav-tab-active').blur();

			if (typeof(localStorage) != 'undefined' ) {
				localStorage.setItem('active_tab', $(this).attr('href') );
			}

			var selected = $(this).attr('href');

			$group.hide();
			$(selected).fadeIn();

		});
	}
	
	// Build sub tabs sections
	
	var $sub_group = $('.of-form-fields .group');
	
	$sub_group.each(function(){ 
		var grp = $(this); 
		var s_tabs = grp.find('.section-sub-heading');
		var tabs = '';
		s_tabs.each(function(e){ 
			$(this).addClass('js-tabbed');
			tabs += '<a data-group="'+grp.attr('id')+'" href="#' + $(this).attr('id')  + '" class="of-sub-tab" id="' + $(this).attr('id') + '-tab">' + $(this).find('> .sub-heading').html() + '</a>'; 
		}); 
		grp.find('.of-group-heading').after('<div class="of-form-fields-sub-tabs">'+ tabs +'</div>');
		
		if ( typeof(localStorage) != 'undefined' ) {
			active_sub_tab = localStorage.getItem('active_sub_tab_'+grp.attr('id')); 
		}

		//console.log("active_sub_tab: "+active_sub_tab);
		
		s_tabs.hide().removeClass('active');
		
		if ( active_sub_tab != '' && $(active_sub_tab).length ) {
			$(active_sub_tab).fadeIn().addClass('active');
			$(active_sub_tab + '-tab').addClass('active');
		} else {
			grp.find('.section-sub-heading:first').fadeIn(); 
			grp.find('.of-sub-tab:first').addClass('active');
		} 
	
		grp.find('.of-sub-tab').on('click',function(e){
			
			e.preventDefault();
			
			// Remove active class from all tabs
			grp.find('.of-sub-tab').removeClass('active');

			$(this).addClass('active').blur();

			if (typeof(localStorage) != 'undefined' ) {
				localStorage.setItem('active_sub_tab_'+$(this).data('group'), $(this).attr('href') );
			}

			var selected = $(this).attr('href');

			s_tabs.hide().removeClass('active');
			$(selected).fadeIn().addClass('active');
			return false;
			
		});
	
	});
	
	// data-condition elements
	
	$('.WPBC_layout_builder_previewXXXX iframe').on('load',function(){
		
		///console.log("iframe loaded"); 
		
		
		
		$('#bc-options--layout--info .heading').on('click',function(){
			
			if($('.of-tabs.nav-tab-wrapper').hasClass('compact')){
				$('.of-tabs.nav-tab-wrapper').removeClass('compact').css('width','');
			}else{
				$('.of-tabs.nav-tab-wrapper').addClass('compact').css('width','35px');
			}
			
			 
			return false;
			
		});
	
	});
	// 
	
	function condition_is_checked(me, type='input'){
		var targets = me.attr('data-target'); 
		//console.log( targets );
		targets = $.parseJSON(targets);
		var conditions = me.attr('data-condition'); 
		//console.log( conditions );
		conditions = $.parseJSON(conditions); 
		
		$.each(targets,function(index,value){
			target = $(value);
			
			if(value.indexOf('#iframe') != -1){
				var res = value.replace('#iframe ', '');
				target = $('.WPBC_layout_builder_preview iframe').contents().find(res);
				//console.log("#iframe found");
			}
			
			if(conditions[index] == 1){
				target.show(); 
				target.addClass('show-by-checkbox');
			}else{ 
				target.hide(); 
				target.removeClass('show-by-checkbox');
			}
			//console.log( value );
		});
	}
	function condition_not_checked(me, type='input'){
		var targets = me.attr('data-target'); 
		//console.log( targets );
		targets = $.parseJSON(targets);
		var conditions = me.attr('data-condition'); 
		//console.log( conditions );
		conditions = $.parseJSON(conditions); 
		
		$.each(targets,function(index,value){
			target = $(value);
			
			if(value.indexOf('#iframe') != -1){
				var res = value.replace('#iframe ', '');
				target = $('.WPBC_layout_builder_preview iframe').contents().find(res);
				//console.log("#iframe found");
			}
			
			if(conditions[index] == 1){
				target.hide(); 
				target.removeClass('show-by-checkbox');
			}else{ 
				target.show(); 
				target.addClass('show-by-checkbox');
			}
			//console.log( value );
		});
	}
	
	$('[data-condition]').each(function(){
		   
		function condition_is_selected(me, val){
			var me = me;  
			var val = val;  
			var targets = me.attr('data-target'); 
			//console.log( targets );
			targets = $.parseJSON(targets);
			var conditions = me.attr('data-condition'); 
			//console.log( conditions );
			conditions = $.parseJSON(conditions);
			var rules = me.attr('data-rules'); 
			//console.log( conditions );
			rules = $.parseJSON(rules);
			$.each(targets,function(index,value){ 
				target = $(value); 
				
				if(value.indexOf('#iframe') != -1){
					var res = value.replace('#iframe ', '');
					target = $('.WPBC_layout_builder_preview iframe').contents().find(res);
					//console.log("#iframe found");
				}
				
				if( conditions[index] == 1 ){  
					if( val == rules[index] && !target.hasClass('show-by-checkbox') ){ 
						target.hide(); 
					}else{
						target.show();  
					}
				}else{ 
					target.show();  
				} 
			});
		}
		
		if($(this).is("select")) {  
			//console.log($(this).val()); 
			condition_is_selected($(this), $(this).val()) 
			$(this).on('change',function(){ 
				var me = $(this);
				var val = me.val(); 
				condition_is_selected(me, val);
			});
		}
		
		if( $(this).is("input") ) {
			if( $(this).is(':checked') ){
				condition_is_checked($(this)); 
			}else{
				condition_not_checked($(this));
			}
			
			$(this).on('click',function(){ 
				if($(this).is(':checked')){
					condition_is_checked($(this));
				}else{
					condition_not_checked($(this));
				} 			
			});
		}
		
	});


	// Loads the color pickers
	if(wpColorPicker_palettes){
		$('.of-color').wpColorPicker({
			palettes: wpColorPicker_palettes
		});
	}else{
		$('.of-color').wpColorPicker();
	}
	

	// Image Options
	$('.of-radio-img-input-wrap').click(function(){
		$( $(this).data('parent') ).find('.of-radio-img-img').removeClass('of-radio-img-selected');
		$(this).find('.of-radio-img-img').addClass('of-radio-img-selected');
	});

	$('.of-radio-label-label').click(function(){
		$(this).parent().parent().find('.of-radio-label-img').removeClass('of-radio-label-img-selected');
		$(this).find('.of-radio-label-img').addClass('of-radio-label-img-selected');
	});

	//$('.of-radio-img-label').hide();
	$('.of-radio-img-img').show();
	$('.of-radio-img-radio').hide(); 

});