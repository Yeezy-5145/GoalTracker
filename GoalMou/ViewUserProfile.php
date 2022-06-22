<?php
	require_once "backend/dbconnect.php";
  require_once "backend/session.php";
	$id = $_SESSION['user_id'];
	$result1 = mysqli_query($link,"SELECT * FROM user WHERE user_id=$id");
	$personal = mysqli_fetch_array($result1);
	$result2 = mysqli_query($link,"SELECT * FROM address WHERE user_id=$id");
	$address = mysqli_fetch_array($result2);
	$avatar_src = "upload/".$personal['avatar'];
?>

<!DOCTYPE html>
<html lang= 'en'>
<head>
	<title>GoalMou Account</title>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"crossorigin="anonymous"/>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<!--overwrite-->
	<link rel="stylesheet" href="./stylesheets/progressbar.css">
	<link rel="stylesheet" href="./stylesheets/notif.css"/>
 	<link rel ="stylesheet" type=" text/css " href ="stylesheets/gl2.css">
	<link rel ="stylesheet" type=" text/css " href ="stylesheets/profileSheet.css">


	<!--fonts-->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Caveat&family=Poppins:wght@300&display=swap" rel="stylesheet">
</head>

<body>
	<header>
	<?php
		include_once './header.php';
	?>
	<div class="container">
		<div class="row gutters">
		<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
		<div class="card h-100">
			<div class="card-body">
				<div class="account-settings">
					<div class="user-profile">
						<div class="picture-container">
							<div class="picture">
								<img src="<?php echo $avatar_src;?>" class="picture-src" id="wizardPicturePreview" title="">
							</div>
						</div>
						<h5 class="user-name"><?php echo $personal["username"]; ?></h5>
						<h6 class="user-email"><?php echo $personal["email"]; ?></h6>
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
							<input type="text" class="form-control" id="userName" name = "userName" placeholder="" readonly value = "<?php echo $personal["username"]; ?>">
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
						<div class="form-group">
							<label for="Birthday">Birthday</label>
							<input type="text" class="form-control" id="birthday" name="birthday" placeholder="" readonly value = "<?php echo $personal["birthday"]; ?>">
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
						<div class="form-group">
							<label for="firstName">First Name</label>
							<input type="text" class="form-control" id="firstName" name="firstName" placeholder="" readonly value = "<?php echo $personal["first_name"]; ?>">
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
						<div class="form-group">
							<label for="lastName">Last Name</label>
							<input type="text" class="form-control" id="lastName" name="lastName" placeholder="" readonly value = "<?php echo $personal["last_name"]; ?>">
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" class="form-control" id="email" name="email" placeholder="" readonly value = "<?php echo $personal["email"]; ?>">
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
						<div class="form-group">
							<label for="phone">Phone</label>
							<input type="text" class="form-control" id="phone" name="phone" placeholder="" readonly value = "<?php echo $personal["phone_number"]; ?>">
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
							<input type="name" class="form-control" id="street" name="street" placeholder="" readonly value = <?php echo $address["street"]; ?>>
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
						<div class="form-group">
							<label for="City">City</label>
							<input type="name" class="form-control" id="city" name="city" placeholder="" readonly value = <?php echo $address["city"]; ?>>
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
						<div class="form-group">
							<label for="State">State</label>
							<input type="text" class="form-control" id="state" name="state" placeholder="" readonly value = <?php echo $address["state"]; ?>>
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
						<div class="form-group">
							<label for="Zip">Zip Code</label>
							<input type="text" class="form-control" id="zip" name="zip" placeholder="" readonly value = <?php echo $address["zip_code"]; ?>>
						</div>
					</div>
				</div>
				<div class="row gutters">
					<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="gap-3 d-md-flex justify-content-md-end text-center">
							<a href = "EditUserProfile.php">
							<button type="button" id="submit" name="submit" class="btn btn-sm btn-primary">Edit Profile</button>
							</a>
						</div>
					</div>
				</div>
				
			</div>
		</div>
		</div>
		</div>
		</div>
		<!-- Include Bootstrap JavaScript plugin -->
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<script type="text/javascript" src="javascript/profileScript.js"></script>

		<script src="./javascript/user.js"></script>
		<script type="text/javascript" src="./javascript/progressbar.js"></script>
</body>

<footer>

</footer>
</html>