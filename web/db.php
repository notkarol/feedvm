<?php

  // Try to connect to the database
$user = "kzieba_writer";
$pass = "UFEEDME";
$host = "webdb.uvm.edu";
$db   = "KZIEBA_UFEEDME";
$DB_CONN = new mysqli($host, $user, $pass, $db);
if ($DB_CONN->connect_error)
  {
    die("CONNECTION FAILED! " . $conn->connect_error);
  }

// Create a new session and save the user's name to the SESSION NETID Variable
session_name("UFEEDME");
session_start();
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

?>