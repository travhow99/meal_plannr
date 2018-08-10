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
  <!-- Google fonts !-->
  <link href="https://fonts.googleapis.com/css?family=Montserrat|Source+Sans+Pro" rel="stylesheet">


</head>

<body>
  <div class="container">
    <h1 style='text-align:center;'>mealPlannr</h1>

    <!-- tabs !-->
    <div id="dashboard" class="container">
      <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
        <li><a data-toggle="tab" href="#favorites">Cook Book</a></li>
        <li><a data-toggle="tab" href="#mealSearch">Meal Search</a></li>
        <li><a data-toggle="tab" href="#pantry">Pantry</a></li>

        <span id="welcome"><i class="fas fa-coffee"></i> <?php echo $login_session; ?></span>
        <span id="logOut"><a href="logout.php">Log Out</a></span>
      </ul>

      <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
          <h3>HOME</h3>
          <p class="lead">What's on the menu this week?</p>
          <div class="calendar">
            <div class="day">
              <span>Monday</span>
              <button class="addMeal btn btn-success" id="addMonday"><i class="fas fa-plus-circle"></i> Add Meal</button>
              <?php
                include 'functions.php';
                echo favoritesDropdown();
              ?>
            </div>
            <div class="day">
              <span>Tuesday</span>
              <button class="addMeal btn btn-success" id="addTuesday"><i class="fas fa-plus-circle"></i> Add Meal</button>
              <?php
                echo favoritesDropdown();
              ?>
            </div>
            <div class="day">
              <span>Wednesday</span>
              <button class="addMeal btn btn-success" id="addWednesday"><i class="fas fa-plus-circle"></i> Add Meal</button>
              <?php
                echo favoritesDropdown();
              ?>
            </div>
            <div class="day">
              <span>Thursday</span>
              <button class="addMeal btn btn-success" id="addThursday"><i class="fas fa-plus-circle"></i> Add Meal</button>
              <?php
                echo favoritesDropdown();
              ?>
            </div>
            <div class="day">
              <span>Friday</span>
              <button class="addMeal btn btn-success" id="addFriday"><i class="fas fa-plus-circle"></i> Add Meal</button>
              <?php
                echo favoritesDropdown();
              ?>
            </div>
          </div>
        </div>
        <div id="favorites" class="tab-pane fade">
          <h3>Cook Book</h3>
          <div id="favorites">
            <?php
                //require 'functions.php';
                echo showFavorites();
            ?>
          </div>
        </div>
        <div id="mealSearch" class="tab-pane fade">
          <h3>Meal Search</h3>
          <div class="container recipeSearch">
            <h3>Find a New Recipe</h3>
            <input id="foodInput" type='text' placeholder="Main Ingredient"></input>
            <button id="searchRecipe" class="btn btn-primary">Find Recipe</button>

          </div>

          <div class="">
            <div class="row recipe-results">
            </div>
            <hr style="border-color:white">
          </div>

        </div>
        <div id="pantry" class="tab-pane fade">
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
              <div id="pantry" class="col-xs-4">
                <h3 class="text-danger">Desperately Needed!</h3>
                <?php

                  showPantry($desperate);

                ?>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div>

  </div>

  <script src="app.js"></script>

</body>

</html>
