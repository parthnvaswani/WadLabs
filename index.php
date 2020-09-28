<?php
    session_unset();
    // import
    require_once  'controller/Controller.php';	
    // create instance	
    $controller = new Controller();	
    // call mvcHandler to display a page
    $controller->mvcHandler();
?>