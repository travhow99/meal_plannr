<?php
   session_start();

   if(session_destroy()) {
      header("Location: login.php?status=loggedout");
   }
   echo "Logged out successfully!";
?>
