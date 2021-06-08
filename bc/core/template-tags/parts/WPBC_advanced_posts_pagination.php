<?php

if ( ! function_exists( 'WPBC_advanced_posts_pagination' ) ) : 

function WPBC_advanced_posts_pagination($args=array()){  

	$show_nav = false; // Just for debug 

	$defaults = array(

		'wp_query' => '',
		'max_page' => '',
		'paged' => '',

		'use_ajax' => false,
		'use_get_next' => false,
		'range' => 8,
		'out_info' => false,
		'nav_class'=> '',
		'ul_class' => 'pagination justify-content-center',
		'li_class' => 'page-item',
		'li_a_class' => 'page-link',
		'li_a_current_class' => 'current',
		'li_disabled' => 'disabled',
		'aria-label' => '',
		'prev_arrow' => '<i class="fa fa-chevron-left"></i>',
		'next_arrow' => '<i class="fa fa-chevron-right"></i>',
		'title_first' => '<i class="fa fa-chevron-left"></i><i class="fa fa-chevron-left"></i>',
		'title_last' => '<i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i>',
		'title_paged' => __('Page', 'bootclean'),
		'title_paged_of' => __('of', 'bootclean'),
		'txt_info' => __('posts under this term.', 'bootclean'),
		'prev_text' => __( 'Previous', 'bootclean' ),
		'next_text' => __( 'Next', 'bootclean' ), 
		'more_text' => __( 'Load more', 'bootclean' ), 
		'more_class' => 'btn btn-primary', 
		'more_text_last' => __( 'No more post to load', 'bootclean' ), 

		'use_pagination_first' => false,
		'use_pagination_last' => false,
		'use_pagination_arrows' => true,
		'use_pagination_paged' => false,
	);
	$args = wp_parse_args( $args, $defaults );

	extract( $args ); 

	$use_pagination_results = $out_info; 
	
	$out_info_msg = "";
	
	$out = "";  
	 
	// global $max_page, $paged, $wp_query; 
	if(empty($max_page)){
		global $max_page;
	}
	if(empty($paged)){
		global $paged;
	}
	if(empty($wp_query)){
		global $wp_query;
	} 	
  	// print_r($wp_query);
	//$out .= $wp_query->max_num_pages . ' - ' . $range . ' - ' . $paged;
  
  	if(!empty($use_ajax)){
  		$nav_class .= ' ajax-posts-pagination';
  	}

	if(!$max_page){$max_page = $wp_query->max_num_pages;} 
	if($max_page>1){
		$out .= "<nav class='$nav_class'>";
	} 

	if(!$paged) {
		$paged = 1;
	} 

	if( !empty($use_ajax) ){  

		$query = $wp_query;
		$query_vars = $wp_query->query_vars;
		 
		$current_page = $query_vars['paged'] ? $query_vars['paged'] : $paged;
		$data_ajax_nav = '';

		$arr_data = '';
		for ($i=0; $i < ($max_page); $i++) { 
			$arr_data[$i] = htmlentities2(get_pagenum_link($i+1)); 
		} 

		if($max_page > 1){
		//$out .= $data;
		$out .= "<a data-max-page='".$max_page."' data-current='".$current_page."' data-ajax-nav='".json_encode($arr_data)."' href='#' data-query='".json_encode($query_vars)."' class='ajax-more-link ".$more_class."'>".$more_text."<span class='loader-icon'></span></a>";
		
		$out .= "<div class='ajax-no-more hidden'>".$more_text_last."</div>";
		}else{
			$out .= "<div class='ajax-no-more'>".$more_text_last."</div>";
		}
	}

	if( empty($use_ajax) || $show_nav ){ 

	if($max_page > 1){
	  
		if(!$paged){$paged = 1;}

		$out .= "<ul class='$ul_class'>";
		
		if($use_pagination_first){
			if($paged != 1){ 
				$out .= "<li class='".$li_class."'><a rel='canonical' class='first ".$li_a_class."' href=" . get_pagenum_link(1) . "> ".$title_first." </a></li>";
			}
		}

		if($use_pagination_arrows){
			$this_class = $li_class;
			if($paged == 1){ 
				$this_class .= ' '.$li_disabled; 
				$next = "<span class='".$li_a_class."'>".$prev_arrow."</span>";
			}else{ 
				$next = "<a class='".$li_a_class."' href='" . htmlentities2(get_pagenum_link($paged-1)) . "'> ".$prev_arrow." </a>";
			} 
			$out .= "<li class='next ".$this_class."'>".$next."</li>";

		}
		
		if($max_page > $range){  
			// When closer to the beginning  
			if($paged < $range){  
				for($i = 1; $i <= ($range + 1); $i++){
					
					$this_class = $li_class;
					if($i==$paged){
						  $this_class .= ' active';
					  } 
					
					$out .= "<li class='".$this_class."'><a href='" . htmlentities2(get_pagenum_link($i)) ."' ";
					if($i>$paged){$out .= "rel='next' ";}
					if($i<$paged){$out .= "rel='prev' ";}
					if($i==$paged){$out .= "class='n ".$li_a_current_class." ".$li_a_class."'";}else{$out .= "class='n ".$li_a_class."'";}; 
					//if($i<10){$i = "0".$i;}
					$out .= ">$i</a></li>";
				}  
			}  
		  // When closer to the end  
		  elseif($paged >= ($max_page - ceil(($range/2)))){  
			for($i = $max_page - $range; $i <= $max_page; $i++){  
			
			$this_class = $li_class;
			if($i==$paged){
				  $this_class .= ' active';
			  } 

			  if($max_page == $i){
			  	$this_class .= ' last';
			  } 
			
			  $out .= "<li class='".$this_class."'><a href='" . htmlentities2(get_pagenum_link($i)) ."' ";
			  if($i>$paged){$out .= "rel='next' ";}
			  if($i<$paged){$out .= "rel='prev' ";}
			  if($i==$paged){$out .= "class='n ".$li_a_current_class." ".$li_a_class."'";}else{$out .= "class='n ".$li_a_class."'";}; 
			  //if($i<10){$i = "0".$i;}
			  $out .= ">$i</a></li>"; 
			}  
		  }  
		  // Somewhere in the middle  
		  elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){  
			for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){ 

			$this_class = $li_class;
			if($i==$paged){
				  $this_class .= ' active';
			  }
			  
			  $out .= "<li class='".$this_class."'><a href='" . htmlentities2(get_pagenum_link($i)) ."' "; 
			  if($i>$paged){$out .= "rel='next' ";}
			  if($i<$paged){$out .= "rel='prev' ";}
			  if($i==$paged){$out .= "class='n ".$li_a_current_class." ".$li_a_class."'";}else{$out .= "class='n ".$li_a_class."'";}; 
			  //if($i<10){$i = "0".$i;}
			  $out .= ">$i</a></li>";
			}  
		  }  
		}  
			// Less pages than the range, no sliding effect needed  
			else{  
			  for($i = 1; $i <= $max_page; $i++){
				  $this_class = $li_class;
				  if($i==$paged){
					  $this_class .= ' active';
				  }

				  if($max_page == $i){
				  	$this_class .= ' last';
				  } 

				$out .= "<li class='".$this_class."'><a href='" . htmlentities2(get_pagenum_link($i)) ."' ";  
				if($i>$paged){$out .= "rel='next' ";}
				if($i<$paged){$out .= "rel='prev' ";}
				if($i==$paged){$out .= "class='n ".$li_a_current_class." ".$li_a_class."'";}else{$out .= "class='n ".$li_a_class."'";}; 
				//if($i<10){$i = "0".$i;}
				$out .= ">$i</a></li>";
				}  
			}  
				
			if($use_pagination_arrows){
				$this_class = $li_class; 
				if($paged == $max_page){ 
					$this_class .= ' '.$li_disabled;  
					$next = "<span class='".$li_a_class."'>".$next_arrow."</span>";
					}else{ 
						$next = "<a class='".$li_a_class."' href='" . htmlentities2(get_pagenum_link($paged+1)) . "'> ".$next_arrow." </a>";
					} 
					$out .= "<li class='next ".$this_class."'>".$next."</li>";
			}

			if($use_pagination_last){		
				if($paged != $max_page){  
					$out .= " <li class='".$li_class."'><a class='last ".$li_a_class."' href='" . htmlentities2(get_pagenum_link($max_page)) . "'> ".$title_last." </a></li>";  
				}
			}
			
		} // if $max_page>1 END 
		
		if($paged==0){$paged = 1;};
		
		if($use_pagination_paged){
			if($max_page>1){$out_info_msg .= "<p class='desc'>".$title_paged." ".$paged . " ".$title_paged_of." " . $max_page."</p>";}
		}
		if($use_pagination_results){
			if($max_page>1){$out_info_msg .= "<p class='out_info'>".$wp_query->found_posts." ".$txt_info."</p>";};
		}
		

		if($use_get_next && $max_page>1 ){
			if($paged == $max_page){
				$next = $more_text_last;  
				$this_class .= ' '.$li_disabled;  
			}else{
				$next = get_next_posts_link($more_text, $max_page); 
			}
			$out = "<nav class='$nav_class'>";
			$out .= "<ul class='$ul_class'>";
			$next = str_replace('href', 'class="'.$more_class.'" data-get-target="#ajax-target" href', $next);
			$out .= "<li id='get-target-button' class='next ".$this_class."'>".$next."</li>";
			$out .= "</ul>";
		   	$out .= "</nav>";
		}
	} // IF no ajax end

	   //
		if($max_page>1){
		   $out .= "</ul>";
		   $out .= "</nav>";
		   $out .= $out_info_msg;
		}
	
	if(!empty($out)) echo $out;
	
}

endif;