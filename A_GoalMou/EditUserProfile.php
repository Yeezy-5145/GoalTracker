<!DOCTYPE html>
<html lang="en">
  <head>
    <title>GoalMou Account</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
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

    <!--overwrite-->
    <link rel="stylesheet" href="./stylesheets/progressbar.css" />

    <link rel="stylesheet" type=" text/css " href="stylesheets/gl2.css" />
    <link
      rel="stylesheet"
      type=" text/css "
      href="stylesheets/profileSheet.css"
    />

    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Caveat&family=Poppins:wght@300&display=swap"
      rel="stylesheet"
    />
  </head>

  <body>
   <?php
    $link = mysqli_connect('localhost', 'root', '','user_profile');
    $id = 1;
    $result1 = mysqli_query($link,"SELECT * FROM user WHERE user_id=$id");
    $personal = mysqli_fetch_array($result1);
    $result2 = mysqli_query($link,"SELECT * FROM address WHERE user_id=$id");
	  $address = mysqli_fetch_array($result2);
    $avatar_src = "upload/".$personal['avatar'];
    ?> 

    <!--Nav Bar-->
    <div class="back-wrap">
      <!-- YS's code -->
      <div class="navigation-bar">
        <div class="nav-left-part">
          <a
            class="btn btn-light btn-lg wide-button"
            data-bs-toggle="offcanvas"
            href="#sidebar"
            role="button"
            aria-controls="sidebar"
            id="openSideBar"
          >
            &#9776;
          </a>
          <div class="logo">
            <img
              src="./images/transparent-logo-rectangle.png"
              alt=""
              srcset=""
            />
            <a href="./goalList_1.html">
              <h1>GoalMou</h1>
            </a>
          </div>
        </div>

        <div class="nav-right-part">
          <div class="navigation">
            <div class="profile">
              <a href="./ViewUserProfile.html">
              <img src="<?php echo $avatar_src;?>" class="profilePhoto" />
                <p class="username"><?php echo $personal["username"]; ?></p>
              </a>
            </div>
          </div>

          <!--Notification button-->
          <div class="notification" id="noti-bar">
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
                            <img
                              src="https://bootdey.com/img/Content/avatar/avatar1.png"
                              width="16"
                              class="img-circle pull-left m-r-5"
                              alt=""
                            />
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
          </div>
        </div>
      </div>
    </div>

    <div id="invis-background"></div>

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
          id="closeSideBar"
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
            <a
              id="userProfileOuter"
              href="#userProfile"
              data-toggle="collapse"
              aria-expanded="false"
              class="dropdown-toggle collapsed"
              ><i class="bi bi-person-bounding-box" style="font-size: 30px"></i>
              User Profile</a
            >
            <ul id="userProfile" class="navbar-nav collapse lisst-unstyled">
              <li>
                <a href="ViewUserProfile.html">
                  <i class="bi-person" style="font-size: 25px"></i
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
              id="goalsNavigation"
              href="#goalsNav"
              data-toggle="collapse"
              aria-expanded="false"
              class="dropdown-toggle collapsed"
              ><i class="bi-award" style="font-size: 30px"></i> My Goals</a
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
            <hr class="dropdown-divider" />
          </li>
          <li>
            <a href="chart.html">
              <i class="fa fa-line-chart"></i
              ><span class="item-text"> Goal Report</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider" />
          </li>
          <li>
            <a href="goal.html">
              <i class="bi-door-open" style="font-size: 27px"></i
              ><span class="item-text"> Log Out</span>
            </a>
          </li>
          <li>
            <hr class="dropdown-divider" />
          </li>
        </ul>
      </div>
    </div>
    <div id="invis-background"></div>


