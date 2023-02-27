<?php
session_start();
include 'config.php';
include 'functions.php';

$user_data = check_login($conn);
$id = $user_data['id'];







?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cart</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/w3.css">
</head>

<body class="w3-serif">

	<?php

		include 'header.php';

	?>



	<section class="w3-padding-small" style="background:rgba(0, 0, 0, 0.6);">
	    <div class="w3-row">
	      <div class="w3-col m12 l12 s12">
	    <div style="height: auto;overflow-y: scroll;" class="">
	      <h2 class="w3-center my-font w3-text-white w3-large w3-padding-16"><span><img src="img/basket_cart.png" width="40px" height="30px" style="filter: invert(10%);"></span>&nbsp;My Shopping Cart</h2>
	      <div class="">
	        <table class="w3-table-all">
	          <thead>
	            <tr class="w3-text-black">
	              <th><b>S/N</b></th>
	              <th><b>Item Name</b></th>
	              <th><b>Quantity</b></th>
	               <th><b>Price</b></th>
	              <th><b>Image</b></th>
	    
	              <th><b>Action</b></th>
	            </tr>
	          </thead>

	          <tbody>
	            <?php 
	           

	              $sql = "SELECT * FROM cart WHERE user_id = '$id' ORDER BY id DESC" ;
	              $query = mysqli_query($conn, $sql);
	              $i = 1;

	              if (mysqli_num_rows($query) > 0) {
	              	
	              	while($result = mysqli_fetch_array($query)){

	          		   $id = $result['id'];
	              	   $title = $result['product_title'];
	              	   $amount = $result['quantity'];
	              	   $price = $result['price']*$amount;
	              	   $img = $result['image'];
	              	   $description = $result['description'];


	            ?>
	            <tr class="w3-text-dark-grey">
	              <td><?php echo $i; ?></td>
	              <td><?php  echo $title; ?></td>
	              <td><?php  echo $amount; ?></td>
	              <td>&#8358;<?php  echo $price; ?></td>
	              <td><img src="admin/<?php  echo $img; ?>" width="80px" height="50px"></td>
	              
	              <td><a href="delete.php?id=<?=$id?>" class="w3-text-red w3-tiny">Remove</a>
	              <a href="checkout.php?amt=<?=$amount?>&id=<?=$id?>&title=<?=$title?>&describe=<?=$description?>&price=<?=$price?>&img=<?=$img?>" class="w3-text-green w3-tiny">Buy Now</a>
	              

	            </tr>

	            <?php

	              $i++;

	              }
	             
	              ?>
	              	<h4>Total : &#8358;</h4>
		          <?php
	          }else{

	          	?>

	          		<tr class="w3-text-red w3-large">
	          		  <td colspan="6">You have not added any item to your shopping cart.</td></tr>
	          		<tr class="w3-text-dark-grey"><td colspan="6">Kindly click this buton to add products <a href="index.php" class="w3-btn w3-teal w3-small">Browse Products</a></td>
	          		</tr>

	          	<?php


	          		}

	            ?>
	          </tbody>
	        </table>
	      </div>
	   </div>

	    </div>
	    <?php

	    #include 'menu.php';

	     ?>
	  </div>
	</section>