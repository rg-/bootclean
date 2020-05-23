<script id="WPBC-parallax-footer-script" type="text/javascript">
	+function ($) { 

		var parallaxMe = $('[data-parallaxjs]');
		if(parallaxMe.length>0){ 
			parallaxMe.attr('id','wpbc-parallaxjs-me');
			var scene = document.getElementById('wpbc-parallaxjs-me');
			var parallaxInstance = new Parallax(parallaxMe.get(0));	
		} 

	}(jQuery);
</script>