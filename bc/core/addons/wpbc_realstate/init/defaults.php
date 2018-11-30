<?php  

/*

	TODO, see how to run this code just once, 
	for ex when theme is installed.

	This is used on settings, using filters like:


	'wpbc/filter/property/property_taxonomies/[TAX_ID]'

*/
	//wp_delete_term(63,'property_location');

$property_taxonomy_list = WPBC_property_taxonomies(); 
if(!empty($property_taxonomy_list)){ 
	foreach ($property_taxonomy_list as $key => $value) { 
		$taxonomy_id = $value['id']; 
		$property_taxonomy_tems_list = $value['default_terms'];
		if(!empty($property_taxonomy_tems_list)){
			foreach ($property_taxonomy_tems_list as $k => $v) {

				if($v['name'] && $v['slug'] && !term_exists($v['name'], $taxonomy_id) ){

					if( !term_exists($v['slug'], $taxonomy_id) ){
						$parent_term_id = 0;

						if(!empty($v['parent'])){
							$t = get_term_by('slug', $v['parent'], $taxonomy_id);
							$parent_term_id = $t->term_id;
						} 

						wp_insert_term(
							$v['name'],
							$taxonomy_id,
							array(
							  'description'	=> !empty($v['description']) ? $v['description'] : '',
							  'slug' 		=> $v['slug'],
							  'parent'		=> $parent_term_id,
							)
						);
					}
				}

			}
		} 
	}
}