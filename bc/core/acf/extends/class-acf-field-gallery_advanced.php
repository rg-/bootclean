<?php

if( ! class_exists('acf_field_gallery_advanced') ) :

class acf_field_gallery_advanced extends acf_field {
	
	
	/*
	*  __construct
	*
	*  This function will setup the field type data
	*
	*  @type	function
	*  @date	5/03/2014
	*  @since	5.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/
	
	function initialize() {
		
		// vars
		$this->name = 'gallery_advanced';
		$this->label = __("Gallery Advanced",'acf');
		$this->category = 'content';
		$this->defaults = array(
			'return_format'	=> 'array',
			'preview_size'	=> 'medium',
			'insert'		=> 'append',
			'library'		=> 'all',
			'min'			=> 0,
			'max'			=> 0,
			'min_width'		=> 0,
			'min_height'	=> 0,
			'min_size'		=> 0,
			'max_width'		=> 0,
			'max_height'	=> 0,
			'max_size'		=> 0,
			'mime_types'	=> '',

			'button_label'	=> __("Add",'acf'),
		);
		
		
		// actions
		add_action('wp_ajax_acf/fields/gallery/get_attachment',				array($this, 'ajax_get_attachment'));
		add_action('wp_ajax_nopriv_acf/fields/gallery/get_attachment',		array($this, 'ajax_get_attachment'));
		
		add_action('wp_ajax_acf/fields/gallery/update_attachment',			array($this, 'ajax_update_attachment'));
		add_action('wp_ajax_nopriv_acf/fields/gallery/update_attachment',	array($this, 'ajax_update_attachment'));
		
		add_action('wp_ajax_acf/fields/gallery/get_sort_order',				array($this, 'ajax_get_sort_order'));
		add_action('wp_ajax_nopriv_acf/fields/gallery/get_sort_order',		array($this, 'ajax_get_sort_order'));
		
	}
	
	/*
	*  input_admin_enqueue_scripts
	*
	*  description
	*
	*  @type	function
	*  @date	16/12/2015
	*  @since	5.3.2
	*
	*  @param	$post_id (int)
	*  @return	$post_id (int)
	*/
	
	function input_admin_enqueue_scripts() {
		
		// localize
		acf_localize_text(array(
		   	'Add Image to Gallery'		=> __('Add Image to Gallery', 'acf'),
			'Maximum selection reached'	=> __('Maximum selection reached', 'acf'),
	   	));
	}
	
	
	/*
	*  ajax_get_attachment
	*
	*  description
	*
	*  @type	function
	*  @date	13/12/2013
	*  @since	5.0.0
	*
	*  @param	$post_id (int)
	*  @return	$post_id (int)
	*/
	
	function ajax_get_attachment() {
		
		// Validate requrest.
		if( !acf_verify_ajax() ) {
			die();
		}
		
		// Get args.
   		$args = acf_request_args(array(
			'id'		=> 0,
			'field_key'	=> '',
		));
		
		// Cast args.
   		$args['id'] = (int) $args['id'];
		
		// Bail early if no id.
		if( !$args['id'] ) {
			die();
		}
		
		// Load field.
		$field = acf_get_field( $args['field_key'] );
		if( !$field ) {
			die();
		}
		
		// Render.
		$this->render_attachment( $args['id'], $field );
		die;
	}
	
	
	/*
	*  ajax_update_attachment
	*
	*  description
	*
	*  @type	function
	*  @date	13/12/2013
	*  @since	5.0.0
	*
	*  @param	$post_id (int)
	*  @return	$post_id (int)
	*/
	
	function ajax_update_attachment() {
		
		// validate nonce
		if( !wp_verify_nonce($_POST['nonce'], 'acf_nonce') ) {
		
			wp_send_json_error();
			
		}
		
		
		// bail early if no attachments
		if( empty($_POST['attachments']) ) {
		
			wp_send_json_error();
			
		}
		
		
		// loop over attachments
		foreach( $_POST['attachments'] as $id => $changes ) {
			
			if ( !current_user_can( 'edit_post', $id ) )
				wp_send_json_error();
				
			$post = get_post( $id, ARRAY_A );
		
			if ( 'attachment' != $post['post_type'] )
				wp_send_json_error();
		
			if ( isset( $changes['title'] ) )
				$post['post_title'] = $changes['title'];
		
			if ( isset( $changes['caption'] ) )
				$post['post_excerpt'] = $changes['caption'];
		
			if ( isset( $changes['description'] ) )
				$post['post_content'] = $changes['description'];
		
			if ( isset( $changes['alt'] ) ) {
				$alt = wp_unslash( $changes['alt'] );
				if ( $alt != get_post_meta( $id, '_wp_attachment_image_alt', true ) ) {
					$alt = wp_strip_all_tags( $alt, true );
					update_post_meta( $id, '_wp_attachment_image_alt', wp_slash( $alt ) );
				}
			}
			
			
			// save post
			wp_update_post( $post );
			
			
			/** This filter is documented in wp-admin/includes/media.php */
			// - seems off to run this filter AFTER the update_post function, but there is a reason
			// - when placed BEFORE, an empty post_title will be populated by WP
			// - this filter will still allow 3rd party to save extra image data!
			$post = apply_filters( 'attachment_fields_to_save', $post, $changes );
			
			
			// save meta
			acf_save_post( $id );
						
		}
		
		
		// return
		wp_send_json_success();
			
	}
	
	
	/*
	*  ajax_get_sort_order
	*
	*  description
	*
	*  @type	function
	*  @date	13/12/2013
	*  @since	5.0.0
	*
	*  @param	$post_id (int)
	*  @return	$post_id (int)
	*/
	
