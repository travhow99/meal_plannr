<?php
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

// Add to database feature, add back
      mysqli_query($conn,"SELECT * FROM meals");

      if (!is_null($_POST['meal_name']) && !is_null($_POST['meal_url'])) {
        $meal_name = $_POST['meal_name'];
        $url = $_POST['meal_url'];

        //Insert Query of SQL
        mysqli_query($conn, "INSERT INTO meals(meal_name, meal_url) VALUES ('$meal_name', '$url')");

        echo "Affected rows: " . mysqli_affected_rows($conn);

      }


//Add favorites to div
function showFavorites(){
  $host = "localhost";
  $userName = "root";
  $password = "root";
  $dbName = "meal_plannr";

  // Create database connection
  $conn = mysqli_connect($host, $userName, $password, $dbName);

  $favorites = mysqli_query($conn,"SELECT * FROM meals");


  while ($row = mysqli_fetch_array($favorites)){
    /* print_r($row["meal_name"]);
    echo "<br>";
    print_r($row["meal_url"]); */

    echo "<a class='btn btn-success' href='" . $row['meal_url'] . "' target='_blank'>". $row['meal_name'] . "</a>";
  };

}




mysqli_close($conn);


?>
