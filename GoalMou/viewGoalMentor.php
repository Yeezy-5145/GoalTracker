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
      setcookie("completion_status", $completion_status);

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

    }

    if (isset($_POST['submit'])) {
      // echo $_POST['mentor_name'];
      // echo $_POST['content'];
      // echo $_POST['rating'];      
      // $mentor_name = $content = $rating = "";
      
      $mentor_name = $_POST['mentor_name'];
      $content = $_POST['content'];
      $rating = $_POST['rating'];
      $goal_id = $goal['goal_id'];
      $image = "./images/bird.gif";

      if($mentor_name == "") {
        $mentor_name = "Anonymous";
      }
      $sql = "INSERT INTO comment(goal_id, mentor_name, content, rating, image) VALUES('$goal_id', '$mentor_name', '$content', '$rating', '$image') ";
      if(mysqli_query($link, $sql)) {
        print_r($goal_id);
        header('Location: viewGoalMentor.php?id='.$goal['goal_id']);
      }
    }

  
    mysqli_free_result($result);
      mysqli_free_result($result_comment);
      mysqli_free_result($result_actionPlan);
      mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8 without BOM" />
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
    <title>View Goal</title>
  </head>
  <body>
    <div class="wrapper">
      <div class="goal viewGoal">
        <div class="imgArea">
          <img src="./images/transparent-logo-square.png" alt="" />
          <h1>GoalMou</h1>
        </div>
        <!--  Title  -->
        <div class="row">
          <i class="fa fa-bullseye"></i>
          <h1 style="color: var(--skin-color)">
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
              <p class="due-date-text">
              <?php echo htmlspecialchars($goal['due_date']) ?>
              </p>
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
            <p>
              <?php echo htmlspecialchars($goal['category']) ?>
            </p>
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
            <p> <?php echo htmlspecialchars($goal['description']) ?></p>

            </ul>
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
                          <?php if($activities[$i][$j]['done'] != 0) { ?>
                            <input 
                            checked
                            type="checkbox" 
                            name="checkdone[]"
                            value="<?php echo $activities[$i][$j]['activity_id'] ?>" 
                            class="checkDone check-<?php echo $i ?>-<?php echo $j ?>"
                            onclick="return false;"
                          />
                            <?php } else { ?>
                              <input 
                                type="checkbox" 
                                name="checkdone[]" 
                                value="<?php echo $activities[$i][$j]['activity_id'] ?>"
                                class="checkDone check-<?php echo $i ?>-<?php echo $j ?>"
                                onclick="return false;"
                              />
                              <?php } ?>
                              <!-- <input 
                                type="checkbox" 
                                name="checkdone" 
                                class="checkDone check-<?php echo $i ?>-<?php echo $j ?>"
                                onclick="checkDone(<?php echo $i ?>, <?php echo $j ?>)"
                              /> -->

                            </div>
                          </div>
                        </li>
                        <?php } ?>
                      </ul>
                    </li>
                    
                    <?php } ?>
                  </form>
            </ol>
          </div>
        </div>

        <!-- Comments -->
        <div class="row">
          <i class="fa fa-comment"></i>
          <div class="comments">
            <h2 class="comments-title" style="color: var(--skin-color)">
              Comments
            </h2>
            <form action="viewGoalMentor.php?id=<?php echo htmlspecialchars($goal['goal_id']) ?>" method="POST">
              <input
                name="mentor_name"
                class="usernameArea"
                type="text"
                placeholder="Enter your name (optional)"
              ></input>
              <input
                name="content"
                class="commentArea"
                type="text"
                placeholder="Leave an advice or encouragement..."
                required
              ></input>

              <div class="rating">
                <p>Rating:</p>
                <select name="rating" class="rating-stars">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
                <p>star(s)</p>
              </div>

              <div class="comment-button-area">
                <input name="submit" type="submit" value="Comment" class="commentButton" />
              </div>
            </form>

            <div class="comments-list">
              <?php for($i = count($comments) - 1; $i >= 0; $i-=1) { ?> 
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

        <!-- Progress bar -->
        <div class="progress-bar-mentor">
          <div class="percentage" style="width:  <?php echo htmlspecialchars($goal['completion_status']) ?>% ">
            <span class="percentage-text"> <?php echo htmlspecialchars($goal['completion_status']) ?>%</span>
          </div>
        </div>

        <!-- Style Switcher  -->
        <div class="style-switcher styleView" style="top: 10px; right: 20px">
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

    <script>
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
    <!-- <script src="./javascript/viewGoal.js"></script> -->
  </body>
</html>
