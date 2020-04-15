<html>
<head> 
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
  <title>Hotels Nearby</title> 
  <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div id="map"></div>
<div class="container">
  <center><h1 style="margin-top:40px;margin-bottom:40px;padding:5px;">LIST OF RESTAURANTS</h1></center>
<table class="table table-striped table-dark table-hover" id="table" style="width:90%;margin-left:5%;">
  <thead>
    
    <tr>
      <th scope="col">RESTAURANT ID</th>
      <th scope="col">RESTAURANT NAME</th>
      <th scope="col">ADDRESS</th>
    </tr>
  </thead>
  <tbody>
<?php

   session_start();
   $lat=$_SESSION['lat'];
     $lon=$_SESSION['lon'];
    $ul="https://developers.zomato.com/api/v2.1/search?lat=$lat&lon=$lon";                  
   

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

   $totalno=$json_data['results_found'];
   
   foreach($json_data['restaurants'] as $key)
   {
    $resid=$key['restaurant']['R']['res_id'];
    $name=$key['restaurant']['name'];
    $address=$key['restaurant']['location']['address'];

    $reslat=$key['restaurant']['location']['latitude'];
    $reslon=$key['restaurant']['location']['longitude'];

    ?>
    <tr>
    <td scope="row"><?php echo $resid;?></td>
    <td scope="row"><?php echo $name;?></td>
    <td scope="row"><?php echo $address;?></td>
    </tr>
    <?php
   }
?> 
</tbody>
</table>
</div>
<div class="card" style="width:50%;margin-left:25%;text-align: center">
        <div class="card-body">
        <form method="POST" action="review.php">
          <input type="text" name="resid" id="resid" placeholder="Restaurant id"><br><br>
          <button name="submit" type="submit" value="Login"class="btn btn-danger" >submit</button>
        </form>
        </div>
      </div>
  </div>
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
  var table=document.getElementById('table'),rIndex;
  for(var i=0;i<table.rows.length;i++)
  {
    table.rows[i].onclick=function()
    {
      document.getElementById('resid').value=this.cells[0].innerHTML;
         }
  }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>