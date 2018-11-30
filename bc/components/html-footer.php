<?php if( !empty( $theme_root['main-footer']['enabled'] )) {
	
	BC_template('main-footer', array(
		'id'=>'main-footer'
	)); 
	
} ?>
			</div><!-- #main-content-wrap END -->
		</div><!-- #main-content END -->
		
		<?php BC_get_partial('main-modal'); ?>
		
		<?php BC_get_partial('go-up'); ?>
		
		<?php BC_get_footer_scripts(); ?>
		
	</body>
</html>