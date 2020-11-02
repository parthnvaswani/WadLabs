<?php 
    if(isset($_GET["q"])){

    $q=$_GET["q"];

    $host = "localhost:3306"; 

    $db = "pnv";

    $user = "root"; 

    $pass = ""; 

    $conn=mysqli_connect($host,$user,$pass);

    mysqli_select_db($conn,$db);

    $query = "SELECT * FROM students WHERE LOWER(name) LIKE  '%$q%'";

    $query_result = mysqli_query($conn,$query);

    $result=[];

    while($row = mysqli_fetch_array($query_result)){
        array_push($result,$row['name']);
    }

    echo json_encode($result);

    }
?>