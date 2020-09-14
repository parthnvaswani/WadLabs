  <nav class="navbar navbar-expand-sm navbar-dark bg-dark mb-4">
    <div class="container">
      <div class="navbar-brand"> <a href="../index.php" class="nav-link" style="color:white;"
            >MY SHOPPING STOP</a
          ></div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobile-nav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="mobile-nav">
        <ul class="navbar-nav ml-auto">
        <?php
        if(basename($_SERVER['PHP_SELF'])==="feed.php"){
            echo '<li class="nav-item">
            <a class="nav-link" href="../index.php?act=logout">Logout</a>
          </li>';
        }else{
          echo '<li class="nav-item">
            <a class="nav-link" href="../index.php?act=register">Sign Up</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../index.php?act=login">Login</a>
          </li>';
        } ?>
        </ul>
      </div>
    </div>
  </nav>
