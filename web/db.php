<?php
$user = "kzieba_writer";
$pass = "UFEEDME";
$host = "webdb.uvm.edu";
$db   = "KZIEBA_UFEEDME";
$DB_CONN = new mysqli($host, $user, $pass, $db);
if ($DB_CONN->connect_error)
  {
    die("CONNECTION FAILED! " . $conn->connect_error);
  }
?>