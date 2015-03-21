<?php
session_name("UFEEDME");
session_start();

$DB_CONN = connect_to_db();
if (!is_logged_in())
  {
    set_session();
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

function set_session()
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
	  add_user();
	}
      // If the user is in the database, make sure that they are allowed to use app
      else
	{
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

function add_user()
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

function add_event($name, $food, $location, $map_location, $start_time, $duration)
{
  // Block people
  if (!isset($_SESSION["CAN_POST"]) || $_SESSION["CAN_POST"] == 0)
    {
      return False;
    }

  $sql = "INSERT INTO 'events' ('name','food','location','map_location', 'created_on','duration') VALUES (\"$name\", \"$food\", \"$location\", \"$map_location\", \"$start_time\", \"$duration\");";
  if ($insert_event_result = $DB_CONN->query($sql))
    {
      return $mysqli->insert_id;
    }
  return False;
}

function get_favorites()
{
  if (!isset($_SESSION["CAN_VIEW"]) || $_SESSION["CAN_VIEW"] == 0)
    {
      return False;
    }

  return False;
}

function get_soon($days)
{
  if (!isset($_SESSION["CAN_VIEW"]) || $_SESSION["CAN_VIEW"] == 0)
    {
      return False;
    }

  return False;
}

?>