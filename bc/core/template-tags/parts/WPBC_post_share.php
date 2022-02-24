<?php 
function WPBC_post_share( $args=array() ){ 
	$defaults = array(
		'class' => 'gpy-1',
		'switch_label' => __('Share this publication', 'bootclean'), 
		'switch_icon' => '<i class="icon-share"></i>',
		'social_defaults' => array(),
		'item_class' => 'btn btn-primary',
		'item_input_class' => 'form-control',
		'switch_class' => 'h5 d-block',
		'share_buttons_class' => '',
		'social_buttons_class' => '',
		'type' => 'default', // default || modal
		'modal_title' => '',
		'modal_class' => 'fade', 
		'modal_dialog_class' => 'modal-dialog-centered',
		'modal_content_class' => '',
		'modal_header_class' => '',
		'modal_body_class' => '',
		'share_buttons_before' => '',
		'share_buttons_after' => '',

	); 
	$this_args = wp_parse_args( $args, $defaults ); 
	$this_args = apply_filters('wpbc/filter/post/share/args', $this_args);
	extract( $this_args ); 
	if($type=='default'){
	?>
	<div class="post-share <?php echo $class; ?>">
		<span class="share_switch <?php echo $switch_class; ?>"><?php echo $switch_label; ?> <?php echo $switch_icon; ?></span>
		<div class="share_buttons <?php echo $share_buttons_class; ?>">
			<div class="social_buttons <?php echo $social_buttons_class; ?>">
				<?php 
				foreach($social_defaults as $item){
					build_share_button($item, $item_class, $item_input_class);
				}
				?>
			</div>	
		</div>
	</div>
	<?php
	}
	if($type=='modal'){
		?>
		<div class="post-share <?php echo $class; ?>">
			
			<a href="#" data-toggle="modal" data-target="#post-share" class="share_switch <?php echo $switch_class; ?>"><?php echo $switch_label; ?> <?php echo $switch_icon; ?></a>
			
			<!-- Modal #post-share -->
			<div class="<?php echo $modal_class; ?> modal" id="post-share" tabindex="-1" role="dialog" aria-labelledby="post-share" aria-hidden="true">

			  <div class="<?php echo $modal_dialog_class; ?> modal-dialog" role="document">
			    
			    <div class="<?php echo $modal_content_class; ?> modal-content">

			      <div class="<?php echo $modal_header_class; ?> modal-header">
			      	<?php if(!empty($modal_title)){ ?>
			        <h5 class="modal-title" id="post-share"><?php echo $modal_title; ?></h5>
			        <?php } ?>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>

			      <div class="<?php echo $modal_body_class; ?> modal-body">
			      	<?php echo $share_buttons_before; ?>
			      	<div class="share_buttons <?php echo $share_buttons_class; ?>">
								<div class="social_buttons <?php echo $social_buttons_class; ?>">
									<?php 
									foreach($social_defaults as $item){
										build_share_button($item, $item_class, $item_input_class);
									}
									?>
								</div>	
							</div>
							<?php echo $share_buttons_after; ?>
			      </div>

			    </div>

			  </div>
	
			</div>
			<!-- Modal #post-share END -->
	
		</div>
		<?php
	}
} 
function build_share_button($item, $item_class, $item_input_class){ 
	$id = $item['id'];
	$icon = '';
	
	if(!empty($item['icon_src'])){
		$src = $item['icon_src']; 
		$icon = '<img src="'.$src.'" alt="" width="24" />';
	} 
	if(!empty($item['icon_html'])){
		$icon = $item['icon_html'];
	}
	if(!empty($item['item_class'])){
		$item_class = $item['item_class'];
	}else{
		$item_class = $item_class . ' btn-'.$id;
	}



	$title = __('Share this on').' '.$item['title'];

	if(!empty($item['item_title'])){
		$title = $item['item_title'];
	}

	$label = !empty($icon) ? $icon : $item['title'];
	
	$url = !empty($item['url']) ? $item['url'] : '';

	$url = apply_filters('wpbc/filter/post/share/button/url', $url, $id);
	$data = '';
	$data = apply_filters('wpbc/filter/post/share/button/data', $data, $id);

	$before = '';
	$after = '';

	echo apply_filters('wpbc/filter/post/share/button/before', $before, $id);

	$filter_id = array('email','print');

	if( !in_array($id, $filter_id) ){  
	?>
	<a href="<?php echo $url; ?>" <?php echo $data; ?> class="<?php echo $item_class;?>" title="<?php echo $title; ?>" target="_blank"><?php echo $label; ?></a>
	<?php
	} 
	
	if($id=='print'){ ?>
		<button onClick="<?php echo $url; ?>" <?php echo $data; ?> class="<?php echo $item_class;?>" title="<?php echo $title; ?>" target="_blank"><?php echo $label; ?></button>
	<?php }

	if($id=='email'){ ?>
	<label for="share-email"><?php echo __('Copy & Paste URL', 'bootclean'); ?></label>
	<textarea name="share-email" class="<?php echo $item_input_class;?>" readonly><?php echo $url; ?></textarea>
	<?php
	}
	 
	echo apply_filters('wpbc/filter/post/share/button/after', $after, $id);
}
add_filter('wpbc/filter/post/share/button/data', function($data, $id){  
	return $data; 
},10,2);

add_filter('wpbc/filter/post/share/button/url', function($url, $id){ 
	$url_passed = $url;
	$the_permalink = get_permalink();
		$the_permalink = apply_filters('wpbc/filter/post/share/permalink',$the_permalink, $id);
	$the_title = get_the_title();
		$the_title = apply_filters('wpbc/filter/post/share/title',$the_title, $id);
	$the_title_urlencode = urlencode($the_title);
	$the_title_rawurlencode = rawurlencode($the_title);
	if($id=='email'){  
		if(!empty($url)){
			$url = $url;
		}else{
			$url = $the_permalink;
		}
		
	}
	if($id=='facebook'){  
		$url = 'http://facebook.com/share.php?u='.$the_permalink.'&amp;t='.$the_title_urlencode.'';
	}
	if($id=='twitter'){
		$url = 'http://twitter.com/home?status=Reading:%20'.$the_title_rawurlencode.'%20'.$the_permalink.'';
	}
	if($id=='delicious'){  
		$url = 'http://del.icio.us/post?url='.$the_permalink.'&amp;title='.$the_title_urlencode.'';
	} 
	if($id=='digg'){  
		$url = 'http://digg.com/submit?phase=2&amp;url='.$the_permalink.'&amp;title='.$the_title_urlencode.'';
	}
	if($id=='stumbleupon'){  
		$url = 'http://www.stumbleupon.com/submit?url='.$the_permalink.'&amp;title='.$the_title_urlencode.'';
	}
	if($id=='google-plus'){  
		$url = 'https://plusone.google.com/_/+1/confirm?hl=en&amp;url='.$the_permalink.'';
	} 
	if($id=='linkedin'){  
		$url = 'https://www.linkedin.com/sharing/share-offsite/?url='.$the_permalink.'';
	} 
	if($id=='pinterest'){  
		$url = 'javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;http://assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());';
	}  

	if($id=='whatsapp'){  
		if(!empty($url)){
			$url = $url;
		}else{
			$url = 'https://api.whatsapp.com/send?text='.$the_permalink.'';
		}
		
	} 

	if($id=='print'){
		$url = 'window.print()';
	}

	if(!empty($url_passed)){
		$url = $url_passed;
	}

	return $url; 
},10,2);