	function ajax_get_sort_order() {
		
		// vars
		$r = array();
		$order = 'DESC';
   		$args = acf_parse_args( $_POST, array(
			'ids'			=> 0,
			'sort'			=> 'date',
			'field_key'		=> '',
			'nonce'			=> '',
		));
		
		
		// validate
		if( ! wp_verify_nonce($args['nonce'], 'acf_nonce') ) {
		
			wp_send_json_error();
			
		}
		
		
		// reverse
		if( $args['sort'] == 'reverse' ) {
		
			$ids = array_reverse($args['ids']);
			
			wp_send_json_success($ids);
			
		}
		
		
		if( $args['sort'] == 'title' ) {
			
			$order = 'ASC';
			
		}
		
		
		// find attachments (DISTINCT POSTS)
		$ids = get_posts(array(
			'post_type'		=> 'attachment',
			'numberposts'	=> -1,
			'post_status'	=> 'any',
			'post__in'		=> $args['ids'],
			'order'			=> $order,
			'orderby'		=> $args['sort'],
			'fields'		=> 'ids'		
		));
		
		
		// success
		if( !empty($ids) ) {
		
			wp_send_json_success($ids);
			
		}
		
		
		// failure
		wp_send_json_error();
		
	}
	
	/**
	 * render_attachment
	 *
	 * Renders the sidebar HTML shown when selecting an attachmemnt.
	 *
	 * @date	13/12/2013
	 * @since	5.0.0
	 *
	 * @param	int $id The attachment ID.
	 * @param	array $field The field array.
	 * @return	void
	 */	
	function render_attachment( $id = 0, $field ) {
		
		// Load attachmenet data.
		$attachment = wp_prepare_attachment_for_js( $id );
		$compat = get_compat_media_markup( $id );
		
		// Get attachment thumbnail (video).
		if( isset($attachment['thumb']['src']) ) {
			$thumb = $attachment['thumb']['src'];
		
		// Look for thumbnail size (image).
		} elseif( isset($attachment['sizes']['thumbnail']['url']) ) {
			$thumb = $attachment['sizes']['thumbnail']['url'];
		
		// Use url for svg.
		} elseif( $attachment['type'] === 'image' ) {
			$thumb = $attachment['url'];
		
		// Default to icon.
		} else {
			$thumb = wp_mime_type_icon( $id );	
		}
		
		// Get attachment dimensions / time / size.
		$dimensions = '';
		if( $attachment['type'] === 'audio' ) {
			$dimensions = __('Length', 'acf') . ': ' . $attachment['fileLength'];	
		} elseif( !empty($attachment['width']) ) {
			$dimensions = $attachment['width'] . ' x ' . $attachment['height'];
		}
		if( !empty($attachment['filesizeHumanReadable']) ) {
			$dimensions .=  ' (' . $attachment['filesizeHumanReadable'] . ')';
		}
		
		?>
		<div class="acf-gallery-side-info">
			<img src="<?php echo esc_attr($thumb); ?>" alt="<?php echo esc_attr($attachment['alt']); ?>" />
			<p class="filename"><strong><?php echo esc_html($attachment['filename']); ?></strong></p>
			<p class="uploaded"><?php echo esc_html($attachment['dateFormatted']); ?></p>
			<p class="dimensions"><?php echo esc_html($dimensions); ?></p>
			<p class="actions">
				<a href="#" class="acf-gallery-edit" data-id="<?php echo esc_attr($id); ?>"><?php _e('Edit', 'acf'); ?></a>
				<a href="#" class="acf-gallery-remove" data-id="<?php echo esc_attr($id); ?>"><?php _e('Remove', 'acf'); ?></a>
			</p>
		</div>
		<table class="form-table">
			<tbody>
				<?php 
				
				// Render fields.
				$prefix = 'attachments[' . $id . ']';
				
				acf_render_field_wrap(array(
					//'key'		=> "{$field['key']}-title",
					'name'		=> 'title',
					'prefix'	=> $prefix,
					'type'		=> 'text',
					'label'		=> __('Title', 'acf'),
					'value'		=> $attachment['title']
				), 'tr');
				
				acf_render_field_wrap(array(
					//'key'		=> "{$field['key']}-caption",
					'name'		=> 'caption',
					'prefix'	=> $prefix,
					'type'		=> 'textarea',
					'label'		=> __('Caption', 'acf'),
					'value'		=> $attachment['caption']
				), 'tr');
				
				acf_render_field_wrap(array(
					//'key'		=> "{$field['key']}-alt",
					'name'		=> 'alt',
					'prefix'	=> $prefix,
					'type'		=> 'text',
					'label'		=> __('Alt Text', 'acf'),
					'value'		=> $attachment['alt']
				), 'tr');
				
				acf_render_field_wrap(array(
					//'key'		=> "{$field['key']}-description",
					'name'		=> 'description',
					'prefix'	=> $prefix,
					'type'		=> 'textarea',
					'label'		=> __('Description', 'acf'),
					'value'		=> $attachment['description']
				), 'tr');
				
				?>
			</tbody>
		</table>
		<?php
		
		// Display compat fields.
		echo $compat['item'];
	}
	
