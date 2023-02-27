<?php
session_start();
include 'config.php';
include 'functions.php';
$user_data = check_login($conn);

$msg='';

if ($_GET['amt'] && $_GET['id'] && $_GET['title'] || $_GET['describe'] && $_GET['price'] && $_GET['img'] ) {
	//Collect product data..
	$amount=$_GET['amt'];
	$id = $_GET['id'];
	$title = $_GET['title'];
	$description = $_GET['describe'];
	$price = $_GET['price'];
	$img = $_GET['img'];

	//Collect customer data
	$customer_name = $user_data['name'];
	$customer_id = $user_data['id'];
	$customer_email = $user_data['email'];
	$customer_phone = $user_data['phone'];
	$customer_address = $user_data['address'];

	
	$sql = "INSERT INTO cart (name,email,phone,address,product_title,price,quantity,image,product_id,user_id) VALUES ('$customer_name','$customer_email','$customer_phone','$customer_address','$title','$price','$amount','$img','$id','$customer_id')";
	$query = mysqli_query($conn, $sql);

	if ($query) {

		$msg = "
				<h2 class='w3-padding w3-large w3-padding-16 w3-margin'>You have successfully added <span style='color:teal;font-size:25px;'>$amount $title</span> to your shopping cart..</h2>

				<div class='w3-margin-top w3-padding'>

					<a href='index.php' class='w3-btn w3-block w3-margin-bottom w3-text-light-grey w3-teal w3-large w3-round-large'>Continue to browse</a>

					<a href='checkout.php?amt=$amount&id=$id&title=$title&describe=$description&price=$price&img=$img' class='w3-btn w3-block w3-text-light-grey w3-blue w3-margin-bottom w3-large w3-round-large'>Buy now</a>
					<a href='cart.php' class='w3-btn w3-block w3-margin-bottom w3-text-light-grey w3-blue-gray w3-large w3-round-large'>View Cart</a>

				</div>


				";
	//echo "$id $title $amount $description $price $customer_id $customer_email $customer_phone $customer_address";

	}else{

		$msg =  "it didnt work, something went wrong, the product was not added to cart.";
	}
}

?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Added to cart</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/w3.css">
	<style type="text/css">
		.box {
		  margin: auto;
		  padding: 0px;
		  border: .5px solid #fff;
		  width: 90%;
		 
		}

		.box h1{
			color: darkgrey;
		}
		.title-img{
			display: flex;
			align-items: center;
			justify-content: space-around;
		}

	</style>

</head>

<body class="w3-serif">

	<?php

		include 'header.php';

	?>
	<div class="box w3-card-4">
		<?=$msg?>
	</div>

</body>
</html>