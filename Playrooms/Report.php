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





$select   = $_GET['selectroom'];
$From     = $_GET['From'];
$To       = $_GET['To'];

$emparray = array();



if($select == "Room"){

$Room = $_GET['room'];

$resultid = $conn->query("SELECT * FROM room where id='$Room' "); 
while($row = $resultid->fetch_assoc()) {  $name = $row["name"]; $price = $row["price"];}

$resultid = $conn->query("SELECT SUM(seconds) as seconds , SUM(secondspause) as secondspause , SUM(price) as Total_Amount FROM room_status where id_room='$Room' AND status='A' AND CAST(datestart AS DATE) between '$From' AND '$To'"); 
while($row = $resultid->fetch_assoc()) {  


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


  $Total_Amount = $row["Total_Amount"];

  $math_details = explode('.', $Total_Amount);

  if(strlen($math_details[0]) == 1){$p_interval = substr($Total_Amount,0,4);
  }else if(strlen($math_details[0]) == 2){$p_interval = substr($Total_Amount,0,5);
  }else if(strlen($math_details[0]) == 3){$p_interval = substr($Total_Amount,0,6);
  }else{$p_interval = substr($Total_Amount,0,7);}




}


  $hader = "
  <ul class='cs-list cs-style1'>
  <li>
  <div class='cs-list_left'><b class='cs-primary_color'>Report:</b> $name</div>
  <div class='cs-list_right'><b class='cs-primary_color'>ID:</b> #$Room</div>
  </li>
  <li>
  <div class='cs-list_left'><b class='cs-primary_color'>Price for one hour:</b> $price $currency</div>
  </li>
  </ul>
  ";


  $result = $conn->query("SELECT * FROM room_status where id_room='$Room' AND status='A' AND CAST(datestart AS DATE) between '$From' AND '$To'"); 
  while($row = $result->fetch_assoc()) {  
                  
                  
  $seconds_start  = $row["seconds"];
  $hours          = floor($seconds_start / 3600);
  $mins           = floor($seconds_start / 60 % 60);
  $secs           = floor($seconds_start % 60);
  $seconds_start  = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);


  
  $secondspause = $row["secondspause"];
  $hours        = floor($secondspause / 3600);
  $mins         = floor($secondspause / 60 % 60);
  $secs         = floor($secondspause % 60);
  $secondspause = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);



  $datestart      = $row["datestart"];

  $date_mysql = date('Y-m-d', strtotime($datestart));
  $time_mysql = date('h:i A', strtotime($datestart));

  $day  = date('w', strtotime($datestart));
  $days = array('Sun', 'Mon', 'Tues', 'Wed','Thurs','Fri', 'Sat');


  $price_room_status = $row["price"];
  $id_room_status    = $row["id"];


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




   $allrows[] = "

  <tr class='trGO' id='go$id_room_status'>
  <td class='cs-width_3'>$name <br>$time_mysql $days[$day]</td>
  <td class='cs-width_2'>$date_mysql</td>
  <td class='cs-width_1'>$seconds_start</td>
  <td class='cs-width_1'>$secondspause</td>
  <td class='cs-width_1'>$seconds_price $currency</td>
  <td class='cs-width_1'>$purchases $currency</td>
  <td class='cs-width_2 cs-text_right'>$price_room_status $currency</td>
  </tr>


  <script type='text/javascript'>
    
  document.getElementById('go$id_room_status').onclick = function() {

  
  window.open('http://localhost/Playrooms/Report_room.php?id_room_status=$id_room_status','_self')

  }


  </script>


  ";

  }


}
else
{


  $resultid = $conn->query("SELECT SUM(seconds) as seconds , SUM(secondspause) as secondspause , SUM(price) as Total_Amount FROM room_status where status='A' AND CAST(datestart AS DATE) between '$From' AND '$To'"); 
  while($row = $resultid->fetch_assoc()) {  


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


  $Total_Amount = $row["Total_Amount"];

  $math_details = explode('.', $Total_Amount);

  if(strlen($math_details[0]) == 1){$p_interval = substr($Total_Amount,0,4);
  }else if(strlen($math_details[0]) == 2){$p_interval = substr($Total_Amount,0,5);
  }else if(strlen($math_details[0]) == 3){$p_interval = substr($Total_Amount,0,6);
  }else{$p_interval = substr($Total_Amount,0,7);}




}



  $hader = "
  <ul class='cs-list cs-style1'>
  <li>
  <div class='cs-list_left'><b class='cs-primary_color'>Report:</b> All Room</div>
  </li>

  </ul>
  ";



  $result = $conn->query("SELECT * FROM room_status where status='A' AND CAST(datestart AS DATE) between '$From' AND '$To' ORDER BY datepause"); 
  while($row = $result->fetch_assoc()) {  

  $id_room    = $row["id_room"];
          
                  
  $seconds_start  = $row["seconds"];
  $hours          = floor($seconds_start / 3600);
  $mins           = floor($seconds_start / 60 % 60);
  $secs           = floor($seconds_start % 60);
  $seconds_start  = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);


  
  $secondspause = $row["secondspause"];
  $hours        = floor($secondspause / 3600);
  $mins         = floor($secondspause / 60 % 60);
  $secs         = floor($secondspause % 60);
  $secondspause = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);



  $datestart      = $row["datestart"];

  $date_mysql = date('Y-m-d', strtotime($datestart));
  $time_mysql = date('h:i A', strtotime($datestart));

  $day  = date('w', strtotime($datestart));
  $days = array('Sun', 'Mon', 'Tues', 'Wed','Thurs','Fri', 'Sat');


  $price_room_status = $row["price"];
  $id_room_status    = $row["id"];


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
  while($row = $resultid->fetch_assoc()) {  

  $name = $row["name"];




   $allrows[] = "

  <tr class='trGO' id='go$id_room_status'>
  <td class='cs-width_3'>$name <br>$time_mysql $days[$day]</td>
  <td class='cs-width_2'>$date_mysql</td>
  <td class='cs-width_1'>$seconds_start</td>
  <td class='cs-width_1'>$secondspause</td>
  <td class='cs-width_1'>$seconds_price $currency</td>
  <td class='cs-width_1'>$purchases $currency</td>
  <td class='cs-width_2 cs-text_right'>$price_room_status $currency</td>
  </tr>


  <script type='text/javascript'>
    
  document.getElementById('go$id_room_status').onclick = function() {

  
  window.open('http://localhost/Playrooms/Report_room.php?id_room_status=$id_room_status','_self')

  }


  </script>


  ";

  }

  }



  


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
            <p class="cs-invoice_date cs-primary_color cs-m0"><b class="cs-primary_color">Date: </b><?php echo $todydate ?></p>
          </div>
          <div class="imgassets cs-invoice_right cs-text_right">
            <div class="cs-logo cs-mb5"><img class="" src="assets/img/logo.png" alt="Logo"></div>
          </div>
        </div>


        <div class="cs-invoice_head cs-50_col cs-mb15">
          <div class="cs-invoice_left">
            <ul>
              <li><b class="cs-primary_color">From:</b> <?php echo $From ?></li>
              <li><b class="cs-primary_color">To:</b> <?php echo $To ?></li>
            </ul>
          </div>
          <div class="cs-invoice_right">
            <ul>
              <li><b class="cs-primary_color">Playback:</b> <?php echo $start ?></li>
              <li><b class="cs-primary_color">Pause:</b> <?php echo $stop ?></li>
            </ul>
          </div>
        </div>
        <div class="cs-mb20">
          <?php echo $hader ?>
        </div>
        <div class="cs-table cs-style1">
          <div class="cs-round_border">
            <div class="cs-table_responsive">
              <table>
                <thead>
                  <tr>
                    <th class="cs-width_3 cs-semi_bold cs-primary_color cs-focus_bg">Name</th>
                    <th class="cs-width_3 cs-semi_bold cs-primary_color cs-focus_bg">Date</th>
                    <th class="cs-width_1 cs-semi_bold cs-primary_color cs-focus_bg">Playback</th>
                    <th class="cs-width_1 cs-semi_bold cs-primary_color cs-focus_bg">Pause</th>
                    <th class="cs-width_1 cs-semi_bold cs-primary_color cs-focus_bg">Amount</th>
                    <th class="cs-width_1 cs-semi_bold cs-primary_color cs-focus_bg">Purchases</th>
                    <th class="cs-width_2 cs-semi_bold cs-primary_color cs-focus_bg cs-text_right">Total</th>
                  </tr>
                </thead>
                <tbody>

                  <?php

             
                  for ($i = 0; $i < count($allrows); $i++){
              
                  echo $allrows[$i];      
              
                  }


                  ?>


                </tbody>
              </table>
            </div>
          </div>
          <div class="cs-invoice_footer">
            <div class="cs-left_footer cs-mobile_hide"></div>
            <div class="cs-right_footer">
              <table>
                <tbody>
                  <tr class="cs-border_none">
                    <td class="cs-width_3 cs-border_top_0 cs-bold cs-f16 cs-primary_color">Total Amount</td>
                    <td class="cs-width_3 cs-border_top_0 cs-bold cs-f16 cs-primary_color cs-text_right"><?php echo "$p_interval $currency" ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
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
      </div>
    </div>
  </div>
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/jspdf.min.js"></script>
  <script src="assets/js/html2canvas.min.js"></script>
  <script src="assets/js/main.js"></script>
</body>
</html>