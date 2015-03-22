<?php require_once("tools.php"); ?>

<!doctype html>

<html lang="en">
<head>
 <meta charset="utf-8">

 <title>UFeedMe</title>
 <meta name="description" content="UFeedMe: connecting students at UVM through events hosting free food">
 <meta name="author" content="UFeedMe">

<meta name="viewport" content="width=device-width, intial-scale=1">

<!-- Stylsheets -->
<link rel="stylesheet" href="css/style.css">
<link href="css/jquery.fs.shifter.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/jquery.timepicker.css" />
<link rel="stylesheet" type="text/css" href="css/bootstrap-datepicker.css" />

<link rel="shortcut icon" href="img/logo/favicon.png" >
<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>

<!-- Scripts -->
<script src="js/jquery-1.11.2.min.js"></script>
<script src="js/shifter/jquery.fs.shifter.min.js"></script>
<script type="text/javascript" src="js/jquery.timepicker.js"></script>
<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="js/datepair.js"></script>
<script type="text/javascript" src="js/jquery.datepair.js"></script>

 <!--[if lt IE 9]>
 <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
 <![endif]-->

<script>
$(document).ready(function() {

	// shifter
	$.shifter({
		maxWidth: "825px"
	});

	/////
	// date pickers

	// initialize input widgets first
	$('#basicExample .time').timepicker({
	    'showDuration': true,
	    'timeFormat': 'H:i:s'
	});

	$('#basicExample .date').datepicker({
	    'format': 'yyyy-mm-dd',
	    'autoclose': true
	});

	// initialize datepair
	var basicExampleEl = document.getElementById('basicExample');
	var datepair = new Datepair(basicExampleEl);

	////
	//toggle buttons

        $( ".food-items img" ).click(function() {       
                document.getElementById("picture").value = $(this).attr('src').split('/').reverse()[0];
  		$( this ).toggleClass( "opacity-full" );
	});

});
</script>

</head>

<body class="shifter">

<header>

<nav data-role="navbar">
     <ul>
     	<li id="logo"><a href="index.php"><img src="img/logo/logo_all_color.png" alt="logo" /></a></li>
		<?php 
	
			if(basename($_SERVER['PHP_SELF'])=="index.php"){
				print '<li>Home</li>' . "\n";
			} else {
				print '<li><a href="index.php">Home</a></li>' . "\n";
			} 

			if(basename($_SERVER['PHP_SELF'])=="submit.php"){
				print '<li>My Events</li>' . "\n";
			} else {
				print '<li><a href="submit.php">My Events</a></li>' . "\n";
			}

			if(basename($_SERVER['PHP_SELF'])=="map.php"){
				print '<li>Map</li>' . "\n";
			} else {
				print '<li><a href="map.php">Map</a></li>' . "\n";
			} 
			
			if(basename($_SERVER['PHP_SELF'])=="insert_event.php"){
				print '<li>Submit Event</li>' . "\n";
			} else {
				print '<li><a href="insert_event.php">Submit Event</a></li>' . "\n";
			}
		?>

     </ul>
    <span class="shifter-handle">Menu</span>
</nav>
</header>

<section class="shifter-page main">
