#!/usr/bin/php
<?php

define('CRON_CI_INDEX', '/var/local/vivagrams/index.php');   // Your CodeIgniter main index.php file
define('CRON', TRUE);   // Test for this in your controllers if you only want them accessible via cron

if(!defined('CRON_LOG')) define('CRON_LOG', 'cron.log');
if(!defined('CRON_TIME_LIMIT')) define('CRON_TIME_LIMIT', 15*60);

$path = "/cronx/gram";

$_SERVER['PATH_INFO'] = $path;
$_SERVER['REQUEST_URI'] = $path;
$_SERVER['QUERY_STRING'] = $path;

# Set run time limit
set_time_limit(CRON_TIME_LIMIT);

# Run CI and capture the output
ob_start();

chdir(dirname(CRON_CI_INDEX));
require(CRON_CI_INDEX);           // Main CI index.php file
$output = ob_get_contents();

if(defined('CRON_FLUSH_BUFFERS')) {
    while(@ob_end_flush());        // display buffer contents
} else {
    ob_end_clean();
}


echo "\n\n";

?>