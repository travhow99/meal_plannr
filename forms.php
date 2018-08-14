<?php
   include('config.php');

   $sql = mysqli_query($conn,"select * from meals");

   while ($row = mysqli_fetch_array($sql)){
     //echo $row['meal_name'].'<br>';
     echo $row['meal_name'];
     
   }

   if ($_SERVER["REQUEST_METHOD"] == "POST") {
     $name = $_POST['name'];
     $city = $_POST['city'];

     echo $name;

   }
?>
