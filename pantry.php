<?php
include('config.php');

  if (mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }/* else {
    echo 'Connected successfully.';
  }
*/
  /* Queries for each pantry category */
  $sql = "SELECT * FROM pantry";

  $stocked_query = "SELECT * FROM pantry WHERE timeLine='stocked'";
  $low_query = "SELECT * FROM pantry WHERE timeLine='low'";
  $desperate_query = "SELECT * FROM pantry WHERE timeLine='desperate'";


  $result = mysqli_query($conn, $sql);

  $low = mysqli_query($conn, $low_query);
  $stocked = mysqli_query($conn, $stocked_query);
  $desperate = mysqli_query($conn, $desperate_query);

  function showPantry($query) {

    while ($row = mysqli_fetch_array($query)) {
      print_r($row['itemName']);
      echo "<br>";
    }

  }
/*
  while ($row = mysqli_fetch_array($result)) {
    echo("<br>");
    print_r($row['itemName']);
    echo " -- ";
    print_r($row['timeLine']);
  }
*/

  if ($_SERVER["REQUEST_METHOD"] == "POST"){
    echo "posted";


    $itemName = $_POST['itemName'];
    $timeLine = $_POST['timeLine'];


    if (!empty($itemName) && !empty($timeLine)) {
      echo "adding $itemName and $timeLine";

      mysqli_query($conn, "INSERT INTO pantry(itemName, timeLine) VALUES ('$itemName', '$timeLine')");
      echo "Affected rows: " . mysqli_affected_rows($conn);

    }
  }


  mysqli_close($conn);


?>
