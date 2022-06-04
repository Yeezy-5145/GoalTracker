<?php
require_once "backend/dbconnect.php";
require_once "backend/session.php";
$userName = $_POST['userName'];
$birthday = $_POST['birthday'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$street = $_POST['street'];
$state = $_POST['state'];
$city = $_POST['city'];
$zip = $_POST['zip'];
$currPass = $_POST['currPass'];
$newPass = $_POST['newPass'];
$conPass = $_POST['conPass'];
$id = $_SESSION['user_id'];
$result = mysqli_query($link,"SELECT * FROM user WHERE user_id=$id");
$personal = mysqli_fetch_array($result);
$verify = password_verify($currPass, $personal["password"]);
$checkUsername = mysqli_query($link,"SELECT * FROM user WHERE username='$userName'");
$redirect_msg = "You will be redirect back to the edit user profile page after 2 seconds.<br>";
$success = True;

echo $redirect_msg;
//check username
if($checkUsername->num_rows ==0){
   $sql = "UPDATE user SET username='$userName' WHERE user_id = $id ";
   mysqli_query($link, $sql);
}
else if($userName == $personal["username"]){

}
else{
   echo "<script>alert('Your username entered is existed. Please enter a new username.');</script>";
   $success = False;
}

$sql = "UPDATE user SET birthday='$birthday', 
      first_name='$firstName', last_name='$lastName', email='$email',phone_number='$phone'
      WHERE user_id = $id ";

mysqli_query($link, $sql);

$sql2 = "UPDATE address SET street='$street', city='$city', state='$state', zip_code='$zip'
        WHERE user_id =$id ";
        
mysqli_query($link, $sql2);


//check password
if(empty($currPass)&& empty($newPass)&& empty($conPass)){

}
else if($verify){
   if(($newPass == $conPass) && !(empty($newPass) &&empty($conPass))){
		$hashPass = password_hash($newPass, PASSWORD_DEFAULT);
		$sql3 = "UPDATE user SET password='$hashPass' WHERE user_id =$id";
		mysqli_query($link, $sql3);
      	echo "<script>alert('Password update successfully.');</script>";
   }
   else{
      echo "<script>alert('The new password entered twice does not match');</script>";
	  $success = False;
   }
}
else{
   echo "<script>alert('Your password entered does not match with current password.');</script>";
   $success = False;
}

//check for form request method 
if(isset($_POST["submit"])) { 
	// check for uploaded file 
	if((isset($_FILES['avatar']['size']))&& $_FILES['avatar']['size']>0) { 
		// avatar name, type, size, temporary name 
		$file_name = $_FILES['avatar']['name']; 
		$file_tmp_name = $_FILES['avatar']['tmp_name']; 
		$file_size = $_FILES['avatar']['size']; 
		// target directory 
		$target_dir = "upload/"; 
		$file_type = pathinfo($target_dir.$file_name, PATHINFO_EXTENSION);

		// target directory 
		$target_dir = "upload/"; 
		$allow_types = array('jpg','png','jpeg','gif');
		if(in_array($file_type, $allow_types)){
			// uploding profile
			if(move_uploaded_file($file_tmp_name,$target_dir.$file_name)) { 
				$sql3 = "UPDATE user SET avatar='$file_name'
				WHERE user_id = $id"; 
				$_SESSION['avatar_src'] = "upload/".$file_name;
				
				// run query 
				$r = mysqli_query($link,$sql3); 
				
				if(mysqli_affected_rows($link) == 1) { 
					// echo $redirect_msg;
					// echo "<p style='color:green'><b><br>File has been successfully uploaded</b></p>"; 
					// header("Refresh:3 url=EditUserProfile.php");
				} 
				else { 
					echo "<h1 style='color:red><br>A system error has been occured</h1>".mysqli_error($link); 
					header("Refresh:2 url=EditUserProfile.php");
					$success = False;
				} 
			} 
			else{ 
				echo "<h1 style='color:red'><br>File cannot be uploaded </h1>"; 
				header("Refresh:2 url=EditUserProfile.php");
				$success = False;
			} 
		}
		else{
			echo "<h1 style='color:red'><br> Sorry, only JPG, JPEG, PNG & GIF files are allowed to upload.</h1>";
			header("Refresh:2 url=EditUserProfile.php");
			$success = False;
		}
	} 
} 
if($success){
	echo "<script>alert('User Profile Update Successfully');</script>";
	header("Refresh:0 url=EditUserProfile.php");
}
else{
	header("Refresh:2 url=EditUserProfile.php");
}
?>