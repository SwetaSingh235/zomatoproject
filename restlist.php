<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link href="css/style.css" rel="stylesheet"/>

 <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
 <style>
 	#intro1{
	width: 100%;
	height: 100vh;
		background:#ff4d4d;
	background-size: 100% 100%;
	position: relative;
	color: white;
	text-align: center;
 	}
 	
    .container{
    	width: 100%;
	height: auto;
	position: relative;
	top: 50%;
	left: 40%;
	transform: translate(-50%, -50%);
    }
 </style>
 </head>
 <body>
 	<?php
     session_start();
     $lat=$_POST['lat'];
     $lon=$_POST['long'];

     $_SESSION['lat']=$lat;
     $_SESSION['lon']=$lon;

    $ul="https://developers.zomato.com/api/v2.1/geocode?lat=$lat&lon=$lon"; 
    $ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $ul);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
$headers = array(
  "Accept: application/json",
  "User-Key: da1a2aeb8b429779717ba7b89dbcdbf1"                                               
  );
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);
if (curl_errno($ch))
 {
    echo 'Error:' . curl_error($ch);
}
curl_close ($ch);

 $json_data = json_decode($result,true);
 $city=$json_data['location']['city_name'];
 $cityid=$json_data['location']['city_id'];
     ?>
 	<div id="intro1">
 		<div class="container">
 	 <div class="row">
 	 <div class="col-lg-6">
 	 	<img src="images/f2.jpg" width="400px" height="100%">
 	 </div>
 	 <div class="col-lg-6" style="margin-top:5%">
 	 <h2>Welcome <?php echo $city; ?></h2>
 	 <p> search for resturant by clicking on the below options</p>		
     <p><a href="res.php" style="color:white">NearBy Restaurants</a></p>
     <p><a href="allres.php"style="color:white">All Restaurant</a></p>
     </div>
       </div>
 	</div>
 </body>
 </html>