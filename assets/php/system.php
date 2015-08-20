<?php
/*
** Main System File for Site Functionality
*/

//Global Site Variables
$error	= array(); //Global array for storing error messages
$config	= array(); //Global array for storing config settings

loadErrors(); //Prepare global errors array for use
loadConfig(); //Read contents of config settings into system

//Function for Preparing Global Array of Error Messages
function loadErrors() {		
	
	global $error; //Reference global error messages array
	
	$error[0]	= 'Failed to load config file';
	
}

//Function for Loading Contents of Config Settings into System
function loadConfig() {
	
	global $config; //Reference global config array
	
	$file = fopen('../config', "r"); //Attempt to open config file
	
	//If file opened correctly
	if ($file) {
		
		//Read each line of file
		while (($line = fgets($file)) !== false) {
			
			//If this line is not a comment
			if (!comment($line)) {
				echo 'no comment';
			}
			//Else handle comment line
			else {
				echo 'comment';
			}
			
		}

		fclose($file);
		
	}
	//Else error opening file
	else {
		echo $GLOBALS['error'][0]; //Echo appropriate error message
	}
	
}

//Function for Checking for a Comment at the Start of a Config File Line
function comment($line) {
	
	//If the line begins with the comment operator
	if (substr($line, 0, 2) == '/*') {
		return true; //Return this line is a comment
	}
	else {
		return false; //Else return this line is not a comment
	}
	
}

?>