<?php 
  require_once "backend/session.php";
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
					id="openSideBar">
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
						<a href="./ViewUserProfile.html">
							<img src="./images/bird.gif" class="profilePhoto" />
              <p class="username">Charmander</p>
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
												<i class="fa fa-gift text-purple"></i> Dad's Birthday
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

	<div id="invis-background"></div>

			<div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="sidebar-label">
				<div class="offcanvas-header">
					<a href="./goalList_2.html" style="text-decoration: none;">
						<img src="./images/transparent-logo-goalmou.png" alt="" width="250">
					</a>
					<button id="closeSideBar" type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
				</div>
				<hr>
				<div class="sidebar-nav offcanvas-body">
					<ul class="sidebar-nav navbar-nav">
						<li>
							<a id="userProfileOuter" href="#userProfile" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed"><i class="bi bi-person-bounding-box" style="font-size: 30px;"></i> User Profile</a>
							<ul id="userProfile" class="navbar-nav collapse lisst-unstyled">
								<li>
									<a href="ViewUserProfile.html">
										<i class="bi-person" style="font-size: 25px;"></i><span class="item-text"> View Profile</span>
									</a>
								</li>
								<li>
									<a href="EditUserProfile.html">
										<i class="fa fa-pencil-square-o"></i><span class="item-text"> Edit Profile</span>
									</a>
								</li>
							</ul>
						</li>
						<li>
							<hr class="dropdown-divider">
						</li>
						<li>
							<a id="goalsNavigation" href="#goalsNav" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed"><i class="bi-award" style="font-size: 30px;"></i> My Goals</a>
							<ul id="goalsNav" class="navbar-nav collapse lisst-unstyled">
								<li>
									<a href="create-goal.html">
										<i class="fa fa-tachometer"></i><span class="item-text"> Create Goal</span>
									</a>
								</li>
								<li>
									<a href="goalList_2.html">
										<i class="fa fa-area-chart"></i><span class="item-text"> Goal List</span>
									</a>
								</li>
							</ul>
						</li>
						<li>
							<hr class="dropdown-divider">
						</li>
						<li>
							<a href="chart.html">
								<i class="fa fa-line-chart"></i><span class="item-text"> Goal Report</span>
							</a>
						</li>
						<li>
							<hr class="dropdown-divider">
						</li>
						<li>
							<a href="goal.html">
								<i class="bi-door-open" style="font-size: 27px;"></i><span class="item-text"> Log Out</span>
							</a>
						</li>
						<li>
							<hr class="dropdown-divider">
						</li>
					</ul>
				</div>
			</div>
			<div id="invis-background"></div>

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

          <div class="totalGoal">
            <h3>Total goal: <span class="goalNumber">4</span></h3>
          </div>

          <div class="create-goal-area">
            <button class="create-goal-button">
              <a href="create-goal.html"> Create Goal </a>
            </button>
          </div>
        </div>
        <div class="goal-list-wrapper">
          <a href="./goalList_1.html#id=1" style="text-decoration: none">
            <div class="each-goal" onclick="toManageGoal()">
              <div class="goal-title-part">
                <!-- <input type="checkbox" name="checkbox-done" class="check" /> -->
                <div class="goal-text">
                  <h3 class="goalT">Fitness plan</h3>
                  <p>2022-12-01 00:00am</p>
                </div>
              </div>

              <i class="fa fa-edit"></i>
            </div>
          </a>

          <a href="./goalList_2.html#id=2" style="text-decoration: none">
            <div class="each-goal" onclick="toManageGoal()">
              <div class="goal-title-part">
                <!-- <input type="checkbox" name="checkbox-done" class="check" /> -->
                <div class="goal-text">
                  <h3 class="goalT">Get rich in 5 years</h3>
                  <p>2027-04-27 10:30pm</p>
                </div>
              </div>

              <i class="fa fa-edit"></i>
            </div>
          </a>

          <a href="./goalList_3.html#id=3" style="text-decoration: none">
            <div class="each-goal" id="goal-3" onclick="toManageGoal()">
              <div class="goal-title-part">
                <!-- <input type="checkbox" name="checkbox-done" class="check" /> -->
                <div class="goal-text">
                  <h3 class="goalT">Vacation to Bali</h3>
                  <p>2022-07-07 6:30pm</p>
                </div>
              </div>

              <i class="fa fa-edit"></i>
            </div>
          </a>

          <a href="./goalList_4.html#id=4" style="text-decoration: none">
            <div class="each-goal" onclick="toManageGoal()">
              <div class="goal-title-part">
                <!-- <input type="checkbox" name="checkbox-done" class="check" /> -->
                <div class="goal-text">
                  <h3 class="goalT">Married Donald Trump</h3>
                  <p>2030-01-01 00:00am</p>
                </div>
              </div>

              <i class="fa fa-edit"></i>
            </div>
          </a>
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

    <!-- Manage Goal-->
    <div class="wrapper manageGoal" id="goal-1">
      <div class="goal">
        <!--  Title  -->
        <div class="row-line">
          <i class="fa fa-bullseye"></i>
          <h1
            class="goalTitle"
            style="color: var(--skin-color)"
            contenteditable="true"
          >
            Fitness plan
          </h1>
        </div>

        <!--  Due date  -->
        <div class="row-line">
          <i class="fa fa-calendar"></i>
          <div class="due-date-content">
            <h2 class="due-date-title" style="color: var(--skin-color)">
              Due Date
            </h2>
            <div class="due-date">
              <p class="due-date-text">2022-12-01 00:00am</p>
              <input
                onchange="changeDate(event)"
                type="datetime-local"
                name="due-date"
                class="due-date-choice"
              />
            </div>
            <!-- <input type="date" name="due-date" class="due-date-input" /> -->
          </div>
        </div>

        <!--  Category  -->
        <div class="row-line">
          <i class="fa fa-list"></i>
          <div class="category-content">
            <h2 class="category-title" style="color: var(--skin-color)">
              Category
            </h2>
            <!-- <p>Fitness</p> -->
            <select name="category" class="category-menu">
              <option value="Other">Others</option>
              <option value="Health and Fitness" selected>
                Health and Fitness
              </option>
              <option value="Financial">Financial</option>
              <option value="Academics">Academics</option>
              <option value="Character">Character</option>
              <option value="Career">Career</option>
            </select>
          </div>
        </div>

        <!--  Description  -->
        <div class="row-line">
          <i class="fa fa-marker"></i>
          <div class="description-list">
            <div class="description-header">
              <h2 class="description-title" style="color: var(--skin-color)">
                Description
              </h2>
              <i
                class="fa fa-add addDescription"
                onclick="addDescription()"
                title="Add description"
              ></i>
            </div>
            <div class="newDescriptionArea"></div>
            <ul class="description-ul">
              <li contenteditable="true" class="description">
                This is my first fitness plan, hope everyone could give some
                advices
              </li>
              <!-- <li contenteditable="true">What should I do?</li>
              <li contenteditable="true">How frequent I want to do?</li>
              <li contenteditable="true">
                How long will it take to reach my goal?
              </li> -->
            </ul>
          </div>
        </div>

        <!--  Action plan  -->
        <div class="row-line">
          <i class="fa fa-list-1-2"></i>
          <div class="action-plans">
            <div class="action-plans-header">
              <h2 class="action-plans-title" style="color: var(--skin-color)">
                Action Plans
              </h2>
              <i
                class="fa fa-add addStep"
                onclick="addStep()"
                title="Add action plan"
              ></i>
            </div>
            <div class="newStepArea"></div>
            <ol class="step-ul">
              <li>
                <div class="step">
                  <p contenteditable="true">Sleep early</p>
                  <div>
                    <input type="checkbox" name="checkdone" class="checkDone" />
                    <i class="fa fa-trash"></i>
                  </div>
                </div>
              </li>
              <li>
                <div class="step">
                  <p contenteditable="true">Drink more water</p>
                  <div>
                    <input type="checkbox" name="checkdone" class="checkDone" />
                    <i class="fa fa-trash"></i>
                  </div>
                </div>
              </li>
              <li>
                <div class="step">
                  <p contenteditable="true">Find a trainer</p>
                  <div>
                    <input type="checkbox" name="checkdone" class="checkDone" />
                    <i class="fa fa-trash"></i>
                  </div>
                </div>
              </li>
              <!-- <li>
                <div class="step">
                  <p contenteditable="true">
                    What the step 4 you gonna take action?
                  </p>
                  <div>
                    <input type="checkbox" name="checkdone" class="checkDone" />
                    <i class="fa fa-trash"></i>
                  </div>
                </div>
              </li>
              <li>
                <div class="step">
                  <p contenteditable="true">
                    What the step 5 you gonna take action?
                  </p>
                  <div>
                    <input type="checkbox" name="checkdone" class="checkDone" />
                    <i class="fa fa-trash"></i>
                  </div>
                </div>
              </li>
              <li>
                <div class="step">
                  <p contenteditable="true">
                    What the step 6 you gonna take action?
                  </p>
                  <div>
                    <input type="checkbox" name="checkdone" class="checkDone" />
                    <i class="fa fa-trash"></i>
                  </div>
                </div>
              </li> -->
            </ol>
          </div>
        </div>

        <!-- Comments -->
        <div class="row-line">
          <i class="fa fa-comment"></i>
          <div class="comments">
            <h2 class="comments-title" style="color: var(--skin-color)">
              Comments
            </h2>
            <!-- <form action="">
              <textarea
                name="give-name"
                class="usernameArea"
                placeholder="Enter your name (optional)"
              ></textarea>
              <textarea
                name="give-comment"
                class="commentArea"
                placeholder="Leave an advice or encouragement..."
                required
              ></textarea>

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
                <input type="submit" value="Comment" class="commentButton" />
              </div>
            </form> -->

            <div class="comments-list">
              <div class="comment">
                <div class="comment-photo-name">
                  <img src="./images/bird.gif" alt="user-photo" />
                  <p>Kevin Durant</p>
                </div>
                <p class="text">
                  From my experience, it is better for you to find a fitness
                  coach to get a more professional advice.
                </p>
                <div class="rating-part">
                  <i class="fa fa-star" style="color: gold"></i>
                  <i class="fa fa-star" style="color: gold"></i>
                  <i class="fa fa-star" style="color: gold"></i>
                  <i class="fa fa-star" style="color: gold"></i>
                  <i class="fa fa-star" style="color: gold"></i>
                </div>
              </div>

              <hr />

              <div class="comment">
                <div class="comment-photo-name">
                  <img src="./images/bird1.webp" alt="user-photo" />
                  <p>Kyrie Irving</p>
                </div>
                <p class="text">Your plan is great! Keep it up!</p>
                <div class="rating-part">
                  <i class="fa fa-star" style="color: gold"></i>
                  <i class="fa fa-star" style="color: gold"></i>
                  <i class="fa fa-star" style="color: gold"></i>
                </div>
              </div>

              <hr />

              <div class="comment">
                <div class="comment-photo-name">
                  <img src="./images/bird3.gif" alt="user-photo" />
                  <p>Annonymous</p>
                </div>
                <p class="text">
                  I like your plan! Hope we can have more discussions about it.
                </p>
                <div class="rating-part">
                  <i class="fa fa-star" style="color: gold"></i>
                  <i class="fa fa-star" style="color: gold"></i>
                  <i class="fa fa-star" style="color: gold"></i>
                  <i class="fa fa-star" style="color: gold"></i>
                </div>
              </div>

              <hr />
            </div>
            <!-- Delete button -->
            <div class="deleteBtnArea">
              <a href="./goalList_1.html">
                <button class="deleteBtn" onclick="deleteGoal()">
                  Delete Goal
                </button>
              </a>
            </div>
          </div>
        </div>

        <!-- Close icon -->
        <div class="close-icon">
          <i class="fa fa-close" title="Close" onclick="closeGoal()"></i>
        </div>

        <!-- Progress bar -->
        <div class="progress-bar">
          <div class="percentage" style="width: 0%">
            <span class="percentage-text">0%</span>
          </div>
        </div>

        <!-- Share Link -->
        <div class="share-link">
          <i class="fa fa-link" title="Copy link" onclick="copyURI(event)"></i>
        </div>
        <img src="./images/LinkCopied.png" class="linkCopied" />

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

    <script
      rel="preconnect"
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    ></script>
    <script src="/javascript/create-goal.js"></script>
    <script type="text/javascript" src="./javascript/progressbar.js"></script>
    <script src="./javascript/goalList_1.js"></script>
    <script src="./javascript/main.js"></script>
    <script src="./javascript/style-swticher.js"></script>
    <!-- <script src="./javascript/data.js"></script>
    <script src="./javascript/user.js"></script> -->
  </body>
</html>