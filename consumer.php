<?php 
$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, "localhost://Lab7/api.php?a=1&b=2");

curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

$output = curl_exec($curl);

curl_close($curl);

echo $output;
?>