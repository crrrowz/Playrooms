<?php

session_start();

$servername  = "127.0.0.1";
$username    = "root";
$password    = "HASSANEIN2@a";
$dbname      = "playroom";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}


if(isset($_POST['startstop'])){


  $status  = $_POST['status'];
  $id_room = $_POST['id_room'];



  $result = $conn->query("SELECT * FROM room WHERE id='$id_room'"); 
  if (mysqli_num_rows($result) == 1) {

    while($row = $result->fetch_assoc()) {  $status_mysql  = $row["status"]; $stop_mysql  = $row["stop"]; }


     if($status == "run" && $status_mysql == "B" && $stop_mysql == "B"){

     $conn->query("INSERT INTO room_status (id_room) VALUES ('$id_room')");
     $conn->query("update room set status='A' where id='$id_room'");

     }






     else if($status == "run" && $status_mysql == "A" && $stop_mysql == "A"){

     $result = $conn->query("SELECT * FROM room_status WHERE id_room='$id_room' and status='B'"); 
     while($row = $result->fetch_assoc()) { $datepause  = $row["datepause"]; $datestart  = $row["datestart"]; $seconds_mysql  = $row["seconds"]; }


     if ($seconds_mysql == NULL){

     // Declare and define two dates
     $date = date('Y-m-d H:i:s');
     $date1 = strtotime($date);
     $date2 = strtotime($datepause);
     
     // Formulate the Difference between two dates
     $seconds = abs($date2 - $date1);

     $conn->query("update room_status set seconds='$seconds' , datepause='0' where id_room='$id_room' and status='B'");
     $conn->query("update room set stop='B' where id='$id_room'");


     }
     else
     {


     // Declare and define two dates
     $date = date('Y-m-d H:i:s');
     $date1 = strtotime($date);
     $date2 = strtotime($datepause);
     
     // Formulate the Difference between two dates
     $seconds = abs($date2 - $date1);

     $seconds = abs($seconds + $seconds_mysql);

     $conn->query("update room_status set seconds='$seconds' , datepause='' where id_room='$id_room' and status='B'");
     $conn->query("update room set stop='B' where id='$id_room'");
       
     } 



     }









     else if($status == "stop" && $status_mysql == "A" && $stop_mysql == "B"){
      
     $date = date('Y-m-d H:i:s');
     
     $conn->query("update room_status set datepause='$date' where id_room='$id_room' and status='B'");
     $conn->query("update room set stop='A' where id='$id_room'");
       
     }

    
     echo 1;
   

     }
     else
     {
     	echo 2;
     }

   }







if(isset($_POST['close'])){


  $id_room  = $_POST['id_room'];
  $price    = $_POST['price'];
  $mathod   = $_POST['mathod'];


  $result = $conn->query("SELECT * FROM room_status WHERE id_room='$id_room' and status='B'"); 

  if (mysqli_num_rows($result) == 1) {


  while($row = $result->fetch_assoc()) { $datepause  = $row["datepause"]; $datestart  = $row["datestart"]; $seconds_mysql  = $row["seconds"]; }


  // Declare and define two dates
  $date1 = strtotime($datepause);
  $date2 = strtotime($datestart);
  
  // Formulate the Difference between two dates
  $seconds = abs($date2 - $date1);
  $seconds = abs($seconds - $seconds_mysql);

  $interval = gmdate("H:i:s", $seconds);

  $conn->query("update room_status set status='A' , seconds='$seconds' , secondspause='$seconds_mysql' , price='$price' , mathod='$mathod' , nterval_time='$interval'  where id_room='$id_room' and status='B'");
  $conn->query("update room set stop='B' , status='B' where id='$id_room'");



    
  echo 1;
   
   



  }
  else
  {
    echo 2;
  }

}




if(isset($_POST['add_item'])){


  $id_room    = $_POST['id_room'];
  $id_item    = $_POST['id_item'];
  $price_item = $_POST['price_item'];


  $result = $conn->query("SELECT * FROM room_status WHERE id_room='$id_room' and status='B'");
  if (mysqli_num_rows($result) == 1) {

  while($row = $result->fetch_assoc()) { $id  = $row["id"]; }


  $conn->query("INSERT INTO item_status (id_item,id_room_status,price) VALUES ('$id_item','$id','$price_item')");


  echo 1;
   
  

  }
  else
  {
    echo 2;
  }

}



if(isset($_POST['remove_item'])){


  $id_room    = $_POST['id_room'];
  $id_item    = $_POST['id_item'];


  $result = $conn->query("SELECT * FROM room_status WHERE id_room='$id_room' and status='B'");
  if (mysqli_num_rows($result) == 1) {

  while($row = $result->fetch_assoc()) { $id  = $row["id"]; }


  $conn->query("DELETE FROM item_status WHERE id_item='$id_item' and id_room_status='$id' LIMIT 1");


  echo 1;
   
  

  }
  else
  {
    echo 2;
  }

}


