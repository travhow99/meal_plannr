<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Register / Login</title>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


</head>
<body>

  <div class="container">
    <h3>Add a New Meal Below</h3>
    <form action="functions.php" method="post">
      <div class="form-group">
        <label for="meal_name">Meal Name:</label>
        <input type="text" class="form-control" id="meal_name">
      </div>
      <div class="form-group">
        <label for="url">URL:</label>
        <input type="text" class="form-control" id="url">
      </div>
      <button type="submit" class="btn btn-default">Submit</button>
    </form>
  </div>


  <script type="text/javascript" src="inc/jquery/jquery-1.11.2.min.js">
    <script type="text/javascript" src="inc/jquery/functions.js">
</body>
</html>
