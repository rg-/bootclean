<?php
$property_id = !empty($property->ID) ? $property->ID : get_the_ID();
$featured_thumb_url = get_the_post_thumbnail_url($property_id, 'medium'); 
$featured_img_url = get_the_post_thumbnail_url($property_id,'full');
?>
<img src="<?php echo $featured_thumb_url; ?>" alt=" " class="property-thumbnail-image w-100 h-auto" data-inview="lazyload" data-inview-src="<?php echo $featured_img_url; ?>"/>