<?php

function WPBC_get_menu_mengamenu($id){ 
	$megamenu_content = WPBC_get_field('megamenu_content', $id);
	if( !empty($megamenu_content) ){
		return $megamenu_content;
	}else{
		return false;
	}
}

add_filter('wp_nav_menu_objects', 'WPBC_wp_nav_menu_objects', 10, 2); 
function WPBC_wp_nav_menu_objects( $items, $args ) {  
	foreach( $items as &$item ) {  
		if( WPBC_get_menu_mengamenu($item->ID) ) { 
			// $item->title .= ' Megamenu'; 
			// print_r($item);
		} 
	}  
	return $items; 
}

function WPBC_build_megamenu($item){
	
	$content = '';
	$mm_id = WPBC_get_menu_mengamenu($item->ID);
	$post_temp = get_post($mm_id);
	if(!empty($post_temp)){ 
		$template_post = get_post($mm_id); 
		$out = $template_post->post_content; 
	}
	
	ob_start(); 
	?>
	<div class="dropdown-megamenu-menu dropdown-menu animated fadeInDown" data-animated-respond="lg">
		<div class="megamenu-dialog">
			<div class="megamenu-dialog-container">
				<div class="container">
					<a href="#" data-toggle="dropdown-close"><i class="fa fa-times"></i></a>
					<div class="row gpt-2 gpb-2">
						<div class="col-lg-4 px-0 gpx-lg-1">
							<figure class="figure">
								<img src="images/sample/architecture/architecture-3076685_1280.jpg" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
								<figcaption class="figure-caption">A caption for the above image.</figcaption>
							</figure>
							<p>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
							<a class="btn btn-primary" href="#">Go somewhere</a>
						</div>
						<div class="col-lg-4 px-0 gpx-lg-1">
							<figure class="figure">
								<img src="images/sample/architecture/architecture-3076685_1280.jpg" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
								<figcaption class="figure-caption">A caption for the above image.</figcaption>
							</figure>
						</div>
						<div class="col-lg-4 px-0 gpx-lg-1">
							<figure class="figure">
								<img src="images/sample/architecture/architecture-3076685_1280.jpg" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
								<figcaption class="figure-caption">A caption for the above image.</figcaption>
							</figure>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}