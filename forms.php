<?php
   include('session.php');
   include('config.php');

   $thisWeek = date('W');
   $nextWeek = date('W') + 1;
   $lastWeek = date('W') - 1;


   // Need to Join with 'meals' table to reference ID# of Meal
   $sql = mysqli_query($conn,"SELECT * FROM meal_calendar WHERE week_number=$thisWeek OR week_number=$lastWeek OR week_number=$nextWeek ORDER BY week_number");

   $types = array();

   //$sqlJoin = mysqli_query($conn,"SELECT meal_calendar.*, meals.meal_name, meals.meal_pic FROM meal_calendar LEFT JOIN meals ON ")
   $sqlSelect = mysqli_query($conn, "SELECT meal_calendar.*, meals.meal_name, meals.meal_pic FROM meal_calendar A
     INNER JOIN meals ON meal_calendar.mon_din=meals.id)");

   $sqlNew = mysqli_query($conn, "SELECT * from calendar");

  while ($row =  mysqli_fetch_array($sqlNew)) {
      $types[] = $row;
      //print_r($row['day']);

  }

 /* individual sql queries to set mealCalendar if already exists */

 // Check DB for entry this day, this week, and this user
    //

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