	/*
	*  render_field()
	*
	*  Create the HTML interface for your field
	*
	*  @param	$field - an array holding all the field's data
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*/
	
	function render_field( $field ) {
		
		// Enqueue uploader assets.
		acf_enqueue_uploader();

		if( empty($field['button_label']) ) {
		
			$field['button_label'] = $this->defaults['button_label'];
			
		}
		
		// Control attributes.
		$attrs = array(
			'id'				=> $field['id'],
			'class'				=> "acf-gallery {$field['class']}",
			'data-library'		=> $field['library'],
			'data-preview_size'	=> $field['preview_size'],
			'data-min'			=> $field['min'],
			'data-max'			=> $field['max'],
			'data-mime_types'	=> $field['mime_types'],
			'data-insert'		=> $field['insert'],
			'data-columns'		=> 4 
		);
		
		// Set gallery height with deafult of 400px and minimum of 200px.
		$height = acf_get_user_setting('gallery_height', 400);
		$height = max( $height, 200 );
		$attrs['style'] = "height:{$height}px";
		
		// Load attachments.
		$attachments = array();
		if( $field['value'] ) {
			
			// Clean value into an array of IDs.
			$attachment_ids = array_map('intval', acf_array($field['value']));
			
			// Find posts in database (ensures all results are real).
			$posts = acf_get_posts(array(
				'post_type'					=> 'attachment',
				'post__in'					=> $attachment_ids,
				'update_post_meta_cache' 	=> true,
				'update_post_term_cache' 	=> false
			));
			
			// Load attatchment data for each post.
			$attachments = array_map('acf_get_attachment', $posts);
		}
		
		?>
<div <?php acf_esc_attr_e($attrs); ?>>
	<input type="hidden" name="<?php echo esc_attr($field['name']); ?>" value="" />
	<div class="acf-gallery-main">
		<div class="acf-gallery-attachments">
			<?php if( $attachments ): ?>
				<?php foreach( $attachments as $i => $attachment ): 
					
					// Vars
					$a_id = $attachment['ID'];
					$a_title = $attachment['title'];
					$a_type = $attachment['type'];
					$a_filename = $attachment['filename'];
					$a_class = "acf-gallery-attachment -{$a_type}";
					
					// Get thumbnail.
					$a_thumbnail = acf_get_post_thumbnail($a_id, $field['preview_size']);
					$a_class .= ($a_thumbnail['type'] === 'icon') ? ' -icon' : '';
					
					?>
					<div class="<?php echo esc_attr($a_class); ?>" data-id="<?php echo esc_attr($a_id); ?>">
						<input type="hidden" name="<?php echo esc_attr($field['name']); ?>[]" value="<?php echo esc_attr($a_id); ?>" />
						<div class="margin">
							<div class="thumbnail">
								<img src="<?php echo esc_url($a_thumbnail['url']); ?>" alt="" />
							</div>
							<?php if( $a_type !== 'image' ): ?>
								<div class="filename"><?php echo acf_get_truncated( $a_filename, 30 ); ?></div>	
							<?php endif; ?>
						</div>
						<div class="actions">
							<a class="acf-icon -cancel dark acf-gallery-remove" href="#" data-id="<?php echo esc_attr($a_id); ?>" title="<?php _e('Remove', 'acf'); ?>"></a>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
		<div class="acf-gallery-toolbar">
			<ul class="acf-hl">
				<li>
					<a href="#" class="acf-button button button-primary acf-gallery-add"><?php echo $field['button_label']; ?></a>
				</li>
				<li class="acf-fr">
					<select class="acf-gallery-sort">
						<option value=""><?php _e('Bulk actions', 'acf'); ?></option>
						<option value="date"><?php _e('Sort by date uploaded', 'acf'); ?></option>
						<option value="modified"><?php _e('Sort by date modified', 'acf'); ?></option>
						<option value="title"><?php _e('Sort by title', 'acf'); ?></option>
						<option value="reverse"><?php _e('Reverse current order', 'acf'); ?></option>
					</select>
				</li>
			</ul>
		</div>
	</div>
	<div class="acf-gallery-side">
		<div class="acf-gallery-side-inner">
			<div class="acf-gallery-side-data"></div>
			<div class="acf-gallery-toolbar">
				<ul class="acf-hl">
					<li>
						<a href="#" class="acf-button button acf-gallery-close"><?php _e('Close', 'acf'); ?></a>
					</li>
					<li class="acf-fr">
						<a class="acf-button button button-primary acf-gallery-update" href="#"><?php _e('Update', 'acf'); ?></a>
					</li>
				</ul>
			</div>
		</div>	
	</div>
</div>
		<?php
		
	}
	
	
	/*
	*  render_field_settings()
	*
	*  Create extra options for your field. This is rendered when editing a field.
	*  The value of $field['name'] can be used (like bellow) to save extra data to the $field
	*
	*  @type	action
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field	- an array holding all the field's data
	*/
	
