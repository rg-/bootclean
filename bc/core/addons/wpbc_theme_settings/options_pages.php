<?php
	
include('options_pages/wpbc-theme-settings.php');

$enable_design = apply_filters('wpbc/filter/theme_settings/enable/design','__return_false');
if($enable_design===true) {
	include('options_pages/wpbc-theme-design.php');
} 