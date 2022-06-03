 <!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link
      href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css"
      rel="stylesheet"
      id="bootstrap-css"
    />
    <link rel="stylesheet" type="text/css" href="./stylesheets/goal.css" />
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link
      href="https://fonts.googleapis.com/css?family=Poppins"
      rel="stylesheet"
    />
    <title>GoalMou Login</title>
  </head>
  <!-- style="background-color:#B7E9FB;" -->
  <body background="images\bg.png">
    <div id="logo">
      <img src="images\transparent-logo-goalmou.png" alt="logo" />
      <p></p>
    </div>
    <div class="container">
      <div class="row full-height justify-content-center">
        <div class="col-md-6 col-md-offset-3">
          <div class="panel panel-login">
            <div class="panel-heading">
              <div class="row">
                <div class="col-xs-6">
                  <a href="#" class="active" id="login-form-link">Login</a>
                </div>
                <div class="col-xs-6">
                  <a href="#" id="register-form-link">Register</a>
                </div>
              </div>
              <hr />
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-12">
                  <form
                    id="login-form"
                    action="./login.php"
                    method="POST"
                    role=""
                    style="display: block"

                  >
                    <div class="form-group">
                      <input
                        type="text"
                        id="username1"
                        name="username1"
                        tabindex="1"
                        class="form-control"
                        placeholder="Username"
                        value=""
                        required
                      />
                    </div>
                    <div class="form-group">
                      <input
                        type="password"
                        id="password1"
                        name="password1"
                        tabindex="2"
                        class="form-control"
                        placeholder="Password"
                        required
                      />
                    </div>
                    <div class="form-group text-center">
                      <input
                        type="checkbox"
                        tabindex="3"
                        class=""
                        name="remember"
                        id="remember"
                      />
                      <label for="remember"> Remember Me</label>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                          <input
                            type="submit"
                            name="login-submit"
                            id="login-submit"
                            tabindex="4"
                            class="form-control btn btn-login"
                            value="Log In"
                          />
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-lg-12">
                          <div class="text-center">
                            <a
                              href="./forgotpassword.php"
                              tabindex="5"
                              class="forgot-password"
                              >Forgot Password?</a
                            >
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                  <form
                    id="register-form"
                    action="./register.php"
                    method="POST"
                    role=""
                    style="display: none"
                  >
                    <div class="form-group">
                      <input
                        type="text"
                        name="username"
                        id="username"
                        tabindex="1"
                        class="form-control"
                        placeholder="Username"
                        value=""
                        required
                      />
                    </div>
                    <div class="form-group">
                      <input
                        type="email"
                        name="email"
                        id="email"
                        tabindex="1"
                        class="form-control"
                        placeholder="Email Address"
                        value=""
                        required
                      />
                    </div>
                    <div class="form-group">
                      <input
                        type="password"
                        name="password" 
                        id="password"
                        tabindex="2"
                        class="form-control"
                        placeholder="Password"
                        required
                      />
                    </div>
                    <div class="form-group">
                      <input
                        type="password"
                        name="confirm_password"
                        id="confirm_password"
                        tabindex="2"
                        class="form-control"
                        placeholder="Confirm Password"
                        required
                      />
                    </div>
                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                          <input
                            type="submit"
                            name="register-submit"
                            id="register-submit"
                            tabindex="4"
                            class="form-control btn btn-register"
                            value="Register Now"
                          />
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="./javascript/goal.js"></script>
  </body>
</html>