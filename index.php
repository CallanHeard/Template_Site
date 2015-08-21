<?php
/*
** Index Page for Combining Site
*/

//Function for Finding Any File Within Site
function find($request) {
	
	//Get all files within current directory
	$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__DIR__));

	//Loop through files found
	foreach($files as $name){
		
		//If end of file path matches the requested file
		if (substr($name, -(strlen($request))) == $request) {
			return $name; //Return the file path
		}
		
	}

}

$title = 'Index'; //Set title of page
require find('system.php'); //Retrieve system code
require $GLOBALS['config']['directory'].'/'.$GLOBALS['config']['system'].'/'.$GLOBALS['config']['header']; //Retrieve page header
?>

		<!-- Website Goes Here -->
<?php
require $GLOBALS['config']['directory'].'/'.$GLOBALS['config']['system'].'/'.$GLOBALS['config']['footer']; //Retrieve page footer
?>