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

<form method="POST" action="insert_event.php">
Name: <input type="text" name="name"> <br>
Food: <input type="text" name="food"> <br>
Location: <input type="text" name="location"> <br>
Start Time: <input type="text" name="start_time"> <br>
Duration: <input type="text" name="duration"> <br>
<input type="submit" name="submit" value="Feed Us!"><br>
<form>

<?php include("footer.php") ?>
</body>
</html>
