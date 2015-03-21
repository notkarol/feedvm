<?php include("header.php");

if(isset($_GET['id']))
{
  $event_id = intval($_GET['id']);
  add_favorite($DB_CONN, $event_id);
}

 ?>

<!--iphone app display-->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, minimal-ui">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="apple-mobile-web-app-title" content="UFeedMe">

<section class="event-container">

<?php
$events = get_my($DB_CONN);
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
  echo '<a' . (is_favorite($DB_CONN, $event['event_id']) ? ' style="background: yellow;" ' : ' ') . ' href="submit.php?id=' . $event['event_id'] . '&title=' . $event['name'] . '&start_time=' . $event['start_time'] . '&end_time=' . $event['end_time'] . '&food=' . $event['food'] . '&location=' . $event['location'] . ' ">★</a>' . "\n";
  echo '<span class="count">' . get_favorites($DB_CONN, $event['event_id']) . '</span>' . "\n";
  echo '</section>' . "\n";
  echo '</article>' . "\n";
}
?>

</section>

<?php include("footer.php") ?>
</body>
</html>
