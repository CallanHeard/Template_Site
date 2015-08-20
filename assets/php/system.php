<?php
/*
** Main System File for Site Functionality
*/

require 'functions.php'; //Retrieve system functions

//Global Site Variables
$error	= array(); //Global array for storing error messages
$config	= array(); //Global array for storing config settings

loadErrors(); //Prepare global errors array for use
loadConfig(); //Read contents of config settings into system
?>