	function render_field_settings( $field ) {
		
		// clear numeric settings
		$clear = array(
			'min',
			'max',
			'min_width',
			'min_height',
			'min_size',
			'max_width',
			'max_height',
			'max_size'
		);
		
		foreach( $clear as $k ) {
			
			if( empty($field[$k]) ) $field[$k] = '';
			
		}
		
		// return_format
		acf_render_field_setting( $field, array(
			'label'			=> __('Return Format','acf'),
			'instructions'	=> '',
			'type'			=> 'radio',
			'name'			=> 'return_format',
			'layout'		=> 'horizontal',
			'choices'		=> array(
				'array'			=> __("Image Array",'acf'),
				'url'			=> __("Image URL",'acf'),
				'id'			=> __("Image ID",'acf')
			)
		));
		
		// preview_size
		acf_render_field_setting( $field, array(
			'label'			=> __('Preview Size','acf'),
			'instructions'	=> '',
			'type'			=> 'select',
			'name'			=> 'preview_size',
			'choices'		=> acf_get_image_sizes()
		));
		
		// insert
		acf_render_field_setting( $field, array(
			'label'			=> __('Insert','acf'),
			'instructions'	=> __('Specify where new attachments are added','acf'),
			'type'			=> 'select',
			'name'			=> 'insert',
			'choices' 		=> array(
				'append'		=> __('Append to the end', 'acf'),
				'prepend'		=> __('Prepend to the beginning', 'acf')
			)
		));
		
		// library
		acf_render_field_setting( $field, array(
			'label'			=> __('Library','acf'),
			'instructions'	=> __('Limit the media library choice','acf'),
			'type'			=> 'radio',
			'name'			=> 'library',
			'layout'		=> 'horizontal',
			'choices' 		=> array(
				'all'			=> __('All', 'acf'),
				'uploadedTo'	=> __('Uploaded to post', 'acf')
			)
		));
		
		// min
		acf_render_field_setting( $field, array(
			'label'			=> __('Minimum Selection','acf'),
			'instructions'	=> '',
			'type'			=> 'number',
			'name'			=> 'min'
		));
		
		// max
		acf_render_field_setting( $field, array(
			'label'			=> __('Maximum Selection','acf'),
			'instructions'	=> '',
			'type'			=> 'number',
			'name'			=> 'max'
		));

		// button_label
		acf_render_field_setting( $field, array(
			'label'			=> __('Button Label','acf'),
			'instructions'	=> '',
			'type'			=> 'text',
			'name'			=> 'button_label',
		));
		
		// min
		acf_render_field_setting( $field, array(
			'label'			=> __('Minimum','acf'),
			'instructions'	=> __('Restrict which images can be uploaded','acf'),
			'type'			=> 'text',
			'name'			=> 'min_width',
			'prepend'		=> __('Width', 'acf'),
			'append'		=> 'px',
		));
		
		acf_render_field_setting( $field, array(
			'label'			=> '',
			'type'			=> 'text',
			'name'			=> 'min_height',
			'prepend'		=> __('Height', 'acf'),
			'append'		=> 'px',
			'_append' 		=> 'min_width'
		));
		
		acf_render_field_setting( $field, array(
			'label'			=> '',
			'type'			=> 'text',
			'name'			=> 'min_size',
			'prepend'		=> __('File size', 'acf'),
			'append'		=> 'MB',
			'_append' 		=> 'min_width'
		));	
		
		
		// max
		acf_render_field_setting( $field, array(
			'label'			=> __('Maximum','acf'),
			'instructions'	=> __('Restrict which images can be uploaded','acf'),
			'type'			=> 'text',
			'name'			=> 'max_width',
			'prepend'		=> __('Width', 'acf'),
			'append'		=> 'px',
		));
		
		acf_render_field_setting( $field, array(
			'label'			=> '',
			'type'			=> 'text',
			'name'			=> 'max_height',
			'prepend'		=> __('Height', 'acf'),
			'append'		=> 'px',
			'_append' 		=> 'max_width'
		));
		
		acf_render_field_setting( $field, array(
			'label'			=> '',
			'type'			=> 'text',
			'name'			=> 'max_size',
			'prepend'		=> __('File size', 'acf'),
			'append'		=> 'MB',
			'_append' 		=> 'max_width'
		));	
		
		// allowed type
		acf_render_field_setting( $field, array(
			'label'			=> __('Allowed file types','acf'),
			'instructions'	=> __('Comma separated list. Leave blank for all types','acf'),
			'type'			=> 'text',
			'name'			=> 'mime_types',
		));
	}
	
	
	/*
	*  format_value()
	*
	*  This filter is appied to the $value after it is loaded from the db and before it is returned to the template
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value (mixed) the value which was loaded from the database
	*  @param	$post_id (mixed) the $post_id from which the value was loaded
	*  @param	$field (array) the field array holding all the field options
	*
	*  @return	$value (mixed) the modified value
	*/
	
