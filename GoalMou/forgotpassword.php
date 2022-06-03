<?php
    session_start();
    include_once 'dbconnect.php';
    //Include required PHPMailer files
    require './phpmailer/PHPMailer.php';
    require './phpmailer/SMTP.php';
    require './phpmailer/Exception.php';
  //Define name spaces
    use PHPMailer as GlobalPHPMailer;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
  //Create instance of PHPMailer
    $mail = new PHPMailer();
  //Set mailer to use smtp
    $mail->isSMTP();
  //Define smtp host
    $mail->Host = "smtp.gmail.com";
  //Enable smtp authentication
    $mail->SMTPAuth = true;
  //Set smtp encryption type (ssl/tls)
    $mail->SMTPSecure = "tls";
  //Port to connect smtp
    $mail->Port = "587";
  //Set gmail username
    $mail->Username = "goalmou@gmail.com";
  //Set gmail password
    $mail->Password = "goalmou123";
  //Email subject
    $mail->Subject = "Reset Password for GoalMou";
  //Set sender email
    $mail->setFrom('goalmou@gmail.com');
  //Enable HTML
    $mail->isHTML(true);
  

  //Finally send email
	// if ( $mail->send() ) {
	// 	echo "Email Sent..!";
	// }else{
	// 	echo "Message could not be sent." . $mail->ErrorInfo;
	// }

  //function to generate random password
  function generate_password($len = 8){
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $password = substr( str_shuffle( $chars ), 0, $len );
    return $password;
   }

  //  $param_password = password_hash($password, PASSWORD_DEFAULT);
  // $email = $_POST['email'];
  // $result = mysqli_query($link,"UPDATE password FROM users where email='" . $_POST['email']. "'");
  // $row = mysqli_fetch_assoc($result);
  // $password=$row['password'];
  //   if ( $mail->send() ) {
  //     echo "Email Sent..!";
  //   }else{
  //     echo "Message could not be sent." . $mail->ErrorInfo;
  //     }

  if(isset($_POST['submit'])){
    $email = $_POST['email'];
      //Add recipient
      $mail->addAddress($email);
    // Prepare an insert statement
    // $sql = "UPDATE password INTO users VALUES ?";
    $password = generate_password();
    //Email body
    $mail->Body = "Your temporary password is $password. Please change your password after logging in to ensure better security.";
    // $sql = "UPDATE users SET password = $password WHERE email = $email" ;
    $password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
    $sql = "UPDATE `user` SET `password`= '" . $password . "' WHERE `email` = '" . $email . "'";
      // echo $sql;
    if($stmt = mysqli_prepare($link, $sql)){
        // Set parameters
        // Attempt to execute the prepared statement
        if((mysqli_stmt_execute($stmt)) && ($mail->send())){
            // echo "Email Sent and stmt executed";s
        } else{
            echo "Oops! Something went wrong. Please try again later." . $mail->ErrorInfo;

        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
  }
        


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" type="text/css" href="stylesheets\forgotpw.css" />
    <link
      href="https://fonts.googleapis.com/css?family=Poppins"
      rel="stylesheet"
    />
    <title>GoalMou Forgot PW</title>
  </head>
  <body>
    <div class="card login-form">
      <div class="card-body">
        <h3 class="card-title text-center">Reset password</h3>

        <div class="card-text">
          <form action="./forgotpassword.php" method="POST">
            <div class="form-group">
              <label for="exampleInputEmail1"
                >Enter your email address and we will send you a link to reset
                your password.</label
              >
              <p></p>
              <input
                type="email"
                class="form-control form-control-sm"
                placeholder="Enter your email address"
                name="email"
                required
              />
            </div>
            <div class="d-grid gap-2">
              <input class="btn btn-primary" type="submit" value="Send password reset email" name="submit">
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
