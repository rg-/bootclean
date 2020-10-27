<?php
$api_key = tokko_config('api_key'); 
$auth = new TokkoAuth($api_key); 
if(isset($_GET['q']) && !empty($auth)){

	$lang = !empty($auth->get_language()) ? $auth->get_language() : 'es_ar';

	$q = urlencode($_GET['q']);
	$r = json_decode(file_get_contents('http://tokkobroker.com/api/v1/location/quicksearch/?lang='.$lang.'&format=json&q='.$q));
	if(!empty($r->objects)){
		echo "<ul>";
		foreach ($r->objects as $key => $value) {
			?>
			<li style="list-style: none; border-bottom:1px solid #bbb; padding-bottom:8px;">
				<b><?php echo $value->id; ?></b> : <?php echo $value->name; ?><br>
				[<?php echo $value->type; ?>] <?php echo $value->full_location; ?>
			</li>
			<?php
		}
		echo "</ul>";
	} 
}
