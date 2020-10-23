<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}
body{
    display:flex;
    justify-content:center;
}
table{
    margin:30px 0px;
}
th,td{
    padding:10px;
}
</style>

<?php 
$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, "https://jsonplaceholder.typicode.com/todos");

curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

$output = curl_exec($curl);

curl_close($curl);
$output=json_decode($output);
echo "
    <table border=1>
      <tr>
        <th>id</th>
        <th>title</th>
        <th>completed</th>
      </tr>";
foreach($output as $out){
    $completed=$out->completed?'yes':'no';
echo "<tr>
        <td>$out->id</td>
        <td>$out->title</td>
        <td>$completed</td>
      </tr>";
}
echo "</table>";
?>