<?php
    include('backend/dbconnect.php');

    
    if (isset($_GET['id'])) {
        $id = mysqli_real_escape_string($link, $_GET['id']);

        // Goal
        $sql = "SELECT * FROM goal WHERE goal_id = '$id'";
        $result = mysqli_query($link, $sql);
        $goal = mysqli_fetch_assoc($result);
        $goal_id = $goal['goal_id'];

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
        for ($i = 0; $i < count($action_plans); $i+=1) {
          $action_id = $action_plans[$i]['action_id'];
          // echo "action id:" . $action_id . "<br>";
          $sql_activity = "SELECT * FROM activity WHERE action_id = '$action_id'";
          $result_activity = mysqli_query($link, $sql_activity);
          $activity = mysqli_fetch_all($result_activity, MYSQLI_ASSOC);
          // echo "One activity:";
          // print_r($activity);
          // echo "<br><br>";
          array_push($activities, $activity);

          if($i == count($action_plans) - 1) {
            mysqli_free_result($result_activity);
            // echo "display";
          }
        }


        mysqli_free_result($result);
        mysqli_free_result($result_comment);
        mysqli_free_result($result_actionPlan);
      }

    if (isset($_POST['save'])) {
      echo "testing";

      // Update action plan
      $sql_action = "SELECT * FROM action_plan WHERE goal_id = '$id'";
      $result_actionPlan = mysqli_query($link, $sql_action);
      $action_plans = mysqli_fetch_all($result_actionPlan, MYSQLI_ASSOC);
      $length_actionPlan = count($action_plans);
      
      for ($i = 0; $i < $length_actionPlan; $i+=1) {
        print_r($_POST["editMainInput-$i"]); // test
        echo "<br><br>";

        // Update action plan
        $new_actionContent = $_POST["editMainInput-$i"];
        $current_actionPlan = $action_plans[$i];
        $action_id = $current_actionPlan['action_id'];

        $sql_updateActionPlan = "UPDATE action_plan SET content = '$new_actionContent' WHERE action_id = '$action_id' ";
        if (mysqli_query($link, $sql_updateActionPlan)) {
          echo "Action plan Success";
        }

        // Update activity
        // print_r($_POST['editActivityInput-4-0']);
        $sql_activity = "SELECT * FROM activity WHERE action_id = '$action_id'";
        $result_activity = mysqli_query($link, $sql_activity);
        $activities = mysqli_fetch_all($result_activity, MYSQLI_ASSOC);
        $length_activity = count($activities);

        for ($j = 0; $j < $length_activity; $j+=1) {
          $new_acticityContent = $_POST["editActivityInput-$i-$j"];
          $currentActivity = $activities[$j];
          $activity_id = $currentActivity['activity_id'];
          $sql_updateActivity = "UPDATE activity SET content = '$new_acticityContent' WHERE activity_id = '$activity_id'";
          if (mysqli_query($link, $sql_updateActivity)) {
            echo "Activity Success";
          }
        }
      }

      // Insert new activity in existing action plan
      if (isset($_COOKIE['newActivities'])) {
        $newActivitiesArray = explode(",", $_COOKIE['newActivities']);
        print_r($newActivitiesArray);

        for ($i = 0; $i < count($newActivitiesArray) ;$i+=2) {
          $activityContent = $_POST[$newActivitiesArray[$i]];
          echo gettype($activity) . "<br>";
          $ac_id = $newActivitiesArray[$i + 1];
          echo $ac_id . "<br>";
          $done = false;
          $sql_newActivity = "INSERT INTO activity (action_id, content, done) VALUES ('$ac_id', '$activityContent', '$done')";
          if (mysqli_query($link, $sql_newActivity)) {
            echo "new activity success";
            setcookie("newActivities", "");
          }
        }

      }

      $title = $_POST['title'];
      $due_date =  $_POST['due_date'];
      // echo date("c", strtotime($_POST['due_date']));
      // echo $_POST['category'];
      if(!empty($_POST['category'])) {
        foreach($_POST['category'] as $selected){
          $category =  ucfirst(str_replace("-", " ", $selected));
        }          
      } 
      $description = $_POST['description'];

      $sql = "UPDATE goal SET title='$title', due_date='$due_date', category='$category', description='$description' WHERE goal_id = '$id'";
      // $sql = "UPDATE goal SET title='$title', due_date='$due_date', category='$category', description='$description' WHERE goal_id=$goal['goal_id']";
      if(mysqli_query($link, $sql)) {
        print_r($goal_id);
        header('Location: manageGoalUser.php?id='.$goal['goal_id']);
      }

    }

    if(isset($_POST['delete'])) {
      $sql = "DELETE FROM goal WHERE goal_id='$id'";
      if(mysqli_query($link, $sql)) {
        print_r($goal_id);
        header('Location: goalList_1.php');
      }
    }

    if (isset($_POST['deleteActivity'])) {
      $activityId_and_length_and_actionId = explode("-", $_POST['deleteActivity']);
      $activity_id = $activityId_and_length_and_actionId[0];
      $length_activities = $activityId_and_length_and_actionId[1];
      $action_id = $activityId_and_length_and_actionId[2];

      if ($length_activities == 1) {
        $sql = "DELETE FROM action_plan WHERE action_id = '$action_id' ";
        if(mysqli_query($link, $sql)) {
          // echo "delete all success";
        }
        $sql_percent = "UPDATE goal SET completion_status = 0 WHERE goal_id = '$goal_id'";
        if (mysqli_query($link, $sql_percent)) {
          setcookie("completion_status", 0);
          // echo "Update percentage";
        }
      }
      $sql = "DELETE FROM activity WHERE activity_id = $activity_id ";
      if(mysqli_query($link, $sql)) {
        // echo "delete activity success";
      }

      // Action plan
      $sql_action = "SELECT * FROM action_plan WHERE goal_id = '$id'";
      $result_actionPlan = mysqli_query($link, $sql_action);
      $action_plans = mysqli_fetch_all($result_actionPlan, MYSQLI_ASSOC);

      // Activity
      $activities = array();
      for ($i = 0; $i < count($action_plans); $i+=1) {
        $action_id = $action_plans[$i]['action_id'];
        // echo "action id:" . $action_id . "<br>";
        $sql_activity = "SELECT * FROM activity WHERE action_id = '$action_id'";
        $result_activity = mysqli_query($link, $sql_activity);
        $activity = mysqli_fetch_all($result_activity, MYSQLI_ASSOC);
        // echo "One activity:";
        // print_r($activity);
        // echo "<br><br>";
        array_push($activities, $activity);

        if($i == count($action_plans) - 1) {
          mysqli_free_result($result_activity);
        }
      }

      mysqli_free_result($result_actionPlan);

    }

    if (isset($_POST['addActionPlan'])) {
      $unique_id = uniqid();
      $action_plan = $_POST['action'];

      // store action plan
      $sql_action = "INSERT INTO action_plan (action_id, goal_id, content) VALUES ('$unique_id', '$id', '$action_plan')";
      if (mysqli_query($link, $sql_action)) {
        // echo "Action plan success";
      }

      // store activity
      for ($i = 1; $i <= $_COOKIE['length'] ;$i+=1) {
        $activity = $_POST["activity-$i"];
        $done = false;
        $sql_activity = "INSERT INTO activity (action_id, content, done) VALUES ('$unique_id', '$activity', '$done')";
        if (mysqli_query($link, $sql_activity)) {
          // echo "activity success";
        }
      }

      setcookie('length', 0);

      // Action plan
      $sql_action = "SELECT * FROM action_plan WHERE goal_id = '$id'";
      $result_actionPlan = mysqli_query($link, $sql_action);
      $action_plans = mysqli_fetch_all($result_actionPlan, MYSQLI_ASSOC);

      // Activity
      $activities = array();
      for ($i = 0; $i < count($action_plans); $i+=1) {
        $action_id = $action_plans[$i]['action_id'];
        // echo "action id:" . $action_id . "<br>";
        $sql_activity = "SELECT * FROM activity WHERE action_id = '$action_id'";
        $result_activity = mysqli_query($link, $sql_activity);
        $activity = mysqli_fetch_all($result_activity, MYSQLI_ASSOC);
        // echo "One activity:";
        // print_r($activity);
        // echo "<br><br>";
        array_push($activities, $activity);

        if($i == count($action_plans) - 1) {
          mysqli_free_result($result_activity);
        }
      }

      mysqli_free_result($result_actionPlan);

    }

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
    <link rel="stylesheet" href="./stylesheets/editGoal.css" />
    <title>Edit Goal</title>
  </head>
  <body>
    <div class="wrapper">
      <div class="goal">
        <!--  Title  -->
        <div class="row">
          <i class="fa fa-bullseye"></i>
          <input 
            class="editTitle" 
            contenteditable="true" 
            value="<?php echo $goal['title'] ?>" 
            name="title"
            form="saveChangesForm"
            onfocusin="focusIn(this)"
            onfocusout="focusOut(this)"
          />
        </div>

        <!--  Due date  -->
        <div class="row">
          <i class="fa fa-calendar"></i>
          <div class="due-date-content">
            <h2 class="due-date-title" style="color: var(--skin-color)">
              Due Date
            </h2>
            <div class="due-date">
              <!-- <p class="due-date-text">2022-04-25T06:02</p> -->
              <!-- 2022-05-31 08:53:45 -->
              
              <input
                type="date"
                class="editDate"
                value="<?php echo $goal['due_date'] ?>"
                name="due_date"
                form="saveChangesForm"
              />
            </div>
            <!-- <input type="date" name="due-date" class="due-date-input" /> -->
          </div>
        </div>

        <!--  Category  -->
        <div class="row">
          <i class="fa fa-list"></i>
          <div class="category-content">
            <h2 class="category-title" style="color: var(--skin-color)">
              Category
            </h2>
            <!-- <p>Fitness</p> -->
            <select form="saveChangesForm" name="category[]" class="category-menu">
              <option value="<?php echo $goal['category'] ?>"><?php echo $goal['category'] ?></option>
              <option value="">- Select -</option>
              <option value="Other">Others</option>
              <option value="Health and Fitness">Health and Fitness</option>
              <option value="Financial">Financial</option>
              <option value="Academics">Academics</option>
              <option value="Character">Character</option>
              <option value="Career">Career</option>
            </select>
          </div>
        </div>

        <!--  Description  -->
        <div class="row">
          <i class="fa fa-marker"></i>
          <div class="description-list">
            <div class="description-header">
              <h2 name="description" class="description-title" style="color: var(--skin-color)">
                Description
              </h2>
            </div>
            <div class="newDescriptionArea">
              <textarea 
                form="saveChangesForm"
                name="description" 
                class="editDescription" 
                cols="70" 
                rows="10"><?php echo $goal['description'] ?>
              </textarea>
            </div>
            
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
              <i
                class="fa fa-plus openAddActivity"
                onclick="openAddActivity(event)"
                style="font-size: large"
              ></i>
            </div>

              <div class="action-plan-body">
                <ul class="action-list">
                  <div class="new-action">
                    <div>
                      <div class="action-item">
                        <input
                          form="addActionPlanForm"
                          type="text"
                          id="action-plan-input"
                          name="action"
                          class="action-plan-input form-control"
                          placeholder="New action"
                          required
                          index="1"
                        />
                        <i
                          class="fa fa-plus addActivity"
                          onclick="addActivity(event)"
                          style="font-size: large"
                        ></i>
                      </div>
                      <ol class="activity-list">
                        <div class="action-list-1">
                          <li class="newActivity-1">
                            <div class="action-plan-activity">
                              <input
                                form="addActionPlanForm"
                                type="text"
                                id="activity-input"
                                name="activity-1"
                                class="activity-input form-control"
                                placeholder="Activity (at least 1 activity is needed)"
                                required
                              />
                              <i class="fa fa-minus deleteActivityButton firstActivity"></i>
                            </div>
                          </li>
                        </div>
                      </ol>
                    </div>
                  </div>
                </ul>
                <div class="actionPlanButton">
                  <input 
                    type="submit" 
                    name="addActionPlan" 
                    value="Add"
                    class="addActionPlanButton"
                    form="addActionPlanForm"
                  >
                </div>
              </div>

            <ol class="step-ul">
              <?php for($i = 0; $i < count($action_plans); $i+=1) { ?>
              <li class="step-ul-li">
                <div class="step">
                  <input 
                    class="editMain" 
                    value="<?php echo $action_plans[$i]['content'] ?>" 
                    form="saveChangesForm"
                    name="editMainInput-<?php echo $i ?>"
                  />
                  <i
                    class="fa fa-plus addActivity"
                    style="font-size: large"
                    onclick="addNewActivity(event, '<?php echo $action_plans[$i]['action_id'] ?>')"
                  ></i>
                </div>

                <ul class="sub-step-ol">
                  <?php for($j = 0; $j < count($activities[$i]); $j+=1 ) { ?>
                  <li class="newInputActivity-<?php echo $i ?>-<?php echo $j ?>">
                    <div class="sub-step">
                    <input 
                      class="editActivity" 
                      value="<?php echo $activities[$i][$j]['content'] ?>" 
                      form="saveChangesForm"
                      name="editActivityInput-<?php echo $i ?>-<?php echo $j ?>"
                    />
                      <div>
                        <button 
                          class="deleteActivityButton"
                          type="submit"
                          name="deleteActivity"
                          form="saveChangesForm"
                          value="<?php echo $activities[$i][$j]['activity_id'] ?>-<?php echo count($activities[$i]) ?>-<?php echo $action_plans[$i]['action_id'] ?>"
                        >
                        <i class="fa fa-trash delete-icon"></i>
                        
                      </button>
                      </div>
                    </div>
                  </li>
                  <?php } ?>
                </ul>
              </li>

              <?php } ?>
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

            <div class="comments-list">
            <?php for($i = 0; $i < count($comments); $i+=1) { ?> 
              <div class="comment">
                <div class="comment-photo-name">
                  <img src="<?php echo htmlspecialchars($comments[$i]['image']) ?>" alt="user-photo" />
                  <p><?php echo htmlspecialchars($comments[$i]['mentor_name']) ?></p>
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

        <!-- Save changes -->
        <div  class="saveChanges">
          <input form="saveChangesForm" type="submit" name="save" value="Save" />
          <!-- <i class="fa fa-save"></i>  -->
        </div>

        <!-- Delete -->
        <div class="deleteGoal">
          <!-- <i class="fa fa-trash"></i> -->
          <input form="saveChangesForm" type="submit" name="delete" value="Delete" />
        </div>
        
      <form 
        action="" 
        method="POST"
        id="saveChangesForm"
      >          
      </form>
      <form 
        action="editGoal.php?id=<?php echo $goal['goal_id'] ?>" 
        method="POST"
        id="addActionPlanForm"
        ></form>
      </div>
    </div>

    <script type="text/javascript">

      let ith = 1;
      document.cookie = "length = " + ith;

      function addActivity(e) {
        // var a = findIndex(e);
        ith++;
        e.preventDefault();
        var newInput = document.createElement("li");
        newInput.setAttribute("class", `newActivity-${ith}`);
        // console.log($(`.action-list-${a} li`).length);
        newInput.innerHTML = `
        <div class="action-plan-activity">
          <input form="addActionPlanForm" type="text" id="activity-input" name="activity-${ith}" 
          class="activity-input form-control" placeholder="Activity " required/>
          <i class="fa fa-minus deleteActivityButton" onclick="deleteActivity(event)"></i>
        </div>
      `;

        var b = ".action-list-1";
        // console.log(b);
        const newD = document.querySelector(b);
        newD.appendChild(newInput);
        console.log(ith);
        var lis = document.querySelectorAll("li")
        console.log("length", lis.length);
        document.cookie = "length = " + ith
      }
      
      function deleteActivity(e) {
        let num = parseInt(e.target.previousElementSibling.getAttribute("name").split("-")[1])
        console.log(typeof(num));

        let currentLi = document.querySelector(`.newActivity-${num}`)
        currentLi.remove();
        console.log("current", currentLi);

        while (num < ith) {
          num++;
          let li = document.querySelector(`.newActivity-${num}`);
          console.log("li", li);
          li.setAttribute("class", `newActivity-${num-1}`);
          let input = li.firstElementChild.firstElementChild
          console.log("input", input);
          input.setAttribute("name", `activity-${num-1}`)
        }
        ith--;
 
        console.log("ith", ith);
        document.cookie = "length = " + ith
      }


      let newActivitiesArray = [];
      let newActivityInputCount = 0

      function addNewActivity(e, action_id) {
        var newInput = document.createElement("li");
        newInput.setAttribute("class", "newInputActivity")
        newInput.innerHTML = `
        <div class="sub-step">
          <input 
            class="editActivity" 
            form="saveChangesForm"
            placeholder="New activity"
            name="editActivityInput-${newActivityInputCount}"
            />
        <div>
        <i 
          class="fa fa-minus deleteNewActivityButton" 
          onclick="deleteNewActivity(event, ${action_id})"
         ></i>
      `;
      let newAc = [
        `editActivityInput-${newActivityInputCount}`, 
        action_id
      ]
      newActivitiesArray.push(newAc)
      console.log(newActivitiesArray);
      document.cookie = "newActivities = " + newActivitiesArray;
      
      console.log(e.target.parentElement.nextElementSibling);
      
      let ol = e.target.parentElement.nextElementSibling
      ol.appendChild(newInput)
      newActivityInputCount++;
    }
    
    function deleteNewActivity(e, action_id) {
      console.log(e.target);
      console.log(e.target.parentElement.previousElementSibling);
      console.log(e.target.parentElement.previousElementSibling.getAttribute("name"));
      console.log(e.target.parentElement.parentElement.parentElement);
      
      let editActivityInput = e.target.parentElement.previousElementSibling.getAttribute("name");
      let currentAc = [
        editActivityInput, 
        action_id
      ]
      for (let i = 0; i < newActivitiesArray.length; i++) {
        if (newActivitiesArray[i][0] == editActivityInput) {
          newActivitiesArray.splice(i, 1);
        }
      }
      // newActivitiesArray.pop(currentAc)

      // let newActivitiesArray = newActivitiesArray.filter((eAI) => {
      //   return eAI == editActivityInput;
      // })
      console.log(newActivitiesArray);
      document.cookie = "newActivities = " + newActivitiesArray;

      let li = e.target.parentElement.parentElement.parentElement
      li.remove();
      newActivityInputCount--;
      }

      function focusIn(e) {
        e.style.background = "#f4f5f7";
        e.style.padding = "3px 10px";
        e.style.fontWeight = "500";
        e.focus();
      }
      
      function focusOut(e) {
        e.style.background = "#fff";
        e.style.padding = "3px 0px";
        e.style.fontWeight = "700";
        e.blur();
      }

      function openAddActivity(e) {
        let actionPlanBody = document.querySelector(".action-plan-body");
        actionPlanBody.classList.toggle("open");

        let openAddActivity = document.querySelector(".openAddActivity");
        openAddActivity.classList.toggle("open")
      }

    </script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
    <script
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

    <!-- <script src="/javascript/style-swticher.js"></script>
    <script src="/javascript/main.js"></script> -->
  </body>
</html>
