<?php
require_once "backend/dbconnect.php";
$del = $_POST['deleteAccount'];
$id = $_SESSION['user_id'];
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
 }
 else{
        $sql = "DELETE FROM address WHERE user_id=$id ";
        mysqli_query($link, $sql);
        $sql2 = "DELETE FROM user WHERE user_id=$id ";
        mysqli_query($link, $sql2);
        echo "<script>alert('Account deleted successfully.');</script>";
        header("Refresh:0 url=goal.php");
 }
?>