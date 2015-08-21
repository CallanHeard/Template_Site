<?php
/*
** Header File for Top of Webpages
*/
?>
<!DOCTYPE html>
<html lang="<?=$GLOBALS['config']['language']?>">
	<head>
		<meta charset="<?=$GLOBALS['config']['charset']?>" />
		<title><?=$title?></title>
		<?=get('styles')?>
		<?=get('scripts')?>
	</head>
	<body>