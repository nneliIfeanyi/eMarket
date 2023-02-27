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
	<title>Shipping Details</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/w3.css">
</head>

<body class="w3-serif">

	<?php

		include 'header.php';

	?>


	<!-- Commerce SECTION -->


	<section class="commerce w3-padding">

		<div class="w3-center w3-serif">
			<h3>Comfirm Shipping Details</h3>
		</div>

			<?php 

			$sql = "SELECT * FROM custumers WHERE id = '$id'";
			$query = mysqli_query($conn, $sql);
			if (mysqli_num_rows($query) > 0) {

				while ($result = mysqli_fetch_assoc($query)) {
					$id=$result['id'];
					$name=$result['name'];
					$phone=$result['phone'];
					$email=$result['email'];
					$address = $result['address'];

			
			?>
		<div class="w3-row-padding w3-margin w3-border">

			<div class="">
				
				<div class="w3-padding-16 w3-padding-small w3-blue-grey">Kindly comfirm if the info provided below corresponds with your real identity.</div>
				<ul class="w3-ul w3-col w3-small l6 m6 s6">	
					<li><b>Name</b></li>
					<li><b>Phone</b></li>
					<li><b>Email</b></li>
					<li><b>Address</b></li>
				</ul>
				<ul class="w3-ul w3-small w3-text-blue-grey w3-col l6 m6 s6">	
					<li><?=$name?></li>
					<li><?=$phone?></li>
					<li><?=$email?></li>
					<li><?=$address?></li>
				</ul>

				<div class="w3-col l12 m12 s12 w3-margin-top w3-topbar w3-padding-16 w3-center">

					<form action="payment.php" method="POST"> 
					<input type="hidden" name="user_email" value="<?php echo $email; ?>"> 
					<input type="hidden" name="amount" value="<?php echo $amount; ?>"> 
					<input type="hidden" name="cartid" value="<?php echo $id; ?>"> 
					<button type="submit" name="pay_now" id="pay-now" title="Pay now">Yes it's me</button>
					</form>

					<a href="edit.php" class="w3-btn w3-text-dark-grey w3-red 	w3-large w3-round-large">No there's a mistake</a>

				</div>

			</div>

		</div>

		<?php

			}
		}else{

			?>

			<div class="w3-row-padding w3-center w3-card-2 w3-margin">

				<div class="w3-half w3-text-red w3-padding-large">
					<h2>No goods to display for now, check again later.</h2>
				</div>

			</div>

			<?php

		}

		?>

	</section>

	<!--=======
			Commerce ENDS===
				=========-->
				<!-- modal-->
				<div class="modal" id="myModal">
					<div class="modal-content w3-animate-top w3-round-large w3-text-black">
						<span class="close">&times;</span>

						
					</div>
				</div>

<script type="text/javascript">
	var price = document.getElementById("price");
	var quant = document.getElementById("quantity");

	quant.addEventListener('change',)
</script>




<script>
		// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

</script>

</body>
</html>










