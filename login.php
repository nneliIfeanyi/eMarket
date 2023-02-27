<?php
session_start();
include 'config.php';

$phoneErr = $passwordErr = $msg = '';


if ($_SERVER['REQUEST_METHOD'] == "POST" ) {
	
	$phone = mysqli_real_escape_string($conn, htmlspecialchars($_POST['phone'], ENT_QUOTES, 'utf-8'));
	$password = mysqli_real_escape_string($conn, htmlspecialchars($_POST['password'], ENT_QUOTES, 'utf-8'));

	if (empty($phone)) {

		$phoneErr = "Please enter your phone number..";
		
	}elseif (empty($password)) {
		
		$passwordErr = "Input your password..";

	}elseif (strlen($password) < 7) {
			
		$passwordErr = "Too short, password must be above 7 characters";

	}else{

		$sql = "SELECT * FROM custumers WHERE phone = '$phone' LIMIT 1";
		$query = mysqli_query($conn, $sql);

		if (mysqli_num_rows($query) > 0) {
			
			$result = mysqli_fetch_assoc($query);

			$user_name =$result['name'];
			$user_phone =$result['phone'];
		 	$user_password =$result['password'];
			
			if ($user_password == $password) {

				if ($user_phone == '08122321931') {
					
			 		$_SESSION['user'] = $user_phone;

			 		$msg = "<b>Login Successful</b>";

		            ?>
		           	 <meta http-equiv='refresh' content='2; admin/index.php'>
		            <?php


				}else{

				$_SESSION['user'] = $user_phone;

		 		$msg = "<b>Login Successful</b>";

	            ?>
	           	 <meta http-equiv="refresh" content="2; index.php">
	            <?php


				}

		 	}else{

		 		$passwordErr = "Password is incorrect!";
		 	}

		}else{

			$phoneErr = "Cross check your phone number..";
		}
	}

}






?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Log In</title>
	<link rel="stylesheet" type="text/css" href="css/w3.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body class="w3-serif body">

	<?php
		include 'header.php';
	?>
	<div class="w3-padding-32 login_div">
	
		<div class="w3-padding">

			<div class="w3-large w3-text-light-grey w3-round w3-tag">
				<i class=""><b>
				Provide your details below to Login.</b></i>
			</div>

			<!--Login Success Message-->
			<div class="w3-margin-bottom w3-text-teal w3-padding-small" style="width:90%;">
				<?= $msg ?>
			</div>

			<!--Login Form -->
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
				
				<div class="w3-grey w3-padding-small w3-margin-bottom">
				  <input type="number" name="phone" class="w3-input" placeholder="Phone number.." value="<?= $phone ?>">
				  <?php
				  	if (!empty($phoneErr)) {

				  		?>
				  		 <span class="w3-small w3-tag w3-red"><?= $phoneErr ?></span>
				  		 <?php
				  	}
				 
					?>
				</div>

				<div class="w3-grey w3-padding-small w3-margin-bottom">
				  <input type="password" name="password" class="w3-input" placeholder="Password..">
				  <?php
				  	if (!empty($passwordErr)) {

				  		?>
				  		 <span class="w3-small w3-tag w3-red"><?= $passwordErr ?></span>
				  		 <?php
				  	}
				 
					?>
				</div>
				
				<div class="w3-margin-bottom">
					<input type="submit" name="login" value="Sign In" class="w3-btn w3-teal w3-round-large">
				</div>

			</form>


			<div class="w3-medium w3-text-light-grey">
				Not yet registered, proceed to <a href="Signup.php" style="text-decoration: none;font-weight: bold;"><span class="w3-text-teal">Sign Up</span></a></div>
			</div>
		</div>
		
	</div>

</body>
</html>