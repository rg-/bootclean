<?php

/*

	All in One SEO WP Plugin
	
	SEO TAGS filters 

*/

function WPBC_tokko_custom_title($title_parts) {
		
		$property_id = get_query_var('property_id', null);  
		if(empty($property_id)){
			$property_id = !empty($_GET['property_id']) ? $_GET['property_id'] : null;
		} 
		if(!empty($property_id)){
			$api_key = tokko_config('api_key');  
			if(empty($api_key)) return;
			$auth = new TokkoAuth($api_key); 
			if(empty($auth)) return;
			$property = new TokkoProperty('id', $property_id, $auth);
			if(empty($property)) return; 

			$title = $property->get_field('address');
	    $title_parts['title'] = $title;
    }

		$development_id = get_query_var('development_id', null);  
		if(empty($development_id)){
			$development_id = !empty($_GET['development_id']) ? $_GET['development_id'] : null;
		} 
		if(!empty($development_id)){
			$api_key = tokko_config('api_key');  
			if(empty($api_key)) return;
			$auth = new TokkoAuth($api_key); 
			if(empty($auth)) return;
			$development = new TokkoDevelopment('id', $development_id, $auth);
			if(empty($development)) return; 

			$title = $development->get_field('name');
	    $title_parts['title'] = $title;
    } 

    return $title_parts;
}
add_filter( 'document_title_parts', 'WPBC_tokko_custom_title' ); 


/* FOR AIOSEO */

add_filter( 'aioseo_title', 'WPBC_tokko_aioseop_title', 10, 1 ); 

function WPBC_tokko_aioseop_title( $title ) { 
		$property_id = get_query_var('property_id', null);  
		if(empty($property_id)){
			$property_id = !empty($_GET['property_id']) ? $_GET['property_id'] : null;
		} 
		if(!empty($property_id)){
			$api_key = tokko_config('api_key');  
			if(empty($api_key)) return;
			$auth = new TokkoAuth($api_key); 
			if(empty($auth)) return;
			$property = new TokkoProperty('id', $property_id, $auth);
			if(empty($property)) return; 

			$type = $property->get_field("type")->name;
			$operations = $property->get_available_operations_names();
			$location = $property->get_field("location")->name;

			$title = $property->get_field('address') . ' / ';
			$title .= strtoupper(implode(" - ",$operations)) . ' / ';
			$title .= strtoupper($type) . ' / ';
			$title .= strtoupper($location) . ' / ';
			$title .= ' REF: ' . $property_id; 

    }

		$development_id = get_query_var('development_id', null);  
		if(empty($development_id)){
			$development_id = !empty($_GET['development_id']) ? $_GET['development_id'] : null;
		} 
		if(!empty($development_id)){
			$api_key = tokko_config('api_key');  
			if(empty($api_key)) return;
			$auth = new TokkoAuth($api_key); 
			if(empty($auth)) return;
			$development = new TokkoDevelopment('id', $development_id, $auth);
			if(empty($development)) return; 

			$title = $development->get_field('name') . ' / ' . $development->get_field("location")->name . ' / REF: ' . $development_id;  
    } 
    return $title; 
}; 

add_filter( 'aioseo_description', 'WPBC_tokko_aioseop_description', 10, 1 ); 

function WPBC_tokko_aioseop_description(){
	$property_id = get_query_var('property_id', null);  
	if(empty($property_id)){
		$property_id = !empty($_GET['property_id']) ? $_GET['property_id'] : null;
	} 
	if(!empty($property_id)){
		$api_key = tokko_config('api_key');  
		if(empty($api_key)) return;
		$auth = new TokkoAuth($api_key); 
		if(empty($auth)) return;
		$property = new TokkoProperty('id', $property_id, $auth);
		if(empty($property)) return;  

		$description = $property->get_field('description'); 

  }

	$development_id = get_query_var('development_id', null);  
	if(empty($development_id)){
		$development_id = !empty($_GET['development_id']) ? $_GET['development_id'] : null;
	} 
	if(!empty($development_id)){
		$api_key = tokko_config('api_key');  
		if(empty($api_key)) return;
		$auth = new TokkoAuth($api_key); 
		if(empty($auth)) return;
		$development = new TokkoDevelopment('id', $development_id, $auth);
		if(empty($development)) return; 

		$description = $development->get_field('description');  
  } 
	return $description; 

}

// aioseo_canonical_url
add_filter( 'aioseo_canonical_url', 'WPBC_tokko_aioseop_canonical_url', 10, 1 ); 

function WPBC_tokko_aioseop_canonical_url( $canonical_url ) { 
 
	$property_id = get_query_var('property_id', null);  
	if(empty($property_id)){
		$property_id = !empty($_GET['property_id']) ? $_GET['property_id'] : null;
	} 
	if(!empty($property_id)){
		$api_key = tokko_config('api_key');  
		if(empty($api_key)) return;
		$auth = new TokkoAuth($api_key); 
		if(empty($auth)) return;
		$property = new TokkoProperty('id', $property_id, $auth);
		if(empty($property)) return;  

		$single_page = WPBC_get_field('field_wpbc_tokko_post_object_single_property','options'); 
		$canonical_url = get_permalink($single_page).WPBC_get_tokko_rewrite_property_url($property);

  }

	$development_id = get_query_var('development_id', null);  
	if(empty($development_id)){
		$development_id = !empty($_GET['development_id']) ? $_GET['development_id'] : null;
	} 
	if(!empty($development_id)){
		$api_key = tokko_config('api_key');  
		if(empty($api_key)) return;
		$auth = new TokkoAuth($api_key); 
		if(empty($auth)) return;
		$development = new TokkoDevelopment('id', $development_id, $auth);
		if(empty($development)) return; 

		$single_page = WPBC_get_field('field_wpbc_tokko_post_object_single_development','options');  
		$canonical_url = get_permalink($single_page).WPBC_get_tokko_rewrite_development_url($development); 
  } 

	return $canonical_url;
}

