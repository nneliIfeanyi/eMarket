<?php
session_start();

include 'config.php';
include 'functions.php';


if (isset($_GET['id'])) {
	
	$id = $_GET['id'];

	$sql = "DELETE FROM cart WHERE id = '$id'";
	$query = mysqli_query($conn, $sql);

	if ($query) {
		
		?>
			<script type="text/javascript">
				alert('Deleted Successfully')
			</script>
			<meta http-equiv="refresh" content="1; cart.php">
		<?php

	}else{

		?>
			<script type="text/javascript">
				alert('An error occured while deleting product.')
			</script>
			<meta http-equiv="refresh" content="2; cart.php">
		<?php


	}

}