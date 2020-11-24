<?php

	$property = $args;  

?>
<div class="ui-property-content-row ui-features-row">

	<div class="ui-tokko-property-features gmt-2"> 

		<?php WPBC_tokko_property_features(array(
			'property' => $property
		), 'property-single'); ?>

	</div>

</div>

<div id="cloned-prices" class="ui-property-content-row ui-prices-row">
</div>