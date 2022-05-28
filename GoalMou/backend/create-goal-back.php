<?php
  require_once 'dbconnect.php';

  /*** Database Connection Test ***/
  // if($conn) {
  //   echo 'database connected';
  // }

  /*** Submit Test **/
  // if(isset($_GET['submit'])){
  //   echo $_GET['goal-title'];
  //   echo $_GET['completion-date'];
  //   echo $_GET['goal-category'];
  //   foreach($_GET as $cat => $items) {
  //     echo $cat . " = " . $items . "<br>";
  //   }
  // }

  // $actionNumber = 1;
  // while(true) {
  //   try {
  //     $temp = "action-" . $actionNumber;
  //     echo $_GET[$temp];
      
  //     $activityNumber = 1;
  //     while(true) {
  //       try {
  //         $temp = "activity-" . $actionNumber . "-" . $activityNumber;
  //         echo $_GET[$temp];
            
  //       } catch (Exception $e) {
  //         break;
  //       }
  //       $activityNumber ++;
  //     }
    
  //   } catch (Exception $e) {
  //     break;
  //   }
  //   $actionNumber ++;
  // }
  

  

  // Remove possible harmful input
  if(isset($_POST['submit'])) {
    // $actionNumber = 1;
    // $toStore = array();
    // while(true) {
    //   $temp = "action-" . $actionNumber;
    //   if(isset($_POST[$temp])) {
    //     // Push actions into array
    //     ${$temp} = array($_POST[$temp]);
    //     array_push($toStore, ${$temp});
    //   } else {
    //     break;
    //   }
    //   $activityNumber = 1;
    //   while(true) {
    //     $temp2 = "activity-" . $actionNumber . "-" . $activityNumber;
    //     if(isset($_POST[$temp2])) {
    //       // Push activities into array
    //       // array_push($toStore[$actionNumber - 1], $_POST[$temp2]);
    //       array_push($toStore[$actionNumber - 1], array($_POST[$temp2], 0));
    //     } else {
    //       break;
    //     }
    //     $activityNumber ++;
    //   }
    //   $actionNumber ++;
    // }
    $goal_id = uniqid();
    $actionNumber = 1;

    while(true) {
      $unique_id = uniqid();
      $temp = "action-" . $actionNumber;
      if(isset($_POST[$temp])) {
        // Push actions into array
        $sql_action = "INSERT INTO action_plan (action_id, goal_id, content) VALUES ('$unique_id', '$goal_id', '$_POST[$temp]')";
        if (mysqli_query($link, $sql_action)) {
          // echo "Action plan success";
        }
      } else {
        break;
      }
      $activityNumber = 1;
      while(true) {
        $activityCode = "activity-" . $actionNumber . "-" . $activityNumber;
        if(isset($_POST[$activityCode])) {
          // Push activity to database
          $done = false;
          $sql_activity = "INSERT INTO activity (action_id, content, done) VALUES ('$unique_id', '$_POST[$activityCode]', false)";
          if (mysqli_query($link, $sql_activity)) {
            // echo "activity success";
          }
        } else {
          break;
        }
        $activityNumber ++;
      }
      $actionNumber ++;
    }

    $title = mysqli_real_escape_string($link, $_POST['goal-title']);
    $toComplete = $_POST['to-complete-date'];
    $category = $_POST['goal-category'];
    $description = mysqli_real_escape_string($link, $_POST['goal-description']);

    $sql = "INSERT INTO goal(goal_id,title,due_date,category,description) VALUES('$goal_id','$title','$toComplete','$category','$description')";
  
    if(mysqli_query($link, $sql)){
      // Success
      header("Location: http://localhost/Web%20Programming/Assignment/GoalTracker/GoalMou/create-goal.php");
      die();
    } else {
      echo "query error: " . mysqli_error($conn);
    }
  }
?>
