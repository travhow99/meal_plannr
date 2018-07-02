<?php
$host = "localhost";
$userName = "root";
$password = "root";
$dbName = "meal_plannr";

// Create database connection
$conn = mysqli_connect($host, $userName, $password, $dbName);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {
  echo 'Connected successfully.';
}


echo '<br>'.$_POST['meal_name'];
echo '<br>'.$_POST['url'];

      mysqli_query($conn,"SELECT * FROM meals");

      $meal_name = $_POST['meal_name'];
      $url = $_POST['url'];

      //Insert Query of SQL
      mysqli_query($conn, "INSERT INTO meals(meal_name, meal_url) VALUES ('$meal_name', '$url')");

      echo "Affected rows: " . mysqli_affected_rows($conn);




mysqli_close($conn);


?>
