<?php
session_start();

$host = "localhost";
$userName = "root";
$password = "root";
$dbName = "meal_plannr";

// Create database connection
$conn = mysqli_connect($host, $userName, $password, $dbName);


// Check connection
/*
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
} else {
  echo 'Connected successfully.';
}
*/

//echo '<br>'.$_POST['meal_name'];
//echo '<br>'.$_POST['meal_url'];

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_SESSION['login_user'];


// Add to database feature, add back
      mysqli_query($conn,"SELECT * FROM meals");

      $meal_name = $_POST['meal_name'];
      $url = $_POST['meal_url'];

      if (!empty($meal_name) && !empty($url)) {

        //Insert Query of SQL
        mysqli_query($conn, "INSERT INTO meals(meal_name, meal_url, user) VALUES ('$meal_name', '$url', '$user')");

        echo "Affected rows: " . mysqli_affected_rows($conn);

      }
    }

// TO DO
//  Pass variable to function for reusability
//Add favorites to div
function showFavorites() {
  $host = "localhost";
  $userName = "root";
  $password = "root";
  $dbName = "meal_plannr";

  $user = $_SESSION['login_user'];


  // Create database connection
  $conn = mysqli_connect($host, $userName, $password, $dbName);

  $favorites = mysqli_query($conn,"SELECT * FROM meals WHERE user='$user'");


  while ($row = mysqli_fetch_array($favorites)){
    /* print_r($row["meal_name"]);
    echo "<br>";
    print_r($row["meal_url"]); */

    echo "<a class='btn btn-success' href='" . $row['meal_url'] . "' target='_blank'>". $row['meal_name'] . "</a>";
  };

}

function get_username() {
  global $current_user;

}



mysqli_close($conn);


?>
