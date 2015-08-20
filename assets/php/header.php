<?php
/*
** Header File for Top of Webpages
*/

require 'system.php'; //Include initial site functionality
?>
<!DOCTYPE html>
<html lang="en-GB">
	<head>
		<meta charset="utf-8" />
		<title><?=$title?></title>
		<?=get('styles')?>
		<?=get('scripts')?>
	</head>
	<body>