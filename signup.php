<?php
	// Lets take the data posted to this page, and enter it in the database
	
	// Setup connection to DB
	
	$db_hostname = "";
	$db_username = "";
	$db_password = "";
	$db_schema = "";
	
	$connection = mysql_connect($db_hostname, $db_username, $db_password);
	
	if(!$connection){
		echo 'Error connecting to the database!';
		die();
	}
	
	// Assuming everything has gone well at this point! Let's
	// store the registration details in a session
	session_start();
	
	
	if(isset ($_POST['f_name'])){
	$f_name = $_POST['f_name'];
	
	
	$_SESSION['f_name'] = $POST_['f_name']; // Initializing Session
	}
?>


<html>
	<head><title>Enter your Registration details</title></head>
	
	<body>
		<h1>Hi! Please enter your details to register</h1>
		
		
		<form action="home.php" method="post">
			Mobile Number <input type="text" name="mobile_no">
			<br>
			<br>
			
			First Name <input type="text" name="f_name">
			<br>
			<br>
			Last Name <input type="text" name="l_name">
			<br>
			<br>
			
			Password <input type="password" name="password">
			<br>
			<br>
			Password check <input type="password" name="chk_password">
			<br>
			<br>
			<input type="submit" name = "register" value="Register!">
		</form>

	</body>
</html>
