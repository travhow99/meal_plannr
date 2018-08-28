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
      $grocery_url = $_POST['grocery_url'];

      if (!empty($meal_name) && !empty($url) && !empty($meal_pic) && !empty($grocery_url)) {

        //Insert Query of SQL
        mysqli_query($conn, "INSERT INTO meals(meal_name, meal_url, meal_pic, grocery_url, user) VALUES ('$meal_name', '$url', '$meal_pic', '$grocery_url', '$user')");

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

function calendar() {
  $monday = date( 'M d', strtotime( 'monday this week' ) );
  $friday = date( 'M d', strtotime( 'friday this week' ) );
  $thisWeek = date('W');

  $nextMonday = date( 'M d', strtotime( 'monday next week' ) );
  $nextFriday = date( 'M d', strtotime( 'friday next week' ) );
  $nextWeek = date('W') + 1;

  $lastMonday = date( 'M d', strtotime( 'monday last week' ) );
  $lastFriday = date( 'M d', strtotime( 'friday last week' ) );
  $lastWeek = date('W') - 1;

  $scrollingDiv = "<div class='weeklyCalendar'><div class='btn prev'><</div>
                    <div class='range' data-week-number='$lastWeek' style='display:none;'>$lastMonday - $lastFriday</div>
                    <div class='range displaying' data-week-number='$thisWeek' style='display:none;'>$monday - $friday</div>
                    <div class='range' data-week-number='$nextWeek' style='display:none;'>$nextMonday - $nextFriday</div>
                  <div class='btn next'>></div></div>";


  echo $scrollingDiv;

}



mysqli_close($conn);


?>
