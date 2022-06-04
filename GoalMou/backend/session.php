<?php
  session_start();

  // if there is no user, return the user to login page
  if(!isset($_SESSION["user_id"])){
    header("Location: goal.php");
    exit();
  }
?>