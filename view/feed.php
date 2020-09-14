<?php 
    require './common/header.php';
    require './common/navbar.php';
?>
<div class="feed-div">You are logged in as <?php echo $_SESSION['userDetails']; ?></div>
<?php 
    require './common/footer.php';
?>