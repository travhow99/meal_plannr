<?php
   include('config.php');
   $thisWeek = date('W');
   $nextWeek = date('W') + 1;

   $lastWeek = date('W') - 1;


   // Need to Join with 'meals' table to reference ID# of Meal
   $sql = mysqli_query($conn,"SELECT * FROM meal_calendar WHERE week_number=$thisWeek OR week_number=$lastWeek OR week_number=$nextWeek ORDER BY week_number");

   $types = array();



  while($row =  mysqli_fetch_array($sql)) {
      $types[] = $row;
      if ($row['week_number'] == $thisWeek) {
        echo $row['mon_din'];
      }
  }







   if ($_SERVER["REQUEST_METHOD"] == "POST") {
     //echo 'posted '.$_POST['mon'].' and '.$_POST['tue'];

     $week = $_POST['week'];
     $monday = $_POST['mon'];
     $tuesday = $_POST['tue'];
     $wednesday = $_POST['wed'];
     $thursday = $_POST['thu'];
     $friday = $_POST['fri'];

     mysqli_query($conn, "INSERT INTO meal_calendar(week_number, mon_din, tue_din, wed_din, thu_din, fri_din) VALUES ('$week', '$monday', '$tuesday', '$wednesday', '$thursday', '$friday')");

        echo "Affected rows: " . mysqli_affected_rows($conn);


   }


?>
