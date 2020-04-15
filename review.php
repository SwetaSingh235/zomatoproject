<html>
<head> 
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
  <title>Hotels Nearby</title> 
  <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
  <center><h1>CUSTOMER REVIEWS</h1></center>
<?php
if(isset($_POST['submit']))
{
	$resid=$_POST['resid'];
   // $radi=20000;
    $ul="https://developers.zomato.com/api/v2.1/reviews?res_id=$resid&count=10";                  
   

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


   foreach($json_data['user_reviews'] as $key)
   {
    $text=$key['review']['review_text'];
    $ratingtext=$key['review']['rating_text'];
    $name=$key['review']['user']['name'];
    $rating=$key['review']['rating'];
    $profilelink=$key['review']['user']['profile_url'];
    ?>
    <div class="card">
      <div class="card-body">
     <p><?php echo 'NAME-'.$name.'  ';?></p>
     <p><?php echo 'PROFILE LINK-'.$profilelink.'  ';?></p>
     <p><?php echo 'TEXT-'.$text.'  ';?></p>
     <p><?php echo 'RATING-'.$rating.'  ';?></p>
     <p><?php echo '<br>';?></p>
    </div>
  </div>
     <?php
   }
 }  
?>
</body>
</html>