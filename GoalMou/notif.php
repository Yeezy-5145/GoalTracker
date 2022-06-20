<?php
  require_once "backend/dbconnect.php";
  require_once "backend/session.php";
  $user_id = $_SESSION['user_id'];
?>

<!-- <!DOCTYPE html>
<html>
<head>
    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
    crossorigin="anonymous"
    />
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"
    />
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="./stylesheets/notif.css"/>
</head>
<body> -->
  <style>
    .notificationButton {
      background-color: transparent !important;
    }

  </style>
<div class="panel panel-default">
  <div class="panel-body">
    <!-- Single button -->
    <div class="btn-group pull-right top-head-dropdown">
      <!-- <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Notification <span class="caret"></span>
      </button> -->
      <button type="button" class="btn btn-default notificationButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <div class="bell">
        <i class="fa fa-bell"></i>
        <div class="unread"></div> 
      </div>
        <span class="caret"></span>
      </button>
      <ul class="dropdown-menu dropdown-menu-right">
        <li class="title-li">
          <h1 class="notif-title">Notification</h1>
        </li>
        <li>
            <?php
            // mentor comment //type M
            $sql = "SELECT comment.mentor_name, comment.time, goal.title, goal.goal_id
                    FROM comment
                    INNER JOIN goal ON goal.goal_id=comment.goal_id 
                    WHERE user_id='$user_id' ORDER BY comment.time DESC LIMIT 10;";
            $result = mysqli_query($link, $sql);
            $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
            mysqli_free_result($result);
            foreach($row as &$mentor){
                $mentor['due_date'] = $mentor['time'];
                unset($mentor['time']);
            }
            $rowNew = array_map(function ($temp) {
                 return $temp + array('type' => 'M'); 
                }, $row);
    
            // exceeded due date //type E
            $sql1 = "SELECT title, due_date, completion_status, goal_id FROM goal WHERE user_id='$user_id' ORDER BY due_date DESC LIMIT 10";
            $result1 = mysqli_query($link, $sql1);
            $row1 = mysqli_fetch_all($result1, MYSQLI_ASSOC);
            mysqli_free_result($result1);
            $rowNew1 = array_map(function ($temp) {
                return $temp + array('type' => 'E'); 
               }, $row1);
  
            // approaching due date //type A
            $sql2 = "SELECT title, due_date, completion_status, goal_id FROM goal WHERE user_id='$user_id' ORDER BY due_date DESC LIMIT 10";
            $result2 = mysqli_query($link, $sql2);
            $row2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);
            mysqli_free_result($result2);
            $rowNew2 = array_map(function ($temp) {
                return $temp + array('type' => 'A'); 
               }, $row2);

            // merge arrays
            $row3 = array_merge($rowNew, $rowNew1, $rowNew2);
            $notif = array();
            // print_r($row3);

            // sorting according to timestamp
            foreach ($row3 as $key => $row){
                $notif[$key] = $row['due_date'];
                    
            }
            array_multisort($notif, SORT_ASC, $row3);
            $dateNow = date_create();
            $date = date_format($dateNow,"Y-m-d");
            $date2 = date_format($dateNow, "Y-m-d H:i:s");

            // $date3 = (date_create($comment["due_date"]))->modify('-1 day');
            // print_r($date3);
            // print_r($date);
            // if(mysqli_num_rows($row) > 0){
            foreach ($row3 as $comment) {
                $output = '';
                if ($comment["type"] == "M"){
                    $output = '
                    <li>
                    <a href="manageGoalUser.php?id='.$comment["goal_id"].'" class="top-text-block">
                    <div class="top-text-heading">'.$comment["mentor_name"].' has commented on goal '.$comment["title"].'</div>
                    <div class="top-text-light">'.$comment["due_date"].'</div>
                    </a>
                    </li>
                    ';
                }elseif ($comment["type"] == "E" && $comment["completion_status"]<100 && ($date > $comment["due_date"])){
                    $output = '
                    <li>
                    <a href="manageGoalUser.php?id='.$comment["goal_id"].'" class="top-text-block">
                    <div class="top-text-heading">Your goal '.$comment["title"].' has exceeded its due date!</div>
                    <div class="top-text-light">'.$date2.'</div>
                    </a>
                    </li>
                    ';
                }elseif ($comment["type"] == "A" && $comment["completion_status"]<100){
                    $date3 = date('Y-m-d',strtotime($comment["due_date"]));
                    $date4 = (new \DateTime($date3))->modify('-1 day');
                    $date5 = date_format($date4,"Y-m-d");

                    if ($date > $date5){
                    $output = '
                        <li>
                        <a href="manageGoalUser.php?id='.$comment["goal_id"].'" class="top-text-block">
                        <div class="top-text-heading">Your due date for goal '.$comment["title"].' is approaching soon... D:</div>
                        <div class="top-text-light">'.$date2.'</div>
                        </a>
                        </li>
                        ';
                    }

                }
                echo $output;
            }
            ?>
      </ul>
    </div>
  </div>
</div>
    <!-- <script
      src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
      integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
      integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
      integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
      crossorigin="anonymous"
    ></script>
</body>
</html> -->