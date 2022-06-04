<?php
  require_once "backend/session.php";
  require_once "backend/dbconnect.php";
  $user_id = $_SESSION['user_id'];
?>

<!--Nav Bar-->
<div class="navigation-bar">
  <div class="nav-left-part">
    <a class="btn btn-light btn-lg wide-button" data-bs-toggle="offcanvas" href="#sidebar" role="button" aria-controls="sidebar" id="openSideBar">
      &#9776;
    </a>
    <div class="logo">
      <img src="./images/transparent-logo-rectangle.png" alt="" srcset="" />
      <a href="./goalList_1.html">
        <h1>GoalMou</h1>
      </a>
    </div>
  </div>

  <div class="nav-right-part">
    <div class="navigation">
      <div class="profile">
        <a href="./ViewUserProfile.php">
          <img src="<?php echo $avatar_src;?>" class="profilePhoto" />
          <p class="username"><?php echo $_SESSION['username'] ?></p>
        </a>
      </div>
    </div>

    <!--Notification button-->
    <?php 
      include_once "notif.php";
    ?>
    <!-- <div class="notification" id="noti-bar">
      <button onclick="myFunction()" class="notificationButton">
        <i class="fa fa-bell"></i>
      </button>
      <div id="listofNotification" class="goalContent">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <div class="widget widget-reminder">
                <div class="widget-reminder-header">TODAY, APR 23</div>
                <div class="widget-reminder-container">
                  <div class="widget-reminder-time">
                    21:00<br />
                    22:00
                  </div>
                  <div class="widget-reminder-divider bg-success"></div>
                  <div class="widget-reminder-content">
                    <h4 class="widget-title">Group Meeting</h4>
                    <div class="widget-desc">
                      <i class="fa fa-map-pin"></i> Google Meet
                    </div>
                  </div>
                </div>
                <div class="widget-reminder-container">
                  <div class="widget-reminder-time">
                    22:30<br />
                    23:30
                  </div>
                  <div class="widget-reminder-divider bg-primary"></div>
                  <div class="widget-reminder-content">
                    <h4 class="widget-title">Supper with Jocelyn</h4>
                    <div class="widget-desc">
                      <i class="fa fa-map-pin"></i> Mamak
                    </div>
                    <div class="m-t-15">
                      <img src="https://bootdey.com/img/Content/avatar/avatar1.png" width="16" class="img-circle pull-left m-r-5" alt="" />
                      Jocelyn
                    </div>
                  </div>
                </div>
                <div class="widget-reminder-header">APR 27</div>
                <div class="widget-reminder-container">
                  <div class="widget-reminder-time">All day</div>
                  <div class="widget-reminder-divider bg-purple"></div>
                  <div class="widget-reminder-content">
                    <h4 class="widget-title">
                      <i class="fa fa-gift text-purple"></i> Dad's
                      Birthday
                    </h4>
                  </div>
                </div>
                <div class="widget-reminder-container">
                  <div class="widget-reminder-time">
                    12:15<br />
                    12:30
                  </div>
                  <div class="widget-reminder-divider bg-danger"></div>
                  <div class="widget-reminder-content">
                    <h4 class="widget-title">Project 1 Presentation</h4>
                    <div class="widget-desc">
                      <i class="ti-pin"></i> Microsoft Teams
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> -->
  </div>
</div>

<div id="invis-background"></div>

<div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="sidebar-label">
  <div class="offcanvas-header">
    <a href="./goalList_1.html" style="text-decoration: none">
      <img src="./images/transparent-logo-goalmou.png" alt="" width="250" />
    </a>
    <button id="closeSideBar" type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <hr />
  <div class="sidebar-nav offcanvas-body">
    <ul class="sidebar-nav navbar-nav">
      <li>
        <a id="userProfileOuter" href="#userProfile" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed"><i class="bi bi-person-bounding-box" style="font-size: 30px"></i>
          User Profile</a>
        <ul id="userProfile" class="navbar-nav collapse lisst-unstyled">
          <li>
            <a href="ViewUserProfile.php">
              <i class="bi-person" style="font-size: 25px"></i><span class="item-text"> View Profile</span>
            </a>
          </li>
          <li>
            <a href="EditUserProfile.php">
              <i class="fa fa-pencil-square-o"></i><span class="item-text"> Edit Profile</span>
            </a>
          </li>
        </ul>
      </li>
      <li>
        <hr class="dropdown-divider" />
      </li>
      <li>
        <a id="goalsNavigation" href="#goalsNav" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed"><i class="bi-award" style="font-size: 30px"></i> My Goals</a>
        <ul id="goalsNav" class="navbar-nav collapse lisst-unstyled">
          <li>
            <a href="create-goal.php">
              <i class="fa fa-tachometer"></i><span class="item-text"> Create Goal</span>
            </a>
          </li>
          <li>
            <a href="goalList_1.html">
              <i class="fa fa-area-chart"></i><span class="item-text"> Goal List</span>
            </a>
          </li>
        </ul>
      </li>
      <li>
        <hr class="dropdown-divider" />
      </li>
      <li>
        <a href="chart.php">
          <i class="fa fa-line-chart"></i><span class="item-text"> Goal Report</span>
        </a>
      </li>
      <li>
        <hr class="dropdown-divider" />
      </li>
      <li>
        <a href="logout.php">
          <i class="bi-door-open" style="font-size: 27px"></i><span class="item-text"> Log Out</span>
        </a>
      </li>
      <li>
        <hr class="dropdown-divider" />
      </li>
    </ul>
  </div>
</div>
<div id="invis-background"></div>