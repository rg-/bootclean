<?php

include('extends/class-acf-field-true_false_advanced.php');
include('extends/class-acf-field-gallery_advanced.php'); 

add_filter( 'wp_kses_allowed_html', 'wpbc_acf_add_allowed_svg_tag', 10, 2 );
function wpbc_acf_add_allowed_svg_tag( $tags, $context ) {
    if ( $context === 'acf' ) {
        $tags['svg']  = array(
            'xmlns'       => true,
            'fill'        => true,
            'viewbox'     => true,
            'role'        => true,
            'aria-hidden' => true,
            'focusable'   => true,
        );
        $tags['path'] = array(
            'd'    => true,
            'fill' => true,
            'class' => true,
        ); 
    }

    return $tags;
}

add_action('admin_footer','WPBC_acf_loading_admin_footer',999);
function WPBC_acf_loading_admin_footer(){
	?>
<script id="WPBC_acf_admin_footer">
	
	(function($) { 

		$(window).on('load',function(){ 
			setTimeout(function(){ 
				$('body.wpbc_acf_loading').removeClass('wpbc_acf_loading').addClass('wpbc_acf_loaded');
			}, 1000); 
		}); 

		$('.acf-field-true-false.wpbc-select-type').each(function(){
			var me = $(this);
			var select = me.find('.acf-input [type="checkbox"]');

			var classes = me.attr('class');
			var classes = classes.split(" ");
			var target = '';
		
			select.on('change', function(event){

				$.each(classes, function(k,v){

					if( v.startsWith('wpbc-select-type-') ){ 
						var target = v.replace('wpbc-select-type-','');
						if(target){ 
							var badge = $('[data-key="'+ target +'"]').find('.wpbc-tab-badge');
							if (event.currentTarget.checked) { 
								choosed = true;
						    badge.removeClass('wpbc-d-none'); 
						  } else {
						  	choosed = false;
						  	badge.addClass('wpbc-d-none');  
						  }
						  if( choosed == 1){
						  	choosed = 'ENABLED';
						  }else{
						  	choosed = 'DISABLED';
						  }
						  badge.attr('title', choosed);
						}
					}

				}); 

			});

		});

		$('.acf-field-select.wpbc-select-type').each(function(){
			var me = $(this);
			var select = me.find('.acf-input select');
			
			var classes = me.attr('class');
			var classes = classes.split(" ");
			var target = ''; 

			select.on('change', function(){

				var choosed = $(this).val();  

				$.each(classes, function(k,v){ 
					if( v.startsWith('wpbc-select-type-') ){ 
						var target = v.replace('wpbc-select-type-',''); 
						if(target){ 
							var badge = $('[data-key="'+ target +'"]').find('.wpbc-tab-badge'); 
							if( choosed != 'none' ){  
								badge.removeClass('wpbc-d-none');  
							}else{  
								badge.addClass('wpbc-d-none');  
							}
							badge.attr('title', choosed);
						}
					} 
				});  

			});

		});

	})(jQuery); 

</script>
	<?php
}

add_filter( 'admin_body_class', 'WPBC_acf_loading_admin_body_class' ); 
function WPBC_acf_loading_admin_body_class( $classes ) { 
	$classes = "$classes wpbc_acf_loading";  
  return $classes; 
}

add_action('admin_head', 'WPBC_acf_loading_admin_head',999); 
function WPBC_acf_loading_admin_head(){ 

	$groups = array( 
		'#acf-group_builder__layout',
		'#acf-group_builder__flexible',
		'#acf-group_builder__flexible_secondary'
	);

	$groups = apply_filters('WPBC_group_builder__admin_styles', $groups);

	?>
<style id="WPBC_group_builder__admin_styles"> 
	
	<?php foreach ($groups as $group) { ?>
		 body.wpbc_acf_loading <?php echo $group; ?>:after {
			content:"";
			display: flex;
			align-items: center;
			justify-content: center;
			min-height: 200px;
			display: block;
			width: 100%;
			position: relative;
			background-color:transparent;
			background-repeat: no-repeat;
			background-position: center center;
			background-size:48px 48px;
			background-image: url("data:image/svg+xml;charset=utf8,%3C!-- By Sam Herbert (@sherb), for everyone. More @ http://goo.gl/7AJzbL --%3E%3Csvg width='38' height='38' viewBox='0 0 38 38' xmlns='http://www.w3.org/2000/svg'%3E%3Cdefs%3E%3ClinearGradient x1='8.042%25' y1='0%25' x2='65.682%25' y2='23.865%25' id='a'%3E%3Cstop stop-color='%23000000' stop-opacity='0' offset='0%25'/%3E%3Cstop stop-color='%23000000' stop-opacity='.631' offset='63.146%25'/%3E%3Cstop stop-color='%23000000' offset='100%25'/%3E%3C/linearGradient%3E%3C/defs%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg transform='translate(1 1)'%3E%3Cpath d='M36 18c0-9.94-8.06-18-18-18' id='Oval-2' stroke='url(%23a)' stroke-width='2'%3E%3CanimateTransform attributeName='transform' type='rotate' from='0 18 18' to='360 18 18' dur='0.9s' repeatCount='indefinite' /%3E%3C/path%3E%3Ccircle fill='%23000000' cx='36' cy='18' r='1'%3E%3CanimateTransform attributeName='transform' type='rotate' from='0 18 18' to='360 18 18' dur='0.9s' repeatCount='indefinite' /%3E%3C/circle%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
		}
		body.wpbc_acf_loading <?php echo $group; ?> .acf-field{
			display: none!important; 
		}

	<?php } ?> 

	body.wpbc_acf_loading .postbox.closed:after{
		display: none!important;
	}
 
</style>
<?php
} 