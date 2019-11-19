<?php

    session_start();
	
    include "../_app/Config.inc.php";
	
    $info = $_POST;
	
    session_destroy();
    $_SESSION = array();
	
    header("Location:../");
	
?>