<?php


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


if(isset($_POST['Name_Room'])){


  $Name_Room  = $_POST['Name_Room'];
  $price_Room = $_POST['price_Room'];


  if(isset($_POST['passCreate_room'])){

  $result = $conn->query("SELECT * FROM settings WHERE pass='".$_POST['passCreate_room']."'"); 
  if (mysqli_num_rows($result) != 1) {echo 4; return;}

  }



  $result = $conn->query("SELECT * FROM room WHERE name='$Name_Room'"); 
  if (mysqli_num_rows($result) == 0) {
  
     $conn->query("INSERT INTO room (name , price) VALUES ('$Name_Room','$price_Room')");

     $resultid = $conn->query("SELECT * FROM room WHERE name='$Name_Room'"); 

     while($row = $resultid->fetch_assoc()) {  

     	$id  = $row["id"];  

     }

   
     if (!file_exists("../Avatar_Room/$id")){mkdir ("../Avatar_Room/$id", 0777, true);}
   
     

     $file_name =  bin2hex(random_bytes(4)); //$_FILES['Avatar_Room']['name']; //getting file name
     $tmp_name = $_FILES['Avatar_Room']['tmp_name']; //getting temp_name of file
     if(move_uploaded_file($tmp_name, "../Avatar_Room/$id/".$file_name.".png")){ //moving file to the specified folder with dynamic name
   
     $conn->query("update room set avatar='Avatar_Room/$id/$file_name.png' where id='$id'");
   
     echo 1;
   
   
     }


}
else
{
	echo 2;
}



}


if(isset($_POST['Name_Item'])){


  $Name_Item  = $_POST['Name_Item'];
  $price_Item = $_POST['price_Item'];


  if(isset($_POST['passCreate_Item'])){

  $result = $conn->query("SELECT * FROM settings WHERE pass='".$_POST['passCreate_Item']."'"); 
  if (mysqli_num_rows($result) != 1) {echo 4; return;}

  }



  $result = $conn->query("SELECT * FROM item WHERE name='$Name_Item'"); 
  if (mysqli_num_rows($result) == 0) {
  
     $conn->query("INSERT INTO item (name , price) VALUES ('$Name_Item','$price_Item')");

     $resultid = $conn->query("SELECT * FROM item WHERE name='$Name_Item'"); 

     while($row = $resultid->fetch_assoc()) {  

     	$id  = $row["id"];  

     }


     
   
     if (!file_exists("../Avatar_Item/$id")){mkdir ("../Avatar_Item/$id", 0777, true);}
   
     
   
     $file_name =  bin2hex(random_bytes(4)); //$_FILES['Avatar_Item']['name']; //getting file name
     $tmp_name = $_FILES['Avatar_Item']['tmp_name']; //getting temp_name of file
     if(move_uploaded_file($tmp_name, "../Avatar_Item/$id/".$file_name.".png")){ //moving file to the specified folder with dynamic name
   
     $conn->query("update item set avatar='Avatar_Item/$id/$file_name.png' where id='$id'");
   
     echo 1;
   
   
     }


}
else
{
	echo 2;
}



}


if(isset($_POST['SSAvatar_Room'])){


  $Name_Room     = $_POST['SSName_Room'];
  $price_Room    = $_POST['price_Room'];
  $id            = $_POST['id'];
  $Name_Roombef  = $_POST['Name_Roombef'];



  $result = $conn->query("SELECT * FROM room WHERE id='$id'"); 
  if (mysqli_num_rows($result) != 1) {echo 3; return;}

  if($Name_Room != $Name_Roombef){

  $result = $conn->query("SELECT * FROM room WHERE name='$Name_Room'"); 
  if (mysqli_num_rows($result) != 0) {echo 2; return;}
  }

  if(isset($_POST['passEdit'])){

  $result = $conn->query("SELECT * FROM settings WHERE pass='".$_POST['passEdit']."'"); 
  if (mysqli_num_rows($result) != 1) {echo 4; return;}

  }




    if($_POST['edAvatar_Room'] == "Same"){

    $conn->query("update room set name='$Name_Room' , price='$price_Room' where id='$id'");

    echo 1;

    }
    else
    {


    if (!file_exists("../Avatar_Room/$id")){mkdir ("../Avatar_Room/$id", 0777, true);}

    $file_name =  bin2hex(random_bytes(4)); //$_FILES['Avatar_Room']['name']; //getting file name
    $tmp_name = $_FILES['Avatar_Room']['tmp_name']; //getting temp_name of file
    if(move_uploaded_file($tmp_name, "../Avatar_Room/$id/".$file_name.".png")){ //moving file to the specified folder with dynamic name
   
    $conn->query("update room set avatar='Avatar_Room/$id/$file_name.png' , name='$Name_Room' , price='$price_Room' where id='$id'");
   
    echo 1;
   
   
    }

    }



}


if(isset($_POST['SSAvatar_Item'])){


  $Name_Item     = $_POST['SSName_Item'];
  $price_Item    = $_POST['price_Item'];
  $id            = $_POST['id'];
  $id_room       = $_POST['id_room'];
  $Name_Itembef  = $_POST['Name_Itembef'];



  $result = $conn->query("SELECT * FROM Item WHERE id='$id'"); 
  if (mysqli_num_rows($result) != 1) {echo 3; return;}

  if($Name_Item != $Name_Itembef){

  $result = $conn->query("SELECT * FROM Item WHERE name='$Name_Item'"); 
  if (mysqli_num_rows($result) != 0) {echo 2; return;}
  }

  if(isset($_POST['passEdit'])){

  $result = $conn->query("SELECT * FROM settings WHERE pass='".$_POST['passEdit']."'"); 
  if (mysqli_num_rows($result) != 1) {echo 4; return;}

  }


  $result = $conn->query("SELECT * FROM room_status WHERE id_room='$id_room' and status='B'"); 
  while($row = $result->fetch_assoc()) {  $ID_room_status  = $row["id"];
  if (mysqli_num_rows($result) != 0) { $conn->query("update item_status set price='$price_Item' where id_room_status='$ID_room_status'");}}




    if($_POST['edAvatar_Item'] == "Same"){

    $conn->query("update Item set name='$Name_Item' , price='$price_Item' where id='$id'");


    echo 1;

    }
    else
    {


    if (!file_exists("../Avatar_Item/$id")){mkdir ("../Avatar_Item/$id", 0777, true);}

    $file_name =  bin2hex(random_bytes(4)); //$_FILES['Avatar_Item']['name']; //getting file name
    $tmp_name = $_FILES['Avatar_Item']['tmp_name']; //getting temp_name of file
    if(move_uploaded_file($tmp_name, "../Avatar_Item/$id/".$file_name.".png")){ //moving file to the specified folder with dynamic name
   
    $conn->query("update Item set avatar='Avatar_Item/$id/$file_name.png' , name='$Name_Item' , price='$price_Item' where id='$id'");
   
    echo 1;
   
   
    }

    }



}












?>