<?php
   include('config.php');

   $sql = mysqli_query($conn,"select * from meals");

   while ($row = mysqli_fetch_array($sql)){
     //echo $row['meal_name'].'<br>';
     //echo $row['meal_name'];

   }

   if ($_SERVER["REQUEST_METHOD"] == "POST") {
     //echo 'posted '.$_POST['mon'].' and '.$_POST['tue'];

     $monday = $_POST['mon'];
     $tuesday = $_POST['tue'];
     $wednesday = $_POST['wed'];
     $thursday = $_POST['thu'];
     $friday = $_POST['fri'];

     $mealDay=array();

     array_push($mealDay,$monday,$tuesday,$wednesday,$thursday,$friday);

     print_r($mealDay);

   }

   echo date('l').'<br>';
?>
