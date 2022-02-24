<?php

// admin_scripts.php
add_action('admin_head',function(){
	?>
<style id="wpbc_tokko_admin_styles" type="text/css">

	.result.wpbc_loading:after{
			content:"";
			display: flex;
			align-items: center;
			justify-content: center;
			min-height: 200px;
			display: block;
			width: 100%;
			position: relative;
			background-color:transparent;
			background-repeat: no-repeat;
			background-position: center center;
			background-size:48px 48px;
			background-image: url("data:image/svg+xml;charset=utf8,%3C!-- By Sam Herbert (@sherb), for everyone. More @ http://goo.gl/7AJzbL --%3E%3Csvg width='38' height='38' viewBox='0 0 38 38' xmlns='http://www.w3.org/2000/svg'%3E%3Cdefs%3E%3ClinearGradient x1='8.042%25' y1='0%25' x2='65.682%25' y2='23.865%25' id='a'%3E%3Cstop stop-color='%23000000' stop-opacity='0' offset='0%25'/%3E%3Cstop stop-color='%23000000' stop-opacity='.631' offset='63.146%25'/%3E%3Cstop stop-color='%23000000' offset='100%25'/%3E%3C/linearGradient%3E%3C/defs%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg transform='translate(1 1)'%3E%3Cpath d='M36 18c0-9.94-8.06-18-18-18' id='Oval-2' stroke='url(%23a)' stroke-width='2'%3E%3CanimateTransform attributeName='transform' type='rotate' from='0 18 18' to='360 18 18' dur='0.9s' repeatCount='indefinite' /%3E%3C/path%3E%3Ccircle fill='%23000000' cx='36' cy='18' r='1'%3E%3CanimateTransform attributeName='transform' type='rotate' from='0 18 18' to='360 18 18' dur='0.9s' repeatCount='indefinite' /%3E%3C/circle%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
		}
	.tokko_submit_form_btn{
		cursor: pointer;
	}
	.tokko_get_location_types .tokko_flex_form{
		display: flex;
    align-items: center;
	}
	.tokko_get_location_types .tokko_flex_form input {
		margin-right: 10px;
	}
	.tokko_sortable_item{
		padding: 0;  
	}
	.tokko_sortable_item label{
		padding: 10px 80px 10px 10px; 
		display: block;
		border:#ccd0d4 solid 1px;
		position: relative;
	} 
	.tokko_add_sortable_item{
		display: flex;
		font-size: 15px;
		background-color:var(--success);
		color:#fff; 
		height: 16px;
		border-radius: 8px;
		padding: 0;
    border: 0;
    cursor: pointer;
	}	
		.tokko_add_sortable_item .dashicons {
				font-size: 11px;
				width: 16px;
				height: 16px;
				line-height: 18px;
		}
	.tokko_sortable_item_delete{
		opacity: 0;
		display: flex;
		font-size: 15px;
		background-color:var(--danger);
		color:#fff;
		width: 16px;
		height: 16px;
		border-radius: 8px;
		position: absolute;
		top: 50%;
		transform: translate(0,-50%);
		right: 10px;
		text-align: center;
		padding: 0;
		border: 0;
		cursor: pointer;
	} 
	.tokko_sortable_item_delete .dashicons{
		font-size: 15px;
		width: 16px;
		height: 16px;
	}

	.tokko_sortable_list .placeholder {
    width: 100%;
    height: 20px;
    background: rgba(0, 0, 0, 0.2);
  }
	.tokko_sortable_item .tokko_sortable_list{ 
		padding: 5px 0 5px 20px;   
	}
	.tokko_sortable_item .tokko_sortable_list .tokko_sortable_item	{ 
		padding: 5px 0;
	}
	.tokko_sortable_item .tokko_sortable_list .tokko_sortable_item label{
		 
	}
	.tokko_sortable_item .tokko_sortable_list .tokko_sortable_list{
		display: none;
	}
	.tokko_sortable_item small{
		position: absolute;
		top: 0;
		padding: 6px;
		right: 0;
		font-size: 10px;
		color: var(--danger);
	}
	.tokko_sortable_item:hover {
		
	}
	.tokko_sortable_item label:hover{
		background: rgba(0, 0, 0, 0.1);
		border-color: #8c8f94;
		cursor: move; 
	}
	.tokko_sortable_item label:hover .tokko_sortable_item_delete{
		opacity: 1;
	} 
	.tokko_sortable_item:last-child{
		margin-bottom: 0;
	}

</style>
	<?php
},9999);

add_action('admin_footer',function(){
	?>
<script id="wpbc_tokko_admin_scripts" type="text/javascript"> 

	+function($){  

		function WBPC_make_tokko_sortable_list(target_key){
			var textarea = $('.acf-field[data-key="'+ target_key +'"] textarea');
			var $tokko_sortable_list = '';
			var tokko_sortable_list = $('.acf-field[data-key="'+ target_key +'"] .tokko_sortable_list');
			
			var lines = textarea.val().split(/\n/);
  		var texts = []
  		for (var i=0; i < lines.length; i++) {
  		  if (/\S/.test(lines[i])) {
  		    texts.push($.trim(lines[i]));
  		  }
  		}
  		var list = JSON.stringify(texts);
  		var li = '';

  		var temp = [];

  		for(var e=0; e<texts.length; e++){
  			if( !texts[e].startsWith("#") ){
	  			var split = texts[e].split(":");
	  			var key = split[0].replace(" ", "");
	  			var value = split[1];
	  			value = (value[0] == ' ') ? value.substr(1) : value; 
	  			var sub_items = [];
	  			item = [key, value, sub_items];
	  			temp.push(item);
	  		}
  		}
  		for(var e=0; e<texts.length; e++){
  			if( texts[e].startsWith("#") ){
  				var split = texts[e].split(":");
	  			var parent_key = split[0].replace(" ", "");
	  			parent_key = parent_key.replace("#", "");
	  			var key = split[1].replace(" ", "");
	  			var value = split[2];
	  			value = (value[0] == ' ') ? value.substr(1) : value;  

	  			for(var ee=0; ee<temp.length; ee++){
	  				if( temp[ee][0] == parent_key ){
	  					temp[ee][2].push([key.replace(" ", ""), value]); 
	  				} 
	  			}
  			}
  		}

  		
  		var list = '';

  		for(var e=0; e<temp.length; e++){ 
  			var key = temp[e][0];
  			var value = temp[e][1];
  			var sub_locations = temp[e][2];

  			var label = key+' : '+value;
  			var sub_values = '';
  			if(sub_locations){
  				for(var se=0; se<sub_locations.length; se++){
  					var skey = sub_locations[se][0];
  					var svalue = sub_locations[se][1];
  					var slabel = key+' : '+skey+' : '+svalue;

  					var btn_delete = '<button data-value="#'+key+' : '+skey+' : '+svalue+'" class="tokko_sortable_item_delete"><span class="dashicons dashicons-no-alt"></span></button>';

  					sub_values += '<div class="tokko_sortable_item" data-value="#'+key+' : '+skey+' : '+svalue+'"><label><small>'+skey+'</small>'+svalue + btn_delete + '</label><div class="tokko_sortable_list"></div></div>'; 
  				}
  			}

  			var btn_delete = '<button type="button" data-value="'+ key+' : '+value+'" class="tokko_sortable_item_delete"><span class="dashicons dashicons-no-alt"></span></button>';

  			list += '<div class="tokko_sortable_item" data-value="'+ key+' : '+value+'"><label><small>'+ key+'</small>'+value+btn_delete+'</label><div class="tokko_sortable_list">'+sub_values+'</div></div>';
  		} 

  		tokko_sortable_list.html(list);

  		tokko_sortable_list.find('.tokko_sortable_item_delete').on('click', function(){ 
				var target = $(this).parent().parent();
				target.remove();
				var textarea_new_val = '';
				tokko_sortable_list.find('.tokko_sortable_item').each(function(i, el){ 
					textarea_new_val += $(el).attr('data-value')+"\r\n";  
				});
				textarea.val(textarea_new_val);
				textarea.trigger('change');
				return false; 
			});

  		$('.acf-field[data-key="'+ target_key +'"] .tokko_sortable_list').sortable({
  			opacity: 0.6,
		    connectWith: '.tokko_sortable_list',
		    //items: '.tokko_sortable_item',
		    //forceHelperSize: true,
				//forcePlaceholderSize: true,
				//placeholder: 'placeholder',
				//scroll: true,
				//cursor: 'move',
				//axis: 'y',
				start: function (event, ui) {
					//ui.placeholder.html( ui.item.html() );
					//ui.placeholder.removeAttr('style');
					//ui.item.css( 'background-color', '#f6f6f6' );
	   		},
	   		stop: function( event, ui ) {
					ui.item.removeAttr( 'style' ); 
					var textarea_new_val = '';
					tokko_sortable_list.find('.tokko_sortable_item').each(function(i, el){ 
						textarea_new_val += $(el).attr('data-value')+"\r\n";  
					});
					textarea.val(textarea_new_val);
					textarea.trigger('change');
				},
		    update: function(event, ui) {

		    },
		  }).disableSelection();

		  /*
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
		  */

		} 

		var tokko_sortable = $('[data-sortable-target-key]');

		if(tokko_sortable.length>0){
			tokko_sortable.each(function(){

				var me = $(this);
				var target_key = me.attr('data-sortable-target-key');
				var textarea = $('.acf-field[data-key="'+ target_key +'"] textarea');
				var input = $('.acf-field[data-key="'+ target_key +'"] .acf-input');
				input.prepend('<div class="tokko_sortable_list"></div>');

				textarea.css('display','none');
				
				WBPC_make_tokko_sortable_list(target_key);

			});

		} 
		
		var tokko_get_location_types = $('.tokko_get_location_types');
		if(tokko_get_location_types.length>0){

			tokko_get_location_types.each(function(){
				var me = $(this);
				
				me.find('.tokko_submit_form_btn').on('click',function(){
					me.find('.result').addClass('wpbc_loading');
					var q = me.find('.q').val();
					var url = '<?php echo admin_url( 'admin-ajax.php' ) .'?action=get_template&name=wpbc_tokko/ajax/get_locations&q='; ?>' + q;
					if( q != '' ){
							$.ajax({ type: "GET",   
					     url: url,   
					     success : function(text)
					     { 
					     	me.find('.result').removeClass('wpbc_loading');
					     	me.find('.result').html(text);
					     	var target_key = me.find('.result[data-sortable-target-key]'); 
					     
					     	var btn = me.find('.result .tokko_add_sortable_item');
					     	btn.each(function(){
					     		$(this).on('click',function(){
					     			var id = $(this).attr('data-id');
					     			var name = $(this).attr('data-name');
					     			var target = target_key.attr('data-sortable-target-key'); 

					     			var textarea = $('.acf-field[data-key="'+ target +'"] textarea');

										var $textarea_current = textarea.val();
										var $new_line = "\r\n"; 
										var $textarea_result = $textarea_current+$new_line+id+" : "+name;

										textarea.val($textarea_result); 

										WBPC_make_tokko_sortable_list(target);

					     		});
					     	});
					     }
					});
					} 

					return false;
				});

			}); 

		} 

	}(jQuery); 
</script>
	<?php
},9999); 