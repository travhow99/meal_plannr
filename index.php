<?php
   include('session.php');
?>

<!DOCTYPE html>
<html>

<head>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="utf-8">
  <title>mealplanner.io</title>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  <!-- Font Awesome !-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

  <link rel="stylesheet" href="css/style.css">

  <link rel="icon" type="image/gif" href="images/coffee2.gif">

</head>

<body>

  <h1 style='text-align:center;'>mealPlannr</h1>
  <h1>Welcome <?php echo $login_session; ?></h1>

  <div id="favorites" class="container">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3>Past Favorites</h3>
      </div>
      <div class="panel-body">

        <?php
            require 'functions.php';
            echo showFavorites();

        ?>
      </div>
    </div>
  </div>

  <div class="container">
    <h3>Add a New Meal Below</h3>
    <form action="functions.php" method="post">
      <div class="form-group">
        <label for="meal_name">Meal Name:</label>
        <input type="text" name="meal_name" class="form-control" id="meal_name">
      </div>
      <div class="form-group">
        <label for="url">URL:</label>
        <input type="text" name="meal_url" class="form-control" id="url">
      </div>
      <!-- PREVENT CLICK DURING TESTING!-->
      <button type="submit" class="btn btn-default ">Submit</button>
      <!--!-->
    </form>
  </div>

  <div class="container recipeSearch">
    <h3>Find a New Recipe</h3>
    <input id="foodInput" type='text' placeholder="Main Ingredient"></input>
    <button id="searchRecipe" class="btn btn-primary">Find Recipe</button>

  </div>

  <div class="container">
    <div class="row recipe-results">
    </div>
    <hr style="border-color:white">
  </div>

  <div id="pantry" class="container">
    <h2>Pantry</h2>

    <input id="neededInput" name="itemName" type="text" placeholder="Add to your list!"></input>
    <!-- <input id="timeLine" name="timeLine" type="text" placeholder="When do you need it?"></input> !-->
    <select id="timeLine" name="timeLine">
      <option value="" disabled hidden selected>What's your supply like?</option>
      <option value="stocked">Just Stocked It</option>
      <option value="low">Running Low</option>
      <option value="desperate">Need It Now</option>
    </select>

    <button id="addNeeded" class="btn btn-success">Add to Pantry</button>
    <span id="pantryError" class="bg-danger">Select your time line!</span>

    <div id="needed" class="row">
      <div id="stocked" class="col-xs-4">
        <h3>Stocked Up!</h3>
        <?php

          require 'pantry.php';
          showPantry($stocked);

        ?>
      </div>
      <div id="runningLow" class="col-xs-4">
        <h3>Running Low...</h3>
        <?php

          showPantry($low);

        ?>
      </div>
      <div id="needNow" class="col-xs-4">
        <h3 class="text-danger">Desperately Needed!</h3>
        <?php

          showPantry($desperate);

        ?>
      </div>
    </div>

  </div>


  <script src="app.js"></script>

</body>

</html>
