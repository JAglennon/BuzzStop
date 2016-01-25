<?php
session_start(); // Starting Session

	$db_hostname = "";
	$db_username = "";
	$db_password = "";
	$db_schema = "";

	// Get the information that is posted to this page from login
	if(isset($_SESSION['addlat'])){
	$addlat = $_SESSION['addlat'];}
	else{
	$addlat = $_GET['addlat'];
	$_SESSION['addlat'] = $addlat;}

	if(isset($_SESSION['addlong'])){
	$addlong = $_SESSION['addlong'];}
	else{
	$addlong = $_GET['addlong'];
	$_SESSION['addlong'] = $addlong;}

	// Get the information that is posted to this page from sign-up
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
}
	if($_POST['submit']){
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
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Travel modes in directions</title>
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 10px
        
      }
      #panel {
        position: absolute;
        left: 50%;
        margin-left: -180px;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
      }
    </style>
    <IMG STYLE="left: 50% WIDTH:200px; HEIGHT:200px" SRC="BuzzStop.png">
    <script src="https://maps.googleapis.com/maps/api/js?key="></script>
    <script src="https://maps.googleapis.com/maps/api/distancematrix/json?&key="></script>"
    <script>
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
var map;
var Current = new google.maps.LatLng(<?php echo $_SESSION['addlat']; ?>, <?php echo $_SESSION['addlong']; ?>);
var Destination = new google.maps.LatLng(53.2010, -6.1114);

function initialize() {
  directionsDisplay = new google.maps.DirectionsRenderer();
  var mapOptions = {
    zoom: 16,
    center: Current
  }
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
  var marker = new google.maps.Marker({position:Current,map:map,title:"You are here!"});
  directionsDisplay.setMap(map);
}

function calcRoute() {
  var selectedMode = document.getElementById('mode').value;
  var request = {
      origin: Current,
      destination: Destination,
      // Note that Javascript allows us to access the constant
      // using square brackets and a string value as its
      // "property."
      travelMode: google.maps.TravelMode[selectedMode]
  };
  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
    }
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
  </head>
  <body>
    <div id="panel">
    <b>Mode of Travel: </b>
    <select id="mode" onchange="calcRoute();">
      <option value="TRANSIT">Transit</option>
    </select>
    </div>
    <div id="map-canvas"></div>
  </body>
</html>
