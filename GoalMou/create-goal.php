<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initialscale=1" />

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

    <!-- Overwrite BootStrap -->
    <link rel="stylesheet" href="./stylesheets/progressbar.css" />
    <link href="./stylesheets/create-goal.css" rel="stylesheet" />

    <!-- Style Sheet Reference -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap"
      rel="stylesheet"
    />

    <title>GoalMou: Create Goal</title>
  </head>

  <body>
    <div class="back-wrap">

      <!-- Header Include -->
      <?php
        include_once './header.php';
      ?>

      <!-- Inputs -->
      <form class="main-form bg-light" action="./backend/create-goal-back.php" method="POST">
        <br />
        <div id="logo-center">
          <a href="./goalList_1.html"
            ><img
              src="images/transparent-logo-goalmou.png"
              width="400"
              height="100"
              id="logo-center"
          /></a>
        </div>
        <div style="padding-left: 30px; padding-right: 30px">
          <label for="goal-title">Goal Title</label>
          <input
            type="text"
            id="goal-title"
            name="goal-title"
            class="form-control"
            required
          />
          <label for="to-complete-date">Due Date</label>
          <input
            type="date"
            id="to-complete-date"
            name="to-complete-date"
            class="form-control"
            required
          />
          <label for="goal-category">Category</label>
          <select id="goal-category" name="goal-category" class="form-control">
            <option value="other">Others</option>
            <option value="health-and-fitness">Health and Fitness</option>
            <option value="financial">Financial</option>
            <option value="academics">Academics</option>
            <option value="character">Character</option>
            <option value="career">Career</option>
          </select>
          <label for="goal-description">Description</label>
          <textarea
            rows="4"
            class="form-control"
            name="goal-description"
            id="goal-description"
            style="resize: none"
          ></textarea>

          <!-- Label -->
          <div class="action-plan">
            <div class="action-plan-header">
              <label for="goal-action-plan"
                >Write Down Your Action Plans!</label
              >
              <i
                class="fa fa-plus addStep"
                onclick="addActionPlan(event)"
                title="Add action plan"
                style="font-size: large"
              ></i>
            </div>
            <div class="action-plan-body">
              <ol class="action-list">
                <div class="new-action">
                  <li>
                    <div class="action-item">
                      <input
                        type="text"
                        id="action-plan-input"
                        name="action-1"
                        class="action-plan-input form-control"
                        placeholder="Action 1"
                        required
                        index="1"
                      />
                      <i
                        class="fa fa-plus addStep"
                        onclick="addActivity(event)"
                        style="font-size: large"
                      ></i>
                      <!-- <i class="fa fa-trash-o delete-icon" onclick="deleteAction(e, name)"></i> -->
                    </div>
                    <ol class="activity-list">
                      <div class="action-list-1">
                        <li>
                          <div class="action-plan-activity mt-1">
                            <input
                              type="text"
                              id="activity-input"
                              name="activity-1-1"
                              class="activity-input form-control"
                              placeholder="Activity 1 . 1"
                              required
                            />
                            <!-- <i class="fa fa-trash-o delete-icon" onclick="deleteAction(e, name)"></i> -->
                          </div>
                        </li>
                      </div>
                    </ol>
                  </li>
                </div>
              </ol>
            </div>
          </div>
          <div id="logo-center">
            <input
              type="submit"
              class="btn btn-primary btn-lg col-5"
              name="submit"
              value="Submit"
            />
          </div>
          <br /><br />
        </div>
      </form>

      <!-- Footer -->
      <footer><br /><br /><br /><br /></footer>
    </div>

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

    <script type="text/javascript" src="./javascript/create-goal.js"></script>
    <script type="text/javascript" src="./javascript/progressbar.js"></script>
  </body>
</html>
