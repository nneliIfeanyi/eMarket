<?php
session_start();
include 'config.php';
include 'functions.php';
$user_data = check_login($conn);
$user_email = $user_data['email'];

if ($_SERVER['REQUEST_METHOD'] == "POST" ) {

	$user_email = $_POST['user_email'];
	$amount = $_POST['amount'] . "." . "00";
	$cartid = $_POST['cartid'];


  $url = "https://api.paystack.co/transaction/initialize";

  $fields = [
    'email' => "$user_email",
    'amount' => "$amount "
  ];

  $fields_string = http_build_query($fields);

  //open connection
  $ch = curl_init();
  
  //set the url, number of POST vars, POST data
  curl_setopt($ch,CURLOPT_URL, $url);
  curl_setopt($ch,CURLOPT_POST, true);
  curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Bearer sk_test_92f11d81a6824b7967f188ddc0d42acf5d9a3fac",
    "Cache-Control: no-cache",
  ));
  
  //So that curl_exec returns the contents of the cURL; rather than echoing it
  curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
  
  //execute post
  $result = curl_exec($ch);
 echo $result;

}
?>













<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>payments</title>
</head>
<body>





</body>
</html>