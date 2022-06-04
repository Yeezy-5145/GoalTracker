<?php
  require_once "backend/session.php";
  session_unset();
  session_destroy();

  if(!isset($_SESSION['loggedin'])) {
    header("location: goal.php");
  }
?>