	function format_value( $value, $post_id, $field ) {
		
		// Bail early if no value.
		if( !$value ) {
			return false;
		}
		
		// Clean value into an array of IDs.
		$attachment_ids = array_map('intval', acf_array($value));
		
		// Find posts in database (ensures all results are real).
		$posts = acf_get_posts(array(
			'post_type'					=> 'attachment',
			'post__in'					=> $attachment_ids,
			'update_post_meta_cache' 	=> true,
			'update_post_term_cache' 	=> false
		));
		
		// Bail early if no posts found.
		if( !$posts ) {
			return false;
		}
		
		// Format values using field settings.
		$value = array();
		foreach( $posts as $post ) {
			
			// Return object.
			if( $field['return_format'] == 'object' ) {
				$item = $post;
				
			// Return array.		
			} elseif( $field['return_format'] == 'array' ) {
				$item = acf_get_attachment( $post );
				
			// Return URL.		
			} elseif( $field['return_format'] == 'url' ) {
				$item = wp_get_attachment_url( $post->ID );
			
			// Return ID.		
			} else {
				$item = $post->ID;
			}
			
			// Append item.
			$value[] = $item;
		}
		
		// Return.
		return $value;
	}
	
	
	/*
	*  validate_value
	*
	*  description
	*
	*  @type	function
	*  @date	11/02/2014
	*  @since	5.0.0
	*
	*  @param	$post_id (int)
	*  @return	$post_id (int)
	*/
	
	function validate_value( $valid, $value, $field, $input ){
		
		if( empty($value) || !is_array($value) ) {
		
			$value = array();
			
		}
		
		
		if( count($value) < $field['min'] ) {
		
			$valid = _n( '%s requires at least %s selection', '%s requires at least %s selections', $field['min'], 'acf' );
			$valid = sprintf( $valid, $field['label'], $field['min'] );
			
		}
		
				
		return $valid;
		
	}
	
	
	/*
	*  update_value()
	*
	*  This filter is appied to the $value before it is updated in the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value - the value which will be saved in the database
	*  @param	$post_id - the $post_id of which the value will be saved
	*  @param	$field - the field array holding all the field options
	*
	*  @return	$value - the modified value
	*/
	
	function update_value( $value, $post_id, $field ) {
		
		// Bail early if no value.
		if( empty($value) ) {
			return $value;
		}
		
		// Convert to array.
		$value = acf_array( $value );
		
		// Format array of values.
		// - ensure each value is an id.
		// - Parse each id as string for SQL LIKE queries.
		$value = array_map('acf_idval', $value);
		$value = array_map('strval', $value);
		
		// Return value.
		return $value;
		
	}	
}


// initialize
acf_register_field_type( 'acf_field_gallery_advanced' );

endif; // class_exists check


add_action('acf/input/admin_footer', 'acf_field_gallery_advanced_admin_footer');

