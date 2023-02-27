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
	<title>My Customers</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="stylesheet" type="text/css" href="../css/w3.css">
</head>

<body class="w3-serif">

	<?php

		include 'header.php';

	?>



	<section class="w3-padding-small" style="background: rgba(0, 0, 0, 0.6);">
	    <div class="w3-row">
	      <div class="w3-col m12 l12 s12">
	    <div style="height: auto;overflow-y: scroll;" class="">
	      <h2 class="w3-center my-font w3-text-white w3-large w3-padding-16">My Customers</h2>
	      <div class="">
	        <table class="w3-table-all">
	          <thead>
	            <tr class="w3-text-black">
	              <th><b>S/N</b></th>
	              <th><b>Name</b></th>
	              <th><b>Phone</b></th>
	               <th><b>Email</b></th>
	              <th><b>Address</b></th>
	            </tr>
	          </thead>

	          <tbody>
	            <?php 
	           

	              $sql = "SELECT * FROM custumers ORDER BY id DESC" ;
	              $query = mysqli_query($conn, $sql);
	              $i = 1;
	              if ($query) {
	              	
	              	while($result = mysqli_fetch_array($query)){

	              	
	              	  $name = $result['name'];
	              	  $phone = $result['phone'];
	              	  $email = $result['email'];
	              	  $address = $result['address'];
	              
	            ?>
	            <tr class="w3-text-dark-grey">
	              <td><?php echo $i; ?></td>
	              <td><?php  echo $name; ?></td>
	              <td><?php  echo $phone; ?></td>
	              <td><?php  echo $email; ?></td>
	              <td><?php  echo $address; ?></td>
	            </tr>

	            <?php

	              $i++;

	              }

	          }else{

	          	?>

	          		<tr class="w3-text-red w3-large">
	          		  <td colspan="6">No Customers yet has identified with your online business.</td></tr>
	          		<tr class="w3-text-dark-grey"><td colspan="6">Why not consider advertising your brand online to create awareness of your online presence.</td>
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