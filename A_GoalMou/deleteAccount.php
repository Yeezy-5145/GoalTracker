<?php
$link = mysqli_connect('localhost', 'root', '','user_profile');
$del = $_POST['deleteAccount'];
$id = 1;
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
 }
 else{
        $sql = "DELETE FROM address WHERE user_id=$id ";
        mysqli_query($link, $sql);
        $sql2 = "DELETE FROM user WHERE user_id=$id ";
        mysqli_query($link, $sql2);
        echo "<script>alert('Account deleted successfully.');</script>";
        header("Refresh:0 url=goal.html");
 }
?>