add_filter( 'aioseo_twitter_tags', 'WPBC_tokko_aioseo_twitter_tags' );

function WPBC_tokko_aioseo_twitter_tags( $twitterMeta ) {
  
  $property_id = get_query_var('property_id', null);  
	if(empty($property_id)){
		$property_id = !empty($_GET['property_id']) ? $_GET['property_id'] : null;
	} 
	if(!empty($property_id)){
		$api_key = tokko_config('api_key');  
		if(empty($api_key)) return;
		$auth = new TokkoAuth($api_key); 
		if(empty($auth)) return;
		$property = new TokkoProperty('id', $property_id, $auth);
		if(empty($property)) return;  
 		
 		$get_cover_picture = $property->get_cover_picture(); 
		if(!empty($get_cover_picture)){
			$img = $get_cover_picture->thumb;
			$img_lg = $get_cover_picture->original;
		}else{
			$img = get_stylesheet_directory_uri().'/images/theme/placeholder.png';
			$img_lg = $img;
		}

 		$twitterMeta['twitter:image'] = $img;

  }

	$development_id = get_query_var('development_id', null);  
	if(empty($development_id)){
		$development_id = !empty($_GET['development_id']) ? $_GET['development_id'] : null;
	} 
	if(!empty($development_id)){
		$api_key = tokko_config('api_key');  
		if(empty($api_key)) return;
		$auth = new TokkoAuth($api_key); 
		if(empty($auth)) return;
		$development = new TokkoDevelopment('id', $development_id, $auth);
		if(empty($development)) return; 

		$get_cover_picture = $development->get_cover_picture(); 
		if(!empty($get_cover_picture)){
			$img = $get_cover_picture->thumb;
			$img_lg = $get_cover_picture->original;
		}else{
			$img = get_stylesheet_directory_uri().'/images/theme/placeholder.png';
			$img_lg = $img;
		}

		$twitterMeta['twitter:image'] = $img;
 
  } 

   return $twitterMeta;
}

add_filter( 'aioseo_facebook_tags', 'WPBC_tokko_aioseo_facebook_tags' );

function WPBC_tokko_aioseo_facebook_tags( $facebookMeta ) {
  
  $property_id = get_query_var('property_id', null);  
	if(empty($property_id)){
		$property_id = !empty($_GET['property_id']) ? $_GET['property_id'] : null;
	} 
	if(!empty($property_id)){
		$api_key = tokko_config('api_key');  
		if(empty($api_key)) return;
		$auth = new TokkoAuth($api_key); 
		if(empty($auth)) return;
		$property = new TokkoProperty('id', $property_id, $auth);
		if(empty($property)) return;  
 		
 		$get_cover_picture = $property->get_cover_picture(); 
		if(!empty($get_cover_picture)){
			$img = $get_cover_picture->thumb;
			$img_lg = $get_cover_picture->original;
		}else{
			$img = get_stylesheet_directory_uri().'/images/theme/placeholder.png';
			$img_lg = $img;
		}

 		$facebookMeta['og:image'] = $img;

  }

	$development_id = get_query_var('development_id', null);  
	if(empty($development_id)){
		$development_id = !empty($_GET['development_id']) ? $_GET['development_id'] : null;
	} 
	if(!empty($development_id)){
		$api_key = tokko_config('api_key');  
		if(empty($api_key)) return;
		$auth = new TokkoAuth($api_key); 
		if(empty($auth)) return;
		$development = new TokkoDevelopment('id', $development_id, $auth);
		if(empty($development)) return; 

		$get_cover_picture = $development->get_cover_picture(); 
		if(!empty($get_cover_picture)){
			$img = $get_cover_picture->thumb;
			$img_lg = $get_cover_picture->original;
		}else{
			$img = get_stylesheet_directory_uri().'/images/theme/placeholder.png';
			$img_lg = $img;
		}

		$facebookMeta['og:image'] = $img;
 
  } 

   return $facebookMeta;
}

/*

	Contact Form 7 addons

*/

if(function_exists('wpcf7_add_shortcode')){

	add_shortcode('get_tokko_property_id', 'get_tokko_property_id_FX');

	function get_tokko_property_id_FX() {
	    //if (!is_array($tag)) return '';

	    //$name = $tag['name'];
	    //if (empty($name)) return '';

	    $out = '';

	    $property_id = get_query_var('property_id', null);  
			if(empty($property_id)){
				$property_id = !empty($_GET['property_id']) ? $_GET['property_id'] : null;
			} 
	    if(!empty($property_id)){
	    	$out = '<input type="hidden" name="get_tokko_property_id" value="'.$property_id.'">';
	    }
	    
	    return $out;
	}

	add_filter( 'wpcf7_special_mail_tags', 'PBC_wpcf7_do_shortcodes_mail_tag', 10, 3 );
	function PBC_wpcf7_do_shortcodes_mail_tag( $output, $name, $html ) {
		if ( 'get_tokko_property_id' == $name )
			$output = do_shortcode( "[$name]" );
	 
		return $output;
	}

}