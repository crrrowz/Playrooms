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




   if (isset($_POST['check_status'])) {
   
   $all = array();


   $result = $conn->query("SELECT * FROM room_status"); 
   if (mysqli_num_rows($result) >= 1) {

   $emparray = array();
   
   $emparray[] = ['auth' => '1'];  
   
   while($row =mysqli_fetch_assoc($result))
   {
   $emparray[] = $row;
   }
   
   $all[] = $emparray;

   }


   $result = $conn->query("SELECT * FROM item"); 
   if (mysqli_num_rows($result) >= 1) {

   $emparray = array();
   
   $emparray[] = ['auth' => '1'];  
   
   while($row =mysqli_fetch_assoc($result))
   {
   $emparray[] = $row;
   }
   
   $all[] = $emparray;

   }


   echo json_encode($all);



}




?>