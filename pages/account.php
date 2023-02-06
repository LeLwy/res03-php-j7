<?php

    if($_SESSION['status']){
        
        $template = "account";
        require 'templates/layout.phtml';
        
    }else{
        
        require 'homepage.php';
    }

?>