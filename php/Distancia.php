<?php 
$coordenada1=$_POST['c1'];
$coordenada2=$_POST['c2'];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=$coordenada1&destinations=$coordenada2&key=AIzaSyAiNWzX14Rv_eJwvESbzD9Cu7azURVERm0");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);
echo $output;
 ?>