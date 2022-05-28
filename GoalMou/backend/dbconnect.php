<?php
    date_default_timezone_set("Asia/Kuala_Lumpur");

    //Store location of the database.
    $host="127.0.0.1";

    //A standard use for myPHP admin MySQL
    $port=3306;

    //The extend for port if the IP in the port is full
    $socket="";

    //database username
    $user="root";

    //Most of the time empty
    $password="";

    //Database name
    $dbname="goalmou";

    //Connection mysqli carry all define above variable to phpadmin
    //die - php immediately stop the function
    $link =new mysqli($host, $user, $password, $dbname, $port, $socket)
    or die('Could not connect to the database server'.mysqli_connect_error());
?>