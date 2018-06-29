<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Register / Login</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>



  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <style>

    #loading-img{
      display:none;
    }

    .response_msg{
      margin-top:10px;
      font-size:13px;
      background:#E5D669;
      color:#ffffff;
      width:250px;
      padding:3px;
      display:none;
    }

    </style>

</head>
<body>

  <div class="container">
    <h3>Add a New Meal Below</h3>
    <form action="functions.php" method="post">
      <div class="form-group">
        <label for="meal_name">Meal Name:</label>
        <input type="text" name="meal_name" class="form-control" id="meal_name">
      </div>
      <div class="form-group">
        <label for="url">URL:</label>
        <input type="text" name="url" class="form-control" id="url">
      </div>
      <button type="submit" class="btn btn-default">Submit</button>
    </form>
  </div>

  <div class="response_msg"></div>
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!--
<script>
     $(document).ready(function(){
       $("#contact-form").on("submit",function(e){
         e.preventDefault();
         if($("#contact-form [name='meal_name']").val() === '')
           {
             $("#contact-form [name='meal_name']").css("border","1px solid red");
           }
         else if ($("#contact-form [name='your_email']").val() === '')
           {
             $("#contact-form [name='your_email']").css("border","1px solid red");
           }
         else
         {
           $("#loading-img").css("display","block");
           var sendData = $( this ).serialize();
           $.ajax({
             type: "POST",
             url: "get_response.php",
             data: sendData,
             success: function(data){
               $("#loading-img").css("display","none");
               $(".response_msg").text(data);
               $(".response_msg").slideDown().fadeOut(3000);
               $("#contact-form").find("input[type=text], input[type=email], textarea").val("");
             }
           });
         }
       });

       $("#contact-form input").blur(function(){
       var checkValue = $(this).val();
       if(checkValue != '')
         {
           $(this).css("border","1px solid #eeeeee");
         }
       });
     });
 </script>
 !-->

</body>
</html>
