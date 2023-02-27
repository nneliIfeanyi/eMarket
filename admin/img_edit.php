<?php

session_start();
include '../config.php';
include '../functions.php';

$user_data = check_login($conn);
$imgErr = $msg ='';

$id = $_GET['id'] ?? null;

	if (!$id) {
		
		if ($_SERVER['REQUEST_METHOD'] == "POST" ) {
			$img = mysqli_real_escape_string($conn, htmlspecialchars($_POST['image'], ENT_QUOTES, 'utf-8'));

			$sql = "SELECT * FROM products WHERE img = '$img' ";
			$query = mysqli_query($conn, $sql);

			if (mysqli_num_rows($query) > 0) {
				
				$result = mysqli_fetch_assoc($query);
				$img = $result['img'];
				
			}


			$id = mysqli_real_escape_string($conn, htmlspecialchars($_POST['id'], ENT_QUOTES, 'utf-8'));
			$image_file = $_FILES['image']['name'];
			$file_nameArr = explode(".", $image_file);
			$extension = end($file_nameArr);
			$ext = strtolower($extension);
			$unique_name = rand(100, 999).rand(100, 999).'.'.$ext;

			$image_folder = "img/".$unique_name;
			$db_image_file = "img/".$unique_name;

			if (empty($image_file)) {
				
				$imgErr = "Pls select an image to update.";
			}else{

				if (valid_format($ext)) {
				
					$sql = "UPDATE products SET img = '$db_image_file' WHERE id = '$id' ";
					$query = mysqli_query($conn, $sql);

					$sql = "UPDATE cart SET image = '$db_image_file' WHERE product_id = '$id' ";
					$query = mysqli_query($conn, $sql);


					if ($query) {

						move_uploaded_file($_FILES['image']['tmp_name'],$image_folder);

						?>

						
						<script type="text/javascript">
							alert('Image Changed successfully.')
						</script>
						<meta http-equiv="refresh" content=".01; products.php">
						<?php

					}else{

						?>

						
						<script type="text/javascript">
							alert('An error occured.')
						</script>
						<meta http-equiv="refresh" content=".01; products.php">
						<?php

					}
				}else{

					$imgErr = "Invalid image format.";
				}
			}
		}

	}else{

		$sql = "SELECT * FROM products WHERE id = '$id' ";
		$query = mysqli_query($conn, $sql);

		if (mysqli_num_rows($query) > 0) {
			
			$result = mysqli_fetch_assoc($query);
			$img = $result['img'];
			
		}
	}



?>




<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Product Picture</title>
    <link rel="stylesheet" type="text/css" href="../css/w3.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">

    <style type="text/css">
        label{
           
        }

        .border{
            border-top: 4px solid gray;
            border-bottom: 4px solid gray;
            border-right: 8px solid grey;
            border-left: 8px solid grey;
        }

        .shadow{
            box-shadow: inset .6px .6px 10px teal, inset -.6px -.6px 10px teal;

        }
    </style>
</head>

<body class="w3-serif w3-light-grey">
    <div class="shadow">


    <?php

        include 'header.php';

    ?>


     <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data"> 
           <div>
           	
           	<img src="<?=$img?>" width="200px" height="100px">

           </div>     
             

        
         <div class="w3-card w3-padding-small">
         	 <label class="w3-text-teal w3-opacity"><b>Add New Picture</b></label><br>
            <input type="file" name="image" style="width:70%;">
            <span class="w3-small w3-tag w3-red"><?= $imgErr ?></span>
         </div>
         
        
        <div class="w3-margin-bottom ">
        	<input type="hidden" name="id" value="<?=$id?>">
        	<input type="hidden" name="image" value="<?=$img?>">
            <input type="submit" name="add" value="Update Image" class="w3-btn w3-teal w3-round-large">
            <a href="edit.php?id=<?=$id?>" class="w3-text-green w3-round-large">Go back</a>
        </div>

     </form>
 </div>
</body>
</html>