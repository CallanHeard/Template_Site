<?php
/*
** Functions File for System Functions
*/

//Function for Preparing Global Array of Error Messages
function loadErrors() {		
	
	global $error; //Reference global error messages array
	
	$error[0]	= 'Failed to load config file'; //Error message for being unable to load config file
	
}

//Function for Loading Contents of Config Settings into System
function loadConfig() {
	
	$file = fopen('../config', "r"); //Attempt to open config file
	
	//If file opened correctly
	if ($file) {
		
		$commentFlag = false; //Flag for signalling reading of comments
		
		//Read each line of file
		while (($line = fgets($file)) !== false) {
	
			//Ignore Newlines
			if ($line !== "\r\n") {
		
				//If this line is not commented
				if (!beginningOfComment($line) && $commentFlag == false ) {
					$GLOBALS['config'][getMapping('key', $line)] = getMapping('value', $line); //Add config setting to global array
				}
				//Else handle comments
				else {
					
					//If this line ends the comment
					if (endOfComment($line)) {
						$commentFlag = false; //Reset comment flag
					}
					//Else comment does not end here
					else {
						$commentFlag = true; //So continue flag
					}
					
				}

			}
				
		}

		fclose($file); //Close file opened for reading
		
	}
	//Else error opening file
	else {
		echo $GLOBALS['error'][0]; //So echo appropriate error message
	}
	
	//Assign base directory value
	$GLOBALS['config']['directory'] = $_SERVER['DOCUMENT_ROOT'].'/'.$GLOBALS['config']['source'].'/'.$GLOBALS['config']['subfolders'];
	
}

//Function for Checking for a Comment at the Start of a Config File Line
function beginningOfComment($line) {
	
	//If the line begins with the comment operator
	if (substr($line, 0, 2) == '/*') {
		return true; //Return this line is a comment
	}
	//Else line does not begin comment
	else {
		return false; //So return false
	}
	
}

//Function for Separating a Config File Line into Mapping Identifiers
function getMapping($type, $line) {

	$parts = explode('=', $line); //Separate parts of the setting string
	
	//Return correct value based on type of mapping identifier required
	switch ($type) {
		case 'key'		: return trim($parts[0]); //Return mapping key
		case 'value'	: return trim($parts[1]); //Return mapping value
	}
	
}

//Function for Checking for the End of a Comment in a Config File Line
function endOfComment($line) {
	
	//If the line ends with the comment operator
	if (substr($line, strlen($line)-4, 2) == '*/') {
		return true; //Return this line ends the comment
	}
	//Else line does not end comment
	else {
		return false; //So return false
	}
	
}

//Read-Only Variable for Style Sheet Markup
function get($request) {
	
	$directory	= $GLOBALS['config']['directory'].'/'.$GLOBALS['config'][$request];
	$content	= '';
	
	foreach(scandir($directory) as $value) {
		
		if ($value !== '.' && $value !== '..') {
			
			$url = $directory."/".$value;
			
			if ($request == 'styles')	$content .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"".$url."\" />\n";
			if ($request == 'scripts')	$content .= "<script src=\"".$url."\"></script>\n";
			
		}
		
	}
	
	return $content;
	
}
?>