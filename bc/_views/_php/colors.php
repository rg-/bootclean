<h1>Contextual Variations</h1>

<h2>Background colors bg-*</h2>
<div class="example-block">
	<?php
	if(isset($theme_root['scheme'])){ 
		$partials = $theme_root['scheme'];
		foreach($partials as $p){
			?>
			<div style="text-transform:capitalize; " class="p-2 my-2 bg-<?php echo $p; ?>"><?php echo $p; ?></div>
			<?php
		}
	}
	?>
</div>
<h2>Text colors text-*</h2>
<div class="example-block">
	<?php
	if(isset($theme_root['scheme'])){ 
		$partials = $theme_root['scheme'];
		foreach($partials as $p){
			?>
			<div style="text-transform:capitalize; " class="p-2 my-2 text-<?php echo $p; ?>"><?php echo $p; ?></div>
			<?php
		}
	}
	?>
</div>
<h2>Border/text colors border-color-*</h2>
<div class="example-block">
	<?php
	if(isset($theme_root['scheme'])){ 
		$partials = $theme_root['scheme'];
		foreach($partials as $p){
			?>
			<div style="text-transform:capitalize; border:1px solid;" class="p-2 my-2 border-color-<?php echo $p; ?> text-<?php echo $p; ?>"><?php echo $p; ?></div>
			<?php
		}
	}
	?>
</div>