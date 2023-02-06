<?php

require 'models/User.php';

$host = "db.3wa.io";
$port = "3306";
$dbname = "louischancioux_phpj7";
$connexionString = "mysql:host=$host;port=$port;dbname=$dbname";

$user = "louischancioux";
$password = "e1657392b3cd3a9bb9acef7eddd5a20c";

$db = new PDO(
    $connexionString,
    $user,
    $password,
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
);

function loadUser(string $email, PDO $db) : ?User
{
    
    $query = $db->prepare('SELECT * FROM users WHERE email = :email');

    $parameters = [
    'email' => $email
    ];

    $query->execute($parameters);
    
    $user = $query->fetch(PDO::FETCH_ASSOC);
    
    if($user === false){
        
        return null;
        
    }else{
        
        $loggedUser = new User($user['first_name'], $user['last_name'], $user['email'], $user['password']);
        $loggedUser->setId($user['id']);
        
        
        return $loggedUser;
    }
    
}

function saveUser(User $user, PDO $db) : User
{
    
    $query = $db->prepare('INSERT INTO users VALUES(NULL, :first_name, :last_name, :email, :password)');

    $parameters = [
    'first_name' => $user->getFirstName(),
    'last_name' => $user->getLastName(),
    'email' => $user->getEmail(),
    'password' => $user->getPassword(),
    ];

    $query->execute($parameters);
    
    return loadUser($user->getEmail(), $db);
}
