<?php 

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "eMarket";

if(!$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
	die("failed to connect");
}