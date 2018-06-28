<?php
$connection = new mysqli("localhost", "root", "root", "meal_plannr");

if (mysqli_connect_error()) {
  die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}

echo 'Connected successfully.';

echo $_POST['meal_name'];

      mysqli_query($connection,"SELECT * FROM meals");

      $meal_name = $_POST['meal_name'];
      $url = $_POST['url'];

      //Insert Query of SQL
      mysqli_query($connection, "INSERT INTO meals(meal_name, url) VALUES ('$meal_name', '$url')");





$mysqli_close($connection);


?>
