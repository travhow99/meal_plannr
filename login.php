<?php
   include("config.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form

      $myusername = mysqli_real_escape_string($conn,$_POST['username']);
      $mypassword = mysqli_real_escape_string($conn,md5($_POST['password']));

      $sql = "SELECT id FROM users WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      //$active = $row['active'];

      $count = mysqli_num_rows($result);

      // If result matched $myusername and $mypassword, table row must be 1 row

      if($count == 1) {
        echo "Welcome ".$myusername;

         //session_register("myusername");
         $_SESSION['login_user'] = $myusername;

        header("location: index.php");
      }else {
         $error = "<i class='fas fa-exclamation-circle'></i><span>Your Login Name or Password is invalid</span>";
      }
   }
?>

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

    <link rel="stylesheet" href="css/login.css">

    <link rel="icon" type="image/gif" href="images/coffee2.gif">

    <!-- Google fonts !-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat|Source+Sans+Pro" rel="stylesheet">


  </head>

   <body bgcolor = "#eaeaea">

       <?php
        if(isset($_GET['status'])) {
          echo "<h3 class='logOut''>Logged out successfully.</h3>";
        }
       ?>



      <div align = "center">
         <div id="login-box" style = "width:300px;">
           <h3 style="color: #d7e8ef;">mealPlannr.io</h3>
           <div class="login-image">
             <img class='img-responsive' src="images/spoon.png" />
           </div>

            <div style = "margin:30px">

               <form action = "" method = "post">
                  <label><i class="fas fa-user"></i></label>
                  <input type = "text" name = "username" placeholder="Username" class="login-input"/><br /><br />
                  <label><i class="fas fa-lock"></i></label>
                  <input type = "password" name = "password" placeholder="Password" class="login-input"/><br/><br />
                  <input class='btn' type = "submit" value = " Log In" /><br />
               </form>

               <div class="register">
                 <a href="#">Register</a>
               </div>

               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>

            </div>

         </div>

      </div>

   </body>
</html>
