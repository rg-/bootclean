<script id="WPBC-pjax-footer-script" type="text/javascript">

	/*

	Required Pjax plugin: https://github.com/MoOx/pjax

	*/

	<?php 
	$settings = array();
	$settings = apply_filters('wpbc/filter/pjax/settings',$settings);
	$settings = json_encode($settings);
	?>
	
	var settings = <?php echo $settings; ?>;  
	var pjax = new Pjax(settings); 

	+function ($) {  

		function pjaxWhenSend(){
			$('#body-loader').addClass('use-loader');
			$('#body-loader').css('opacity',.5);
			$('#body-loader').show();
			$('#body-loader').removeClass('inited');
			$('body').removeClass('inited');
			$('body').addClass('loading');  
			$('body.side-menu-visible #side-menu .navbar-toggler').trigger('click'); 
			$(window).trigger('resize');
			<?php do_action('wpbc/action/pjax/js/send'); ?>
		}
		function pjaxWhenSuccess(){

			_pjaxReplaceBodyAttrs(); 
			_pjaxRefreshComponents(); 
			_pjaxRefreshHash(); 

			$(window).trigger('resize'); 
			$('#body-loader').css('opacity',.5).fadeOut(500, function(){ 
				$(this).hide();
				$(this).addClass('inited');
				$('body').removeClass('loading');
				$('body').addClass('inited');
				$('#body-loader').addClass('use-loader');
				<?php do_action('wpbc/action/pjax/js/success/loader'); ?>
				$(window).trigger('resize');
			});
			<?php do_action('wpbc/action/pjax/js/success'); ?>
		}
		/* 
		pjax:send
		pjax:complete 
		pjax:success 
		pjax:error  
		*/
		document.addEventListener("pjax:send", pjaxWhenSend);
		document.addEventListener("pjax:success", pjaxWhenSuccess);

		function _pjaxRefreshHash(){
			if( window.location.hash && $(window.location.hash).length>0 && $('.scroll-to[href="'+window.location.hash+'"]') ){
				bs_scroll_to(window.location.hash); 
			}else{

			}
		}

		function _pjaxRefreshComponents(){

			/*

			Refresh all ramilay components.
			You can allways use the action 'wpbc/action/pjax/js/success'
			to include more js callbacks

			*/

			$(".scroll-to:not(.menu-item), .scroll-to-nav a, .scroll-to.menu-item a").on('click',function (e){
				bs_do_scroll_to($(this));
			}); 
		  
		  if($('[data-toggle="nav-affix"]').length>0){
				$('[data-toggle="nav-affix"]').navAffix();
			} 
			if($('[data-load-addclass]').length>0){
				$('[data-load-addclass]').loadAddclass();
			} 
			if($('[data-slick]').length>0){ 
				$('[data-slick]').make_slick(); 
			}  

			if($('[data-inview]').length>0){
				$('[data-inview]').inview();
			}

			$('a.antispam[href^="mailto:"]').antiSpam();
			
			$('body').removeClass('side-menu-visible');
			$('nav.navbar-expand-aside, nav.navbar-expand-3d').expandAside();

			if($('nav.navbar-expand-aside, nav.navbar-expand-3d').length>0){
				$('body').addClass('use-navbar-better'); // Guess this is not needed, see #simulate-body-class part
			} 

			if($('.wpcf7-form').length>0){ 
				wpcf7.initForm( jQuery('.wpcf7-form') ); 
			} 

		}
		function _pjaxReplaceBodyAttrs(){

			/* 
			Get data from #simulate-body-tags and pass to body... :)
			This html element should be present on page and ready as "selector" on pjax settings. 
			*/ 

	  	var new_body_tags = $('#simulate-body-tags');  
			// Repalce body class
			$('body').attr('class', new_body_tags.attr('class'));  
			// Replace data-config
			if( new_body_tags.attr('data-config') ){
				$('body').attr('data-config', new_body_tags.attr('data-config'));
			} 

			// remove body attrs 
			$.each( $('body')[0].attributes, function ( index, attribute ) { 
	      if (typeof attribute !== typeof undefined && attribute !== false) {
	      	if( attribute.name == 'class' || attribute.name =='data-config' && attribute.name ) return;
	      	if( !new_body_tags.is('['+attribute.name+']') ){ 
						$('body').removeAttr(attribute.name);
					}
	      } 
			});
			// Replace rest attrs, but not class, id, style and data-config
			$.each( new_body_tags[0].attributes, function ( index, attribute ) {
				if( attribute.name == 'class' || attribute.name =='id' || attribute.name =='style'  || attribute.name =='data-config' ) return;  
		      $('body').attr( attribute.name, attribute.value );

		  });
		}

	}(jQuery);

</script>