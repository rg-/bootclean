<?php

function WPBC_template_landing_build_section($args=array()){


	/*
	
	$args = array( 

		'id' => '', // DIV ID AND TEMPLATE NAME
		'class' => '',

		'acf' => array(
			'group_id' => '',
			'label' => '',
			'fields' => array(),
		),

	);

	*/ 

	if(empty($args) || empty($args['acf'])) return; 

	add_filter('wpbc/filter/template-landing/sections', function($sections) use ($args){
		global $post;
		$post_id = $post->id;

		$sections[] = array(
			'id' => !empty($args['id']) ? $args['id'] : '',
			'class' => !empty($args['class']) ? $args['class'] : '',
			'attrs' => !empty($args['attrs']) ? $args['attrs'] : '',
			'acf' => !empty($args['acf']) ? $args['acf'] : '',
			//'acf_field' => WPBC_get_field($args['acf']['group_id'], $post_id),
		);
	 
		return $sections;
	}, 0, 1);

	add_filter('wpbc/filter/template-landing/fields', function($fields) use ($args){

		$show_helper = apply_filters('wpbc/filter/template-landing/fields/show_helper',1);

		$msg = '<h3 style="margin-top:0!important; margin-bottom:0!important; ">'.$args['acf']['label'].'</h3>';
		if($show_helper){
			$msg .= '<span class="wpbc-badge secondary" style="text-transform:none!important; margin-top:13px;">template_landing__'.$args['acf']['group_id'].'</span>';
		}

		$fields[] = WPBC_acf_make_accordion_field(
			array(
				'key' => 'wpbc_template_landing__'.$args['acf']['group_id'].'_accordion',
				'label' => $msg,
			)
		); 

		$sub_fields = $args['acf']['sub_fields']; 

		$fields[] = array (
			'key' => 'wpbc_template_landing__'.$args['acf']['group_id'].'',
			'label' => !empty($args['acf']['group_label']) ? $args['acf']['group_label'] : _x('Section Content','bootclean'),
			'name' => 'template_landing__'.$args['acf']['group_id'].'',
			'type' => 'group',
			'value' => NULL,
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => 'wpbc-template-section-group',
				'id' => '',
			),
			'layout' => !empty($args['acf']['group_layout']) ? $args['acf']['group_layout'] : 'seamless',
			'sub_fields' => $sub_fields,
		);

		return $fields;

	}, 0, 1); 

} 
 


/*

	Template Part Functions

*/

function WPBC_template_landing__get_sections(){
	$sections = array();
	$sections = apply_filters('wpbc/filter/template-landing/sections', $sections);
	return $sections;
}

function WPBC_template_landing__main_pageheader(){
	WPBC_template_landing__main_container(true);
}

function WPBC_template_landing__main_container($get_page_header=false){   
	global $post;  

	/* Fiter this based on page fields used later, use the ID here and also on html id="" value and scroll-to link item */ 
	$make_sections = true; 
	
	$sections = WPBC_template_landing__get_sections();

	if($sections[0]['id']=='main-page-header' && !$get_page_header){
		unset($sections[0]);	
		$count = 1;
	}else{
		$count = 0;
	}

	if( !empty($sections[0]['id']) && $sections[0]['id']=='main-page-header' && $get_page_header){ 
		$sections = array($sections[0]); 
	}

	
	if(!empty($sections) && $make_sections){ 
 		
 		do_action('wpbc/layout/sections/start', $sections, $get_page_header);

		foreach ($sections as $k=>$v){
			$args = array(); 
			$args['id'] = $v['id'];
			$args['class'] = $v['class'];
			$args['attrs'] = $v['attrs'];
			$args['next'] = (!empty($v['next'])) ? $v['next'] : ( !empty($sections[$count+1]['id']) ? $sections[$count+1]['id'] : '' );

			if(!empty($v['acf_field'])){ 
				$args['acf_field'] = $v['acf_field'];  
			}else{ 
				$args['acf_field'] = WPBC_get_field('template_landing__'.$v['acf']['group_id'], $post->ID);
			}
			if(!empty($v['acf_field_xtra'])){ 
				$args['acf_field_xtra'] = $v['acf_field_xtra'];  
			}

			// $args passed to template SEE template-parts/landing 
			$template_folder = 'template-landing';
			$template_folder = apply_filters('wpbc/filter/template-landing/template_folder', $template_folder); 
			$out = WPBC_get_template_parts($template_folder.'/'.$v['id'].'', $args); 
			$section_args = array( 
				'id' => $v['id'],  
				'class' => $v['class'],
				'attrs' => $v['attrs'],
				'index' => $count, 
				'template_section' => $out, 
			);
			WPBC_template_landing__make_section($section_args);

			$count++; 
		} 

		do_action('wpbc/layout/sections/end', $sections, $get_page_header);

	}
}

function WPBC_template_landing__make_section($args=array()){ 

	extract(shortcode_atts(array( 
		'id' => '',  
		'class' => '',
		'attrs' => '',
		'index' => 0, 
		'template_section' => ''
	), $args));  

	// $args['next'] = 
	// $template_section = WPBC_get_template_parts('landing/'.$id.'', $args); 
	if(!empty($template_section)){ 
		
		$id = (!empty($id)) ? 'id="'.$id.'"' : 'id="landing-section'.$index.'"';
		$out = '<div '.$id.' '.$attrs.' class="'.$class.' landing-section" data-index="'.$index.'">'; 
			$out .= do_shortcode($template_section);
		$out .= '</div>';

		echo $out; 

	}
}


function WPBC_template_landing__section_slider($args, $items, $type='inline'){  
	$slick = array(
		'dots' => false,
		'arrows' => true,
		'appendArrows' => '#custom-arrows-'.$args['id'],  
	);
	$slick = json_encode($slick);
	$use_zoom = true;
	if(!empty($args['no-zoom'])){
		$use_zoom = false;
	}

	$item_class = '';
	$item_image_class = '';

	if($use_zoom){
		$item_class .= 'hover-effect-zoom';
		$item_image_class .= 'hover-elem';
	}
	?>
<div id="#slick-<?php echo $args['id']; ?>" class="theme-slick-slider type-<?php echo $type;?>" data-slick='<?php echo $slick; ?>'>
	<?php foreach($items as $k=>$v){ ?>
		<?php if($type=='inline'){ ?>
			<div class="item <?php echo $item_class; ?>">
				<div class="item-container">
					<?php
					$full = wp_get_attachment_image_src( $v['image'], 'full', false );
					?>
					<img class="<?php echo $item_image_class; ?>" src="<?php echo $full[0]; ?>" alt=" "/>
				</div>
			</div>
		<?php } ?>
		<?php if($type=='background'){ ?>
			<div class="item <?php echo $item_class; ?>">
				<div class="loading">
					<?php
					$full = wp_get_attachment_image_src( $v['image'], 'full', false );
					$medium = wp_get_attachment_image_src( $v['image'], 'medium', false );
					?>
					<span class="lazyload-loading"></span>
					<div class="item-container image-cover <?php echo $item_image_class; ?>" style="background-image: url(<?php echo $medium[0]; ?>);" data-lazyload-src="<?php echo $full[0]; ?>">
					</div>
				</div>
			</div>
		<?php } ?>
	<?php }?>
</div>
<div id="custom-arrows-<?php echo $args['id']; ?>" class="custom-arrows"></div>
	<?php
}

function WPBC_template_landing__section_next($next, $class='text-primary', $text='<i class="icon-arrow-down"></i>'){
?>
<a class="btn-section-next scroll-to <?php echo $class;?>" href="#<?php echo $next;?>"><?php echo $text;?></a>
<?php
} 