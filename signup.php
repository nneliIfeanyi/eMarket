<?php
session_start();
include 'config.php';

/*if (isset($_SESSION['user'])) {
	
	$user = $_SESSION['user'];

}else{

	//redirect to login

	header("location:index.php");
}*/

	//Form validation variables..
$nameErr = $emailErr = $phoneErr = $addressErr = $passwordErr = $passwordErr2 = $comfirmErr = $comfirmErr2 = $msg = "";
$name = $email = $phone = $address = $msg2 = '';

if ($_SERVER['REQUEST_METHOD'] == "POST" ) {
	
	$name = mysqli_real_escape_string($conn, htmlspecialchars($_POST['name'], ENT_QUOTES, 'utf-8'));
	$email = mysqli_real_escape_string($conn, htmlspecialchars($_POST['email'], ENT_QUOTES, 'utf-8'));
	$phone = mysqli_real_escape_string($conn, htmlspecialchars($_POST['phone'], ENT_QUOTES, 'utf-8'));
	$address = mysqli_real_escape_string($conn, htmlspecialchars($_POST['address'], ENT_QUOTES, 'utf-8'));
	$password = mysqli_real_escape_string($conn, htmlspecialchars($_POST['password'], ENT_QUOTES, 'utf-8'));
	$c_password =mysqli_real_escape_string($conn, htmlspecialchars($_POST['comfirm_password'], ENT_QUOTES, 'utf-8'));
	//$avatar = null;

	if (empty($name)) {

		$nameErr = "Please kindly enter your name..";
		
	}elseif (empty($email)) {

		$emailErr = "Also input your email address..";
		
	}elseif (empty($phone)) {

		$phoneErr = "Your phone number is required!";
		
	}elseif (empty($address)) {

		$addressErr = "Address is required..";

	}elseif (empty($password)) {
		
		$passwordErr = "Input password..";

	}elseif (strlen($password) < 7) {
			
		$passwordErr = "Too short, password must be above 7 characters";

	}elseif (empty($c_password)) {
		
		$comfirmErr = "kindly comfirm password..";

	}elseif (strlen($c_password) < 7) {
			
			$comfirmErr = "Password does not match..";
		
	}elseif ($password !== $c_password) {
			
		$comfirmErr = "Password does not match try again..";

	}else{

		//Check if data already exist in database..

		$check = "SELECT * FROM custumers WHERE phone = '$phone'";
		$check_user = mysqli_query($conn,$check);
		$row_count = mysqli_num_rows($check_user);

       if ($row_count > 0) {

       		$msg = "A user already exist with same credentials try using a different phone number.";        
                       
       	}else{

       		//Insert to database...

       		$sql = "INSERT INTO custumers (name,email,phone,address,password) VALUES ('$name','$email','$phone','$address','$password')";

       		$result = mysqli_query($conn, $sql);

       		if ($result) {
       			
       			$msg2 = "Registration successful you will be redirected to the Login page.";

	            ?>
	           	 <meta http-equiv='refresh' content='5; login.php'>
	            <?php

       		}else{

       			$msg = "An error occured, Please try again later.";
       		}
       	}
	}
}

?>






<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sign Up</title>
	<link rel="stylesheet" type="text/css" href="css/w3.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body class="w3-serif body">

	<?php
		include 'header.php';
	?>
	<div class="w3-padding-32 login_div">
	
		<div class="w3-padding">

			<div class="w3-large w3-center w3-text-teal w3-round w3-tag">
				<i class=""><b>
				Use the form below to register and create a customer's profile.
					</b></i>
			</div>

			<!--Login  Message-->
			<div class="w3-margin-bottom w3-red w3-tag">
				<?= $msg ?>
			</div>

			<div class="w3-margin-bottom w3-teal w3-tag">
				<?= $msg2 ?>
			</div>

			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
				<div class="w3-margin-bottom w3-margin-top w3-blue-grey w3-padding-small">
					<input type="text" name="name" class="w3-input" placeholder="Enter your name.."  value="<?= $name ?>">
					<?php
				  	if (!empty($nameErr)) {

				  		?>
				  		 <span class="w3-small w3-tag w3-red"><?= $nameErr ?></span>
				  		 <?php
				  	}
				 
					?>
				</div>

				<div class="w3-margin-bottom w3-blue-grey w3-padding-small">
					<input type="email" name="email" class="w3-input" placeholder="Email.." value="<?= $email ?>">
					
					<?php
				  	if (!empty($emailErr)) {

				  		?>
				  		 <span class="w3-small w3-tag w3-red"><?= $emailErr ?></span>
				  		 <?php
				  	}
				 
					?>
				</div>

				<div class="w3-blue-grey w3-padding-small w3-margin-bottom">
				  <input type="number" name="phone" class="w3-input" placeholder="Phone number.." value="<?= $phone ?>">

				  <?php
				  	if (!empty($phoneErr)) {

				  		?>
				  		 <span class="w3-small w3-tag w3-red"><?= $phoneErr ?></span>
				  		 <?php
				  	}
				 
					?>
				</div>

				<div class="w3-blue-grey w3-padding-small w3-margin-bottom">
				  <input type="text" name="address" class="w3-input" placeholder="Address.." value="<?= $address ?>">
				 <?php
				  	if (!empty($addressErr)) {

				  		?>
				  		 <span class="w3-small w3-tag w3-red"><?= $addressErr ?></span>
				  		 <?php
				  	}
				 
					?>
				</div>
				<div class="w3-blue-grey w3-padding-small w3-margin-bottom">
				  <input type="password" name="password" class="w3-input" placeholder="Password..">
				  <?php
				  	if (!empty($passwordErr)) {

				  		?>
				  		 <span class="w3-small w3-tag w3-red"><?= $passwordErr ?></span>
				  		 <?php
				  	}
				 
					?>
				</div>
				<div class="w3-blue-grey w3-padding-small w3-margin-bottom">
				  <input type="password" name="comfirm_password" class="w3-input" placeholder="Comfirm password..">
				 <?php
				  	if (!empty($comfirmErr)) {

				  		?>
				  		 <span class="w3-small w3-tag w3-red"><?= $comfirmErr ?></span>
				  		 <?php
				  	}
				 
					?>
				</div>

				<div class="w3-margin-bottom">
					<input type="submit" name="register" value="Sign Up" class="w3-btn w3-teal w3-round-large">
				</div>

			</form>

			<div class="w3-medium w3-light-grey w3-tag">Already done this, proceed to <a href="login.php" style="text-decoration: none;font-weight: bold;"><span class="w3-text-teal">Log In</span></a></div>
		</div>
		
	</div>

</body>
</html>