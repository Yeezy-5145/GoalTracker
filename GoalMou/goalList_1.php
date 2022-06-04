<?php

  require_once "backend/session.php";
  require_once "backend/dbconnect.php";

  $user_id = $_SESSION['user_id'];
  $sql = "SELECT * FROM goal WHERE user_id = '$user_id'";
  $result = mysqli_query($link, $sql);
  $goals = mysqli_fetch_all($result, MYSQLI_ASSOC);
  $goalLength = mysqli_num_rows($result);
  
  mysqli_free_result($result);

  if (isset($_GET['home'])) {
    header('Location: goalList_1.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link
      rel="shortcut icon"
      href="./images/transparent-logo-square.png"
      type="image/x-icon"
    />
    <link
      rel="shortcut icon"
      href="./images/transparent-logo-square.png"
      type="image/x-icon"
    />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
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

    <!-- Bootstrap -->
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
    <link rel="stylesheet" href="./stylesheets/manageGoal.css" />
    <link rel="stylesheet" href="./stylesheets/progressbar.css" />
    <link rel="stylesheet" href="./stylesheets/notif.css"/>
    <link rel="stylesheet" href="./stylesheets/gl2.css" />

    <!--     
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poppins" />
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;500;600;700&family=Clicker+Script&family=Hurricane&family=Poppins:wght@200;300;400;500;600&display=swap" rel="stylesheet">
<style>
  @import url('https://fonts.googleapis.com/css2?family=Caveat:wght@400;500;600;700&family=Clicker+Script&family=Hurricane&family=Poppins:wght@200;300;400;500;600&display=swap');
  </style> -->
    <title>Goal List</title>
  </head>
  <body>
    <div class="my-wrapper">
    <!-- Header Include -->
    <?php
      include_once './header.php';
    ?>

      <div class="goal-list-section">
        <div class="upper-part">
          <div class="search-bar">
            <input
              id="myInput"
              type="text"
              placeholder="Search"
              onkeyup="searchFunction()"
            />
            <i class="fa fa-search"></i>
          </div>

          <!-- <div class="totalGoal">
            <h3>Total goal: <span class="goalNumber"><?php echo htmlspecialchars($goalLength) ?></span></h3>
          </div> -->

          <select onclick="filterFunction()" class="filter" id="my-filter">
            <option value="all" selected="" id="valueAll">All</option>
            <option value="Health and fitness" id="value1">Health and fitness</option>
            <option value="Financial" id="value2">Financial</option>
            <option value="Academics" id="value3">Academics</option>
            <option value="Character" id="value4">Character</option>
            <option value="Career" id="value5">Career</option>
            <option value="Others" id="value6">Others</option>
          </select>

          

          <div class="create-goal-area">
            <button class="create-goal-button">
              <a href="create-goal.php"> Create Goal </a>
            </button>
          </div>
        </div>
        <div class="goal-list-wrapper">
          <?php foreach($goals as $goal) { ?>
            <a href="manageGoalUser.php?id=<?php echo $goal['goal_id'] ?>" style="text-decoration: none">
              <div class="each-goal" >
                <div class="goal-title-part">
                  <div class="goal-text">
                    <h3 class="goalT"><?php echo htmlspecialchars($goal['title']); ?></h3>
                    <p class="goalC"><?php echo htmlspecialchars($goal['category']); ?></p>
                  </div>
                </div>
                
                <!-- <i class="fa fa-edit"></i> -->
                <p><?php echo htmlspecialchars($goal['due_date']); ?></p>
              </div>
            </a>
          <?php } ?>
        </div>
      </div>
    </div>

    <div
      class="offcanvas offcanvas-start"
      tabindex="-1"
      id="sidebar"
      aria-labelledby="sidebar-label"
    >
      <div class="offcanvas-header">
        <a href="./goalList_1.html" style="text-decoration: none">
          <img
            src="./images/transparent-logo-goalmou.png"
            alt=""
            height=""
            width="190"
          />
        </a>
        <button
          type="button"
          class="btn-close text-reset"
          data-bs-dismiss="offcanvas"
          aria-label="Close"
        ></button>
      </div>
      <hr />
      <div class="sidebar-nav offcanvas-body">
        <ul class="sidebar-nav navbar-nav">
          <li>
            <!-- <a href="ViewUserProfile.html">
								<i class="bi-person"></i><span class="item-text">User Profile</span>
							</a> -->
            <a
              href="#userProfile"
              data-toggle="collapse"
              aria-expanded="false"
              class="dropdown-toggle"
              >User Profile</a
            >
            <ul id="userProfile" class="navbar-nav collapse lisst-unstyled">
              <li>
                <a href="ViewUserProfile.html">
                  <i class="bi-person"></i
                  ><span class="item-text"> View Profile</span>
                </a>
              </li>
              <li>
                <a href="EditUserProfile.html">
                  <i class="fa fa-pencil-square-o"></i
                  ><span class="item-text"> Edit Profile</span>
                </a>
              </li>
            </ul>
          </li>
          <li>
            <hr class="dropdown-divider" />
          </li>
          <li>
            <a
              href="#goalsNav"
              data-toggle="collapse"
              aria-expanded="false"
              class="dropdown-toggle"
              >My Goals</a
            >
            <ul id="goalsNav" class="navbar-nav collapse lisst-unstyled">
              <li>
                <a href="create-goal.html">
                  <i class="fa fa-tachometer"></i
                  ><span class="item-text"> Create Goal</span>
                </a>
              </li>
              <li>
                <a href="goalList_1.html">
                  <i class="fa fa-area-chart"></i
                  ><span class="item-text"> Goal List</span>
                </a>
              </li>
            </ul>
          </li>
          <li>
            <a href="chart.html">
              <i class="bi-person"></i
              ><span class="item-text"> Goal Report</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider" />
          </li>
          <li>
            <a href="aboutUs.html">
              <i class="bi-person"></i><span class="item-text"> About Us</span>
            </a>
          </li>
          <li>
            <a href="contactUs.html">
              <i class="bi-person"></i
              ><span class="item-text"> Contact Us</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider" />
          </li>
          <li>
            <a href="goal.html">
              <i class="bi-person"></i><span class="item-text"> Log Out</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider" />
          </li>
        </ul>
      </div>
    </div>

    <!-- Fade backdrop -->
    <div class="fade-bg"></div>

    

    <script src="./javascript/goalList_1.js"></script>
    <script src="./javascript/main.js"></script>
    <script src="./javascript/style-swticher.js"></script>
    <!-- <script src="./javascript/data.js"></script>
    <script src="./javascript/user.js"></script> -->

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
    <!-- <script src="/javascript/create-goal.js"></script> -->
    <script src="./javascript/goalList_1.js"></script>
    <script src="./javascript/main.js"></script>
    <script type="text/javascript" src="./javascript/progressbar.js"></script>
    <!-- <script src="./javascript/style-swticher.js"></script> -->
    <!-- <script src="./javascript/data.js"></script>
    <script src="./javascript/user.js"></script> -->
  </body>
</html>