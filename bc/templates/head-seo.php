<?php if (isset($theme_root['html-seo'])){ ?>
<?php if(isset($theme_root['head-tag-title'])) {
	$sep = isset($theme_root['head-tag-title-separation']) ? $theme_root['head-tag-title-separation'] : ' - ';
	?>
	<title><?php echo isset($theme_root['page-title']) ? $theme_root['page-title'].$sep : ''; ?><?php echo isset($theme_root['site-title']) ? $theme_root['site-title'] : ''; ?></title>
<?php } ?>
<?php if(isset($theme_root['head-tag-description'])) { ?>
	<meta name="description" content="<?php echo isset($theme_root['page-description']) ? $theme_root['page-description'] : ''; ?>">
<?php } ?>
<?php } ?>