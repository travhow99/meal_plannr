<?php
$host = "localhost";
$userName = "root";
$password = "root";
$dbName = "meal_plannr";

// Create database connection
$conn = new mysqli($host, $userName, $password, $dbName);

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

echo 'Connected successfully.';
/*
echo $_POST['meal_name'];

      mysqli_query($conn,"SELECT * FROM meals");

      $meal_name = $_POST['meal_name'];
      $url = $_POST['url'];

      //Insert Query of SQL
      mysqli_query($conn, "INSERT INTO meals(meal_name, url) VALUES ('$meal_name', '$url')");





$mysqli_close($conn);
*/

?>
