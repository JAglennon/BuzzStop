<?php

$db_hostname = "";
	$db_username = "";
	$db_password = "";
	$db_schema = "";

	session_start();
	// Get the information that is posted to this page
	if(isset($_SESSION['mobile_no'])){
	$mobile = $_SESSION['mobile_no'];}
	else{
	$mobile = $_POST['mobile_no'];
	$_SESSION['mobile_no'] = $mobile;}
	
	if(isset($_SESSION['f_name'])){
	$f_name = $_SESSION['f_name'];}
	else{
	$f_name = $_POST['f_name'];
	$_SESSION['f_name'] = $f_name;} // Store First Name for later
	
	if(isset($_SESSION['l_name'])){
	$l_name = $_SESSION['l_name'];}
	else{
	$l_name = $_POST['l_name'];
	$_SESSION['l_name'] = $l_name;} // Store Last Name for later
	
	if(isset($_SESSION['password'])){
	$password = $_SESSION['password'];}
	else{
	$password = $_POST['password'];
	$_SESSION['password'] = $password;} // Store password for later
		
// Establish a link to the database
	$connection = mysql_connect($db_hostname, $db_username, $db_password);
	
	if(!$connection){
		echo 'Error connecting!';
		die();
	}
	
	// Else, assume it works
	
	// Select a schema to work with!
	$db = mysql_select_db($db_schema, $connection);
	
	// 1. Check to see if this page is being requested from login.php, or, from signup.php
	
	$existingUser = "";
	$newUser = "";
	
	if($_POST['submit']){
	// Then being called from login.php
	// meaning this is an EXISTING user!
	
	//Get the Users first name.
	$sql = "SELECT * FROM User WHERE mobile_no = '" . $_SESSION['mobile_no']."' AND password ='" . $_SESSION['password'] . "';";		
	$result = mysql_query($sql);
	while($row = mysql_fetch_array($result)){
		// store first name for later 
		$f_name = $row['f_name'];
	}  
	
	$check = "SELECT * FROM User WHERE mobile_no = '". $_SESSION['mobile_no']."' AND password ='" . $_SESSION['password'] . "';";	
	$result = mysql_query($check);	
	if($result){
	
		echo "<h1>Welcome " . $f_name . "!</h1>"; 
	}
	else{
	echo  "You are not registered Please complete the "?><html><a href="signup.php">sign up form!</a></html><?php ;
	}
}	
	
	
	if($_POST['register']){
	// Then being called from signup.php 
	// meaning this is an NEW user!
	
	// construct the SQL to insert the data posted to this page
	// into the database
	$sql = "INSERT INTO User VALUES ('" . $_POST['mobile_no'] . "', '" . $_POST['f_name'] . "', '" . $_POST['l_name'] . "', '" . $_POST['password'] . "', '" . $_POST['chk_password'] . "')";
	$results = mysql_query($sql);
	
	// CHeck to see if query ran succcessfull!
	if(!$results){
		echo 'Problem registering user in database!';
		die();
	}
	
	echo	"<h1>Welcome " . $_POST['f_name'] . "!</h1>";
	
	$newUser = $_POST['f_name'];
	}

	//TEAM ACCOUNT SERVER NB INFO: buzzardz   password foluva12


//WEEK 1										WEEK 2
// The home page needs sessions					// add CHECK MY STOP button(current_loc update)
//input for destination							// functionality from CMS button
//retrieve current location						// 
// output map with route
// output ETA
