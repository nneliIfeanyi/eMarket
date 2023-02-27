<?php
session_start();
include 'config.php';
include 'functions.php';


if ($_GET['amt'] && $_GET['id'] && $_GET['title'] || $_GET['describe'] && $_GET['price'] && $_GET['img'] ) {
	//Collect product data..
	$amount=$_GET['amt'];
	$id = $_GET['id'];
	$title = $_GET['title'];
	$description = $_GET['describe'];
	$price = $_GET['price'];
	$img = $_GET['img'];
	$total = $amount*$price;

}else{


}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Comfirm Checkout</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/w3.css">

	<style type="text/css">
		.box{
		  margin: auto;
		  padding: 0px;
		  border: .5px solid #fff;
		  width: 90%;
		 
		}

		.box h1{
			color: grey;
		}
		.title-img{
			display: flex;
			align-items: center;
			justify-content: space-around;
		}


	@media(min-width: 668px){

		.title-img{
			display: flex;
			align-items: center;
			justify-content: space-around;

			margin: auto;
			width: 60%;
		}
	}


	</style>
</head>

<body class="w3-serif">

	<?php

		include 'header.php';

	?>
	<div class="box w3-card-4 w3-margin-top">

		<div class="w3-row-padding">

			<h1 class="w3-center">Order Details</h1>

				<div class="title-img w3-padding-16 ">
					<p class="w3-xlarge"><?=$title?></p>

					<input type="hidden" name="image" value="<?=$img?>">
					<img src="admin/<?=$img?>" class="w3-circle w3-image" height="100px" width="50%">
				</div>

				<div class="w3-col l12 m12 s12 w3-margin-bottom w3-padding-16 w3-center">

					<p class="w3-center"><?=$description?></p>
				</div>


				<div class="w3-half w3-center">
					<ul class="w3-ul w3-border">
						<li>Quantity :&nbsp;<span class="w3-small"><?=$amount?></span></li>
						<li>Price :&nbsp;<span class="w3-small">&#8358;<?=$price?></span></li>
						<li>Total :&nbsp;<span class="w3-small">&#8358;<?=$total?></span></li>
					</ul>

				</div>

				<div class="w3-half w3-center">
					<p><b>NOTE:</b></p>
					<h4 class="w3-text-green w3-medium" >Pay on Delivery option attracts extra charges.</h4>
				</div>

				<div class="w3-col l12 m12 s12 w3-margin-top w3-padding-16 w3-center">

					<a href="shipping.php" class="w3-btn w3-text-dark-grey w3-teal 	w3-large w3-round-large">Pay on delivery</a>

					<a href="shipping.php?amount=<?=$total?>" class="w3-btn w3-text-dark-grey w3-blue 	w3-large w3-round-large">Pay Now</a>

				</div>

			</div>


	</div>


</body>
</html>