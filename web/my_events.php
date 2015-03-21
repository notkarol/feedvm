<?php include("header.php") ?>


<!--iphone app display-->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, minimal-ui">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="apple-mobile-web-app-title" content="UFeedMe">

  My events


  <article class="event">
  	<article style="background-image: url(http://dewitt.sanford.duke.edu/wp-content/uploads/2014/05/goat.jpg);" class="eimage"></article>
  		<h2>Salsa Dancing</h2>
  		<ul>
  			<li>Come dance with UVM's Sass Team!</li>
  			<li>Chips and salsa</li>
  			<li>Tuesday, Nov 1 • Patrick Gym</li>
  		</ul>
  		<button type="button">★</button>
  </article>
  
<?php 
$result = get_event($DB_CONN , 15);
print "<p>";
print_r($result);
print "</p>";
?>

<?php include("footer.php") ?>
</body>
</html>
