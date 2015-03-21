<?php
session_name("UFEEDME");
session_start();

$DB_CONN = connect_to_db();
if (!is_logged_in())
  {
    set_session($DB_CONN);
  }


function connect_to_db()
{
  $user = "kzieba_writer";
  $pass = "UFEEDME";
  $host = "webdb.uvm.edu";
  $db   = "KZIEBA_UFEEDME";
  $DB_CONN = new mysqli($host, $user, $pass, $db);
  if ($DB_CONN->connect_error)
    {
      die("CONNECTION FAILED! " . $conn->connect_error);
    }
  return $DB_CONN;
}

function is_logged_in()
{
  return isset($_SESSION["NETID"]);
}

function set_session($DB_CONN)
{
  $_SESSION["NETID"] = $_SERVER["WEBAUTH_USER"];
  $_SESSION["POINTS"] = -1;
  $_SESSION["CAN_POST"] = 0;
  $_SESSION["CAN_VIEW"] = 0;
  $_SESSION["NEW_USER"] = 0;

  // Try to find this user in the database
  $sql = "SELECT * FROM `users` WHERE netid=\"" . $_SESSION["NETID"] . "\";";
  if ($find_user_result = $DB_CONN->query($sql))
    {
      // If the NETID is not in the database, add it
      if ($find_user_result->num_rows == 0)
	{
	  add_user($DB_CONN);
	}
      // If the user is in the database, make sure that they are allowed to use app
      else
	{
	  echo "UPDATING SESSION";
	  $row = $find_user_result->fetch_row();

	  $today = date("Y-m-d");
	  $cantpost = $row[2];
	  $cantview = $row[3];

	  $today_time = strtotime($today);
	  $cantpost_time = strtotime($cantpost);
	  $cantview_time = strtotime($cantview);

	  $_SESSION["POINTS"] = intval($row[1]);
	  $_SESSION["CAN_POST"] = $cantpost_time <= $today_time ? 1 : 0;
	  $_SESSION["CAN_VIEW"] = $cantview_time <= $today_time ? 1 : 0;
	}
    }
  
}

function add_user($DB_CONN)
{
  $sql = "INSERT INTO `users` (`netid`, `points`) VALUES (\"" . $_SESSION["NETID"] . "\", 0);";
  if ($insert_user_result = $DB_CONN->query($sql))
    {
      $_SESSION["POINTS"] = 0;
      $_SESSION["CAN_POST"] = 1;
      $_SESSION["CAN_VIEW"] = 1;
      $_SESSION["NEW_USER"] = 1;
    }
  else
    {
      die("Unable to add user. Please try again later");
    }
}

function add_event($DB_CONN, $name, $food, $location, $map_location, $start_time, $end_time, $picture)
{
  // Block people
  if (!isset($_SESSION["CAN_POST"]) || $_SESSION["CAN_POST"] == 0)
    {
      return False;
    }
  $netid = $_SESSION['NETID'];
  $sql = "INSERT INTO `events` (`netid`, `name`,`food`,`location`,`map_location`,`start_time`, `end_time`, `picture`, `created_on`) VALUES (\"$netid\", \"$name\", \"$food\", \"$location\", \"$map_location\", \"$start_time\", \"$end_time\", \"$picture\", NOW());";
  if ($insert_event_result = $DB_CONN->query($sql))
    {
      echo "SUCCESS!";
      return $mysqli->insert_id;
    }
  else
  {
      echo $sql;
  }
  return False;
}

function get_favorites($DB_CONN)
{
  if (!isset($_SESSION["CAN_VIEW"]) || $_SESSION["CAN_VIEW"] == 0)
    {
      return False;
    }

  return False;
}

function get_soon($DB_CONN, $days)
{
  if (!isset($_SESSION["CAN_VIEW"]) || $_SESSION["CAN_VIEW"] == 0)
    {
      return False;
    }

  return False;
}

function add_user_event($DB_CONN, $event_id, $attended, $rating ){
    // get net id 
    $netid = $_SESSION['NETID'];

    $sql = "INSERT INTO `user_events` (`netid`,`event_id`,`attended`,`rating`) VALUES (\"$netid\",\"$event_id\",\"$attended\",\"$rating\")";

    if ($insert_event_result = $DB_CONN->query($sql)) {
      echo "SUCCESS!";
      return $mysqli->insert_id;
    }

    else {
      echo $sql;
     }
      return False;

}

function get_event($DB_CONN, $event_id){ 
    // get net id 
    $netid = $_SESSION['NETID'];

    $sql = "SELECT * FROM events WHERE event_id = $event_id";
    $result = $DB_CONN->query($sql);
    return $result->fetch_row();
}


?>
