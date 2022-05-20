<?php

error_reporting(0);
ini_set('display_errors', 0);

require_once 'php/main.php';
session_start();


if($_SESSION['ref'] != null){

$ref = $_SESSION['ref'];

$_SESSION['ref'] = null;


}
else
{

$ref = "";

}



$_SESSION['Create_report'] = 0;




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
while($row = $resultid->fetch_assoc()) {  

     $currency          = $row["currency"];  
     $LockEdit_room     = $row["LockEdit_room"]; 
     $LockDelete_room   = $row["LockDelete_room"]; 
     $LockCreate_report = $row["LockCreate_report"]; 
     $LockCreate_room   = $row["LockCreate_room"]; 
     $LockCreate_item   = $row["LockCreate_item"]; 
     $LockEdit_item     = $row["LockEdit_item"]; 
     $LockDelete_item   = $row["LockDelete_item"];



}


if($LockCreate_room == "A"){

$INPLockCreate_room = "<div class='col-12'><div class='sign__group'><input id='passCreate_room' type='password' name='pass' class='sign__input' placeholder='Password'></div></div>";
$dataLockCreate_room = "form_data.append('passCreate_room', document.getElementById('passCreate_room').value);";
$LockCreate_room = "checked";



}
else
{


$INPLockCreate_room = "";
$dataLockCreate_room = "";
$LockCreate_room = "";

}



if($LockCreate_item == "A"){

$INPLockCreate_item = "<div class='col-12'><div class='sign__group'><input id='passCreate_Item' type='password' name='pass' class='sign__input' placeholder='Password'></div></div>";
$dataLockCreate_item = "form_data.append('passCreate_Item', document.getElementById('passCreate_Item').value);";
$LockCreate_item = "checked";



}
else
{


$INPLockCreate_item = "";
$dataLockCreate_item = "";
$LockCreate_item = "";

}


if($LockCreate_report == "A"){

$INPreport = "<div class='col-12'><div class='sign__group'><input id='passreport' type='password' class='sign__input' placeholder='Password'></div></div>";
$dataLockreport = ", 'pass' : document.getElementById('passreport').value";
$Lockreport = "checked";



}
else
{


$INPreport = "";
$dataLockreport = "";
$Lockreport = "";

}


if($LockEdit_item == "A"){

$INPEdit_item = "<div class='col-12'><div class='sign__group'><input id='passEdit_Item' type='password' name='pass' class='sign__input' placeholder='Password'></div></div>";
$dataLockEdit_item = "form_data.append('passEdit', document.getElementById('passEdit_Item').value);";
$LockEdit_item = "checked";



}
else
{


$INPEdit_item = "";
$dataLockEdit_item = "";
$LockEdit_item = "";

}


if($LockDelete_item == "A"){

$INPDelete_item = "<div class='col-12'><div class='sign__group'><input id='passDelete_item' type='password' name='pass' class='sign__input' placeholder='Password'></div></div>";
$dataLockDelete_item = ", 'passDelete_item' : document.getElementById('passDelete_item').value";
$LockDelete_item = "checked";



}
else
{


$INPDelete_item = "";
$dataLockDelete_item = "";
$LockDelete_item = "";

}








$todydate = date('Y-m-d')






?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- CSS -->
	<link rel="stylesheet" href="css/bootstrap-reboot.min.css">
	<link rel="stylesheet" href="css/bootstrap-grid.min.css">
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/magnific-popup.css">
	<link rel="stylesheet" href="css/select2.min.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/ionicons.min.css">

	<!-- Favicons -->
	<link rel="icon" type="image/png" href="img/crowz.png" sizes="32x32">
	<link rel="apple-touch-icon" href="img/logo-app.JPG">

	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="Hassanein Hassan">
	<title>Playrooms – CroWz</title>

