<?php
include 'config.php';


$weekdays = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday");

$thisWeek = date('W');
$lastWeek = date('W') - 1;
$nextWeek = date('W') + 1;

$weeks = array($lastWeek, $thisWeek, $nextWeek);



foreach ($weeks as $week){
  echo '<div class="meal-row meal-row-'.$week.'">';

// Loop through each day of week
foreach ($weekdays as $weekday) {
  if (!$conn)
    {
    die("Connection error: " . mysqli_connect_error());
    }

  $lowered = strtolower($weekday);
  echo "<div id='$lowered' class='noselect day'>
          <span>$weekday</span></br>";

  //$sql = 'SELECT * FROM calendar';

  $sql = 'SELECT * FROM calendar';


  $entry = [];

  $result = mysqli_query($conn, $sql);
  //echo '<br>result: '.$result;

  while($row = mysqli_fetch_assoc($result)) {
    // Check if entry matches for the day
    if ($row['day'] == $weekday && $row['week_number'] == ($week) && $row['saved_by'] == $login_session) {
      // if there is a result from this day, week, & user
      // Build query
      $sqlZ = "SELECT calendar.meal_id, calendar.day, calendar.week_number, meals.ID, meals.meal_name, meals.meal_pic FROM calendar INNER JOIN meals ON calendar.meal_id = meals.id WHERE calendar.day='$weekday'";

      $query = mysqli_query($conn, $sqlZ);

      while ($row = mysqli_fetch_assoc($query)) {

        array_push($entry, $row);
      }

    }

  }


    if (!empty($entry)){
      $mealpic = $entry[0]['meal_pic'];
      $mealname = $entry[0]['meal_name'];
      echo "<div class='dayMealPlan' style='background-image:url($mealpic)'>$mealname</div>";
    } else {
      echo '<div class="dayMealPlan">Click to add a favorite meal below!</div>
      <span class="meal-name"></span>
      <span class="meal-id"></span>
      <button class="addMeal btn btn-success" id="addFriday"><i class="fas fa-plus-circle"></i></button>';
      echo favoritesDropdown();
    }
    echo '</div>';

  }
  echo '</div>';

}
?>
