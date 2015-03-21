<?php include("header.php") ?>

<!--iphone app display-->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, minimal-ui">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="apple-mobile-web-app-title" content="UFeedMe">

<section class="event-container">
<?php
$events = get_soon($DB_CONN, 7);
foreach ($events as $event)
{
  echo ' <article class="event">' . "\n";
  echo ' <section class="col-1">' . "\n";
  echo ' <img src="img/food_icons/' . $event['picture']. '" alt="food" />' . "\n";
  echo ' </section>' . "\n";
  echo ' <section class="col-2">' . "\n";
  echo '<h2>' . $event['name'] . '</h2>' . "\n";
  echo '<ul>' . "\n";
  echo '<li>' . $event['food'] . '</li>' . "\n"; 
  echo '<li>' . $event['start_time'] . '</li>' . "\n"; 
  echo '<li>' . $event['location'] . '</li>' . "\n"; 
  echo '</ul>' . "\n";
  echo '</section>' . "\n";
  echo '<section class="col-3">' . "\n";
  echo '<a href="index.php?title=' . $event['name'] . '&start_time=' . $event['start_time'] . '&end_time=' . $event['end_time'] . '&food=' . $event['food'] . '&location=' . $event['location'] . ' ">★</a>' . "\n";
  echo '<span class="count">' . strlen($event['name']) . '</span>' . "\n";
  echo '</section>' . "\n";
  echo '</article>' . "\n";
}
?>
</section>

<?php include("footer.php") ?>
</body>
</html>
