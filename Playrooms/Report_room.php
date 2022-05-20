<?php 

error_reporting(0);
ini_set('display_errors', 0);

require_once 'php/main.php';
session_start();

if($_SESSION['Create_report'] != 1){echo "Please go back to the main page and re-order Or contact the programmer to solve the problem"; return;}

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

$resultid = $conn->query("SELECT * FROM settings"); 
while($row = $resultid->fetch_assoc()) { $currency = $row["currency"]; }

$id_room_status = $_GET['id_room_status'];




$result = $conn->query("SELECT * FROM room_status where id='$id_room_status'"); 
while($row = $result->fetch_assoc()) { 

$price_room_status = $row["price"];
$id_room = $row["id_room"];


$seconds  = $row["seconds"];
$hours    = floor($seconds / 3600);
$mins     = floor($seconds / 60 % 60);
$secs     = floor($seconds % 60);
$start    = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);


$secondspause = $row["secondspause"];
$hours        = floor($secondspause / 3600);
$mins         = floor($secondspause / 60 % 60);
$secs         = floor($secondspause % 60);
$stop         = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);


$datestart = $row["datestart"];
$datepause = $row["datepause"];
$mathod = $row["mathod"];

if($mathod == "Card")
{
$mathod = "Card money";
}else{$mathod = "Cash money";}





}



$result_room_status = $conn->query("SELECT SUM(price) as SUMprice FROM item_status where id_room_status='$id_room_status'"); 
while($row = $result_room_status->fetch_assoc()) { $purchases = $row["SUMprice"]; }
if($purchases == null){$purchases = 0;}



$math_details = explode('.', $purchases);

if(strlen($math_details[0]) == 1){$purchases = substr($purchases,0,4);
}else if(strlen($math_details[0]) == 2){$purchases = substr($purchases,0,5);
}else if(strlen($math_details[0]) == 3){$purchases = substr($purchases,0,6);
}else{$purchases = substr($purchases,0,7);}




$seconds_price = abs($purchases - $price_room_status);

$math_details = explode('.', $seconds_price);

if(strlen($math_details[0]) == 1){$seconds_price = substr($seconds_price,0,4);
}else if(strlen($math_details[0]) == 2){$seconds_price = substr($seconds_price,0,5);
}else if(strlen($math_details[0]) == 3){$seconds_price = substr($seconds_price,0,6);
}else{$seconds_price = substr($seconds_price,0,7);}  





$resultid = $conn->query("SELECT * FROM room where id='$id_room' "); 
while($row = $resultid->fetch_assoc()) {  $name = $row["name"]; $price = $row["price"];}


$item_statuslop = array();

$resultid1 = $conn->query("SELECT * FROM item"); 
while($row1 = $resultid1->fetch_assoc()) {  

$id_item            = $row1["id"];
$name_item          = $row1["name"];
$price_item         = $row1["price"];


$item_status = $conn->query("SELECT * FROM item_status where id_item='$id_item' and id_room_status='$id_room_status'"); 
$cont_item_status = mysqli_num_rows($item_status);

$item_status1 = $conn->query("SELECT * FROM item_status where id_item='$id_item' and id_room_status='$id_room_status'  GROUP BY id_item"); 
while($row3 = $item_status1->fetch_assoc()) {

$Total_Amount = abs($cont_item_status * $price_item);

$item_statuslop[] =  "

<tr>
<td class='cs-width_3 '>$name_item</td>
<td class='cs-width_2 cs-text_center'>$cont_item_status</td>
<td class='cs-width_2 cs-text_center'>$price_item $currency</td>
<td class='cs-width_2 cs-text_center cs-primary_color'>$Total_Amount $currency</td>
</tr>


";



}


}

$item_statuscheck = $conn->query("SELECT * FROM item_status where id_room_status='$id_room_status'");
if (mysqli_num_rows($item_statuscheck) != 0) {




$item_statusch1 = "

  <table>
    <thead>
      <tr class='cs-focus_bg'>
        <th class='cs-width_3 cs-semi_bold cs-primary_color'>Item</th>
        <th class='cs-width_2 cs-semi_bold cs-primary_color cs-text_center'>Quantity</th>
        <th class='cs-width_2 cs-semi_bold cs-primary_color cs-text_center'>Unit price</th>
        <th class='cs-width_2 cs-semi_bold cs-primary_color cs-text_center'>Amount</th>
      </tr>
    </thead>
    <tbody>";

 

$item_statusch2 = "</tbody></table>";



}
else
{

$item_statusch1 = "";
$item_statusch2 = "";

}







$todydate = date('Y-m-d');


?>


