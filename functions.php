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
      $meal_pic = $_POST['meal_pic'];

      if (!empty($meal_name) && !empty($url) && !empty($meal_pic)) {

        //Insert Query of SQL
        mysqli_query($conn, "INSERT INTO meals(meal_name, meal_url, meal_pic, user) VALUES ('$meal_name', '$url', '$meal_pic', '$user')");

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

  $sql = mysqli_query($conn,"SELECT * FROM meals WHERE user='$user'");


  while ($row = mysqli_fetch_array($sql)){
    /* print_r($row["meal_name"]);
    echo "<br>";
    print_r($row["meal_url"]); */

    echo "<div class='favoriteRecipe pop' data-content='<a data-meal=&quot;". $row['meal_name'] . "&quot; class=&quot;dayz&quot;>M</a><a data-meal=&quot;". $row['meal_name'] . "&quot; class=&quot;dayz&quot;>T</a><a data-meal=&quot;". $row['meal_name'] . "&quot; class=&quot;dayz&quot;>W</a><a data-meal=&quot;". $row['meal_name'] . "&quot; class=&quot;dayz&quot;>Th</a><a data-meal=&quot;". $row['meal_name'] . "&quot; class=&quot;dayz&quot;>F</a>' data-toggle='popover'>". $row['meal_name'] . " <a href='" . $row['meal_url'] . "' target='_blank'><i class='fas fa-external-link-alt'></i></a> <i class='fas fa-cart-plus'></i></div>";
  };

}

// Function for drop down favorites
function favoritesDropdown() {
  $host = "localhost";
  $userName = "root";
  $password = "root";
  $dbName = "meal_plannr";

  $user = $_SESSION['login_user'];


  // Create database connection
  $conn = mysqli_connect($host, $userName, $password, $dbName);

  $sql = mysqli_query($conn,"SELECT * FROM meals WHERE user='$user'");


  echo "<div class='dropdown-container'><div class='favoritesDropdown'><span>Eating Out</span>";
    while ($row = mysqli_fetch_array($sql)){
      echo "<span data-url=" . $row['meal_pic'] . ">" . $row['meal_name'] . "</span>";
    };
  echo "</div></div>";

}

function get_username() {
  global $current_user;

}



mysqli_close($conn);


?>
