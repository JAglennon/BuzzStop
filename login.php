<?php
session_start(); // Starting Session


	$db_hostname = "";
	$db_username = "";
	$db_password = "";
	$db_schema = "";

// Establish a link to the database
	$connection = mysql_connect($db_hostname, $db_username, $db_password);
	
	if(!$connection){
		echo 'Error connecting!';
		die();
	}
	
	// Else, assume it works
	
	// Select a schema to work with!
	$db = mysql_select_db($db_schema, $connection);
	
	// Lets construct the SQL to look at the data in the database
	
$_SESSION['mobile_no'] = $mobile; // Initializing Session
$_SESSION['password'] = $password;

?>

<!DOCTYPE html>
<html 
    <head>
    
     <style>
    #map-canvas {
        width: 500px;
        height: 400px;
      }
       
#page{
width:100%;
margin:0 auto;
}

#container{
width: 90%;
margin:0 auto;

}

#masthead{
width:100%;
height:2em;
padding:5%;
font-family:'courier';
font-size:4em;
color: red;


}

#2Column{
width:90%
margin:0 auto;

}

#Column1{

width:40%;
margin-left:5%;
margin-right:2.5%;
color:red;
float:left;
padding-top:2.5%;


}
#Column2{

width:40%;
margin-left:2.5%;
margin-right:5%;
color: blue;
float:right;
padding-top:2.5%;

} 


</style>
</head>
<body>
<div id="page">
	<div id="container">
		<header id= "masthead">
		
		<IMG STYLE="margin-left: auto; margin-right: auto; WIDTH:200px; HEIGHT:200px" SRC="BuzzStop.png">
		
	</div>
		</header>	
		
	<section id="2Column">
	<section id="Column1">

<p id="demo">Click the button to get your position.</p>

<button onclick="getLocation()">Get Location</button>

<div id="mapholder"></div>

<script src="http://maps.google.com/maps/api/js?sensor=false"></script>

<script>
var x = document.getElementById("demo");
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    lat = position.coords.latitude;
    lon = position.coords.longitude;
    latlon = new google.maps.LatLng(lat, lon)
    
    mapholder = document.getElementById('mapholder')
    mapholder.style.height = '250px';
    mapholder.style.width = '500px';

    var myOptions = {
    center:latlon,zoom:16,
    mapTypeId:google.maps.MapTypeId.ROADMAP,
    mapTypeControl:false,
    navigationControlOptions:{style:google.maps.NavigationControlStyle.SMALL}
    }
    
    var map = new google.maps.Map(document.getElementById("mapholder"), myOptions);
    var marker = new google.maps.Marker({position:latlon,map:map,title:"You are here!"});
    document.write = 'http://gcdsrv.com/~buzzardz/BuzzStop/Julie/login2.php?addlat='+lat+'&addlong='+lon+'&addposition='+latlon;
}
 
</script>
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
 <?php
 $addlat = $_GET['addlat'];
 $addlong = $_GET['addlong'];


$_SESSION['addlat'] = $addlat;
$_SESSION['addlong'] = $addlong;
 ?>

 
<script>
function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            x.innerHTML = "User denied the request for Geolocation."
            break;
        case error.POSITION_UNAVAILABLE:
            x.innerHTML = "Location information is unavailable."
            break;
        case error.TIMEOUT:
            x.innerHTML = "The request to get user location timed out."
            break;
        case error.UNKNOWN_ERROR:
            x.innerHTML = "An unknown error occurred."
            break;
    }
}
</script>

</section>

<section id="Column2">
	<h1>Welcome to BuzzStop	 Please Login</h1>
		<form action="MapIntegeration1.php" method="post">
			Your Mobile Numer <input type="text" name="mobile_no">
			<br>
			Your password <input type="password" name="password">
			<input type="submit"  value="Login!">
		</form>
		<p>
<form action = "signup.php" method = "post">
New to BuzzStop? Please Click here to register <input type = "submit" name = "redirect" value="Register" />
</form>
</p>
	
	</section>
		
	</section>
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X');ga('send','pageview');
        </script>
       

	</div>
    </body>
</html>





