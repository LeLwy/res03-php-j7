<?php

/********** ROUTING **********/

if(isset($_GET["route"])){
    
    checkRoute($_GET["route"]);
    
}else{
    
    checkRoute("");
    
}
    
/********** REGISTRATION-FORM **********/

$errorMessage = "";

if(isset($_POST['firstName']) && !empty($_POST['firstName']) 
&& isset($_POST['lastName']) && !empty($_POST['lastName']) 
&& isset($_POST['email']) && !empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) 
&& isset($_POST['password']) && !empty($_POST['password']) 
&& isset($_POST['confirmPassword']) && !empty($_POST['confirmPassword']))
{
    
    
    if($_POST['password'] === $_POST['confirmPassword']){
        
        $newUser = new User($_POST['firstName'], $_POST['lastName'], $_POST['email'], password_hash($_POST['password'], PASSWORD_DEFAULT));
        
        saveUser($newUser);
        
    }else{
        
        $errorMessage = "Les mots de passe ne correspondent pas";
        
    }
    
    if(empty($_POST['firstName'])){
        
        $errorMessage = "Veuillez renseigner un prénom";
        
    }else if(empty($_POST['lastName'])){
        
        $errorMessage = "Veuillez renseigner un nom";
        
    }else if(empty($_POST['email']) && (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))){
        
        $errorMessage = "Veuillez renseigner un email valide";
        
    }else if(empty($_POST['password'])){
        
        $errorMessage = "Veuillez renseigner un mot de passe";
        
    }else if(empty($_POST['confirmPassword'])){
        
        $errorMessage = "Veuillez confirmer votre mot de passe";
        
    }
}


/********** CONNECTING-FORM **********/

$accountError = "";

if(isset($_POST['userEmail']) && !empty($_POST['userEmail'] && (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))) 
&& isset($_POST['userPassword']) && !empty($_POST['userPassword']))
{
    
    if(password_verify($_POST['userEmail'], loadUser($_POST['userEmail'])->getPassword())){
        
        require './pages/account.php';
        
    }else{
        
        $accountError = "Les informations rentrées ne correspondent pas";
    }
}