<form action = "userProfile.php" method ="post" enctype="multipart/form-data">
    <div class="container">
      <div class="row gutters">
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
          <div class="card h-100">
            <div class="card-body">
              <div class="account-settings">
                <div class="user-profile">
                  <div class="user-profile">
                    <div class="picture-container">
                      <div class="picture">
                        <img src="<?php echo $avatar_src;?>" class="picture-src" id="profilePicturePreview" >
                        <input type="file" name = "avatar" id="profilePic">
                      </div>
                      <p class = "text-secondary"><i><small>Choose Picture</small></i></p>
                    </div>
                    <h5 class="user-name"><?php echo $personal["username"]; ?></h5>
                    <h6 class="user-email"><?php echo $personal["email"]; ?></h6>
                  </div>
                  
                </div>
                <div class="justify-content-md-end text-center">
                  <a href="#myModal" role="button" class="btn btn-danger btn-sm" data-bs-toggle="modal">Delete Account</a>
                  <div id="myModal" class="modal fade" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete Account Confirmation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p>Do you sure you want to delete your account?</p>
                                <p class="text-secondary"><small>This action cannot be undo!</small></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form action = "deleteAccount.php" method ="post" enctype="multipart/form-data">
                                <input style ="margin-bottom: 0px; "class="btn btn-danger"  type = "submit" name= "deleteAccount" id="deleteAccount" value = "Delete Account">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
          <div class="card h-100">
            <div class="card-body">
              <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                  <h4 class="fw-bold mb-2">Personal Details</h4>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <label for="userName">Username</label>
                    <input
                      type="text"
                      class="form-control"
                      id="userName"
                      name= "userName"
                      placeholder="Username"
                      value= <?php echo $personal["username"]; ?>
                    />
                  </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <label for="Birthday">Birthday</label>
                    <input
                      type="date"
                      class="form-control"
                      id="birthday"
                      name= "birthday"
                      placeholder="Birthday"
                      value= <?php echo $personal["birthday"]; ?>
                    />
                  </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input
                      type= "text"
                      class= "form-control"
                      id= "firstName"
                      name= "firstName"
                      placeholder= "First Name"
                      value= <?php echo $personal["first_name"]; ?>
                    />
                  </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input
                      type="text"
                      class="form-control"
                      id="lastName"
                      name= "lastName"
                      placeholder="Last Name"
                      value= <?php echo $personal["last_name"]; ?>
                    />
                  </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input
                      type="email"
                      class="form-control"
                      id="email"
                      name= "email"
                      placeholder="Email"
                      value= <?php echo $personal["email"]; ?>
                    />
                  </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input
                      type="text"
                      class="form-control"
                      id="phone"
                      name= "phone"
                      placeholder="Phone number"
                      value= <?php echo $personal["phone_number"]; ?>
                    />
                  </div>
                </div>
              </div>
              <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                  <h4 class="fw-bold mb-2">Address</h4>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <label for="Street">Street</label>
                    <input
                      type="name"
                      class="form-control"
                      id="street"
                      name= "street"
                      placeholder="Street"
                      value = <?php echo $address["street"]; ?>
                    />
                  </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <label for="City">City</label>
                    <input
                      type="name"
                      class="form-control"
                      id="city"
                      name= "city"
                      placeholder="City"
                      value = <?php echo $address["city"]; ?>
                    />
                  </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <label for="State">State</label>
                    <input
                      type="text"
                      class="form-control"
                      id="state"
                      name= "state"
                      placeholder="State"
                      value = <?php echo $address["state"]; ?>
                    />
                  </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                  <div class="form-group">
                    <label for="Zip">Zip Code</label>
                    <input
                      type="text"
                      class="form-control"
                      id="zip"
                      name= "zip"
                      placeholder="Zip Code"
                      value = <?php echo $address["zip_code"]; ?>
                    />
                  </div>
                </div>
              </div>
              <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                  <h4 class="fw-bold mb-2">Password</h4>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                  <label>Current Password</label>
                  <div class="form-group pass_show">
                    <input
                      type="password"
                      class="form-control"
                      id = "currPass"
                      name = "currPass"
                      placeholder="Current Password"
                    />
                  </div>
                  <label>New Password</label>
                  <div class="form-group pass_show">
                    <input
                      type="password"
                      class="form-control"
                      id = "newPass"
                      name = "newPass"
                      placeholder="New Password"
                    />
                  </div>
                  <label>Confirm Password</label>
                  <div class="form-group pass_show">
                    <input
                      type="password"
                      class="form-control"
                      id = "conPass"
                      name = "conPass"
                      placeholder="Confirm Password"
                    />
                  </div>
                </div>
              </div>
              <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                  <div
                    class="gap-3 d-md-flex justify-content-md-end text-center"
                  >
                    <input class="btn btn-sm btn-primary" type = "submit" name= "submit" id="submit" value = "Update">
                     
                  </div>
                </div>
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Include Bootstrap JavaScript plugin -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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

    <script type="text/javascript" src="./javascript/progressbar.js"></script>
    <script type="text/javascript" src="javascript/profileScript.js"></script>
  </body>

  <footer></footer>
</html>