<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <!-- Favicons -->
  <link rel="icon" type="image/png" href="img/crowz.png" sizes="32x32">
  <link rel="apple-touch-icon" href="img/logo-app.JPG">

  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="Hassanein Hassan">
  <title>Playrooms – CroWz</title>

  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <div class="cs-container">
    <div class="cs-invoice cs-style1">
      <div class="cs-invoice_in" id="download_section">
        <div class="cs-invoice_head cs-type1 cs-mb25">
          <div class="cs-invoice_left">

            <p class="cs-invoice_number cs-primary_color cs-mb0 cs-f16"><b class="cs-primary_color">Date:</b> <?php echo $todydate ?></p>

          </div>
          <div class="imgassets cs-invoice_right cs-text_right">
            <div class="cs-logo cs-mb5"><img src="assets/img/logo.png" alt="Logo"></div>
          </div>
        </div>
        <div class="cs-invoice_head cs-mb10">
          <div class="cs-invoice_left">

            <b class="cs-primary_color">Report:</b> <?php echo $name ?><p><b class="cs-primary_color cs-semi_bold">ID:</b> <?php echo "#$id_room"?></p><p><b class="cs-primary_color cs-semi_bold">Price for one hour:</b> <?php echo "$price $currency"?></p>

          </div>
        </div>
        <ul class="cs-list cs-style2">
          <li>
            <div class="cs-list_left">Date start: <b class="cs-primary_color cs-semi_bold "><?php echo $datestart?></b></div>
            <div class="cs-list_right">Date stop: <b class="cs-primary_color cs-semi_bold "><?php echo $datepause?></b></div>
          </li>
          <li>
            <div class="cs-list_left">Playback: <b class="cs-primary_color cs-semi_bold "><?php echo $start?></b></div>
            <div class="cs-list_right">Pause: <b class="cs-primary_color cs-semi_bold "><?php echo $stop?></b></div>
          </li>
          <li>
            <div class="cs-list_left">Amount: <b class="cs-primary_color cs-semi_bold "><?php echo "$seconds_price $currency"?></b></div>
          </li>
        </ul>
        <div class="cs-table cs-style2">
          <div class="cs-round_border">
            <div class="cs-table_responsive">
              
              <?php 


              echo $item_statusch1;

              for ($i = 0; $i < count($item_statuslop); $i++){
  
              echo $item_statuslop[$i];      
          
              }

              echo $item_statusch2;




              ?>


            </div>
          </div>
        </div>
        <div class="cs-table cs-style2">
          <div class="cs-table_responsive">
            <table>
              <tbody>
                <tr class="cs-table_baseline">
                  <td class="cs-width_5">

                    <b class="cs-primary_color">Pay By:</b> <?php echo $mathod ?><br/>
                    
                  </td>
                  <td class="cs-width_5 cs-primary_color cs-bold cs-f16 cs-text_center">Total Amount:</td>
                  <td class="cs-width_2 cs-text_center cs-primary_color cs-bold cs-primary_color cs-f16"><?php echo "$price_room_status $currency" ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!-- <div class="cs-note">
          <div class="cs-note_left">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M416 221.25V416a48 48 0 01-48 48H144a48 48 0 01-48-48V96a48 48 0 0148-48h98.75a32 32 0 0122.62 9.37l141.26 141.26a32 32 0 019.37 22.62z" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><path d="M256 56v120a32 32 0 0032 32h120M176 288h160M176 368h160" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg>
          </div>
          <div class="cs-note_right">
            <p class="cs-mb0"><b class="cs-primary_color cs-bold">Note:</b></p>
            <p class="cs-m0">Here we can write a additional notes for the client to get a better understanding of this invoice.</p>
          </div>
        </div> --><!-- .cs-note -->
      </div>
      <div class="cs-invoice_btns cs-hide_print">
        <a href="javascript:window.print()" class="cs-invoice_btn cs-color1">
          <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><circle cx="392" cy="184" r="24"/></svg>
          <span>Print</span>
        </a>
        <button id="download_btn" class="cs-invoice_btn cs-color2">
          <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><title>Download</title><path d="M336 176h40a40 40 0 0140 40v208a40 40 0 01-40 40H136a40 40 0 01-40-40V216a40 40 0 0140-40h40" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M176 272l80 80 80-80M256 48v288"/></svg>
          <span>Download</span>
        </button>
        <a href="javascript:history.go(-1)" class="cs-invoice_btn cs-color1">
          <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><circle cx="392" cy="184" r="24"/></svg>
          <span>Back</span>
        </a>
      </div>
    </div>
  </div>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/jspdf.min.js"></script>
  <script src="assets/js/html2canvas.min.js"></script>
  <script src="assets/js/main.js"></script>
</body>
</html>