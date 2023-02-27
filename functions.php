<?php

function  check_login($conn)
{
  if (isset($_SESSION['user'])) {
    // code...
    $user_phone = $_SESSION['user'];
    $query = "select * from custumers where phone = '$user_phone' limit 1";

    $result = mysqli_query($conn,$query);
    if ($result && mysqli_num_rows($result) > 0) {
      // code...
      $user_data = mysqli_fetch_assoc($result);
      return $user_data;
    }
  }else{ 

  //redirect to login
 header("location:login.php");
 }
}


function notify(){
    
    if (isset($_SESSION['user'])) {
  
    $username = $_SESSION['user'];
  
    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $time = date("h:i:sa");
    
    $from = "admin@cpmschool.com.ng";
    
    $to = "js1class@cpmschool.com.ng";
    
    $subject = "Notify";
    
    $message = "Just purchased" . " " . "$username" . " " . "$time";
    
    $headers = "From:" . $from;
    
    if(mail($to,$subject,$message, $headers)) {
        
        return true;
    } else {
        
      return false;
    }
    }
}



function valid_format($ext){

  if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png') {
    
    return true;

  }else{

    return false;
  }

}