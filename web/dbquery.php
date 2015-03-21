<?php
    // if the form has been submitted 
    if(isset($_POST['submit'])){

    	// get values from form 
    	$name = $_POST['name'];
        $food = $_POST['food'];
        $location = $_POST['location'];
        $start_time = $_POST['start_time'];
        $duration = $_POST['duration'];
    }
    
    // modify the sql database
    $sql = "INSERT INTO 'events' ('name','food','location','created_on','duration') VALUES ($name, $food, $location, $start_time, $duration);"

?>
