<?php
ob_start(); 
// Put here some html
?>
<div class="bg-primary text-white h-100">
	<div class="container h-100">
		<div class="jumbotron bg-transparent text-center mb-0 h-100" >
			<h1 class="display-4" data-animated="init" data-animated-on="fadeInUp" data-animated-off="fadeOut" data-animation-duration=".3s">BS 4 Basic template</h1>
			<p class="lead" data-animated="init" data-animated-on="fadeInUp" data-animated-off="fadeOut" data-animation-duration=".3s" data-animation-delay=".3s">Bootstrap 4 - Demo the all elements for theme designer.</p>
		</div>
	</div>
</div>
<?php
// ... some html into variable:
$content = ob_get_contents();
ob_end_clean();
// Clean, yours!
?>

<?php
ob_start(); 
// Put here some html
?>
<div class="bg-secondary text-white h-100">
	<div class="container h-100">
		<div class="jumbotron bg-transparent text-center mb-0 h-100">
			<h1 class="display-4 animated" data-animated-on="fadeInUp" data-animated-off="fadeOut" data-animation-duration=".3s">BS 4 Basic template</h1>
			<p class="lead" data-animated="init" data-animated-on="bounceInUp" data-animated-off="fadeOut" data-animation-duration=".3s" data-animation-delay=".3s">Bootstrap 4 - Demo the all elements for theme designer.</p>
		</div>
	</div>
</div>
<?php
// ... some html into variable:
$content_2 = ob_get_contents();
ob_end_clean();
// Clean, yours!
?>

<?php    
BC_get_component('slick', array( 
	'container_class'=>'gmb-1',
	'container_item_class'=>'',  
	'slick'=>'{ "dots":true, "arrows":false, "vertical":true, "verticalSwiping":true, "infinite": true }',
	'items'=> array(
		array('content'=>$content),
		array('content'=>$content_2)
	)
));
?>