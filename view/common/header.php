<?php
      session_start();
      if(isset($_SESSION['userDetails'])){
        if(basename($_SERVER['PHP_SELF'])==="feed.php"){
          $details=$_SESSION['userDetails'];
        }
        else{
          header('Location:../index.php?act=feed');
        }
      }
      else if(basename($_SERVER['PHP_SELF'])==="feed.php"){
          header('Location:../index.php?act=login');
      }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
<link rel="stylesheet" href="../Public/styles/style.css">
  <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
  <title>Shopping Stop</title>
</head>
<body>