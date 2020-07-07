<?php
add_action('admin_footer','WPBC_theme_settings_admin_footer',999);
function WPBC_theme_settings_admin_footer(){
	?>
<script id="WPBC_theme_settings_admin_footer">
	
	(function($) {


		$(window).on('load',function(){ 
			setTimeout(function(){ 
				$('body.wpbc_loading').removeClass('wpbc_loading');
			}, 1000); 
		});

		var accordion_layouts = $('.wpbc-acf-accordion-layout');

		accordion_layouts.each(function(){

			var me = $(this); 
			var layout_location = me.find('.layout_location .acf-input input[type="radio"]');

			layout_location.on('click', function(){

				var img_to_replace = me.find('.acf-accordion-title img.icon');
				$new_img = $(this).parent().find('.radio-as-thumb-img-thumb').attr('src')
				img_to_replace.attr('src', $new_img)
				//alert( $(this).parent().find('.radio-as-thumb-img-thumb').attr('src') );

			});

		});

	})(jQuery); 

</script>
	<?php
}