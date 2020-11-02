<?php 
if(isset($_GET['q'])){
$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, "localhost://Lab9/api.php?q=$_GET[q]");

curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

$output = curl_exec($curl);

curl_close($curl);

echo $output;
}
?>