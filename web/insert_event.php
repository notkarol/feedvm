<?php 
include("session.php");

if (isset($_POST['submit']))
  {
    echo "WE ARE PROCESSING YOUR FORM<br>";
  }
include("header.php") 
?>
<body>
WELCOME <?php echo $_SESSION["NETID"]; ?>! <br>

<form class="basic-grey" method="POST" action="insert_event.php">
	<h1>Submit an Event</h1>

	<label>
		<span>Event Name:</span>
		<input type="text" name="name" placeholder="Event name">
	</label>
	<label>
		<span>Description:</span>
		<input type="text" name="food" placeholder="Event info and food offered">
	</label>
	<label>
		<span>Location:</span>
		<input type="text" name="location" placeholder="Location name">
	</label>

	<div id="basicExample">
		<label>
			<span>Date:</span>
	    	<input name="start_date" type="text" class="date start" placeholder="Start date" />
		</label>
		<label>
			<span>&nbsp;</span>
		    	<input type="text" name="end_date" class="date end" placeholder="End date" />
		    </label>
		<label>
			<span>Time:</span>
	    	<input name="duration" name="start_time" type="text" class="time start" placeholder="Start time" />
	    </label>
	    <label>
			<span>&nbsp;</span>
	    	<input type="text" name="end_time" class="time end" placeholder="End time"/>
	    </label>
	    <label>
			<span>Food Image:</span>
			<ul class="food-items" >
		    	<li><img src="img/food_icons/popcorn.png" alt="food"/></li>
		    	<li><img src="img/food_icons/fries.png" alt="food"/></li>
		    	<li><img src="img/food_icons/apple.png" alt="food"/></li>
		    </ul>
		</label>
		<label>
			<span>&nbsp;</span>
			<ul class="food-items" >
		    	<li><img src="img/food_icons/coffee.png" alt="food"/></li>
		    	<li><img src="img/food_icons/cookie.png" alt="food"/></li>
		    	<li><img src="img/food_icons/pizza.png" alt="food"/></li>
		    </ul>
		</label>
		<label>
			<span>&nbsp;</span>
			<ul class="food-items" >
		    	<li><img src="img/food_icons/iceCream.png" alt="food"/></li>
		    	<li><img src="img/food_icons/muffin.png" alt="food"/></li>
		    	<li><img src="img/food_icons/misc.png" alt="food"/></li>
	   		</ul>
		</label>

	</div>

	<label>
		<span>&nbsp;</span>
		<input class="button" type="submit" name="submit" value="Feed Us!">
	</label>
<form>

<?php include("footer.php") ?>
</body>
</html>
