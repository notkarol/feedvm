<?php
  require_once("tools.php");
  
  $events = get_soon($DB_CONN, 7);
  $icon_names = array("red-blank.png", "blu-blank.png", "grn-blank.png");

  $icon_js = "";
  foreach ($events as $event)
  {
    $event_id = $event['event_id'];
    $netid = $event['netid'];
    $location = $event['location'];
    $start_time = $event['start_time'];
    $end_time = $event['end_time'];
    $name = $event['name'];
    $food = $event['food'];
    $created_on = $event['created_on'];
    $is_fake = $event['is_fake'];
    $map_location = $event['map_location'];
    $picture = $event['picture'];
    $days = 5;
    $icon = $days < 1 ? $icon_names[0] : $days < 3 ? $icon_names[1] : $icon_names[2];
    $icon_js .= "
    geocoder.geocode( { 'address': '$location'}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        var marker = new google.maps.Marker({
          position: results[0].geometry.location,
          map: map,
          title: '$name',
	  icon: iconBase + '$picture'
	   });
        var infowindow = new google.maps.InfoWindow({ content: '$name ($location $start_time - $end_time): $food'});
        google.maps.event.addListener(marker, 'click', function() {
           infowindow.open(map, marker);
        });
       } else {
        alert('Geocode was not successful for the following reason: ' + status);
       }
    });

  
";
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>UFeedMe Map</title>
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
    <script>

function location_of_address(address) {
}

function initialize() {
  geocoder = new google.maps.Geocoder();
  var mapOptions = {
    zoom: 15,
    center: new google.maps.LatLng(44.4725, -73.1936)
  }
  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
  var iconBase = 'https://maps.google.com/mapfiles/kml/paddle/';
  var iconBase = 'img/food_icons/';

  <?php echo $icon_js; ?>
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
  </head>
  <body>
    <div id="map-canvas"></div>
  </body>
</html>

