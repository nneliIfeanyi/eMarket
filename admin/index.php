<?php
session_start();
include '../config.php';
include '../functions.php';


if (isset($_SESSION['user'])) {
    
    $user = $_SESSION['user'];

    $sql = "SELECT * FROM custumers WHERE phone = '$user'";
    $query = mysqli_query($conn, $sql);
    if ($query) {
        
        $user_data = mysqli_fetch_assoc($query);
        $name = $user_data['name'];    

    }

}else{

    //redirect to login

    header("location:../login.php");
}
    //Form validation variables..
$titleErr = $describeErr = $imgErr = $categoryErr = $priceErr = $discountErr = "";
$title = $description = $image_file = $price = $discount = $msg = '';

if ($_SERVER['REQUEST_METHOD'] == "POST" ) {
    
    $title = mysqli_real_escape_string($conn, htmlspecialchars($_POST['title'], ENT_QUOTES, 'utf-8'));
    $description = mysqli_real_escape_string($conn, htmlspecialchars($_POST['describe'], ENT_QUOTES, 'utf-8'));
    $category = mysqli_real_escape_string($conn, htmlspecialchars($_POST['category'], ENT_QUOTES, 'utf-8'));
    $price = mysqli_real_escape_string($conn, htmlspecialchars($_POST['price'], ENT_QUOTES, 'utf-8'));
    $discount = mysqli_real_escape_string($conn, htmlspecialchars($_POST['discount'], ENT_QUOTES, 'utf-8'));
    $image_file = $_FILES['image']['name'];
    $file_nameArr = explode(".", $image_file);
    $extension = end($file_nameArr);
    $ext = strtolower($extension);
    $unique_name = rand(100, 999).rand(100, 999).'.'.$ext;

    $image_folder = "img/".$unique_name;
    $db_image_file = "img/".$unique_name;


    if (empty($title)) {

        $titleErr = "Product name is required..";

    }elseif (empty($category)) {

        $categoryErr = "kindly select product category.";

    }elseif (empty($price)) {
        
        $priceErr = "price is required";

    }elseif (empty($image_file)) {
        
        $imgErr = "Product image is required.."; 

    }elseif (!valid_format($ext)) {

        $imgErr = "File format not supported, use jpeg or jpg or png it should work.";
       
    }else{

        
      $sql = "INSERT INTO products (title,description,img,category,price,discount_p) VALUES ('$title','$description','$db_image_file','$category','$price','$discount')";
      $query = mysqli_query($conn, $sql);


      if (!$query) {

         $errMsg = "Something went wrong try again";

      }else{
        
        move_uploaded_file($_FILES['image']['tmp_name'],$image_folder);
        $msg = "<h2 class='w3-large w3-text-green w3-blue'>Product added successfully..</h2>";
        ?>
        <meta http-equiv="refresh" content="2; products.php">

        <?php
        
      }  

    }

    
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Add Product</title>
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

    <div class="w3-padding-32 w3-card-4 w3-margin-top w3-margin-bottom w3-white" style="width:80%;margin: auto;">
    
        <div class="w3-row-padding">

            <div class="w3-row-padding">
                <div>
                    <span class="w3-xlarge w3-center"> 
                        Welcome <span class="w3-text-green"><?=$name?></span>
                    </span><br>
                <i class="w3-text-dark-grey">
                 Use the form below to add Products to display to customers..
                </i></div>           

            <!--Success Message-->
            <div class="w3-margin-bottom w3-padding-small" style="width:90%;">
                <i class=""></i>
                <?= $msg ?>
            </div>

            <!--Add product Form -->
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data"> 
                
                <div class="w3-card">
                  <input type="text" name="title" class="w3-input" placeholder="Name of product" value="<?= $title ?>">
                </div>
                <span class="w3-small w3-tag w3-red"><?= $titleErr ?></span>

                 <div class="w3-card">
                    <select id="classID" name="category" class="w3-text-dark-grey w3-select">
                      <option value="">Select category--</option>
                      <option value="cup">Cups</option>
                      <option value="tumblers">Tumblers</option>
                      <option value="plates">Plates</option>
                      <option value="trays">Trays</option>
                      <option value="bags">Bags</option>
                      <option value="feeding_bottles">Feeding Bottles</option>
                    </select>
                </div>
                <span class="w3-small w3-tag w3-red"><?= $categoryErr ?></span>
                
                <div class=" w3-card w3-margin-bottom">
                  <input type="text" name="describe" class="w3-input" placeholder="Describe the product" value="<?= $description ?>">
                </div>


                <div class="w3-row w3-card">

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

                  <label class="w3-text-blue w3-opacity-min"><b>Add Product Picture</b></label>
                 <div class="w3-card w3-padding-small">
                    <input type="file" name="image">
                 </div>
                 <span class="w3-small w3-tag w3-red"><?= $imgErr ?></span>
                
                <div class="w3-margin-bottom">
                    <input type="submit" name="add" value="Add Product" class="w3-btn w3-teal w3-round-large">
                </div>

            </form>
        </div>

            <?php

                include 'menu.php';

            ?>


        </div>
        
    </div>
</div>
</body>
</html>