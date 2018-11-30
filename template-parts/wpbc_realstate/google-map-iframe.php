<?php

$args = !empty($_GET['args']) ? $_GET['args'] : $args; 
$args = wp_parse_args( $args, array() ); 
$src = $args['src'];  
if(!empty($src)){
?>
<iframe class="" src="<?php echo $src; ?>" width="800" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
<?php } ?>