function acf_field_gallery_advanced_admin_footer() {
	
	?>
	<script type="text/javascript">
	(function($){
	
	var Field = acf.Field.extend({
		
		type: 'gallery_advanced',
		
		events: {
			'click .acf-gallery-add':			'onClickAdd',
			'click .acf-gallery-edit':			'onClickEdit',
			'click .acf-gallery-remove':		'onClickRemove',
			'click .acf-gallery-attachment': 	'onClickSelect',
			'click .acf-gallery-close': 		'onClickClose',
			'change .acf-gallery-sort': 		'onChangeSort',
			'click .acf-gallery-update': 		'onUpdate',
			'mouseover': 						'onHover',
			'showField': 						'render'
		},
		
		actions: {
			'validation_begin': 	'onValidationBegin',
			'validation_failure': 	'onValidationFailure',
			'resize':				'onResize'
		},
		
		onValidationBegin: function(){
			acf.disable( this.$sideData(), this.cid );
		},
		
		onValidationFailure: function(){
			acf.enable( this.$sideData(), this.cid );
		},
		
		$control: function(){
			return this.$('.acf-gallery');
		},
		
		$collection: function(){
			return this.$('.acf-gallery-attachments');
		},
		
		$attachments: function(){
			return this.$('.acf-gallery-attachment');
		},
		
		$attachment: function( id ){
			return this.$('.acf-gallery-attachment[data-id="' + id + '"]');
		},
		
		$active: function(){
			return this.$('.acf-gallery-attachment.active');
		},
		
		$main: function(){
			return this.$('.acf-gallery-main');
		},
		
		$side: function(){
			return this.$('.acf-gallery-side');
		},
		
		$sideData: function(){
			return this.$('.acf-gallery-side-data');
		},
		
		isFull: function(){
			var max = parseInt( this.get('max') );
			var count = this.$attachments().length;
			return ( max && count >= max );
		},
		
		getValue: function(){
			
			// vars
			var val = [];
			
			// loop
			this.$attachments().each(function(){
				val.push( $(this).data('id') );
			});
			
			// return
			return val.length ? val : false;
		},
		
		addUnscopedEvents: function( self ){
			
			// invalidField
			this.on('change', '.acf-gallery-side', function(e){
				self.onUpdate( e, $(this) );
			});
		},
		
		addSortable: function( self ){
			
			// add sortable
			this.$collection().sortable({
				items: '.acf-gallery-attachment',
				forceHelperSize: true,
				forcePlaceholderSize: true,
				scroll: true,
				start: function (event, ui) {
					ui.placeholder.html( ui.item.html() );
					ui.placeholder.removeAttr('style');
	   			},
	   			update: function(event, ui) {
					self.$input().trigger('change');
		   		}
			});
			
			// resizable
			this.$control().resizable({
				handles: 's',
				minHeight: 200,
				stop: function(event, ui){
					acf.update_user_setting('gallery_height', ui.size.height);
				}
			});
		},
		
		initialize: function(){
			
			// add unscoped events
			this.addUnscopedEvents( this );
			
			// render
			this.render();
		},
		
		render: function(){
			
			// vars
			var $sort = this.$('.acf-gallery-sort');
			var $add = this.$('.acf-gallery-add');
			var count = this.$attachments().length;
			
			// disable add
			if( this.isFull() ) {
				$add.addClass('disabled');
			} else {
				$add.removeClass('disabled');
			}
			
			// disable select
			if( !count ) {
				$sort.addClass('disabled');
			} else {
				$sort.removeClass('disabled');
			}
			
			// resize
			this.resize();
		},
		
		resize: function(){
			
			// vars
			var width = this.$control().width();
			var target = 150;
			var columns = Math.round( width / target );
						
			// max columns = 8
			columns = Math.min(columns, 8);
			
			// update data
			this.$control().attr('data-columns', columns);
		},
		
		onResize: function(){
			this.resize();
		},
		
		openSidebar: function(){
			
			// add class
			this.$control().addClass('-open');
			
			// hide bulk actions
			// should be done with CSS
			//this.$main().find('.acf-gallery-sort').hide();
			
			// vars
			var width = this.$control().width() / 3;
			width = parseInt( width );
			width = Math.max( width, 350 );
			
			// animate
			this.$('.acf-gallery-side-inner').css({ 'width' : width-1 });
			this.$side().animate({ 'width' : width-1 }, 250);
			this.$main().animate({ 'right' : width }, 250);
		},
		
		closeSidebar: function(){
			
			// remove class
			this.$control().removeClass('-open');
			
			// clear selection
			this.$active().removeClass('active');
			
			// disable sidebar
			acf.disable( this.$side() );
			
			// animate
			var $sideData = this.$('.acf-gallery-side-data');
			this.$main().animate({ right: 0 }, 250);
			this.$side().animate({ width: 0 }, 250, function(){
				$sideData.html('');
			});
		},
		
		onClickAdd: function( e, $el ){
			
			// validate
			if( this.isFull() ) {
				this.showNotice({
					text: acf.__('Maximum selection reached'),
					type: 'warning'
				});
				return;
			}
			
			// new frame
			var frame = acf.newMediaPopup({
				mode:			'select',
				title:			acf.__('Add Image to Gallery'),
				field:			this.get('key'),
				multiple:		'add',
				library:		this.get('library'),
				allowedTypes:	this.get('mime_types'),
				selected:		this.val(),
				select:			$.proxy(function( attachment, i ) {
					this.appendAttachment( attachment, i );
				}, this)
			});
		},
		
		appendAttachment: function( attachment, i ){
			
			// vars
			attachment = this.validateAttachment( attachment );
			
			// bail early if is full
			if( this.isFull() ) {
				return;
			}
			
			// bail early if already exists
			if( this.$attachment( attachment.id ).length ) {
				return;
			}
			
			// html
			var html = [
			'<div class="acf-gallery-attachment" data-id="' + attachment.id + '">',
				'<input type="hidden" value="' + attachment.id + '" name="' + this.getInputName() + '[]">',
				'<div class="margin" title="">',
					'<div class="thumbnail">',
						'<img src="" alt="">',
					'</div>',
					'<div class="filename"></div>',
				'</div>',
				'<div class="actions">',
					'<a href="#" class="acf-icon -cancel dark acf-gallery-remove" data-id="' + attachment.id + '"></a>',
				'</div>',
			'</div>'].join('');
			var $html = $(html);
			
			// append
			this.$collection().append( $html );
			
			// move to beginning
			if( this.get('insert') === 'prepend' ) {
				var $before = this.$attachments().eq( i );
				if( $before.length ) {
					$before.before( $html );
				}
			}
			
			// render attachment
			this.renderAttachment( attachment );
			
			// render
			this.render();
			
			// trigger change
			this.$input().trigger('change');
		},
		
		validateAttachment: function( attachment ){
			
			// defaults
			attachment = acf.parseArgs(attachment, {
				id: '',
				url: '',
				alt: '',
				title: '',
				filename: '',
				type: 'image'
			});
			
			// WP attachment
			if( attachment.attributes ) {
				attachment = attachment.attributes;
				
				// preview size
				var url = acf.isget(attachment, 'sizes', this.get('preview_size'), 'url');
				if( url !== null ) {
					attachment.url = url;
				}
			}
			
			// return
			return attachment;
		},
		
		renderAttachment: function( attachment ){
			
			// vars
			attachment = this.validateAttachment( attachment );
			
			// vars
			var $el = this.$attachment( attachment.id );
			
			// Image type.
			if( attachment.type == 'image' ) {
				
				// Remove filename.
				$el.find('.filename').remove();
			
			// Other file type.	
			} else {	
				
				// Check for attachment featured image.
				var image = acf.isget(attachment, 'image', 'src');
				if( image !== null ) {
					attachment.url = image;
				}
				
				// Update filename text.
				$el.find('.filename').text( attachment.filename );
			}
			
			// Default to mimetype icon.
			if( !attachment.url ) {
				attachment.url = acf.get('mimeTypeIcon');
				$el.addClass('-icon');
			}
			
			// update els
		 	$el.find('img').attr({
			 	src:	attachment.url,
			 	alt:	attachment.alt,
			 	title:	attachment.title
			});
		 	
			// update val
		 	acf.val( $el.find('input'), attachment.id );
		},
		
		editAttachment: function( id ){
			
			// new frame
			var frame = acf.newMediaPopup({
				mode:		'edit',
				title:		acf.__('Edit Image'),
				button:		acf.__('Update Image'),
				attachment:	id,
				field:		this.get('key'),
				select:		$.proxy(function( attachment, i ) {
					this.renderAttachment( attachment );
					// todo - render sidebar
				}, this)
			});
		},
		
		onClickEdit: function( e, $el ){
			var id = $el.data('id');
			if( id ) {
				this.editAttachment( id );
			}
		},
		
		removeAttachment: function( id ){
			
			// close sidebar (if open)
			this.closeSidebar();
			
			// remove attachment
			this.$attachment( id ).remove();
			
			// render
			this.render();
			
			// trigger change
			this.$input().trigger('change');
		},
		
		onClickRemove: function( e, $el ){
			
			// prevent event from triggering click on attachment
			e.preventDefault();
			e.stopPropagation();
			
			//remove
			var id = $el.data('id');
			if( id ) {
				this.removeAttachment( id );
			}
		},
		
		selectAttachment: function( id ){
			
			// vars
			var $el = this.$attachment( id );
			
			// bail early if already active
			if( $el.hasClass('active') ) {
				return;
			}
			
			// step 1
			var step1 = this.proxy(function(){
				
				// save any changes in sidebar
				this.$side().find(':focus').trigger('blur');
				
				// clear selection
				this.$active().removeClass('active');
				
				// add selection
				$el.addClass('active');
				
				// open sidebar
				this.openSidebar();
				
				// call step 2
				step2();
			});
			
			// step 2
			var step2 = this.proxy(function(){
				
				// ajax
				var ajaxData = {
					action: 'acf/fields/gallery/get_attachment',
					field_key: this.get('key'),
					id: id
				};
				
				// abort prev ajax call
				if( this.has('xhr') ) {
					this.get('xhr').abort();
				}
				
				// loading
				acf.showLoading( this.$sideData() );
				
				// get HTML
				var xhr = $.ajax({
					url: acf.get('ajaxurl'),
					data: acf.prepareForAjax(ajaxData),
					type: 'post',
					dataType: 'html',
					cache: false,
					success: step3
				});
				
				// update
				this.set('xhr', xhr);
			});
			
			// step 3
			var step3 = this.proxy(function( html ){
				
				// bail early if no html
				if( !html ) {
					return;
				}
				
				// vars
				var $side = this.$sideData();
				
				// render
				$side.html( html );
				
				// remove acf form data
				$side.find('.compat-field-acf-form-data').remove();
				
				// merge tables
				$side.find('> table.form-table > tbody').append( $side.find('> .compat-attachment-fields > tbody > tr') );	
								
				// setup fields
				acf.doAction('append', $side);
			});
			
			// run step 1
			step1();
		},
		
		onClickSelect: function( e, $el ){
			var id = $el.data('id');
			if( id ) {
				this.selectAttachment( id );
			}
		},
		
		onClickClose: function( e, $el ){
			this.closeSidebar();
		},
		
		onChangeSort: function( e, $el ){
			
			// Bail early if is disabled.
			if( $el.hasClass('disabled') ) {
				return;
			}
			
			// Get sort val.
			var val = $el.val();
			if( !val ) {
				return;
			}
			
			// find ids
			var ids = [];
			this.$attachments().each(function(){
				ids.push( $(this).data('id') );
			});
			
			
			// step 1
			var step1 = this.proxy(function(){
				
				// vars
				var ajaxData = {
					action: 'acf/fields/gallery/get_sort_order',
					field_key: this.get('key'),
					ids: ids,
					sort: val
				};
				
				
				// get results
			    var xhr = $.ajax({
			    	url:		acf.get('ajaxurl'),
					dataType:	'json',
					type:		'post',
					cache:		false,
					data:		acf.prepareForAjax(ajaxData),
					success:	step2
				});
			});
			
			// step 2
			var step2 = this.proxy(function( json ){
				
				// validate
				if( !acf.isAjaxSuccess(json) ) {
					return;
				}
				
				// reverse order
				json.data.reverse();
				
				// loop
				json.data.map(function(id){
					this.$collection().prepend( this.$attachment(id) );
				}, this);
			});
			
			// call step 1
			step1();
		},
		
		onUpdate: function( e, $el ){
			
			// vars
			var $submit = this.$('.acf-gallery-update');
			
			// validate
			if( $submit.hasClass('disabled') ) {
				return;
			}
			
			// serialize data
			var ajaxData = acf.serialize( this.$sideData() );
			
			// loading
			$submit.addClass('disabled');
			$submit.before('<i class="acf-loading"></i> ');
			
			// append AJAX action		
			ajaxData.action = 'acf/fields/gallery/update_attachment';
			
			// ajax
			$.ajax({
				url: acf.get('ajaxurl'),
				data: acf.prepareForAjax(ajaxData),
				type: 'post',
				dataType: 'json',
				complete: function(){
					$submit.removeClass('disabled');
					$submit.prev('.acf-loading').remove();
				}
			});
		},
		
		onHover: function(){
			
			// add sortable
			this.addSortable( this );
			
			// remove event
			this.off('mouseover');
		}
	});
	
	acf.registerFieldType( Field );
	
	// register existing conditions
	acf.registerConditionForFieldType('hasValue', 'gallery_advanced');
	acf.registerConditionForFieldType('hasNoValue', 'gallery_advanced');
	acf.registerConditionForFieldType('selectionLessThan', 'gallery_advanced');
	acf.registerConditionForFieldType('selectionGreaterThan', 'gallery_advanced');
	
})(jQuery);
	</script>
	<?php
	
}

?>