
<?php

$host = "localhost:3306"; //please change here if required as per your setup

$db = "pnv"; // please change here as per your setup

$user = "root"; //please change here if required as per your setup

$pass = ""; //please change here if required as per your setup

$conn=mysqli_connect($host,$user,$pass);

mysqli_select_db($conn,$db);

$age = $_POST['age'];

$sex = $_POST['sex'];

$wpm = $_POST['wpm'];

$query = "SELECT * FROM students WHERE sex = '$sex' AND age <= $age AND wpm <= $wpm";

$query_result = mysqli_query($conn,$query);

?>

<table>

<tr>

<th>Name</th>

<th>Age</th>

<th>Sex</th>

<th>WPM</th>

</tr>

<?php

while($row = mysqli_fetch_array($query_result)){

echo "

<tr>

<td>$row[name]</td>

<td>$row[age]</td>

<td>$row[sex]</td>

<td>$row[wpm]</td>

</tr>

";

}

?>

</table>