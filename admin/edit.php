<?php
session_start();
include '../config.php';
include '../functions.php';
$user_data = check_login($conn);
$msg = $titleErr = $priceErr= $imgErr=$desc= '';

	
if ($_GET['id']) {
	
	$id = $_GET['id'];

	$sql ="SELECT * FROM products WHERE id = '$id' ";
	$query = mysqli_query($conn, $sql);

	if ($query) {

		$result = mysqli_fetch_assoc($query);
		$title = $result['title'];
		$desc = $result['description'];
		$image = $result['img'];
		$category = $result['category'];
		$price = $result['price'];
		$discount = $result['discount_p'];

	}else{

		$msg = "An error occured.";
	}
	
}else{ 

	if ($_SERVER['REQUEST_METHOD'] == "POST" ) {


	    $id = $_POST['id'];
	    $title = mysqli_real_escape_string($conn, htmlspecialchars($_POST['title'], ENT_QUOTES, 'utf-8'));
	    $description = mysqli_real_escape_string($conn, htmlspecialchars($_POST['describe'], ENT_QUOTES, 'utf-8'));
	   
	    $price = mysqli_real_escape_string($conn, htmlspecialchars($_POST['price'], ENT_QUOTES, 'utf-8'));
	    $discount = mysqli_real_escape_string($conn, htmlspecialchars($_POST['discount'], ENT_QUOTES, 'utf-8'));

	   	if (empty($title)) {
	   		
	   		$titleErr = "Title is required";
	   	}elseif (empty($price)) {
	   		
	   		$priceErr = "price is required";
	   	}else{


	   		$sql = "UPDATE products SET title = '$title', description = '$description', price = '$price' WHERE id = '$id'";
	   		 $query = mysqli_query($conn, $sql);

	   		 //Update cart aswell.. 

	   		 $sql2 = "UPDATE cart SET product_title = '$title', description = '$description', price = '$price' WHERE product_id = '$id'";
	   		 $query2 = mysqli_query($conn, $sql2);


	   		 if (!$query2) {

	   		     ?>

	   		     
	   		     <script type="text/javascript">
	   		     	alert('An error occured.')
	   		     </script>
	   		     <meta http-equiv="refresh" content=".01; products.php">
	   		     <?php

	   		 }else{
	   		     
	   		    
	   		     ?>

	   		     
	   		     <script type="text/javascript">
	   		     	alert('Product updated successfully.')
	   		     </script>
	   		     <meta http-equiv="refresh" content=".01; products.php">
	   		     <?php
	   		     
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
	<title>Update Info</title>
	<link rel="stylesheet" type="text/css" href="../css/w3.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body class="w3-serif">

	<?php
		include 'header.php';
	?>
	<div class="w3-padding-32 login_div">
	
		<div class="w3-padding">

			<div class="w3-large w3-center w3-text-teal w3-round w3-tag">
				<i class=""><b>
				Edit and Update Product..
					</b></i>
			</div>

			<!--Login  Message-->
			<div class="w3-margin-bottom w3-text-light-grey">
				<?= $msg ?>
			</div>

			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
				

				<div class="w3-card">
				  <input type="text" name="title" class="w3-input" placeholder="Name of product" value="<?= $title ?>">
				</div>
				<span class="w3-small w3-tag w3-red"><?= $titleErr ?></span>

				
				<div class=" w3-card w3-margin-bottom">
				  <input type="text" name="describe" class="w3-input" placeholder="Describe the product" value="<?= $desc ?>">
				</div>


				<div class="w3-row w3-card w3-margin-bottom">

				     <div class="w3-col l6 m6 s6">
				        <input type="number" name="price" class="w3-input" placeholder="Price.." value="<?= $price ?>">
				        <?php

				            if (!empty($priceErr)) {

				                ?>
				                 <span class="w3-small w3-tag w3-red"><?= $priceErr ?></span>
				                 <?php
				            }
				            


				        ?>
				         
				     </div>
				    

				      
				     <div class="w3-col l6 m6 s6">
				        <input type="number" name="discount" class="w3-input" placeholder="Discount Price.." value="<?= $discount ?>">
				     </div>
				 </div>
				
				<div class="w3-margin-bottom">

					<input type="hidden" name="id" value="<?=$id?>">
				    <input type="submit" name="add" value="Update Product" class="w3-btn w3-teal w3-round-large">
				</div>

				<p class="w3-large w3-text-light-grey">Click <a href="img_edit.php?id=<?=$id?>" class="w3-text-teal">here</a> to edit product image.</p>

				<a href="products.php" class="w3-btn w3-blue w3-opacity-min w3-text-dark-grey w3-round-large">Go back</a>

			</form>
		</div>
		
	</div>

</body>
</html>