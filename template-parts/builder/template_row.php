<?php 
$template_id = get_sub_field('key__layout_template_row__content_'.'key__r_wpbc_template', $post_id);
echo do_shortcode('[WPBC_get_template id="'.$template_id.'"/]');