if(isset($_POST['Delete_Room'])){

  $id_room = $_POST['id_room'];



  if(isset($_POST['passDelete_item'])){

  $result = $conn->query("SELECT * FROM settings WHERE pass='".$_POST['passDelete_item']."'"); 
  if (mysqli_num_rows($result) != 1) {echo 3; return;}

  }



  $result = $conn->query("SELECT * FROM room WHERE id='$id_room'"); 
  if (mysqli_num_rows($result) == 1) {



  $conn->query("DELETE FROM room WHERE id='$id_room'");



  $result = $conn->query("SELECT * FROM room_status WHERE id_room='$id_room'"); 
  while($row = $result->fetch_assoc()) { 

  $id_room_status  = $row["id"]; 

  $conn->query("DELETE FROM item_status WHERE id_room_status='$id_room_status'");

  }


  $conn->query("DELETE FROM room_status WHERE id_room='$id_room'");


 if (file_exists("../Avatar_Room/$id_room")) {
 
 $files = glob("../Avatar_Room/$id_room/*"); // get all file names
 foreach($files as $file){ // iterate files
 if(is_file($file)) {
 unlink($file); // delete file
 }}
 
 rmdir("../Avatar_Room/$id_room");
 
 
 }
  

  echo 1;

  }
  else
  {

  echo 2;
  
  }



}



if(isset($_POST['Delete_Item'])){

  $id_Item = $_POST['id_Item'];



  if(isset($_POST['passDelete_item'])){

  $result = $conn->query("SELECT * FROM settings WHERE pass='".$_POST['passDelete_item']."'"); 
  if (mysqli_num_rows($result) != 1) {echo 3; return;}

  }



  $result = $conn->query("SELECT * FROM Item WHERE id='$id_Item'"); 
  if (mysqli_num_rows($result) == 1) {



  $conn->query("DELETE FROM Item WHERE id='$id_Item'");


  $conn->query("DELETE FROM Item_status WHERE id_Item='$id_Item'");


 if (file_exists("../Avatar_Item/$id_Item")) {
 
 $files = glob("../Avatar_Item/$id_Item/*"); // get all file names
 foreach($files as $file){ // iterate files
 if(is_file($file)) {
 unlink($file); // delete file
 }}
 
 rmdir("../Avatar_Item/$id_Item");
 
 
 }
  

  echo 1;

  }
  else
  {

  echo 2;
  
  }



}


if(isset($_POST['Changing_setting'])){

  $pass       = $_POST['pass'];
  $newpass    = $_POST['newpass'];
  $currency   = $_POST['currency'];


  $result = $conn->query("SELECT * FROM settings WHERE pass='$pass'"); 
  if (mysqli_num_rows($result) != 1) {echo 2; return;}

  if($newpass == ""){$newpass = $pass;}

  $conn->query("update settings set pass='$newpass' , currency='$currency' where pass='$pass'");

  if(isset($_POST['LockEdit_room'])){$conn->query("update settings set LockEdit_room='A' where pass='$pass'");}else{$conn->query("update settings set LockEdit_room='B' where pass='$pass'");}
  if(isset($_POST['LockEdit_item'])){$conn->query("update settings set LockEdit_item='A' where pass='$pass'");}else{$conn->query("update settings set LockEdit_item='B' where pass='$pass'");}
  if(isset($_POST['LockDelete_room'])){$conn->query("update settings set LockDelete_room='A' where pass='$pass'");}else{$conn->query("update settings set LockDelete_room='B' where pass='$pass'");}
  if(isset($_POST['LockCreate_report'])){$conn->query("update settings set LockCreate_report='A' where pass='$pass'");}else{$conn->query("update settings set LockCreate_report='B' where pass='$pass'");}
  if(isset($_POST['LockCreate_room'])){$conn->query("update settings set LockCreate_room='A' where pass='$pass'");}else{$conn->query("update settings set LockCreate_room='B' where pass='$pass'");}
  if(isset($_POST['LockCreate_item'])){$conn->query("update settings set LockCreate_item='A' where pass='$pass'");}else{$conn->query("update settings set LockCreate_item='B' where pass='$pass'");}
  if(isset($_POST['LockDelete_item'])){$conn->query("update settings set LockDelete_item='A' where pass='$pass'");}else{$conn->query("update settings set LockDelete_item='B' where pass='$pass'");}

  echo 1;

}

if(isset($_POST['Create_report'])){


  if(!isset($_POST['pass'])){$_SESSION['Create_report'] = 1; echo 1; return; }

  $result = $conn->query("SELECT * FROM settings WHERE pass='".$_POST['pass']."'"); 
  if (mysqli_num_rows($result) != 1) {echo 2; return;}


  $_SESSION['Create_report'] = 1;

  echo 1;

}




if(isset($_POST['refrash'])){

$_SESSION['ref'] = $_POST['id'];

echo 1;
}

?>