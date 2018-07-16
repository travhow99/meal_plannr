<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>mealplanner.io</title>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <!-- Font Awesome !-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

  <link rel="stylesheet" href="css/style.css">

</head>
<body>

  <div class="container" style="display:none;">
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
  </div>


 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

 <script src="app.js"></script>

</body>
</html>
