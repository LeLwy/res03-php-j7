<?php

function checkRoute(string $route) : void 
{
    if($route === "connexion"){
        
        require './../pages/login.php';
        
    }else if($route === "creer-un-compte"){
        
        require './../pages/register.php';
        
    }else if($route === "mon-compte"){
        
        require './../pages/account.php';
        
    }else{
        
        require './../pages/homepage.php';
        
    }
}

?>