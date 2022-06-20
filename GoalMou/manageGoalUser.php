<?php
    include('backend/dbconnect.php');

    
    if (isset($_GET['id'])) {
        $id = mysqli_real_escape_string($link, $_GET['id']);

        // Goal
        $sql = "SELECT * FROM goal WHERE goal_id = '$id'";
        $result = mysqli_query($link, $sql);
        $goal = mysqli_fetch_assoc($result);
        $goal_id = $goal['goal_id'];
        // set completion status
        $completion_status = $goal['completion_status'];
        // echo "First" . $completion_status;
        // setcookie("completion_status", $completion_status);

        // Comment table
        $sql_comment = "SELECT * FROM comment WHERE goal_id = '$id'";
        $result_comment = mysqli_query($link, $sql_comment);
        $comments = mysqli_fetch_all($result_comment, MYSQLI_ASSOC);

        // Action plan
        $sql_action = "SELECT * FROM action_plan WHERE goal_id = '$id'";
        $result_actionPlan = mysqli_query($link, $sql_action);
        $action_plans = mysqli_fetch_all($result_actionPlan, MYSQLI_ASSOC);

        // Activity
        $activities = array();
        $activitiesDone = array();
        for ($i = 0; $i < count($action_plans); $i+=1) {
          $action_id = $action_plans[$i]['action_id'];
          // echo "action id:" . $action_id . "<br>";
          $sql_activity = "SELECT * FROM activity WHERE action_id = '$action_id'";
          $result_activity = mysqli_query($link, $sql_activity);
          $activity = mysqli_fetch_all($result_activity, MYSQLI_ASSOC);
          array_push($activities, $activity);
          if ($i == count($action_plans) - 1) {
            mysqli_free_result($result_activity);
          }

          // $sql = "SELECT * FROM activity WHERE action_id = '$action_id' && done = true";
          // $result_done = mysqli_query($link, $sql);
          // $doneActivities = mysqli_fetch_all($result_done, MYSQLI_ASSOC);
          for ($j = 0; $j < count($activity); $j+=1) {
            if ($activity[$j]['done'] == 1) {
              array_push($activitiesDone, $action_id);
            }
          }
        }

        // Put all activties in one array
        $allActivitiesInOneArray = array();
          for ($i = 0; $i < count($activities); $i+=1) {
            for ($j = 0; $j < count($activities[$i]); $j+=1) {
              array_push($allActivitiesInOneArray, $activities[$i][$j]);
            }
          }

          // Get length of all activities
          // print_r($activities);
          $totalLengthActivities = count($allActivitiesInOneArray);
          // echo "Total: " . $totalLengthActivities . "<br>";

        // Activity done
        // print_r($activitiesDone);
        $totalLengthDoneActivities = count($activitiesDone);
        // echo "Done: " . count($activitiesDone) . "<br>";

        // Calculate percentage
        if ($totalLengthActivities !== 0) {

          $completion_status = ($totalLengthDoneActivities / $totalLengthActivities) * 100;
          $completion_status = number_format($completion_status, 0);
          $sql_percent = "UPDATE goal SET completion_status = $completion_status WHERE goal_id = '$goal_id'";
          if (mysqli_query($link, $sql_percent)) {
            // echo "complete" . $completion_status; 
            // echo "Update percentage";
          }
          setcookie("completion_status", $completion_status);
        } else {
          $sql_percent = "UPDATE goal SET completion_status = 0 WHERE goal_id = '$goal_id'";
          if (mysqli_query($link, $sql_percent)) {
            // echo "complete" . $completion_status; 
            // echo "Update percentage";
          }
          setcookie("completion_status", $completion_status);
        }
        // Fetch goal again to update percentage
        $sql = "SELECT * FROM goal WHERE goal_id = '$id'";
        $result = mysqli_query($link, $sql);
        $goal = mysqli_fetch_assoc($result);

      }

      // save progress - edit
      if (isset($_POST['saveProgressEdit'])) {
        // print_r($_POST['checkdone']);

        $noCheck = array();
        if(!empty($_POST['checkdone'])) {    
          foreach($_POST['checkdone'] as $activity_id){
            // echo "value : ".$activity_id.'<br/>';

            $sql_checkDone = "UPDATE activity SET done = 1 WHERE activity_id = '$activity_id'";
            if(mysqli_query($link, $sql_checkDone)) {
              // echo "Check success <br>";
            }
          }

          for ($i = 0; $i < count($allActivitiesInOneArray); $i+=1) {
            echo "<br>" . $allActivitiesInOneArray[$i]['activity_id'];
            $existed = false;
            for ($j = 0; $j < count($_POST['checkdone']); $j+=1) {
              echo "<br>check only: " . $_POST['checkdone'][$j];
              if ($allActivitiesInOneArray[$i]['activity_id'] == $_POST['checkdone'][$j]) {
                echo "<br> " . $allActivitiesInOneArray[$i]['activity_id'] . "==" . $_POST['checkdone'][$j];
                $existed = true;
              }
            }
            if (!$existed) {
              echo "<br>left" . $allActivitiesInOneArray[$i]['activity_id'];
              array_push($noCheck, $allActivitiesInOneArray[$i]['activity_id']);
            }
          }
        } else {
          // all no check
          for($i = 0; $i < count($allActivitiesInOneArray); $i+=1) {
            $noCheck_acId = $allActivitiesInOneArray[$i]['activity_id'];
            $sql_noCheckDone = "UPDATE activity SET done = 0 WHERE activity_id = '$noCheck_acId'";
            if(mysqli_query($link, $sql_noCheckDone)) {
               // echo "Check success <br>";
            }
          }
        }

        // uncheck the one that checked before
        echo " <br> Final nocheck: ";
        print_r($noCheck);
        for($i = 0; $i < count($noCheck); $i+=1) {
          $noCheck_acId = $noCheck[$i];
          $sql_noCheckDone = "UPDATE activity SET done = 0 WHERE activity_id = '$noCheck_acId'";
          if(mysqli_query($link, $sql_noCheckDone)) {
            // echo "Check success <br>";
            }
          }

          // Action plan
        $sql_action = "SELECT * FROM action_plan WHERE goal_id = '$id'";
        $result_actionPlan = mysqli_query($link, $sql_action);
        $action_plans = mysqli_fetch_all($result_actionPlan, MYSQLI_ASSOC);

        // Activity
        $activities = array();
        $activitiesDone = array();
        for ($i = 0; $i < count($action_plans); $i+=1) {
          $action_id = $action_plans[$i]['action_id'];
          // echo "action id:" . $action_id . "<br>";
          $sql_activity = "SELECT * FROM activity WHERE action_id = '$action_id'";
          $result_activity = mysqli_query($link, $sql_activity);
          $activity = mysqli_fetch_all($result_activity, MYSQLI_ASSOC);
          array_push($activities, $activity);
          if ($i == count($action_plans) - 1) {
            mysqli_free_result($result_activity);
          }

          // $sql = "SELECT * FROM activity WHERE action_id = '$action_id' && done = true";
          // $result_done = mysqli_query($link, $sql);
          // $doneActivities = mysqli_fetch_all($result_done, MYSQLI_ASSOC);
          for ($j = 0; $j < count($activity); $j+=1) {
            if ($activity[$j]['done'] == 1) {
              array_push($activitiesDone, $action_id);
            }
          }
        }

        // Put all activties in one array
        $allActivitiesInOneArray = array();
          for ($i = 0; $i < count($activities); $i+=1) {
            for ($j = 0; $j < count($activities[$i]); $j+=1) {
              array_push($allActivitiesInOneArray, $activities[$i][$j]);
            }
          }

          // Get length of all activities
          // print_r($activities);
          $totalLengthActivities = count($allActivitiesInOneArray);
          // echo "Total: " . $totalLengthActivities . "<br>";

        // Activity done
        // print_r($activitiesDone);
        $totalLengthDoneActivities = count($activitiesDone);
        // echo "Done: " . count($activitiesDone) . "<br>";

        // Calculate percentage
        if ($totalLengthActivities !== 0) {

          $completion_status = ($totalLengthDoneActivities / $totalLengthActivities) * 100;
          $completion_status = number_format($completion_status, 0);
          $sql_percent = "UPDATE goal SET completion_status = $completion_status WHERE goal_id = '$goal_id'";
          if (mysqli_query($link, $sql_percent)) {
            // echo "complete" . $completion_status; 
            // echo "Update percentage";
          }
          setcookie("completion_status", $completion_status);
        } else {
          $sql_percent = "UPDATE goal SET completion_status = 0 WHERE goal_id = '$goal_id'";
          if (mysqli_query($link, $sql_percent)) {
            // echo "complete" . $completion_status; 
            // echo "Update percentage";
          }
          setcookie("completion_status", $completion_status);
        }

        

        header("Location: editGoal.php?id=$goal_id");
      }
      
      // save progress - back
      if (isset($_POST['saveProgressBack'])) {
        // print_r($_POST['checkdone']);

        $noCheck = array();
        if(!empty($_POST['checkdone'])) {    
          foreach($_POST['checkdone'] as $activity_id){
            // echo "value : ".$activity_id.'<br/>';

            $sql_checkDone = "UPDATE activity SET done = 1 WHERE activity_id = '$activity_id'";
            if(mysqli_query($link, $sql_checkDone)) {
              // echo "Check success <br>";
            }
          }

          for ($i = 0; $i < count($allActivitiesInOneArray); $i+=1) {
            echo "<br>" . $allActivitiesInOneArray[$i]['activity_id'];
            $existed = false;
            for ($j = 0; $j < count($_POST['checkdone']); $j+=1) {
              echo "<br>check only: " . $_POST['checkdone'][$j];
              if ($allActivitiesInOneArray[$i]['activity_id'] == $_POST['checkdone'][$j]) {
                echo "<br> " . $allActivitiesInOneArray[$i]['activity_id'] . "==" . $_POST['checkdone'][$j];
                $existed = true;
              }
            }
            if (!$existed) {
              echo "<br>left" . $allActivitiesInOneArray[$i]['activity_id'];
              array_push($noCheck, $allActivitiesInOneArray[$i]['activity_id']);
            }
          }
        } else {
          // all no check
          for($i = 0; $i < count($allActivitiesInOneArray); $i+=1) {
            $noCheck_acId = $allActivitiesInOneArray[$i]['activity_id'];
            $sql_noCheckDone = "UPDATE activity SET done = 0 WHERE activity_id = '$noCheck_acId'";
            if(mysqli_query($link, $sql_noCheckDone)) {
               // echo "Check success <br>";
            }
          }
        }

        // uncheck the one that checked before
        echo " <br> Final nocheck: ";
        print_r($noCheck);
        for($i = 0; $i < count($noCheck); $i+=1) {
          $noCheck_acId = $noCheck[$i];
          $sql_noCheckDone = "UPDATE activity SET done = 0 WHERE activity_id = '$noCheck_acId'";
          if(mysqli_query($link, $sql_noCheckDone)) {
            // echo "Check success <br>";
            }
          }

        // Action plan
        $sql_action = "SELECT * FROM action_plan WHERE goal_id = '$id'";
        $result_actionPlan = mysqli_query($link, $sql_action);
        $action_plans = mysqli_fetch_all($result_actionPlan, MYSQLI_ASSOC);

        // Activity
        $activities = array();
        $activitiesDone = array();
        for ($i = 0; $i < count($action_plans); $i+=1) {
          $action_id = $action_plans[$i]['action_id'];
          // echo "action id:" . $action_id . "<br>";
          $sql_activity = "SELECT * FROM activity WHERE action_id = '$action_id'";
          $result_activity = mysqli_query($link, $sql_activity);
          $activity = mysqli_fetch_all($result_activity, MYSQLI_ASSOC);
          array_push($activities, $activity);
          if ($i == count($action_plans) - 1) {
            mysqli_free_result($result_activity);
          }

          // $sql = "SELECT * FROM activity WHERE action_id = '$action_id' && done = true";
          // $result_done = mysqli_query($link, $sql);
          // $doneActivities = mysqli_fetch_all($result_done, MYSQLI_ASSOC);
          for ($j = 0; $j < count($activity); $j+=1) {
            if ($activity[$j]['done'] == 1) {
              array_push($activitiesDone, $action_id);
            }
          }
        }

        // Put all activties in one array
        $allActivitiesInOneArray = array();
          for ($i = 0; $i < count($activities); $i+=1) {
            for ($j = 0; $j < count($activities[$i]); $j+=1) {
              array_push($allActivitiesInOneArray, $activities[$i][$j]);
            }
          }

          // Get length of all activities
          // print_r($activities);
          $totalLengthActivities = count($allActivitiesInOneArray);
          // echo "Total: " . $totalLengthActivities . "<br>";

        // Activity done
        // print_r($activitiesDone);
        $totalLengthDoneActivities = count($activitiesDone);
        // echo "Done: " . count($activitiesDone) . "<br>";

        // Calculate percentage
        if ($totalLengthActivities !== 0) {

          $completion_status = ($totalLengthDoneActivities / $totalLengthActivities) * 100;
          $completion_status = number_format($completion_status, 0);
          $sql_percent = "UPDATE goal SET completion_status = $completion_status WHERE goal_id = '$goal_id'";
          if (mysqli_query($link, $sql_percent)) {
            // echo "complete" . $completion_status; 
            // echo "Update percentage";
          }
          setcookie("completion_status", $completion_status);
        } else {
          $sql_percent = "UPDATE goal SET completion_status = 0 WHERE goal_id = '$goal_id'";
          if (mysqli_query($link, $sql_percent)) {
            // echo "complete" . $completion_status; 
            // echo "Update percentage";
          }
          setcookie("completion_status", $completion_status);
        }

       
        
        header("Location: goalList_1.php");
      }

      

      // if (isset($_COOKIE['completion_status'])) {
      //   // echo "Current: " . $_COOKIE['completion_status'];
        
      //   $percentage = $_COOKIE['completion_status'];

      //   if (count($action_plans) > 0) {
      //     $percentage = ($numberOfDone / $totalActivity) * 100;
      //     $percentage = number_format($percentage, 0);
      //     setcookie("completion_status", $percentage);

      //     $sql_percent = "UPDATE goal SET completion_status = $percentage WHERE goal_id = '$goal_id'";
      //     if (mysqli_query($link, $sql_percent)) {
      //       // echo "Update percentage";
      //     }
      //   } else {
      //     $sql_percent = "UPDATE goal SET completion_status = 0 WHERE goal_id = '$goal_id'";
      //     if (mysqli_query($link, $sql_percent)) {
      //       // echo "Update percentage";
      //     }
      //   }
      // }

      // Goal
      // $sql = "SELECT * FROM goal WHERE goal_id = $id";
      // $result = mysqli_query($link, $sql);
      // $goal = mysqli_fetch_assoc($result);
      // $goal_id = $goal['goal_id'];
      // // set completion status
      // $completion_status = $goal['completion_status'];
      // // setcookie("completion_status", $completion_status);
      

      // // Action plan
      // $sql_action = "SELECT * FROM action_plan WHERE goal_id = $id";
      // $result_actionPlan = mysqli_query($link, $sql_action);
      // $action_plans = mysqli_fetch_all($result_actionPlan, MYSQLI_ASSOC);

      // // Activity
      // $activities = array();
      // for ($i = 0; $i < count($action_plans); $i+=1) {
      //   $action_id = $action_plans[$i]['action_id'];
      //   // echo "action id:" . $action_id . "<br>";
      //   $sql_activity = "SELECT * FROM activity WHERE action_id = '$action_id'";
      //   $result_activity = mysqli_query($link, $sql_activity);
      //   $activity = mysqli_fetch_all($result_activity, MYSQLI_ASSOC);
      //   array_push($activities, $activity);
      //   if ($i == count($action_plans) - 1) {
      //     mysqli_free_result($result_activity);
      //   }
      // }

      // // Activity done
      // $sql = "SELECT * FROM activity WHERE done = 1";
      // $result_done = mysqli_query($link, $sql);
      // $doneActivities = mysqli_fetch_all($result_done, MYSQLI_ASSOC);
      // $numberOfDone = count($doneActivities);
      // echo "Number of done:" . $numberOfDone . "<br>";
      
      mysqli_free_result($result);
      mysqli_free_result($result_comment);
      mysqli_free_result($result_actionPlan);
      mysqli_close($link);
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="shortcut icon"
      href="./images/transparent-logo-square.png"
      type="image/x-icon"
    />
    <!-- Style Switcher -->
    <link
      rel="stylesheet"
      href="./stylesheets/skins/color-1.css"
      class="alternate-style"
      title="color-1"
      disabled
    />
    <link
      rel="stylesheet"
      href="./stylesheets/skins/color-2.css"
      class="alternate-style"
      title="color-2"
      disabled
    />
    <link
      rel="stylesheet"
      href="./stylesheets/skins/color-3.css"
      class="alternate-style"
      title="color-3"
      disabled
    />
    <link
      rel="stylesheet"
      href="./stylesheets/skins/color-4.css"
      class="alternate-style"
      title="color-4"
      disabled
    />
    <link
      rel="stylesheet"
      href="./stylesheets/skins/color-5.css"
      class="alternate-style"
      title="color-5"
      disabled
    />
    <link
      rel="stylesheet"
      href="./stylesheets/skins/color-6.css"
      class="alternate-style"
      title="color-6"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    />
    <link rel="stylesheet" href="./stylesheets/manageGoal.css" />
    <title>Manage Goal</title>
  </head>
  <body>
    <div class="wrapper">
      <div class="goal">
      <div class="imgArea">
          <img src="./images/transparent-logo-square.png" alt="" />
          <h1>GoalMou</h1>
        </div>
        <!--  Title  -->
        <div class="row">
          <i class="fa fa-bullseye"></i>
          <h1 style="color: var(--skin-color)" >
            <?php echo htmlspecialchars($goal['title']) ?>
          </h1>
        </div>

        <!--  Due date  -->
        <div class="row">
          <i class="fa fa-calendar"></i>
          <div class="due-date-content">
            <h2 class="due-date-title" style="color: var(--skin-color)">
              Due Date
            </h2>
            <div class="due-date">
              <p class="due-date-text" >
                <?php echo htmlspecialchars($goal['due_date']) ?>
              </p>
              <input
                onchange="changeDate(event)"
                type="datetime-local"
                name="due-date"
                class="due-date-choice"
              />
            </div>
          </div>
        </div>

        <!--  Category  -->
        <div class="row">
          <i class="fa fa-list"></i>
          <div class="category-content">
            <h2 class="category-title" style="color: var(--skin-color)">
              Category
            </h2>
            <p class="category"><?php echo htmlspecialchars($goal['category']) ?></p>
          </div>
        </div>

        <!--  Description  -->
        <div class="row">
          <i class="fa fa-marker"></i>
          <div class="description-list">
            <div class="description-header">
              <h2 class="description-title" style="color: var(--skin-color)">
                Description
              </h2>
            </div>
            <div class="newDescriptionArea"></div>
            <p class="description"> <?php echo htmlspecialchars($goal['description']) ?></p>
          </div>
        </div>

        <!--  Action plan  -->
        <div class="row">
          <i class="fa fa-list-1-2"></i>
          <div class="action-plans">
            <div class="action-plans-header">
              <h2 class="action-plans-title" style="color: var(--skin-color)">
                Action Plans
              </h2>
            </div>
            
            <?php if(count($action_plans) > 0) { ?>
            <ol class="step-ul">
              <form action="" method="POST">
              <?php for($i = 0; $i < count($action_plans); $i+=1) { ?>
              <li class="step-ul-li">
                <div class="step">
                  <p>
                    <?php echo $action_plans[$i]['content'] ?>
                  </p>
                </div>

                <ul class="sub-step-ol">
                  <?php for($j = 0; $j < count($activities[$i]); $j+=1 ) { ?>
                  <li>
                    <div class="sub-step">
                      <p contenteditable="true">
                        <?php echo $activities[$i][$j]['content'] ?>
                      </p>
                      <div>
                          <?php if($activities[$i][$j]['done'] == 0) { ?>
                            <input 
                            
                            type="checkbox" 
                            name="checkdone[]"
                            value="<?php echo $activities[$i][$j]['activity_id'] ?>" 
                            class="checkDone check-<?php echo $i ?>-<?php echo $j ?>"
                            onclick="checkDone(<?php echo $i ?>, <?php echo $j ?>, <?php echo $activities[$i][$j]['activity_id'] ?>)"
                          />
                            <?php } else { ?>
                              <input 
                                checked
                                type="checkbox" 
                                name="checkdone[]" 
                                value="<?php echo $activities[$i][$j]['activity_id'] ?>"
                                class="checkDone check-<?php echo $i ?>-<?php echo $j ?>"
                                onclick="checkDone(<?php echo $i ?>, <?php echo $j ?>, <?php $activities[$i][$j]['activity_id'] ?>)"
                              />
                              <?php } ?>

                              <!-- Edit -->
                              <a href="editGoal.php?id=<?php echo $goal['goal_id'] ?>" class="editButton">
                                <!-- <button>Edit</button> -->
                                <div>
                                  <input name="saveProgressEdit" type="submit" value="Edit" onclick="saveCheckResult()">
                                  <!-- <i class="fa fa-edit editManage"></i> -->
                                </div>
                              </a>
                              
                              <!-- <div class="editButton">
                              </div> -->

                              <!-- Back icon -->
                              <div>
                                <div class="close-icon">
                                  <!-- <i class="fa fa-arrow-left" title="Back"></i> -->
                                  <input name="saveProgressBack" type="submit" value="Back" onclick="saveCheckResult()">
                                </div>
                              </div>
                            </div>
                          </div>
                        </li>
                        <?php } ?>
                      </ul>
                    </li>
                    
                    <?php } ?>
                  </form>
            </ol>
            <?php } else { ?>
                <!-- Back icon -->
                <a href="goalList_1.php">
                  <div class="close-icon">
                    <!-- <i class="fa fa-arrow-left" title="Back"></i> -->
                    <input name="saveProgressBack" type="submit" value="Back" onclick="saveCheckResult()">
                  </div>
                </a>

                <!-- Edit -->
                <a href="editGoal.php?id=<?php echo $goal['goal_id'] ?>" class="editButton" onclick="saveCheckResult()">
                  <!-- <button>Edit</button> -->
                    <div>
                      <input name="saveProgressEdit" type="submit" value="Edit">
                      <!-- <i class="fa fa-edit editManage"></i> -->
                    </div>
                </a>

            <?php } ?>
          </div>
        </div>

        <!-- Comments -->
        <div class="row">
          <i class="fa fa-comment"></i>
          <div class="comments">
            <h2 class="comments-title" style="color: var(--skin-color)">
              Comments
            </h2>

            <div class="comments-list">
              <?php for($i = count($comments) - 1; $i >= 0 ; $i-=1) { ?> 
              <div class="comment">
                <div class="comment-photo-name">
                  <img src="<?php echo htmlspecialchars($comments[$i]['image']) ?>" alt="user-photo" />
                  <p><?php echo htmlspecialchars($comments[$i]['mentor_name']) ?></p>
                  <p class="comment-time"><?php echo htmlspecialchars($comments[$i]['time']) ?></p>
                </div>
                <p class="text">
                <?php echo htmlspecialchars($comments[$i]['content']) ?>
                </p>
                <div class="rating-part">
                  <?php for($j = 0; $j < $comments[$i]['rating']; $j+=1) { ?>
                    <i class="fa fa-star" style="color: gold"></i>
                  <?php } ?>
                </div>
              </div>

              <hr />
              <?php } ?>
            </div>
          </div>
        </div>

        <!-- Back icon -->
        <!-- <a href="goalList_1.php?home=true">
          <div class="close-icon">
            <i class="fa fa-arrow-left" title="Back"></i>
            <h4>Back</h4>
          </div>
        </a> -->

        <!-- Progress bar -->
        <div class="progress-bar">
          <div class="percentage" style="width:  <?php echo htmlspecialchars($goal['completion_status']) ?>% ">
            <span class="percentage-text"> <?php echo htmlspecialchars($goal['completion_status']) ?>%</span>
          </div>
        </div>
        <!-- <div class="progress-bar">
          <div class="percentage" style="width: <?php echo htmlspecialchars($goal['completion_status']) ?>%">
            <span class="percentage-text"><?php echo htmlspecialchars($goal['completion_status']) ?>%</span>
          </div>
        </div> -->

        <!-- Edit -->
        <!-- <a href="editGoal.php?id=<?php echo $goal['goal_id'] ?>" class="editButton">
          <button>Edit</button>
        </a> -->

        <!-- Share Link -->
        <div class="share-link">
          <i class="fa fa-link" title="Copy link" onclick="copyURI(event, '<?php echo htmlspecialchars($goal['goal_id']) ?>')"></i>
          <img src="./images/LinkCopied.png" class="linkCopied" />
        </div>

        <!-- Style Switcher  -->
        <div class="style-switcher">
          <div class="style-switcher-toggler s-icon">
            <i class="fas fa-cog fa-spin" title="Color Theme"></i>
          </div>
          <div class="theme-color">
            <h4 style="text-align: center">Colors</h4>
            <div class="colors">
              <span
                class="color-1"
                onclick="setActivityStyle('color-1')"
              ></span>
              <span
                class="color-2"
                onclick="setActivityStyle('color-2')"
              ></span>
              <span
                class="color-3"
                onclick="setActivityStyle('color-3')"
              ></span>
              <span
                class="color-4"
                onclick="setActivityStyle('color-4')"
              ></span>
              <span
                class="color-5"
                onclick="setActivityStyle('color-5')"
              ></span>
              <span
                class="color-6"
                onclick="setActivityStyle('color-6')"
              ></span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      <?php
        echo "let completionStatus = '$completion_status';";
        echo "let totalActivity = '$totalLengthActivities';";
        echo "let numberOfDone = '$totalLengthDoneActivities';";
      ?>

    
      function checkDone(i, j, activity_id) {
        completionStatus = parseInt(completionStatus);
        numberOfDone = parseInt(numberOfDone);
        totalActivity = parseInt(totalActivity);
        console.log(typeof(completionStatus));
        console.log(typeof(numberOfDone));
        console.log(typeof(totalActivity));
        console.log(numberOfDone);
        console.log(totalActivity);

        let progress = document.querySelector(".percentage")
        let percentage = document.querySelector(".percentage-text")
        let checkDone = document.querySelector(`.check-${i}-${j}`)
        if (!checkDone.hasAttribute("checked")) {
          checkDone.setAttribute("checked", "true");
          numberOfDone+=1;
        } else {
          checkDone.removeAttribute("checked")
          numberOfDone-=1;
        }

        completionStatus = (numberOfDone / totalActivity) * 100;
        completionStatus = parseFloat(completionStatus).toFixed(0);
        console.log(numberOfDone);
        console.log(completionStatus);
        
        progress.style.width = `${completionStatus}%`
        percentage.innerHTML = `${completionStatus}%`
        document.cookie = "completion_status = " + completionStatus;
        if (completionStatus < 50) {
          console.log("50");
          percentage.style.color = "#000";
        } else {
          percentage.style.color = "#fff";
          
        }

        // location.reload();
      }
      
        function copyURI(e, id) {
          console.log(id);
          const linkCopied = document.querySelector(".linkCopied");

          // navigator.clipboard.writeText(window.location.href);
          navigator.clipboard.writeText(`http://localhost/GoalMou/GoalTracker/GoalMou/viewGoalMentor.php?id=${id}`);
          linkCopied.style.display = "block";
          setTimeout(() => {
            linkCopied.style.display = "none";
          }, 2000);
          console.log("123");
        }

        // Style-switcher
        const styleSwticher = document.querySelector(".style-switcher");
        const styleSwticherToggle = document.querySelector(".style-switcher-toggler");

        styleSwticherToggle.addEventListener("click", () => {
          styleSwticher.classList.toggle("open");
        });

        // Theme Color
        const alternateStyle = document.querySelectorAll(".alternate-style");

        function setActivityStyle(color) {
          alternateStyle.forEach((style) => {
            if (color === style.getAttribute("title")) {
              style.removeAttribute("disabled");
            } else {
              style.setAttribute("disabled", "true");
            }
          });
          styleSwticher.classList.remove("open");
        }

    
    </script>

    
    <!-- <script src="/javascript/style-swticher.js"></script> -->
    <!-- <script src="/javascript/main.js"></script> -->
  </body>
</html>