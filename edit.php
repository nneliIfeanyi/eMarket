<?php
session_start();
include 'config.php';
include 'functions.php';
$user_data = check_login($conn);
$id = $user_data['id'];

$sql = "SELECT * FROM custumers WHERE id = '$id'";
$query = mysqli_query($conn, $sql);

if (mysqli_num_rows($query) > 0) {

	while ($result = mysqli_fetch_assoc($query)) {
		$id=$result['id'];
		$name=$result['name'];
		$phone=$result['phone'];
		$email=$result['email'];
		$address = $result['address'];


	}
}else{

	$msg = "An error occured.";

}


$nameErr = $emailErr = $phoneErr = $addressErr = $msg = "";


if ($_SERVER['REQUEST_METHOD'] == "POST" ) {
	
	$name = mysqli_real_escape_string($conn, htmlspecialchars($_POST['name'], ENT_QUOTES, 'utf-8'));
	$email = mysqli_real_escape_string($conn, htmlspecialchars($_POST['email'], ENT_QUOTES, 'utf-8'));
	$phone = mysqli_real_escape_string($conn, htmlspecialchars($_POST['phone'], ENT_QUOTES, 'utf-8'));
	$address = mysqli_real_escape_string($conn, htmlspecialchars($_POST['address'], ENT_QUOTES, 'utf-8'));


	if (empty($name)) {

		$nameErr = "Please kindly enter your name..";
		
	}elseif (empty($email)) {

		$emailErr = "Also input your email address..";
		
	}elseif (empty($phone)) {

		$phoneErr = "Your phone number is required!";
		
	}elseif (empty($address)) {

		$addressErr = "Address is required..";

	}else{

		//Check if data already exist in database..

		$sql = "UPDATE custumers SET name='$name', email='$email', phone='$phone', address='$address' WHERE id = '$id'";
		$query = mysqli_query($conn,$sql);
		

   		if ($query) {
   			
   			$msg = "<h2 class='w3-text-light-grey'> You have successfully updated your data info.</h2>";

            ?>
           	 <meta http-equiv='refresh' content='2; shipping.php'>
            <?php

   		}else{

   			$msg = "<h2 class='w3-text-red'>An error occured, Please try again later.";
   		}
  
	}
}

?>






<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Update Info</title>
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
				Crosscheck your details below and make corrections..
					</b></i>
			</div>

			<!--Login  Message-->
			<div class="w3-margin-bottom">
				<?= $msg ?>
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

				<div class="w3-margin-bottom">
					<input type="submit" name="update" value="Update" class="w3-btn w3-teal w3-round-large">
				</div>

			</form>
		</div>
		
	</div>

</body>
</html>