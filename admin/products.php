<?php
session_start();
include '../config.php';
include '../functions.php';

$user_data = check_login($conn);

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Products</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/w3.css">
</head>

<body class="w3-serif">

	<?php

		include 'header.php';
	
	?>



	<section class="w3-padding-small" style="background:rgba(0, 0, 0, 0.6);">
	    <div class="w3-row">
	      <div class="w3-col m12 l12 s12">
	    <div style="height: auto;overflow-y: scroll;" class="">
	      <h2 class="w3-center my-font w3-text-white w3-large w3-padding-16">My Products</h2>
	      <div class="">
	     
	        <table class="w3-table-all">
	          <thead>
	            <tr class="w3-text-black">
	              <th><b>S/N</b></th>
	              <th><b>Item Name</b></th>
	              <th><b>Description</b></th>
	              <th><b>Image</b></th>
	               <th><b>Price</b></th>
	              <th><b>Action</b></th>
	            </tr>
	          </thead>

	          <tbody>
	            <?php 
	           

	              $sql = "SELECT * FROM products ORDER BY id DESC" ;
	              $query = mysqli_query($conn, $sql);
	              $i = 1;
	              if (mysqli_num_rows($query) > 0) {
	              	
	              	while($result = mysqli_fetch_array($query)){

		             	$id = $result['id'];
		                $title = $result['title'];
		                $amount = $result['description'];
		                $price = $result['price'];
		                $img = $result['img'];
	             
	            ?>
	            <tr class="w3-text-dark-grey">
	              <td><?php echo $i; ?></td>
	              <td><?php  echo $title; ?></td>
	              <td><?php  echo $amount; ?></td>
	              <td><img src="<?php  echo $img; ?>" width="80px" height="50px"></td>
	              <td><?php  echo $price; ?></td>
	              
	              <td>
	              	<a href="edit.php?id=<?=$id;?>" class="w3-text-red w3-tiny">Edit
	              	</a>
	              <a href="delete.php?id=<?=$id?>" class="w3-text-green w3-tiny">Delete</a>
	              

	            </tr>

	            <?php

	              $i++;

	              }

	          }else{

	          	?>

	          		<tr class="w3-text-red w3-large">
	          		  <td colspan="6">Your show room is empty.. Because you have not added any products to display to your customers.</td></tr>
	          		<tr class="w3-text-dark-grey"><td colspan="6">Kindly click this buton to add products <a href="index.php" class="w3-btn w3-teal w3-small">Add Product</a></td>
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

	    include 'menu.php';

	     ?>
	  </div>
	</section>