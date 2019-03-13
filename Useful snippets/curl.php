<?php 
/*
Short command with curl to reach a website authenticate and receive data. Dont use it often enough to remember it so saving it here.
Version 0.1.0 13/03/2019
*/
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL, "http://yourwebsite.tech/api/authenticate"); //example url
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch,CURLOPT_HEADER, false);
curl_setopt($ch,CURLOPT_POST, true);
curl_setopt($ch,CURLOPT_POSTFIELDS, "name=NAME&password=PASSWORD"); //in case security credentials are required
$result = curl_exec($ch);
curl_close($ch);
$json = json_decode($result,true); //receiving json for example
?>