</head>
<body>
	<!-- header -->
	<header class="header">
		<div class="header__content">
			<div class="header__logo">
				
					<img src="img/logo.png" alt="">
				
			</div>


				<div class="header__action header__action--profile">
					<a class="header__profile-btn" href="#" role="button" id="dropdownMenuProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<p>Options</p>

					
					</a>

					<ul class="dropdown-menu header__profile-menu" aria-labelledby="dropdownMenuProfile">

						<li>
						<a class="card__cover open-modal" href="#modal-Create-a-room">
						<span>Create a room</span>
					</a>
				</li>
						<li>
						<a class="card__cover open-modal" href="#modal-Create-a-item">
						<span>Create a item</span>
					</a>
				</li>

                     <li>
                              <a class="card__cover open-modal" href="#modal-create-report">
                              <span>Create report</span>
                         </a>
                    </li>

                    <li>
                              <a class="card__cover open-modal" href="#modal-setting">
                              <span>Setting</span>
                         </a>
                    </li>

                   
						
					</ul>
				</div>
			</div>

		</div>
	</header>
	<!-- end header -->


	     <!-- <script type="text/javascript">


          setInterval(function(){ 


		$.ajax({
          url: 'php/renewed.php', // <-- point to server-side PHP script 
          data: { 
          'check_status' : 1 ,
          },      
          type: 'post',
          
          success: function(response){

          var response = JSON.parse(response);
          
          if(response[0].auth == '1'){



          }
          
          
          }});


          }, 1000);
		


	    </script> -->




	<!-- main content -->
	<main class="main">
		<div class="container">

			<!-- dashboard -->
			<div class="row row--grid">
	
			
						<?php 


				    $resultid = $conn->query("SELECT * FROM room"); 
                        while($row = $resultid->fetch_assoc()) {  

                        $id      = $row["id"];  
                        $name    = $row["name"];
                        $price   = $row["price"];  
                        $avatar  = $row["avatar"];  
                        $status_mysql  = $row["status"];
   
                        if($status_mysql == "A"){
         
                        $status_room = "<button id='show_room$id' href='#modal-show-room$id' class='author__follow author__follow--true card__cover open-modal' type='button'>Not Empty</button>";

                        }
                        else
                        {

                        $status_room = "<button id='show_room$id' href='#modal-show-room$id' class='author__follow card__cover open-modal' type='button'>Empty</button>";

                        }

                        $avatar_details = explode('/', $avatar);



                        if($LockDelete_room == "A"){

                        $INPLockDelete_room = "<div class='col-12'><div class='sign__group'><input id='pass$id' type='password' name='pass' class='sign__input' placeholder='Password'></div></div>";
                        $dataLockDelete_room = ", 'pass' : document.getElementById('pass$id').value";
                        $LockDelete_room = "checked";
                       
                       
                       }
                       else
                       {
                       
                        $INPLockDelete_room = "";
                        $dataLockDelete_room = "";
                        $LockDelete_room = "";
                       
                       
                       }



                       if($LockEdit_room == "A"){

                       $INPLockEdit_room = "<div class='col-12'><div class='sign__group'><input id='passEdit$id' type='password' name='pass' class='sign__input' placeholder='Password'></div></div>";
                       $dataLockEdit_room = "form_data.append('passEdit', document.getElementById('passEdit$id').value);";
                       $LockEdit_room = "checked";
                      
                      
                       }
                       else
                       {
                       
                        $INPLockEdit_room = "";
                        $dataLockEdit_room = "";
                        $LockEdit_room = "";
                       
                       
                       }





						$room = "

						<div id='when_Delete_Room$id' class='col-12 col-sm-6 col-lg-4 col-xl-3'>
					    <div class='author'>
						<a class='author__cover'></a>


						

						<div class='author__meta card__author--verified'>
							
							<img id='imgavatar$id' class='author__avatar' src='$avatar' alt='>

							
							<h3 class='author__name'></h3>
							<h3 id='nameh3$id' class='author__name'>$name</h3>
							<div class='author__wrap'>
								<div class='author__followers'>
									<p id='pricep$id'>$price $currency</p>
									<span>For one hour</span>
								</div>

                                        <a id='modalroomed$id' href='#modal-show-roomed$id' class='author__ed card__cover open-modal' ></i></a>

								$status_room
							</div>
						</div>


					    </div>
				        </div>




                            <!-- modal asset -->
                            <div id='modal-show-roomed$id' class='zoom-anim-dialog mfp-hide modal modal--asset'>
                                 <button class='modal__close' type='button'><i class='icon ion-ios-close'></i></button>


                                <div class='row row--grid'>

                                <!-- title -->
                                <div class='col-12'>
                                     <div class='main__title main__title--page'>
                                          <h1>Edit Room</h1>
                                     </div>
                                </div>
                                <!-- end title -->
                                </div>


                                <div class='row'>
                                               <div class='asset__info'>

                                              <div id='response_Room'></div>
                                                    <div class='progress' id='progress_Room'></div>
                                          

                                                         <div class='col-12'>
                                                              <div class='sign__group'>
                                                                   <input id='Name_Roomed_Room$id' type='text' name='Name' class='sign__input' placeholder='Name Room'>
                                                              </div>
                                                         </div>


                                                         <div class='col-12 col-md-4'>
                                                              <div class='sign__group'>
                                                                   <input id='price_Roomed_Room$id' type='number' name='price' class='sign__input' placeholder='Price'>
                                                              </div>
                                                         </div>

                                                         <div class='col-12'>
                                                              <div class='sign__file'>
                                                                   <label id='file_Room$id' for='upload_Avatar_Roomed_Room$id'>Avatar Room</label>
                                                                   <input data-name='#file_Room$id' id='upload_Avatar_Roomed_Room$id' name='avatar' class='sign__file-upload' type='file' accept='.png, .jpg, .jpeg'>
                                                              </div>
                                                         </div>


                                                         $INPLockEdit_room




            
                                   
         
                                                               <!-- actions -->

                                                               <div class='col-12 col-xl-4'>
                                                              <div class='asset__btns'>

                                                              <button type='button' class='asset__btn asset__btn--full asset__btn--clr' id='ed_Room$id'>Save</button>

                                                              <button type='button' class='asset__btn asset__btn--full asset__btn--clr_Close open-modal' href='#modal-Delete_Room$id'>Delete</button>

                                                             
                                                               </div>
                                                               </div>

                                                         

                                 </div>
                                </div>

                            
                            </div>

                            
                            <!-- end modal asset -->


                            <!-- modal asset -->
                            <div id='modal-Delete_Room$id' class='zoom-anim-dialog mfp-hide modal modal--asset'>
                                 <button class='modal__close' type='button'><i class='icon ion-ios-close'></i></button>


                                <div class='row row--grid'>

                                <!-- title -->
                                <div class='col-12'>
                                     <div class='main__title main__title--page'>
                                          <h1>Delete Room</h1>
                                          <p><span style='color:#EF2828;'>IMPORTANT NOTE</span> : Upon deletion, you will lose all data related to this room from previous or current purchases and visits</p>
                                     </div>
                                </div>
                                <!-- end title -->
                                </div>


                                <div class='row'>
                                               <div class='asset__info'>

                                              <div id='response_RoomDelete'></div>
               

                                                         $INPLockDelete_room


                                                               <!-- actions -->

                                                               <div class='col-12 col-xl-4'>
                                                              <div class='asset__btns'>

                                                              <button type='button' class='asset__btn asset__btn--full asset__btn--clr open-modal' href='#modal-show-roomed$id' >Back</button>
                                                              <button type='button' class='asset__btn asset__btn--full asset__btn--clr_Close' id='Delete_Room$id'>Delete</button>

                                                             
                                                               </div>
                                                               </div>

                                                         

                                 </div>
                                </div>

                            
                            </div>
                            <!-- end modal asset -->



                            <script src='js/jquery-3.5.1.min.js'></script>
                            <script type='text/javascript'>

                            var ED_ROOM$id = {

                            name: '$name',
                            price: '$price', 
                            avatar_details: '$avatar_details[2]'

                            }


                            

                            document.getElementById('modalroomed$id').onclick = function() {

                            document.getElementById('Name_Roomed_Room$id').value          = ED_ROOM$id.name;
                            document.getElementById('price_Roomed_Room$id').value         = ED_ROOM$id.price;
                            document.getElementById('file_Room$id').innerHTML             = ED_ROOM$id.avatar_details;

                         
                            }




                

                             document.getElementById('ed_Room$id').onclick = function() {



                             if(document.getElementById('Name_Roomed_Room$id').value == ED_ROOM$id.name && document.getElementById('price_Roomed_Room$id').value == ED_ROOM$id.price && document.getElementById('file_Room$id').innerHTML == ED_ROOM$id.avatar_details){return}

                  
                             var _URL = window.URL || window.webkitURL;

                             fileInput = document.getElementById('upload_Avatar_Roomed_Room$id')

                             var Name_Room  = document.getElementById('Name_Roomed_Room$id').value;   
                             var price_Room = document.getElementById('price_Roomed_Room$id').value;




                             if(document.getElementById('upload_Avatar_Roomed_Room$id').value == '' || Name_Room == '' || price_Room == ''){


                             if(Name_Room == ''){

                             $('#Name_Roomed_Room$id').toggleClass('checkbox_shake checkbox_red');
                             setTimeout(function(){ $('#Name_Roomed_Room$id').toggleClass('checkbox_shake checkbox_red');}, 300);

                             }

                             if(price_Room == ''){

                             $('#price_Roomed_Room$id').toggleClass('checkbox_shake checkbox_red');
                             setTimeout(function(){ $('#price_Roomed_Room$id').toggleClass('checkbox_shake checkbox_red');}, 300);

                             }


                             if (document.getElementById('file_Room$id').innerHTML != '$avatar_details[2]'){

                             if(document.getElementById('upload_Avatar_Roomed_Room$id').value == ''){

                             $('#file_Room$id').css('color', 'red');
                             $('#file_Room$id').toggleClass('checkbox_shake');
                             setTimeout(function(){ $('#file_Room$id').css('color', '#bdbdbd'); $('#file_Room$id').toggleClass('checkbox_shake');}, 300);
                             }

                             return;

                             }



                             }


                             if (document.getElementById('file_Room$id').innerHTML != '$avatar_details[2]'){



                             var file, img;
                             if ((file = fileInput.files[0])) {
                             img = new Image();
                             img.onload = function () {
                             var width = this.width;
                             var height = this.height;
                             $('#width').html(width);
                             $('#height').html(height);
                             if(width == height)
                             {

                              upload();
                              
                              }
                              else
                              {

                                 
                              $('#file_Room$id').css('color', 'red');
                              $('#file_Room$id').toggleClass('checkbox_shake');
                              setTimeout(function(){ $('#file_Room$id').css('color', '#bdbdbd'); $('#file_Room$id').toggleClass('checkbox_shake');}, 300);

    
                              }
    
    
                              };
                              img.src = _URL.createObjectURL(file);
                              }


                              }
                              else
                              {

                              upload();

                              }


                               function upload() {



                               if(document.getElementById('alert_Room') == null){


                               document.getElementById('upload_Avatar_Roomed_Room$id').disabled = true;

                               var form_data = new FormData();  


                               if (document.getElementById('file_Room$id').innerHTML != '$avatar_details[2]'){

                               var file_data = $('#upload_Avatar_Roomed_Room$id').prop('files')[0];   
                               form_data.append('Avatar_Room', file_data);
                               form_data.append('edAvatar_Room', 'Not Same');

                               }
                               else
                               {
                               form_data.append('edAvatar_Room', 'Same');
                               }


                               form_data.append('SSName_Room', Name_Room);
                               form_data.append('price_Room', price_Room);
                               form_data.append('id', '$id');
                               form_data.append('Name_Roombef', ED_ROOM$id.name);
                               form_data.append('SSAvatar_Room', 1);
                               $dataLockEdit_room
                               

                                                        
                               $.ajax({
                               url: 'php/upload.php', // <-- point to server-side PHP script 
                               dataType: 'text',  // <-- what to expect back from the PHP script, if anything
                               cache: false,
                               contentType: false,
                               processData: false,
                               data: form_data,                         
                               type: 'post',



                               xhr: function () {
                               var xhr = new window.XMLHttpRequest();
                               xhr.upload.addEventListener('progress', function (evt) {
                               if (evt.lengthComputable) {
                               var percentComplete = evt.loaded / evt.total;
                               console.log(percentComplete);


                               $('#progress_Room').css('width', percentComplete * 89 + '%');

                               }
                               }, false);
                               return xhr;
                               },




                               success: function(response){



                               if (response == 1) {

                               var filename = fileInput.value.replace(/^.*[\\\/]/, '')



                               ED_ROOM$id.name               = Name_Room;
                               ED_ROOM$id.price              = price_Room;
                               ED_ROOM$id.avatar_details     = document.getElementById('file_Room$id').innerHTML;

                               document.getElementById('nameh3$id').innerHTML = Name_Room;
                               document.getElementById('nameh1$id').innerHTML = Name_Room;

                               document.getElementById('pricep$id').innerHTML = price_Room +' $currency';
                               Clock$id.pri = price_Room;

                               document.getElementById('imgavatar$id').src = '$avatar_details[0]/$avatar_details[1]/'+document.getElementById('file_Room$id').innerHTML;




                               var response_all = ".'"'."<div id='alert_Room' class='alert success'><strong>Edit room successfully</strong></div>".'"'."
                               $('#response_Room').append(response_all);

                               document.getElementById('upload_Avatar_Roomed_Room$id').disabled = false;

                               setTimeout(function(){

                                $('#alert_Room').remove(); 
                                $('#progress_Room').css('width', '0%'); 

                               }, 4900);



                               }
                               else if(response == 2)
                               {

                               document.getElementById('upload_Avatar_Roomed_Room$id').disabled = false;

                               $('#progress_Room').css('width', '0%'); 

                               var response_all = ".'"'."<div id='alert_Room' class='alert warning'><strong>Room name already exists</strong></div>".'"'."
                               $('#response_Room').append(response_all);
                               setTimeout(function(){ $('#alert_Room').remove(); }, 4900);

                               }
                               else if(response == 4)
                               {

                               document.getElementById('upload_Avatar_Roomed_Room$id').disabled = false;

                               $('#progress_Room').css('width', '0%'); 

                               var response_all = ".'"'."<div id='alert_Room' class='alert warning'><strong>Your password is incorrect</strong></div>".'"'."
                               $('#response_Room').append(response_all);
                               setTimeout(function(){ $('#alert_Room').remove(); }, 4900);

                               }
                               else
                               {

                               document.getElementById('upload_Avatar_Roomed_Room$id').disabled = false;

                               $('#progress_Room').css('width', '0%'); 

                               var response_all = ".'"'."<div id='alert_Room' class='alert warning'><strong>Reload the page and try again</strong></div>".'"'."
                               $('#response_Room').append(response_all);
                               setTimeout(function(){ $('#alert_Room').remove(); }, 4900);

                               }
     
     
     
                               }
                               });

                               

                               }
                               }
    
                                  
                                 

                                  


                             }


                             document.getElementById('Delete_Room$id').onclick = function() {

                              if(document.getElementById('alert_Room') == null){


                              $.ajax({
                              url: 'php/main.php', // <-- point to server-side PHP script 
                              data: { 'Delete_Room' : 1 , 'id_room' : $id $dataLockDelete_room},      
                              type: 'post',
               
                              success: function(response){
               
                              if(response == '1'){

                              $('#when_Delete_Room$id').remove();

                              $('.open-modal').magnificPopup({});
                              $.magnificPopup.close(); 

                              }
                              else if(response == '3'){

                              var response_all = ".'"'."<div id='alert_Room' class='alert warning'>Your password is incorrect<strong></strong></div>".'"'."
                              $('#response_RoomDelete').append(response_all);
                              setTimeout(function(){ $('#alert_Room').remove(); }, 4900);


                              }
                              else
                              {

                              var response_all = ".'"'."<div id='alert_Room' class='alert warning'><strong>Reload the page and try again</strong></div>".'"'."
                              $('#response_RoomDelete').append(response_all);
                              setTimeout(function(){ $('#alert_Room').remove(); }, 4900);

                              }



                              }});

                              } 
 


                              }

                             </script>



						";



						echo $room;
				

						}



						?>

						


			</div>
			<!-- end dashboard -->

		</div>
	</main>
	<!-- end main content -->


	<!-- footer -->
	<footer class="footer">
		<div class="container">
	
			<div class="row">
				<div class="col-12">
					<div class="footer__content">
						<div class="footer__social">

							<a href="https://www.facebook.com/crrowz/" target="_blank"><i class='icon ion-logo-facebook'></i></a>
							<a href="https://www.instagram.com/c.rowz/" target="_blank"><i class='icon ion-logo-instagram'></i></a>

							
						</div>

						<small class="footer__copyright">Copyright &copy; 2022 Hassanein Hassan All rights reserved.</small>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- end footer -->




	         <?php


	          $resultid = $conn->query("SELECT * FROM room"); 
               while($row = $resultid->fetch_assoc()) {  

               $id            = $row["id"];  
               $name          = $row["name"];
               $price         = $row["price"];  
               $avatar        = $row["avatar"]; 
               $status_mysql  = $row["status"];
               $stop_mysql    = $row["stop"]; 

               if($status_mysql == "A"){

               $status_room = "";

               $result = $conn->query("SELECT * FROM room_status WHERE id_room='$id' and status='B'"); 
               while($row = $result->fetch_assoc()) { $datepause  = $row["datepause"]; $datestart  = $row["datestart"]; $seconds_mysql  = $row["seconds"]; $id_room_status = $row['id'];}
               if (mysqli_num_rows($result) == 1) {




               // Declare and define two dates
               $date       = date('Y-m-d H:i:s');
               $date1      = strtotime($date);
               $date2      = strtotime($datestart);
               $date_pause = strtotime($datepause);

     
               if($stop_mysql == "A"){


               // Declare and define two dates

               

               $seconds = abs($date2 - $date1);
               $seconds_pause = abs($date1 - $date_pause);
               $seconds_pause = abs($seconds_mysql + $seconds_pause);
               $seconds = abs($seconds - $seconds_pause);


               $button_startstop = "<button class='asset__btn asset__btn--full asset__btn--clr' type='button' id='startstop$id' value='run' onclick='startstop$id()' style='font-size:24px;'><i id='startstop_img$id' class='icon ion-ios-play'></i></button>";
              
               $hours    = floor($seconds / 3600);
               $mins     = floor($seconds / 60 % 60);
               $secs     = floor($seconds % 60);
               $interval = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);


               $interval_details = explode(':', $interval); $h_interval = $interval_details[0]; $m_interval = $interval_details[1]; $s_interval = $interval_details[2];


               $item_status2 = $conn->query("SELECT SUM(price) AS price_Total FROM item_status where id_room_status='$id_room_status'"); 
               $row_status2 = mysqli_fetch_assoc($item_status2); 
               $price_Total = $row_status2['price_Total']; 

               $mathpr = $price / 60 / 60;
               $math = $mathpr * $seconds + $price_Total;

               $math_details = explode('.', $math);

               if(strlen($math_details[0]) == 1){$p_interval = substr($math,0,4);
               }else if(strlen($math_details[0]) == 2){$p_interval = substr($math,0,5);
               }else if(strlen($math_details[0]) == 3){$p_interval = substr($math,0,6);
               }else{$p_interval = substr($math,0,7);}


               $display = "";
               $display_P = "";


               $Clock_start = null;



               }
               else if($stop_mysql == "B")
               {

               // Formulate the Difference between two dates
               $seconds = abs($date1 - $date2);
               $seconds = abs($seconds - $seconds_mysql);
               $h_interval = "00"; $m_interval = "00"; $s_interval = "00";
               $p_interval = "0.00";

               $display = "display_close_none";
               $display_P = "";

               $button_startstop = "<button class='asset__btn asset__btn--full asset__btn--clr' type='button' id='startstop$id' value='stop' onclick='startstop$id()' style='font-size:24px;'><i id='startstop_img$id' class='icon ion-ios-pause'></i></button>";


               $Clock_start = "Clock$id.start$id();";

               $item_status2 = $conn->query("SELECT SUM(price) AS price_Total FROM item_status where id_room_status='$id_room_status'"); 
               $row_status2 = mysqli_fetch_assoc($item_status2); 
               $price_Total = $row_status2['price_Total']; 

               }


               }
               else
               {

  

               $price_Total = 0; 

               $Clock_start = null;
               $display = "display_close_none";
               $display_P = "display_close_none";

               $seconds = 0;
               $h_interval = "00"; $m_interval = "00"; $s_interval = "00";
               $p_interval = "0.00";

               $button_startstop = "<button class='asset__btn asset__btn--full asset__btn--clr' type='button' id='startstop$id' value='run' onclick='startstop$id()' style='font-size:24px;'><i id='startstop_img$id' class='icon ion-ios-play'></i></button>";

               }

               }
               else
               {

  

               $price_Total = 0; 

               $Clock_start = null;
               $display = "display_close_none";
               $display_P = "display_close_none";

               $seconds = 0;
               $h_interval = "00"; $m_interval = "00"; $s_interval = "00";
               $p_interval = "0.00";

               $button_startstop = "<button class='asset__btn asset__btn--full asset__btn--clr' type='button' id='startstop$id' value='run' onclick='startstop$id()' style='font-size:24px;'><i id='startstop_img$id' class='icon ion-ios-play'></i></button>";

               }

               echo "<input hidden type='number' value='$price_Total' id='price_Total$id'>";


               $modal_room1 = "

               <!-- modal asset -->
               <div id='modal-show-room$id' class='zoom-anim-dialog mfp-hide modal modal--asset'>
               	<button class='modal__close' type='button'><i class='icon ion-ios-close'></i></button>

               	<div class='row row--grid'>

               	<!-- title -->
               	<div class='col-12'>
               		<div class='main__title main__title--page'>
               			<h1 id='nameh1$id'>$name</h1>
               		</div>
               	</div>
               	<!-- end title -->
               	</div>

               	<div class='row'>

               			<!-- sidebar -->
               			<div class='col-12 col-xl-4'>
               				
               				


               				<div class='asset__info'>

               					

               					<div class='tab-content'>
               						<div class='tab-pane fade show active' id='tab-1' role='tabpanel'>
               							<div class='asset__actions asset__actions--scroll' id='asset__actions--scroll1$id'>
               							<div id='room_user$id'>
               							<div id='iDiv$id'></div>


               							";

                                    	echo $modal_room1;




                                        $resultid2 = $conn->query("SELECT * FROM room_status where id_room='$id' and status='B' ");
                                        if (mysqli_num_rows($resultid2) == 1) {

                                        
                                        $resultid1 = $conn->query("SELECT * FROM item"); 
                                        while($row1 = $resultid1->fetch_assoc()) {  
                                       
                                        $id_item            = $row1["id"];
                                        $name_item          = $row1["name"];
                                        $price_item         = $row1["price"];
                                        $avatar_item        = $row1["avatar"]; 


                                        $item_status = $conn->query("SELECT * FROM item_status where id_item='$id_item' and id_room_status='$id_room_status'"); 
                                        $cont_item_status = mysqli_num_rows($item_status);
                                        $item_status1 = $conn->query("SELECT * FROM item_status where id_item='$id_item' and id_room_status='$id_room_status'  GROUP BY id_item"); 
                                        while($row3 = $item_status1->fetch_assoc()) {


                                       
                                        $modal_room2 =	"
                                        
                                        <div id='user_buy_item1$id$id_item'>
                                        <div id='user_item1$id$id_item' class='asset__action asset__action--verified'>
                                        <img id='imgavatar1$id$id_item' src='$avatar_item' alt=''>
                                        <p><span id='nameitem2$id$id_item'>$name_item</span> for <b><span id='pricep$id$id_item'>$price_item</span> $currency</p>
                                        </div>
                                        </div>
                                       
                                        <div id='user_buy_item2$id$id_item'>
                                        <div id='user_item2$id$id_item' class='asset__action_buttons'>
                                        <a class='asset__action_button' style='cursor: default;'><span id='cont_item_status2$id$id_item'>$cont_item_status</span></a>
                                        </div>
                                        </div>
                                        

                                       
                                        ";

                                        echo $modal_room2;

                                        }

                                       
                                        }

                                        }









               					$modal_room3 = "
               								



               								
                                             </div>

               						</div>
               						</div>
               					</div>
               					<!-- end tabs -->
               					</div>

               		
               					<div class='asset__wrap '>
               				
               					<div class='asset__timer'>
               					<span><i class='icon ion-ios-timer'></i>The Time</span>
               					<div class='asset__clock'><span id='hou$id'>$h_interval</span>:<span id='min$id'>$m_interval</span>:<span id='sec$id'>$s_interval</span></div>
               					</div>

               					<script type='text/javascript'>


 
               		               var Clock$id = {
                                        sec: $seconds,
                                        pri: $price,
                                        start$id: function () {
                                        if (!this.interval) {
                                        var self = this;
                                        function pad(val) { return val > 9 ? val : '0' + val; }
                                        
                                        this.interval = setInterval(function () {
                                        self.sec += 1;
                                        
                                        document.getElementById('sec$id').innerHTML = (pad(self.sec % 60));
                                        document.getElementById('min$id').innerHTML = (pad(parseInt(self.sec / 60, 10) % 60));
                                        document.getElementById('hou$id').innerHTML = (pad(parseInt(self.sec / 3600, 10)));
                                        
                                        
                                        const mathpr = Math.abs(Number(self.pri) / Number(60) / Number(60));
                                        var math = Number(mathpr) * Number(self.sec) + Number(document.getElementById('price_Total$id').value)

                                        var math_split = String(math).split('.');
                                        var p_interval;

                                        if(math_split[0].length == 1){p_interval = String(math).substr(0, 4);
                                        	}else if(math_split[0].length == 2){p_interval = String(math).substr(0, 5);
                                        		}else if(math_split[0].length == 3){p_interval = String(math).substr(0, 6);}else {p_interval = String(math).substr(0, 7);}


                                        document.getElementById('Total$id').innerHTML =  p_interval + ' $currency';
                                        
                                        
                                        
                                        }, 1000);
                                        
                                        }
                                        },
                                        
                                        pause$id: function () {
                                        clearInterval(this.interval);
                                        delete this.interval;
                                        },
 
                                        reset$id: function () {
                                        Clock$id.sec = null; 
                                        clearInterval(this.interval);
                                        document.getElementById('sec$id').innerHTML = '00';
                                        document.getElementById('min$id').innerHTML = '00';
                                        document.getElementById('hou$id').innerHTML = '00';
                                        delete this.interval;
                                        },
 
                                        };
               						

               					</script>



               					<div class='asset__price'>
               						<span>Total</span>
               						<span id='Total$id'>$p_interval $currency</span>
               					</div>
               					</div>

               					<!-- actions -->
               					<div class='asset__btns'>
               						$button_startstop
               						<button class='asset__btn asset__btn--full asset__btn--clr card__cover open-modal $display_P' id='purchases$id' type='button' href='#modal-buy-from-menu$id'>Menu</button>
               						<button class='asset__btn asset__btn--full asset__btn--clr_Close modal_button_close card__cover open-modal $display' id='close$id' type='button' href='#modal-close$id'>Pay</button>
               					</div>
               					<!-- end actions -->
               					

                         <script src='js/jquery-3.5.1.min.js'></script>
               		<script type='text/javascript'>




               		$Clock_start

                                     
               		
               
                         function startstop$id() {

                         	

                         var value_startstop = document.getElementById('startstop$id').value;

                         var status

                         if (value_startstop == 'run') {



                         status = 'run'

                         document.getElementById('startstop$id').value = 'stop';
                         $('#startstop_img$id').removeClass('icon ion-ios-play' ).addClass( 'icon ion-ios-pause')

                         $('#close$id').addClass( 'display_close_none' ); 
                         $('#purchases$id').removeClass( 'display_close_none' ); 

                         Clock$id.start$id();

                     
                         $('#show_room$id').addClass('author__follow--true' );
                         document.getElementById('show_room$id').innerHTML = 'Not Empty';



                         }
                         else
                         {

                         status = 'stop'
               
                         document.getElementById('startstop$id').value = 'run';
                         $('#startstop_img$id').removeClass('icon ion-ios-pause' ).addClass( 'icon ion-ios-play')

                         Clock$id.pause$id();
 
                         $('#close$id').removeClass( 'display_close_none' ); 

                         }



                         $.ajax({
                         url: 'php/main.php', // <-- point to server-side PHP script 
                         data: { 'startstop' : 1 , 'id_room' : $id , 'status' : status },      
                         type: 'post',

                         success: function(response){


                         }});







                         }



               		

                     
               		</script>



               				
               			</div>
               			<!-- end sidebar -->
               		</div>

               
               </div>
               <!-- end modal asset -->

               ";


              echo $modal_room3;


         echo "

          <!-- modal asset -->
          <div id='modal-close$id' class='zoom-anim-dialog mfp-hide modal modal--asset'>
          	<button class='modal__close' type='button'><i class='icon ion-ios-close'></i></button>

          	
               						
               <button class='asset__btn asset__btn--full asset__btn--clr iconmony' type='button' value='Cash' onclick='Pay$id(this)'>Cash Money <i class='icon ion-ios-cash'></i></button>
               <button class='asset__btn asset__btn--full asset__btn--clr iconmony' type='button' value='Card' onclick='Pay$id(this)'>Card Money <i class='icon ion-ios-card'></i></button>
               <button id='modal_show_room$id' class='asset__btn asset__btn--full asset__btn--clr card__cover open-modal' type='button' href='#modal-show-room$id'>Back</button>

               					
          </div>
          <!-- end modal asset -->

          ";
		
			  $modal_menu1 =	"

					   	<!-- modal asset -->
                        <div id='modal-buy-from-menu$id' class='zoom-anim-dialog mfp-hide modal modal--asset'>
                        	<button class='modal__close' type='button'><i class='icon ion-ios-close'></i></button>

                        <div class='row row--grid'>

                        	<!-- title -->
                        	<div class='col-12'>
                        		<div class='main__title main__title--page'>
                        			<h1>Buy from menu</h1>
                        		</div>
                        	</div>
                        	<!-- end title -->
                        	</div>


                        	<div class='row'>
                        			<!-- content -->
                        			 <!-- <div class='col-12 col-xl-8'>
                        				<div class='asset__item'>
                        					<img src='img/cover/avatar13.jpg' alt=''>

                        				</div>
                        			</div>  -->
                        			<!-- end content -->

                        			<!-- sidebar -->
                        			<div class='col-12 col-xl-4'>
                        				
                        				


                        				<div class='asset__info'>

                        					
                                            <!-- tabs -->
                        					<div class='tab-content'>
                        						<div class='tab-pane fade show active' id='tab-1' role='tabpanel'>
                        							<div class='asset__actions asset__actions--scroll' id='asset__actions--scroll2$id'>

                        				";

                        				echo $modal_menu1;

                                        $id_itemarray = array();

                        				$resultid1 = $conn->query("SELECT * FROM item"); 
                                        while($row1 = $resultid1->fetch_assoc()) {  
                                       
                                        $id_item            = $row1["id"];
                                        $name_item          = $row1["name"];
                                        $price_item         = $row1["price"];
                                        $avatar_item        = $row1["avatar"];

                                        $id_itemarray[]     = $row1["id"];

                                        $avatar_details = explode('/', $avatar_item);



                                        $resultid2 = $conn->query("SELECT * FROM room_status where id_room='$id' and status='B' ");
                                        if (mysqli_num_rows($resultid2) == 1) {
                                    

                                        while($row2 = $resultid2->fetch_assoc()) { $id_room_status = $row2["id"]; }


                                        $item_status = $conn->query("SELECT * FROM item_status where id_item='$id_item' and id_room_status='$id_room_status' "); 
                                        $cont_item_status = mysqli_num_rows($item_status);

                                        } else { $cont_item_status = 0; }

                                    




                                       
                                        $modal_menu2 =	"
                                       
                                        <div id='buy_item1$id$id_item' class='asset__action asset__action--verified'>
                                        <img id='imgavatar$id$id_item' src='$avatar_item' alt=''>
                                        <p><span id='nameitem1$id$id_item'>$name_item</span> for <b><span id='pricep2$id$id_item'>$price_item</span> $currency</p>
                                        </div>
                                       
                                        <div id='buy_item2$id$id_item' class='asset__action_buttons'>
                                        <a href='#modal-edititme$id$id_item' class='iconitme open-modal' id='modalItemed$id$id_item'></a>
                                        <a class='asset__action_button' style='cursor: default;'><span id='cont_item_status$id$id_item'>$cont_item_status</span></a>
                                        <a class='asset__action_button asset__action_button--remove' id='remove_item$id$id_item'><i class='icon ion-ios-remove'></i></a>
                                        <a class='asset__action_button asset__action_button--add' id='add_item$id$id_item'><i class='icon ion-ios-add'></i></a>
                                        </div>


                                        <script src='js/smooth-scrollbar.js'></script>
                                        <script type='text/javascript'>

                                        var Scrollbar = window.Scrollbar;
                                        if ($('#asset__actions--scroll1$id').length) {
	                               	Scrollbar.init(document.querySelector('#asset__actions--scroll1$id'), {
	                               		damping: 0.1,
	                               		renderByPixels: true,
	                               		alwaysShowTracks: true,
	                               		continuousScrolling: false,
	                               	});
	                                   }

	                                   if ($('#asset__actions--scroll2$id').length) {
	                               	Scrollbar.init(document.querySelector('#asset__actions--scroll2$id'), {
	                               		damping: 0.1,
	                               		renderByPixels: true,
	                               		alwaysShowTracks: true,
	                               		continuousScrolling: false,
	                               	});
	                                   }


                                        document.getElementById('add_item$id$id_item').onclick = function() {

                                        $.ajax({
                                        url: 'php/main.php', // <-- point to server-side PHP script 
                                        data: { 'add_item' : 1 , 'id_room' : $id , 'id_item' : $id_item , 'price_item' : document.getElementById('pricep2$id$id_item').innerHTML},      
                                        type: 'post',
               
                                        success: function(response){
               
                                        if(response == '1'){


                                        var cont_item_status = Math.abs(Number(document.getElementById('cont_item_status$id$id_item').innerHTML) + Number(1));
                                        $('#cont_item_status$id$id_item').html(cont_item_status)
                                        $('#cont_item_status2$id$id_item').html(cont_item_status)




                                        var Total_f = document.getElementById('Total$id').innerHTML.replaceAll(' $currency', '');
                                        var Total_m = Number(Total_f) + Number(document.getElementById('pricep2$id$id_item').innerHTML)
 

                                        var math_split = String(Total_m).split('.');
                                        var p_interval;

                                        if(math_split[0].length == 1){p_interval = String(Total_m).substr(0, 4);
                                        	}else if(math_split[0].length == 2){p_interval = String(Total_m).substr(0, 5);
                                        		}else if(math_split[0].length == 3){p_interval = String(Total_m).substr(0, 6);}else {p_interval = String(Total_m).substr(0, 7);}

                                        document.getElementById('Total$id').innerHTML = p_interval +' $currency'

                                        document.getElementById('price_Total$id').value = Number(document.getElementById('price_Total$id').value) + Number(document.getElementById('pricep2$id$id_item').innerHTML)






                                       if(Number(document.getElementById('cont_item_status$id$id_item').innerHTML) < 2){

                                        var iDiv =  ".'"'."<div id='user_buy_item1$id$id_item'><div id='user_item1$id$id_item' class='asset__action asset__action--verified'><img id='imgavatar$id$id_item' src='$avatar_item' alt=''><p><span id='nameitem1$id$id_item'>$name_item</span> for <b><span id='pricep2$id$id_item'>".'"'."+document.getElementById('pricep2$id$id_item').innerHTML+".'"'."</span> $currency</p></div></div><div id='user_buy_item2$id$id_item'><div id='user_item2$id$id_item' class='asset__action_buttons'><a class='asset__action_button' style='cursor: default;'><span id='cont_item_status2$id$id_item'>".'"'."+cont_item_status+".'"'."</span></a></div></div>".'"'."

                                       $('#iDiv$id').append(iDiv);

                                        }

               
               
                                        }
               
               	                        
               
               
                                        }});

                                        }



                                        document.getElementById('remove_item$id$id_item').onclick = function() {

                                        if(Number(document.getElementById('cont_item_status$id$id_item').innerHTML) > 0)
                                        {

                                        $.ajax({
                                        url: 'php/main.php', // <-- point to server-side PHP script 
                                        data: { 'remove_item' : 1 , 'id_room' : $id , 'id_item' : $id_item , 'price_item' : document.getElementById('pricep2$id$id_item').innerHTML},      
                                        type: 'post',
               
                                        success: function(response){
               
                                        if(response == '1'){


                                        var cont_item_status = Math.abs(Number(document.getElementById('cont_item_status$id$id_item').innerHTML) - Number(1));
                                        $('#cont_item_status$id$id_item').html(cont_item_status)
                                        $('#cont_item_status2$id$id_item').html(cont_item_status)



                                        var Total_f = document.getElementById('Total$id').innerHTML.replaceAll(' $currency', '');
                                        var Total_m = Number(Total_f) - Number(document.getElementById('pricep2$id$id_item').innerHTML)

                                        var math_split = String(Total_m).split('.');
                                        var p_interval;

                                        if(math_split[0].length == 1){p_interval = String(Total_m).substr(0, 4);
                                        	}else if(math_split[0].length == 2){p_interval = String(Total_m).substr(0, 5);
                                        		}else if(math_split[0].length == 3){p_interval = String(Total_m).substr(0, 6);}else {p_interval = String(Total_m).substr(0, 7);}

                                                  

                                        document.getElementById('Total$id').innerHTML = p_interval +' $currency'

                                        document.getElementById('price_Total$id').value = Number(document.getElementById('price_Total$id').value) - Number(document.getElementById('pricep2$id$id_item').innerHTML)




                                        if(Number(document.getElementById('cont_item_status$id$id_item').innerHTML) < 1){

                                        $('#user_item1$id$id_item').remove();
                                        $('#user_item2$id$id_item').remove();

                                        }

                                        }
           
               
                                        }});

                                        }

                                        }

                                        </script>





                                        <!-- modal asset -->
                            <div id='modal-edititme$id$id_item' class='zoom-anim-dialog mfp-hide modal modal--asset'>
                                 <button class='modal__close' type='button'><i class='icon ion-ios-close'></i></button>


                                <div class='row row--grid'>

                                <!-- title -->
                                <div class='col-12'>
                                     <div class='main__title main__title--page'>
                                          <h1>Edit Item</h1>
                                     </div>
                                </div>
                                <!-- end title -->
                                </div>


                                <div class='row'>
                                <div class='asset__info'>

                               <div id='response_Item'></div>
                                     <div class='progress' id='progress_Item'></div>
                              

                                          <div class='col-12'>
                                               <div class='sign__group'>
                                                    <input id='Name_Itemed_Item$id$id_item' type='text' name='Name' class='sign__input' placeholder='Name Item'>
                                               </div>
                                          </div>


                                          <div class='col-12 col-md-4'>
                                               <div class='sign__group'>
                                                    <input id='price_Itemed_Item$id$id_item' type='number' name='price' class='sign__input' placeholder='Price'>
                                               </div>
                                          </div>

                                          <div class='col-12'>
                                               <div class='sign__file'>
                                                    <label id='file_Item$id$id_item' for='upload_Avatar_Itemed_Item$id$id_item'>Avatar Item</label>
                                                    <input data-name='#file_Item$id$id_item' id='upload_Avatar_Itemed_Item$id$id_item' name='avatar' class='sign__file-upload' type='file' accept='.png, .jpg, .jpeg'>
                                               </div>
                                          </div>


                                          $INPEdit_item




            
                              
         
                                                <!-- actions -->

                                                <div class='col-12 col-xl-4'>
                                               <div class='asset__btns'>

                                               <button type='button' class='asset__btn asset__btn--full asset__btn--clr' id='ed_Item$id$id_item'>Save</button>

                                               <button type='button' class='asset__btn asset__btn--full asset__btn--clr_Close open-modal' href='#modal-Delete_Item$id$id_item'>Delete</button>

                                              
                                                </div>
                                                </div>

                                          

                               </div>
                              </div>

                            
                            </div>


                            <!-- end modal asset -->


                            <!-- modal asset -->
                            <div id='modal-Delete_Item$id$id_item' class='zoom-anim-dialog mfp-hide modal modal--asset'>
                                 <button class='modal__close' type='button'><i class='icon ion-ios-close'></i></button>


                                <div class='row row--grid'>

                                <!-- title -->
                                <div class='col-12'>
                                     <div class='main__title main__title--page'>
                                          <h1>Delete Item</h1>
                                          <p><span style='color:#EF2828;'>IMPORTANT NOTE</span> : Upon deletion, you will lose all data related to this Item from previous or current purchases and visits</p>
                                     </div>
                                </div>
                                <!-- end title -->
                                </div>


                                <div class='row'>
                                               <div class='asset__info'>

                                              <div id='response_ItemDelete'></div>
               

                                                         $INPDelete_item


                                                               <!-- actions -->

                                                               <div class='col-12 col-xl-4'>
                                                              <div class='asset__btns'>

                                                              <button type='button' class='asset__btn asset__btn--full asset__btn--clr open-modal' href='#modal-edititme$id$id_item' >Back</button>
                                                              <button type='button' class='asset__btn asset__btn--full asset__btn--clr_Close' id='Delete_Item$id$id_item'>Delete</button>

                                                             
                                                               </div>
                                                               </div>

                                                         

                                 </div>
                                </div>

                            
                            </div>
                            <!-- end modal asset -->



                            <script src='js/jquery-3.5.1.min.js'></script>
                            <script type='text/javascript'>

                            var ED_Item$id$id_item = {

                            name: '$name_item',
                            price: '$price_item', 
                            avatar_details: '$avatar_details[2]'

                            }


                            

                            document.getElementById('modalItemed$id$id_item').onclick = function() {

                            document.getElementById('Name_Itemed_Item$id$id_item').value          = ED_Item$id$id_item.name;
                            document.getElementById('price_Itemed_Item$id$id_item').value         = ED_Item$id$id_item.price;
                            document.getElementById('file_Item$id$id_item').innerHTML             = ED_Item$id$id_item.avatar_details;

                         
                            }




                

                             document.getElementById('ed_Item$id$id_item').onclick = function() {



                             if(document.getElementById('Name_Itemed_Item$id$id_item').value == ED_Item$id$id_item.name && document.getElementById('price_Itemed_Item$id$id_item').value == ED_Item$id$id_item.price && document.getElementById('file_Item$id$id_item').innerHTML == ED_Item$id$id_item.avatar_details){return}

                  
                             var _URL = window.URL || window.webkitURL;

                             fileInput = document.getElementById('upload_Avatar_Itemed_Item$id$id_item')

                             var Name_Item  = document.getElementById('Name_Itemed_Item$id$id_item').value;   
                             var price_Item = document.getElementById('price_Itemed_Item$id$id_item').value;




                             if(document.getElementById('upload_Avatar_Itemed_Item$id$id_item').value == '' || Name_Item == '' || price_Item == ''){


                             if(Name_Item == ''){

                             $('#Name_Itemed_Item$id$id_item').toggleClass('checkbox_shake checkbox_red');
                             setTimeout(function(){ $('#Name_Itemed_Item$id$id_item').toggleClass('checkbox_shake checkbox_red');}, 300);

                             }

                             if(price_Item == ''){

                             $('#price_Itemed_Item$id$id_item').toggleClass('checkbox_shake checkbox_red');
                             setTimeout(function(){ $('#price_Itemed_Item$id$id_item').toggleClass('checkbox_shake checkbox_red');}, 300);

                             }


                             if (document.getElementById('file_Item$id$id_item').innerHTML != '$avatar_details[2]'){

                             if(document.getElementById('upload_Avatar_Itemed_Item$id$id_item').value == ''){

                             $('#file_Item$id$id_item').css('color', 'red');
                             $('#file_Item$id$id_item').toggleClass('checkbox_shake');
                             setTimeout(function(){ $('#file_Item$id$id_item').css('color', '#bdbdbd'); $('#file_Item$id$id_item').toggleClass('checkbox_shake');}, 300);
                             }

                             return;

                             }



                             }


                             if (document.getElementById('file_Item$id$id_item').innerHTML != '$avatar_details[2]'){



                             var file, img;
                             if ((file = fileInput.files[0])) {
                             img = new Image();
                             img.onload = function () {
                             var width = this.width;
                             var height = this.height;
                             $('#width').html(width);
                             $('#height').html(height);
                             if(width == height)
                             {

                              upload();
                              
                              }
                              else
                              {

                                 
                              $('#file_Item$id$id_item').css('color', 'red');
                              $('#file_Item$id$id_item').toggleClass('checkbox_shake');
                              setTimeout(function(){ $('#file_Item$id$id_item').css('color', '#bdbdbd'); $('#file_Item$id$id_item').toggleClass('checkbox_shake');}, 300);

    
                              }
    
    
                              };
                              img.src = _URL.createObjectURL(file);
                              }


                              }
                              else
                              {

                              upload();

                              }


                               function upload() {



                               if(document.getElementById('alert_Item') == null){


                               document.getElementById('upload_Avatar_Itemed_Item$id$id_item').disabled = true;

                               var form_data = new FormData();  


                               if (document.getElementById('file_Item$id$id_item').innerHTML != '$avatar_details[2]'){

                               var file_data = $('#upload_Avatar_Itemed_Item$id$id_item').prop('files')[0];   
                               form_data.append('Avatar_Item', file_data);
                               form_data.append('edAvatar_Item', 'Not Same');

                               }
                               else
                               {
                               form_data.append('edAvatar_Item', 'Same');
                               }


                               form_data.append('SSName_Item', Name_Item);
                               form_data.append('price_Item', price_Item);
                               form_data.append('id', '$id_item');
                               form_data.append('id_room', '$id');
                               form_data.append('Name_Itembef', ED_Item$id$id_item.name);
                               form_data.append('SSAvatar_Item', 1);
                               $dataLockEdit_item
                               

                                                        
                               $.ajax({
                               url: 'php/upload.php', // <-- point to server-side PHP script 
                               dataType: 'text',  // <-- what to expect back from the PHP script, if anything
                               cache: false,
                               contentType: false,
                               processData: false,
                               data: form_data,                         
                               type: 'post',



                               xhr: function () {
                               var xhr = new window.XMLHttpRequest();
                               xhr.upload.addEventListener('progress', function (evt) {
                               if (evt.lengthComputable) {
                               var percentComplete = evt.loaded / evt.total;
                               console.log(percentComplete);


                               $('#progress_Item').css('width', percentComplete * 89 + '%');

                               }
                               }, false);
                               return xhr;
                               },




                              success: function(response){
                               
                               

                              if (response == 1) {

                              $.ajax({
                              url: 'php/main.php', // <-- point to server-side PHP script 
                              data: { 
                              'refrash'  : 1,
                              'id'  : '$id$id_item'
                              },      
                              type: 'post',
                              
                              success: function(response){

                              if (response == 1) {location.reload();}

                              }});



                              var cont_price_item_status = Number(document.getElementById('cont_item_status$id$id_item').innerHTML) * Number(document.getElementById('pricep2$id$id_item').innerHTML);

                              var Total_f = document.getElementById('Total$id').innerHTML.replaceAll(' $currency', '');

                              var Total_m = Number(Total_f) - Number(cont_price_item_status)

                              var cont_price_Item = Number(document.getElementById('cont_item_status$id$id_item').innerHTML) * Number(price_Item);

                              var Total_m = Number(Total_m) + Number(cont_price_Item);


                         

                              var math_split = String(Total_m).split('.');
                              var p_interval;

                              if(math_split[0].length == 1){p_interval = String(Total_m).substr(0, 4);
                                   }else if(math_split[0].length == 2){p_interval = String(Total_m).substr(0, 5);
                                        }else if(math_split[0].length == 3){p_interval = String(Total_m).substr(0, 6);}else {p_interval = String(Total_m).substr(0, 7);}
                                        

                              document.getElementById('Total$id').innerHTML = p_interval +' $currency'

                              document.getElementById('price_Total$id').value = Number(document.getElementById('price_Total$id').value) - Number(cont_price_item_status)

                              var cont_price_Total_Item = Number(document.getElementById('cont_item_status$id$id_item').innerHTML) * Number(price_Item);
                              document.getElementById('price_Total$id').value = Number(document.getElementById('price_Total$id').value) + Number(cont_price_Total_Item)







                               ED_Item$id$id_item.name               = Name_Item;
                               ED_Item$id$id_item.price              = price_Item;
                               ED_Item$id$id_item.avatar_details     = document.getElementById('file_Item$id$id_item').innerHTML;
                         


                              document.getElementById('nameitem1$id$id_item').innerHTML = Name_Item;
                              document.getElementById('imgavatar$id$id_item').src = '$avatar_details[0]/$avatar_details[1]/'+document.getElementById('file_Item$id$id_item').innerHTML;
                              document.getElementById('pricep2$id$id_item').innerHTML = price_Item;

                          



                              if (document.getElementById('user_buy_item1$id$id_item') != null) {


                               document.getElementById('nameitem2$id$id_item').innerHTML = Name_Item;
                               document.getElementById('pricep$id$id_item').innerHTML = price_Item;
                               document.getElementById('imgavatar1$id$id_item').src = '$avatar_details[0]/$avatar_details[1]/'+document.getElementById('file_Item$id$id_item').innerHTML;


                              }





                               var response_all = ".'"'."<div id='alert_Item' class='alert success'><strong>Edit Item successfully</strong></div>".'"'."
                               $('#response_Item').append(response_all);

                               document.getElementById('upload_Avatar_Itemed_Item$id$id_item').disabled = false;

                               setTimeout(function(){

                                $('#alert_Item').remove(); 
                                $('#progress_Item').css('width', '0%'); 

                               }, 4900);






                               }
                               else if(response == 2)
                               {

                               document.getElementById('upload_Avatar_Itemed_Item$id$id_item').disabled = false;

                               $('#progress_Item').css('width', '0%'); 

                               var response_all = ".'"'."<div id='alert_Item' class='alert warning'><strong>Item name already exists</strong></div>".'"'."
                               $('#response_Item').append(response_all);
                               setTimeout(function(){ $('#alert_Item').remove(); }, 4900);

                               }
                               else if(response == 4)
                               {

                               document.getElementById('upload_Avatar_Itemed_Item$id$id_item').disabled = false;

                               $('#progress_Item').css('width', '0%'); 

                               var response_all = ".'"'."<div id='alert_Item' class='alert warning'><strong>Your password is incorrect</strong></div>".'"'."
                               $('#response_Item').append(response_all);
                               setTimeout(function(){ $('#alert_Item').remove(); }, 4900);

                               }
                               else
                               {

                               document.getElementById('upload_Avatar_Itemed_Item$id$id_item').disabled = false;

                               $('#progress_Item').css('width', '0%'); 

                               var response_all = ".'"'."<div id='alert_Item' class='alert warning'><strong>Reload the page and try again</strong></div>".'"'."
                               $('#response_Item').append(response_all);
                               setTimeout(function(){ $('#alert_Item').remove(); }, 4900);

                               }
     
     
     
                               }
                               });

                               

                               }
                               }
    
                                  
                                 

                                  


                             }


                             document.getElementById('Delete_Item$id$id_item').onclick = function() {

                              if(document.getElementById('alert_Item') == null){


                              $.ajax({
                              url: 'php/main.php', // <-- point to server-side PHP script 
                              data: { 'Delete_Item' : 1 , 'id_Item' : $id_item $dataLockDelete_item},      
                              type: 'post',
               
                              success: function(response){
               
                              if(response == '1'){



                              var cont_price_item_status = Number(document.getElementById('cont_item_status$id$id_item').innerHTML) * Number(document.getElementById('pricep2$id$id_item').innerHTML);

                              var Total_f = document.getElementById('Total$id').innerHTML.replaceAll(' $currency', '');

                              var Total_m = Number(Total_f) - Number(cont_price_item_status)

                              var math_split = String(Total_m).split('.');
                              var p_interval;

                              if(math_split[0].length == 1){p_interval = String(Total_m).substr(0, 4);
                                   }else if(math_split[0].length == 2){p_interval = String(Total_m).substr(0, 5);
                                        }else if(math_split[0].length == 3){p_interval = String(Total_m).substr(0, 6);}else {p_interval = String(Total_m).substr(0, 7);}

                                        

                              document.getElementById('Total$id').innerHTML = p_interval +' $currency'

                              document.getElementById('price_Total$id').value = Number(document.getElementById('price_Total$id').value) - Number(cont_price_item_status)

                        
                              



                        
                              $('#buy_item1$id$id_item').remove();
                              $('#buy_item2$id$id_item').remove();
                              $('#user_buy_item1$id$id_item').remove();
                              $('#user_buy_item2$id$id_item').remove();

                              document.getElementById('modal_show_room$id').click();

                              }
                              else if(response == '3'){

                              var response_all = ".'"'."<div id='alert_Item' class='alert warning'>Your password is incorrect<strong></strong></div>".'"'."
                              $('#response_ItemDelete').append(response_all);
                              setTimeout(function(){ $('#alert_Item').remove(); }, 4900);


                              }
                              else
                              {

                              var response_all = ".'"'."<div id='alert_Item' class='alert warning'><strong>Reload the page and try again</strong></div>".'"'."
                              $('#response_ItemDelete').append(response_all);
                              setTimeout(function(){ $('#alert_Item').remove(); }, 4900);

                              }



                              }});

                              } 
 


                              }


                             if('$ref' != null){ 
                                  
                                  if('$ref' == '$id$id_item'){
    
                                  $(window).on('load', function() {
                                      document.getElementById('modal_show_room$id').click(); 
                                  });
             
    
                                  } 
                             }



                             </script>









                           
                            ";

                            echo $modal_menu2;
                           
                            }
                  						
                  
                  						
                                 $id_itemarray = implode(',', $id_itemarray);

                  			$modal_menu3 =	"

                  			</div>
                  			</div>
                  			</div>
                  			<!-- end tabs -->


                  			<!-- actions -->
                  			<div class='asset__btns'>
                  				<button class='asset__btn asset__btn--full asset__btn--clr card__cover open-modal' type='button' href='#modal-show-room$id'>Back</button>
                  			</div>
                  			<!-- end actions -->


                        		</div>
                        	</div>
                        	<!-- end sidebar -->
                        </div>



                         <script>

                         function Pay$id(o) {

                         var price =    document.getElementById('Total$id').innerHTML.slice(0, -1);
               
                         $.ajax({
                         url: 'php/main.php', // <-- point to server-side PHP script 
                         data: { 'close' : 1 , 'id_room' : $id , 'price' : price , 'mathod' : o.value},      
                         type: 'post',
               
                         success: function(response){
               
                         if(response == '1'){
               
               
               
                         Clock$id.reset$id();
                         document.getElementById('startstop$id').value = 'run';
                         $('#startstop_img$id').removeClass('icon ion-ios-pause' ).addClass( 'icon ion-ios-play')                      
                         document.getElementById('Total$id').innerHTML = '0.00 $currency';
                         /*$('#room_user$id').remove();*/
               
                         $('#close$id').addClass( 'display_close_none' ); 
                         $('#purchases$id').addClass( 'display_close_none' ); 
               
                         $('#show_room$id').removeClass('author__follow--true' );
                         document.getElementById('show_room$id').innerHTML = 'Empty';
                         document.getElementById('price_Total$id').value = 0;
               
               
                          $('.open-modal').magnificPopup({});
                          $.magnificPopup.close();


                          var id_itemarray = [$id_itemarray];
                          for (var i=0; i < id_itemarray.length; i++) {

                          var cont_item_status = 0;
                          $('#cont_item_status$id'+id_itemarray[i]).html(cont_item_status)
                          $('#cont_item_status2$id'+id_itemarray[i]).html(cont_item_status)

                          $('#user_item1$id'+id_itemarray[i]).remove();
                          $('#user_item2$id'+id_itemarray[i]).remove();

                          } 
               
                          
               
               
                         }
               
                             
               
               
                         }});
               
               
                         }


                         

                     
                         </script>


                        
                        </div>
                        <!-- end modal asset -->


					   	";

			
					   	echo $modal_menu3;


					   	}



	            ?>


	


	<style>

	 .progress {
	 position: relative;
     display: block;
     text-align: center;
     width: 0;
     height: 3px;
     background: #009BFF;
     transition: width .3s;
     margin-bottom: 30px;
     margin-left: 20px;
     }


     .alert {
      position: relative ;
      padding: 10px;
      color: white;
      opacity: 1;
      transition: opacity 0.6s;
      border-radius: 10px;
      text-align: center;
      width: 330px;
      margin-bottom: 30px;
      font-size: 14px;
      margin-left: 20px;



      -webkit-animation: cssAnimation 5s forwards; 
      animation: cssAnimation 5s forwards;
      }
  
      @keyframes cssAnimation {
      0%   {opacity: 1;}
      90%  {opacity: 1;}
      100% {opacity: 0;}
      }
  
      @-webkit-keyframes cssAnimation {
      0%   {opacity: 1;}
      90%  {opacity: 1;}
      100% {opacity: 0;}
  
      }

    
    .alert.success {background-color: #04AA6D;}
    .alert.info {background-color: #2196F3;}
    .alert.error {background-color: #ff9800;}
    .alert.warning {background-color: #f44336;}
    
    .closebtn {
      margin-left: 15px;
      color: white;
      font-weight: bold;
      float: right;
      font-size: 22px;
      line-height: 20px;
      cursor: pointer;
      transition: 0.3s;
    }
    
    .closebtn:hover {
      color: black;
    }

    ::-webkit-calendar-picker-indicator {
    filter: invert(1);
    }

	 </style>


       <!-- modal asset -->
     <div id="modal-create-report" class="zoom-anim-dialog mfp-hide modal modal--asset">
          <button class='modal__close' type='button'><i class='icon ion-ios-close'></i></button>
    

    <div class="row row--grid">

          <!-- title -->
          <div class="col-12">
               <div class="main__title main__title--page">
                    <h1>Create report</h1>
               </div>
          </div>
          <!-- end title -->
          </div>



          <form id="Report" action="Report.php" method="get" target="_blank">

          <div class="row">
                         <div class="asset__info">   

                              <div id="response_report"></div> 


                                    <div class="col-12">
                                        <div class="sign__group">
                                             <label class="filter__label">From:</label>
                                             <input id="From" value="<?php echo $todydate?>" type="date" name="From" class="sign__input">
                                        </div>
                                    </div>       

                                    <div class="col-12">
                                        <div class="sign__group">
                                             <label class="filter__label">To:</label>
                                             <input id="To" value="<?php echo $todydate?>" type="date" name="To" class="sign__input">
                                        </div>
                                    </div>    

                    

                                   <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                        <label class="filter__label">Report type:</label>
                                        <div class="sign__group2">

                                             
                                             <select name="selectroom" id="selectroom" class="sign__select2" >
                                                  <option value="overall">All Room</option>
                                                  <option value="Room">One Room</option>
                                             </select>



                                             <select hidden name="room" id="room" class="sign__select2">

                                                  <?php 

                                                  $resultid = $conn->query("SELECT * FROM room"); 
                                                  while($row = $resultid->fetch_assoc()) {  
                         
                                                  $id      = $row["id"];  
                                                  $name    = $row["name"];  


                                                  echo "<option value='$id'>$name</option>";


                                                  }



                                                  ?>
                                                  

                                             </select>

                                             


                                        </div>
                                   </div>

                                   <?php echo $INPreport?>


                                   <button type='button' class='sign__btn' id='Create_report' >Create report</button>


       </div>
      </div>
     </form>



          <script src="js/jquery-3.5.1.min.js"></script>
          <script type="text/javascript">

          document.getElementById('selectroom').onchange = function() {



               if(document.getElementById('selectroom').value == "Room") {

                    document.getElementById('room').hidden = false;

               }
               else
               {

                   document.getElementById('room').hidden = true;

               }



          }

          document.getElementById('To').onchange  = function() {

          if(document.getElementById('To').value < document.getElementById('From').value){

          document.getElementById('To').value = document.getElementById('From').value;

          }


          }


          document.getElementById('From').onchange  = function() {

          if(document.getElementById('To').value < document.getElementById('From').value){

            
          document.getElementById('From').value = document.getElementById('To').value;

               
          }


          }



          document.getElementById('Create_report').onclick = function() {




          if(document.getElementById('alert_Room') == null){


          $.ajax({
          url: 'php/main.php', // <-- point to server-side PHP script 
          data: { 

          'Create_report'  : 1
          <?php echo $dataLockreport?>
          },      
          type: 'post',
          
          success: function(response){
          
          if(response == '1'){


          $('#Report').submit();

          }
          else
          {

          var response_all = "<div id='alert_Room' class='alert warning'><strong>Your password is incorrect</strong></div>"
          $("#response_report").append(response_all);
          setTimeout(function(){ $("#alert_Room").remove(); }, 4900);


          }



          }});



          }
          }

               
          </script>

          

     
     </div>
     <!-- end modal asset -->




      <!-- modal asset -->
     <div id="modal-setting" class="zoom-anim-dialog mfp-hide modal modal--asset">
          <button class='modal__close' type='button'><i class='icon ion-ios-close'></i></button>
    

    <div class="row row--grid">

          <!-- title -->
          <div class="col-12">
               <div class="main__title main__title--page">
                    <h1>Edit setting</h1>
               </div>
          </div>
          <!-- end title -->
          </div>


          <div class="row">
                         <div class="asset__info">                    

                                   <div class='col-12'>
                                         <div class='sign__group'>
                                              <input id='newpass' type='password' name='newpass' class='sign__input' placeholder='New Password'>
                                         </div>
                                    </div>


                                   <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                                            <div class="sign__group">
                                                                 <select name="select" id="select" class="sign__select">
                                                                      <option value="$">Dollar $</option>
                                                                      <option value="€">Euro €</option>
                                                                      <option value="£">Pound £</option>
                                                                      <option value="IQD">Dinar IQD</option>
                                                                      <option value="AED">Dirham AED</option>
                                                                      <option value="EGP">Pound EGP</option>
                                                                 </select>
                                                            </div>
                                                       </div>


                                                
                                                      
                                                                 <ul class="filter__checkboxes">

                                                                      <li>
                                                                           <input id="LockEdit_room" type="checkbox" name="LockEdit_room" <?php echo $LockEdit_room?>>
                                                                           <label for="LockEdit_room">Lock edit room</label>
                                                                      </li>

                                                                      <li>
                                                                           <input id="LockEdit_item" type="checkbox" name="LockEdit_item" <?php echo $LockEdit_item?>>
                                                                           <label for="LockEdit_item">Lock edit item</label>
                                                                      </li>

                                                                      <li>
                                                                           <input id="LockDelete_item" type="checkbox" name="LockDelete_item" <?php echo $LockDelete_item?>>
                                                                           <label for="LockDelete_item">Lock delete item</label>
                                                                      </li>


                                                                      <li>
                                                                           <input id="LockDelete_room" type="checkbox" name="LockDelete_room" <?php echo $LockDelete_room?>>
                                                                           <label for="LockDelete_room">Lock delete room</label>
                                                                      </li>

                                                                      <li>
                                                                           <input id="LockCreate_report" type="checkbox" name="LockCreate_report" <?php echo $Lockreport?>>
                                                                           <label for="LockCreate_report">Lock create report</label>
                                                                      </li>

                                                                      <li>
                                                                           <input id="LockCreate_room" type="checkbox" name="LockCreate_room" <?php echo $LockCreate_room?>>
                                                                           <label for="LockCreate_room">Lock create room</label>
                                                                      </li>

                                                                      <li>
                                                                           <input id="LockCreate_item" type="checkbox" name="LockCreate_item" <?php echo $LockCreate_item?>>
                                                                           <label for="LockCreate_item">Lock create item</label>
                                                                      </li>
                                                                      
                                                                 </ul>
                                                            
                                                  
            

                                   <button type='button' class='sign__btn open-modal' id='Changing'  href='#modal-checkpass'>Changing</button>

                                   

           </div>
          </div>

          

     
     </div>
     <!-- end modal asset -->


      <!-- modal asset -->
     <div id="modal-checkpass" class="zoom-anim-dialog mfp-hide modal modal--asset">
          <button class='modal__close' type='button'><i class='icon ion-ios-close'></i></button>
    

    <div class="row row--grid">

          <!-- title -->
          <div class="col-12">
               <div class="main__title main__title--page">
                    <h1>Confirm password</h1>
               </div>
          </div>
          <!-- end title -->
          </div>


          <div class="row">
              <div class="asset__info">

              <div id="response_currency"></div>                

                <div class='col-12'>
                      <div class='sign__group'>
                           <input id='pass' type='password' name='pass' class='sign__input' placeholder='Password'>
                      </div>
                 </div>


       

                 <!-- actions -->

                 <div class='col-12 col-xl-4'>
                <div class='asset__btns'>

                <button type='button' class='asset__btn asset__btn--full asset__btn--clr open-modal' href='#modal-setting' >Back</button>
                <button type='button' class='asset__btn asset__btn--full asset__btn--clr_Close' id='Save_setting'>Save</button>

                
                 </div>
                 </div>
                                   

           </div>
          </div>

          

     
     </div>
     <!-- end modal asset -->
     <script type="text/javascript">

     document.getElementById('Save_setting').onclick = function() {


          if(document.getElementById('alert_Room') == null){

          if ($('#LockEdit_room').is(':checked')) { var LockEdit_room = "'LockEdit_room':1"}else{var LockEdit_room}
          if ($('#LockEdit_item').is(':checked')) { var LockEdit_item = "'LockEdit_item':1"}else{var LockEdit_item}
          if ($('#LockDelete_room').is(':checked')) { var LockDelete_room = "'LockDelete_room':1"}else{var LockDelete_room}
          if ($('#LockCreate_report').is(':checked')) { var LockCreate_report = "'LockCreate_report':1"}else{var LockCreate_report}
          if ($('#LockCreate_room').is(':checked')) { var LockCreate_room = "'LockCreate_room':1"}else{var LockCreate_room}
          if ($('#LockCreate_item').is(':checked')) { var LockCreate_item = "'LockCreate_item':1"}else{var LockCreate_item}
          if ($('#LockDelete_item').is(':checked')) { var LockDelete_item = "'LockDelete_item':1"}else{var LockDelete_item}


          $.ajax({
          url: 'php/main.php', // <-- point to server-side PHP script 
          data: { 

          'Changing_setting'  : 1 ,
          'pass'              : document.getElementById('pass').value,
          'newpass'           : document.getElementById('newpass').value,
          'currency'          : document.getElementById('select').value,
          LockEdit_room,
          LockEdit_item,
          LockDelete_room,
          LockCreate_report,
          LockCreate_room,
          LockCreate_item,
          LockDelete_item,
          },      
          type: 'post',
          
          success: function(response){
          
          if(response == '1'){

          location.reload();  
          

          }
          else
          {

          var response_all = "<div id='alert_Room' class='alert warning'>Your password is incorrect<strong></strong></div>"
          $('#response_currency').append(response_all);
          setTimeout(function(){ $('#alert_Room').remove(); }, 4900);


          }
        



          }});

          } 



     }



     </script>


	<!-- modal asset -->
	<div id="modal-Create-a-room" class="zoom-anim-dialog mfp-hide modal modal--asset">
		<button class='modal__close' type='button'><i class='icon ion-ios-close'></i></button>
    

    <div class="row row--grid">

		<!-- title -->
		<div class="col-12">
			<div class="main__title main__title--page">
				<h1>Create a room</h1>
			</div>
		</div>
		<!-- end title -->
		</div>


		<div class="row">
					<div class="asset__info">

                        <div id="response_Room"></div>
						<div class="progress" id="progress_Room"></div>
				

							<div class="col-12">
								<div class="sign__group">
									<input id="Name_Room" type="text" name="Name" class="sign__input" placeholder="Name Room">
								</div>
							</div>


							<div class="col-12 col-md-4">
								<div class="sign__group">
									<input id="price_Room" type="number" name="price" class="sign__input" placeholder="Price">
								</div>
							</div>

							<div class="col-12">
								<div class="sign__file">
									<label id="file_Room" for="upload_Avatar_Room">Avatar Room</label>
									<input data-name="#file_Room" id="upload_Avatar_Room" name="avatar" class="sign__file-upload" type="file" accept=".png, .jpg, .jpeg">
								</div>
							</div>



                                   <?php echo $INPLockCreate_room?>


							
								<button type="button" class="sign__btn" id="Create_Room">Create Room</button>
							

		 </div>
		</div>

		

	
	</div>
	<!-- end modal asset -->


	<!-- modal asset -->
	<div id="modal-Create-a-item" class="zoom-anim-dialog mfp-hide modal modal--asset">
		<button class='modal__close' type='button'><i class='icon ion-ios-close'></i></button>


		<div class="row row--grid">

		<!-- title -->
		<div class="col-12">
			<div class="main__title main__title--page">
				<h1>Create a item</h1>
			</div>
		</div>
		<!-- end title -->
		</div>


		<div class="row">
					<div class="asset__info">
 
						    
                            <div id="response_Item"></div>
                            <div class="progress" id="progress_Item"></div>
				

							<div class="col-12">
								<div class="sign__group">
									<input id="Name_Item" type="text" name="Name" class="sign__input" placeholder="Name Item">
								</div>
							</div>


							<div class="col-12 col-md-4">
								<div class="sign__group">
									<input id="price_Item" type="number" name="price" class="sign__input" placeholder="Price">
								</div>
							</div>

							<div class="col-12">
								<div class="sign__file">
									<label id="file_Item" for="upload_Avatar_Item">Avatar Item</label>
									<input data-name="#file_Item" id="upload_Avatar_Item" name="avatar" class="sign__file-upload" type="file" accept=".png, .jpg, .jpeg">
								</div>
							</div>

                                   <?php echo $INPLockCreate_item?>


							
								<button type="button" class="sign__btn" id="Create_Item">Create Item</button>
							

		 </div>
		</div>

	
	</div>
	<!-- end modal asset -->


	<script type="text/javascript">


        
        
    

		document.getElementById('Create_Room').onclick = function() {


		  var _URL = window.URL || window.webkitURL;

            fileInput = document.getElementById('upload_Avatar_Room')

            var Name_Room  = document.getElementById('Name_Room').value;   
            var price_Room = document.getElementById('price_Room').value;


            if(document.getElementById('upload_Avatar_Room').value == "" || Name_Room == "" || price_Room == ""){


            if(Name_Room == ""){

            $('#Name_Room').toggleClass('checkbox_shake checkbox_red');
            setTimeout(function(){ $('#Name_Room').toggleClass('checkbox_shake checkbox_red');}, 300);

            }

            if(price_Room == ""){

            $('#price_Room').toggleClass('checkbox_shake checkbox_red');
            setTimeout(function(){ $('#price_Room').toggleClass('checkbox_shake checkbox_red');}, 300);

            }

            if(document.getElementById('upload_Avatar_Room').value == ""){

            $('#file_Room').css('color', 'red');
            $('#file_Room').toggleClass('checkbox_shake');
            setTimeout(function(){ $('#file_Room').css('color', '#bdbdbd'); $('#file_Room').toggleClass('checkbox_shake');}, 300);
            }

            return;


            }


    
            var file, img;
            if ((file = fileInput.files[0])) {
            img = new Image();
            img.onload = function () {
            var width = this.width;
            var height = this.height;
            $("#width").html(width);
            $("#height").html(height);
            if(width == height)
            {




    
            	upload();
            
            }
            else
            {

            	
            	$('#file_Room').css('color', 'red');
               $('#file_Room').toggleClass('checkbox_shake');
               setTimeout(function(){ $('#file_Room').css('color', '#bdbdbd'); $('#file_Room').toggleClass('checkbox_shake');}, 300);

    
            }
    
    
            };
            img.src = _URL.createObjectURL(file);
            }


            function upload() {


            if(document.getElementById("alert_Room") == null){


            document.getElementById('upload_Avatar_Room').disabled = true;


            var file_data = $('#upload_Avatar_Room').prop('files')[0];   
            var form_data = new FormData();  

            form_data.append('Avatar_Room', file_data);
            form_data.append('Name_Room', Name_Room);
            form_data.append('price_Room', price_Room);
            <?php echo $dataLockCreate_room?>

                                     
            $.ajax({
            url: 'php/upload.php', // <-- point to server-side PHP script 
            dataType: 'text',  // <-- what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,                         
            type: 'post',



            xhr: function () {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function (evt) {
            if (evt.lengthComputable) {
            var percentComplete = evt.loaded / evt.total;
            console.log(percentComplete);


            $('#progress_Room').css('width', percentComplete * 89 + '%');

            }
            }, false);
            return xhr;
            },




            success: function(response){



            if (response == 1) {

            var filename = fileInput.value.replace(/^.*[\\\/]/, '')


            var response_all = "<div id='alert_Room' class='alert success'><strong>Add New Room successfully</strong></div>"
            $("#response_Room").append(response_all);

            document.getElementById('upload_Avatar_Room').innerHTML = null;
            document.getElementById('file_Room').innerHTML          = "Avatar Room";
            document.getElementById('Name_Room').value              = null;
            document.getElementById('price_Room').value             = null;
            document.getElementById('upload_Avatar_Room').disabled = false;

            setTimeout(function(){

             $("#alert_Room").remove(); 
             $('#progress_Room').css('width', '0%'); 

            }, 4900);


            }
            else if(response == 4)
            {

            document.getElementById('upload_Avatar_Room').disabled = false;
            $('#progress_Room').css('width', '0%'); 
            var response_all = "<div id='alert_Room' class='alert warning'><strong>Your password is incorrect</strong></div>"
            $("#response_Room").append(response_all);
            setTimeout(function(){ $("#alert_Room").remove(); }, 4900);
      

            }
            else
            {

            document.getElementById('upload_Avatar_Room').disabled = false;
            $('#progress_Room').css('width', '0%'); 
            var response_all = "<div id='alert_Room' class='alert warning'><strong>We apologize, there is a professional problem, contact support for assistance</strong></div>"
            $("#response_Room").append(response_all);
            setTimeout(function(){ $("#alert_Room").remove(); }, 4900);

            }
     
     
     
            }
            });

            

            }
            }
    
		    	
		    

			


		}


		document.getElementById('Create_Item').onclick = function() {


		  var _URL = window.URL || window.webkitURL;

            fileInput = document.getElementById('upload_Avatar_Item')

            var Name_Item  = document.getElementById('Name_Item').value;   
            var price_Item = document.getElementById('price_Item').value;


            if(document.getElementById('upload_Avatar_Item').value == "" || Name_Item == "" || price_Item == ""){


            if(Name_Item == ""){

            $('#Name_Item').toggleClass('checkbox_shake checkbox_red');
            setTimeout(function(){ $('#Name_Item').toggleClass('checkbox_shake checkbox_red');}, 300);

            }

            if(price_Item == ""){

            $('#price_Item').toggleClass('checkbox_shake checkbox_red');
            setTimeout(function(){ $('#price_Item').toggleClass('checkbox_shake checkbox_red');}, 300);

            }

            if(document.getElementById('upload_Avatar_Item').value == ""){

            $('#file_Item').css('color', 'red');
            $('#file_Item').toggleClass('checkbox_shake');
            setTimeout(function(){ $('#file_Item').css('color', '#bdbdbd'); $('#file_Item').toggleClass('checkbox_shake');}, 300);
            }

            return;


            }


    
            var file, img;
            if ((file = fileInput.files[0])) {
            img = new Image();
            img.onload = function () {
            var width = this.width;
            var height = this.height;
            $("#width").html(width);
            $("#height").html(height);
            if(width == height)
            {
    
            upload();
            
            }
            else
            {

            $('#file_Item').css('color', 'red');
            $('#file_Item').toggleClass('checkbox_shake');
            setTimeout(function(){ $('#file_Item').css('color', '#bdbdbd'); $('#file_Item').toggleClass('checkbox_shake');}, 300);
    
  
            }
    
    
            };
            img.src = _URL.createObjectURL(file);
            }



            function upload() {


            if(document.getElementById("alert_Item") == null){

            document.getElementById('upload_Avatar_Item').disabled = true;
 

            var file_data = $('#upload_Avatar_Item').prop('files')[0];   
            var form_data = new FormData();  

            form_data.append('Avatar_Item', file_data);
            form_data.append('Name_Item', Name_Item);
            form_data.append('price_Item', price_Item);
            <?php echo $dataLockCreate_item?>

                                     
            $.ajax({
            url: 'php/upload.php', // <-- point to server-side PHP script 
            dataType: 'text',  // <-- what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,                         
            type: 'post',



            xhr: function () {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function (evt) {
            if (evt.lengthComputable) {
            var percentComplete = evt.loaded / evt.total;
            console.log(percentComplete);


            $('#progress_Item').css('width', percentComplete * 89 + '%');

            }
            }, false);
            return xhr;
            },




            success: function(response){



            if (response == 1) {

            var filename = fileInput.value.replace(/^.*[\\\/]/, '')


  
            var response_all = "<div id='alert_Item' class='alert success'><strong>Add New Item successfully</strong></div>"
            $("#response_Item").append(response_all);

            document.getElementById('upload_Avatar_Item').value = null;
            document.getElementById('file_Item').innerHTML      = "Avatar Item";
            document.getElementById('price_Item').value         = null;
            document.getElementById('Name_Item').value          = null;
            document.getElementById('upload_Avatar_Item').disabled = false;

            setTimeout(function(){

             $("#alert_Item").remove(); 
             $('#progress_Item').css('width', '0%'); 



            }, 4900);


            }
            else if(response == 4)
            {


            document.getElementById('upload_Avatar_Item').disabled = false;
            $('#progress_Item').css('width', '0%'); 
            var response_all = "<div id='alert_Item' class='alert warning'><strong>Your password is incorrect</strong></div>"
            $("#response_Item").append(response_all);
            setTimeout(function(){ $("#alert_Item").remove(); }, 4900);
      


            }
            else
            {
            
            document.getElementById('upload_Avatar_Item').disabled = false;
            $('#progress_Item').css('width', '0%'); 
            var response_all = "<div id='alert_Item' class='alert warning'><strong>We apologize, there is a professional problem, contact support for assistance</strong></div>"
            $("#response_Item").append(response_all);
            setTimeout(function(){ $("#alert_Item").remove(); }, 4900);

            }
     
     
     
            }
            });

            

            }
            }
    
		    



		}
 
		

	</script>








	<!-- JS -->
	<script src="js/jquery-3.5.1.min.js"></script>
	<script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/select2.min.js"></script>
	<script src="js/smooth-scrollbar.js"></script>
	<script src="js/jquery.countdown.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>