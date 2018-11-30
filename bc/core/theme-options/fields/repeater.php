<?php


class Options_Framework_Repeater {
	
}

add_filter('wpbc/filter/options/repeater',function($output, $option_name,$option,$value,$counter){
	$out = '';
  
	$out .= apply_filters('wpbc/filter/options/repeater/before', $out, $option_name, $option, $value, $counter);

	if(is_null($counter)){
		$out .= '<input class="of-input inline" data-id="' . esc_attr( $option_name . '-' . $option['id'] . '' ) . '" data-rel="' . esc_attr( $option_name . '[' . $option['id'] . ']' ) . '" type="text" value="' . esc_attr( $value ) . '" />';
	}else{
		$out .= '<input class="of-input inline" readonly name="' . esc_attr( $option_name . '[' . $option['id'] . ']['.$counter.']' ) . '" type="text" value="' . esc_attr( $value ) . '" />';
	}

	$out .= apply_filters('wpbc/filter/options/repeater/after', $out, $option_name, $option, $value, $counter); 

	return $out;
},10,5);


function BC_build_repeater_id($option_name, $id, $counter){
	return esc_attr( $option_name . '-' . $id . '-'.$counter.'' );
}

function BC_options_repeater_field( $option_name, $option, $values ){
	$counter = 0;

	$delete_btn = '<div class="group-actions"><span class="delete"><button title="Remove" class="dodelete button icon delete">'. __('&times;') .'</button></span></div>';
	
    $output = '<div class="of-repeat-loop BC-sortable-fields">';

    if( is_array( $values ) ) foreach ( (array)$values as $value ){

        $output .= '<div class="of-repeat-group saved ui-state-default" id="repeater-' . BC_build_repeater_id($option_name, $option['id'], $counter) . '">';
			$output .= '<div class="group-fields">';
			$output .= '<div class="group-dragger"><span class="dashicons dashicons-move"></span></div>';
			 

			$output .= apply_filters('wpbc/filter/options/repeater',$output,$option_name,$option,$value,$counter);  


			$output .= '</div><!–.group-fields–>';
			$output .= '<div class="group-actions"><span class="delete"><button title="Remove" target="#repeater-' . BC_build_repeater_id($option_name, $option['id'], $counter) . '" class="dodelete button icon delete">'. __('&times;') .'</button></span></div>';


        $output .= '</div><!–.of-repeat-group–>';

        $counter++;
    }

    $output .= '<div class="of-repeat-group to-copy ui-state-default" data-name="">';
		$output .= '<div class="group-fields">';
		$output .= '<div class="group-dragger"><span class="dashicons dashicons-move"></span></div>';
		
		$output .= apply_filters('wpbc/filter/options/repeater',$output,$option_name,$option,$option['std'],null);

		//$output .= '<input class="of-input" data-id="' . esc_attr( $option_name . '-' . $option['id'] . '' ) . '" data-rel="' . esc_attr( $option_name . '[' . $option['id'] . ']' ) . '" type="text" value="' . esc_attr( $option['std'] ) . '" />';
		


		$output .= '</div><!–.group-fields–>';
		$output .= '<div class="group-actions"><span class="delete"><button title="Remove" target="" class="dodelete button icon delete">'. __('&times;') .'</button></span></div>'; 

    $output .= '</div><!–.of-repeat-group–>';

    $output .= '<button class="docopy button icon add">Add</button>';

    $output .= '</div><!–.of-repeat-loop–>';

    return $output;
}
add_filter('optionsframework_repeater', 'BC_options_repeater_field', 10, 3);

/*
* Sanitize Repeat Fields
*/
function of_sanitize_repeater( $input, $option ){
	$clean = '';
	if( is_array( $input ) )
	$clean = array_map( 'sanitize_text_field', $input);
	return $clean;
}
add_filter( 'of_sanitize_repeater', 'of_sanitize_repeater', 10, 2 );


/*
* Custom repeating field scripts
* Add and Delete buttons
*/
function of_repeat_script(){ ?>

    <script type="text/javascript">
        jQuery(function($){
			
			$('.BC-sortable-fields').sortable({
				
				items: "> .of-repeat-group"
				
			});
            
			$(".docopy").on("click", function(e){

                // the loop object
                $loop = $(this).parent();

                // the group to copy
                $group = $loop.find('.to-copy').clone().insertBefore($(this)).removeClass('to-copy').addClass('ready');

                // the new input
                $input = $group.find('input');

                input_name = $input.attr('data-rel');
                count = $loop.children('.of-repeat-group').not('.to-copy').length;
				input_id = $input.attr('data-id');
				$group.attr('data-name', 'repeater' + input_id + '-' + ( count - 1 ) + '');
				$group.find('.dodelete').attr('target', '#repeater' + input_id + '-' + ( count - 1 ) + '');
                $input.attr('name', input_name + '[' + ( count - 1 ) + ']'); 

                if( $loop.find('[data-callback]').length>0 ){
                	$loop.find('[data-callback]').each(function(){
                		var callback = $(this).data('callback');
                		// return typeof callback != 'undefined'; 
                	});
                }
                
                
                
                <?php  echo apply_filters('wpbc/filter/options/repeater/js/docopy',''); ?>

				return false;
            });

            $(".of-repeat-group").on("click", ".dodelete", function(e){
				 
                $($(this).attr('target')).remove();
				return false;
            });

        });
    </script>
<?php
}
add_action( 'optionsframework_custom_scripts', 'of_repeat_script' );