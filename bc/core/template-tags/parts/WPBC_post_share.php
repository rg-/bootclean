<?php 
function WPBC_post_share( $args=array() ){ 
	$defaults = array(
		'class' => '',
		'switch_label' => __('Share this publication', 'bootclean'), 
		'switch_icon' => '<i class="icon-share"></i>',
		'social_defaults' => array(),
		'item_class' => 'btn btn-primary',
		'switch_class' => '',
		'share_buttons_class' => '',
		'social_buttons_class' => '',
		'type' => 'default', // default || modal
		'modal_title' => '',
	); 
	$this_args = wp_parse_args( $args, $defaults ); 
	extract( $this_args ); 
	if($type=='default'){
	?>
	<div class="post-share <?php echo $class; ?>">
		<span class="share_switch <?php echo $switch_class; ?>"><?php echo $switch_label; ?> <?php echo $switch_icon; ?></span>
		<div class="share_buttons <?php echo $share_buttons_class; ?>">
			<div class="social_buttons <?php echo $social_buttons_class; ?>">
				<?php 
				foreach($social_defaults as $item){
					build_share_button($item, $item_class);
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
			<div class="modal fade" id="post-share" tabindex="-1" role="dialog" aria-labelledby="post-share" aria-hidden="true">

			  <div class="modal-dialog modal-dialog-centered" role="document">
			    
			    <div class="modal-content">

			      <div class="modal-header">
			      	<?php if(!empty($modal_title)){ ?>
			        <h5 class="modal-title" id="post-share"><?php echo $modal_title; ?></h5>
			        <?php } ?>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>

			      <div class="modal-body">
			      	
			      	<div class="share_buttons <?php echo $share_buttons_class; ?>">
						<div class="social_buttons <?php echo $social_buttons_class; ?>">
							<?php 
							foreach($social_defaults as $item){
								build_share_button($item, $item_class);
							}
							?>
						</div>	
					</div>

			      </div>

			    </div>

			  </div>
	
			</div>
			<!-- Modal #post-share END -->
	
		</div>
		<?php
	}
} 
function build_share_button($item, $item_class){ 
	$id = $item['id'];
	$icon = '';
	
	if(!empty($item['icon_src'])){
		$src = $item['icon_src']; 
		$icon = '<img src="'.$src.'" alt="" width="24" />';
	} 
	if(!empty($item['icon_html'])){
		$icon = $item['icon_html'];
	}
	$title = __('Share this on').' '.$item['title'];
	$label = !empty($icon) ? $icon : $item['title'];
	
	$url = apply_filters('wpbc/filter/post/share/button/url', $url, $id);
	$data = '';
	$data = apply_filters('wpbc/filter/post/share/button/data', $data, $id);

	?>
	<a href="<?php echo $url; ?>" <?php echo $data; ?> class="<?php echo $item_class;?> btn-<?php echo $id; ?>" title="<?php echo $title; ?>" target="_blank"><?php echo $label; ?></a>
	<?php
}
add_filter('wpbc/filter/post/share/button/data', function($data, $id){  
	return $data; 
},10,2);

add_filter('wpbc/filter/post/share/button/url', function($url, $id){ 
	$the_permalink = get_permalink();
		$the_permalink = apply_filters('wpbc/filter/post/share/permalink',$the_permalink, $id);
	$the_title = get_the_title();
		$the_title = apply_filters('wpbc/filter/post/share/title',$the_title, $id);
	$the_title_urlencode = urlencode($the_title);
	$the_title_rawurlencode = rawurlencode($the_title);
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
	if($id=='pinterest'){  
		$url = 'javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;http://assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());';
	} 

	return $url; 
},10,2);