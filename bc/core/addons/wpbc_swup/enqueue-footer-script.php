<script id="WPBC-swup-footer-script" type="text/javascript"> 
	
	<?php 
	$animationSelector = apply_filters('wpbc/filter/swup/animationSelector', '[class*="swup-transition-"]' ); 
	$containers = apply_filters('wpbc/filter/swup/containers', '#main-container-areas, #simulate-body-tags' ); 
	$plugins = apply_filters('wpbc/filter/swup/plugins', 'SwupFadeTheme' ); 
	$SwupGaPlugin = apply_filters('wpbc/filter/swup/SwupGaPlugin',0);
	$plugins_mainElement = apply_filters('wpbc/filter/swup/plugins/mainElement', '#main-container-areas' ); 
	?>
	var test = <?php echo $plugins; ?>;

	var $swup_defaults = {

	      // when this option is enabled, swup disables browser native scroll control (sets scrollRestoration to manual) and takes over this task. 
	      // This means that position of scroll on previous page(s) is not preserved (but can be implemented manually based on use case). 
	      // Otherwise swup scrolls to top/#element on popstate as it does with normal browsing.
	      /*
	      animateHistoryBrowsing: false,
				*/

	      // animation selector
	      animationSelector: '<?php echo $animationSelector; ?>',

	      // defines link elements that will trigger the transition
	      linkSelector: 'a[href^="' + window.location.origin + '"]:not([data-no-swup]), a[href^="/"]:not([data-no-swup]), a[href^="#"]:not([data-no-swup])',

	      // default container(s)
	      containers: ['<?php echo $containers; ?>'], // #swup

	      // stores previously loaded contents of the pages in memory
	      /*
	      cache: true, 
				*/

	      // request headers
	      /*
	      requestHeaders: {
	        'X-Requested-With': 'swup',
	        Accept: 'text/html, application/xhtml+xml'
	      },
	      */

	      // enable/disable plugins
	      // see below
	      /*
	      plugins: [new SwupOverlayTheme({
	      		color: '#222',
						duration: 600,
						direction: 'to-top',})
	      ],
				*/

				/*
				plugins: [
					new SwupSlideTheme({
						mainElement: '#main-content',
						reversed: false
					})
	      ],
				*/
				/* 
				plugins: [new SwupFadeTheme({
							mainElement: '#main-content-wrap', 
						}
					)
	      ],
				*/ 

	      // skips popState handling when using other tools manipulating the browser history
	      /*
	      skipPopStateHandling: function skipPopStateHandling(event) {
	        return !(event.state && event.state.source === 'swup');
	      }
	      */

	}; 

	/* PLUGINS

	plugins: [
      new SwupHeadPlugin(),
      new SwupBodyClassPlugin()
  ],

	*/
	<?php
	if(!empty($plugins)){
		if($plugins=='SwupFadeTheme'){
		?>
			$swup_defaults.plugins = [
				new SwupFadeTheme({
						mainElement: '<?php echo $plugins_mainElement; ?>', 
				}),
				<?php if($SwupGaPlugin){ ?>
					new SwupGaPlugin()
				<?php } ?>
		  ];
		<?php	
		}
		if($plugins=='SwupSlideTheme'){
		?>
			$swup_defaults.plugins = [
					new SwupSlideTheme({
						mainElement: '<?php echo $plugins_mainElement; ?>', 
						reversed: false
					}),
					<?php if($SwupGaPlugin){ ?>
					new SwupGaPlugin()
				<?php } ?>
	      ];
		<?php	
		}
		if($plugins=='SwupOverlayTheme'){
			$args = array(
				'color' => '#222',
				'duration' => 600,
				'direction' => 'to-left'
			);
			$args = apply_filters('wpbc/filter/swup/plugins/SwupOverlayTheme/args', $args );
			$args = json_encode($args);
		?>
			$swup_defaults.plugins = [
				new SwupOverlayTheme(<?php echo $args;?>),
				<?php if($SwupGaPlugin){ ?>
					new SwupGaPlugin()
				<?php } ?>
				];
		<?php	
		} 

	}
	?>
	/* PLUGINS END */

	/* INIT */
	const swup = new Swup($swup_defaults); 

	/* EVENTS */

	/* triggers when link is clicked */
	swup.on('clickLink', function() {
		$('body.side-menu-visible #side-menu .navbar-toggler').trigger('click'); 
		$('*:focus').blur();
		$('body').trigger('wpbc.swup.clickLink');
	});

	/* triggers right after the content of page is replaced */
	swup.on('contentReplaced', function() {
		_swupReplaceBodyAttrs(); 
		$('body').trigger('wpbc.swup.contentReplaced');
		<?php do_action('wpbc/action/swup/contentReplaced'); ?>
		/*
	  swup.options.containers.forEach((selector) => {
	    // load scripts for all elements with 'selector'
	  });
	  */
	});

	/* similar to contentReplaced, except it is once triggered on load */
	swup.on('pageView', function() {
		$('body').removeClass('loading');
		$('body').addClass('inited'); 
		$('body').trigger('wpbc.swup.pageView');
	  <?php do_action('wpbc/action/swup/pageView'); ?>
	});

	swup.on('willReplaceContent', function() { 
		$('body').trigger('wpbc.swup.willReplaceContent');
	  <?php do_action('wpbc/action/swup/willReplaceContent'); ?>
	});
	swup.on('animationInDone', function() { 
		$('body').trigger('wpbc.swup.animationInDone');
	  <?php do_action('wpbc/action/swup/animationInDone'); ?>
	});

	swup.on('transitionEnd', function() { 
		$('body').trigger('wpbc.swup.transitionEnd');
	  <?php do_action('wpbc/action/swup/transitionEnd'); ?>
	});

	function _swupReplaceBodyAttrs(){
		/* 
		Get data from #simulate-body-tags and pass to body... :)
		This html element should be present on page and ready as "container" on swup settings. 
		*/  
  	var new_body_tags = $('#simulate-body-tags');  
		// Repalce body class
		$('body').attr('class', new_body_tags.attr('class'));  
		// Replace data-config
		if( new_body_tags.attr('data-config') ){
			$('body').attr('data-config', new_body_tags.attr('data-config'));
		}  
		// remove body attrs 
		$.each( $('body')[0].attributes, function ( index, attribute ) { 
      if (typeof attribute !== typeof undefined && attribute !== false) {
      	if( attribute.name == 'class' || attribute.name =='data-config' && attribute.name ) return;
      	if( !new_body_tags.is('['+attribute.name+']') ){ 
					$('body').removeAttr(attribute.name);
				}
      } 
		});
		// Replace rest attrs, but not class, id, style and data-config
		$.each( new_body_tags[0].attributes, function ( index, attribute ) {
			if( attribute.name == 'class' || attribute.name =='id' || attribute.name =='style'  || attribute.name =='data-config' ) return;  
	      $('body').attr( attribute.name, attribute.value ); 
	  });
	}

	/* EVENTS END */

</script>