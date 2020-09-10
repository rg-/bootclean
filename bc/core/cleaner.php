<?php

// see https://github.com/roots/soil
// see https://github.com/taniarascia/wp-functions
// see https://github.com/vincentorback/clean-wordpress-admin

$WPBC_is_acf = WPBC_is_acf(); 

/**/

require 'cleaner/login.php'; // jobsolete from v 11
require 'cleaner/dashboard.php';
require 'cleaner/admin-bar.php'; 
require 'cleaner/admin-footer.php'; 
require 'cleaner/head.php'; 
require 'cleaner/emojis.php'; 
require 'cleaner/javascript.php'; 
require 'cleaner/updates.php';
require 'cleaner/theme_support.php'; 
require 'cleaner/comments.php';
require 'cleaner/tiny_mce.php'; 

