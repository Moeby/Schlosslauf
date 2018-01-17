<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(file_exists('../database/Dao/UserDao.php')){
    require_once '../database/Dao/UserDao.php';
    require_once '../database/Dao/CountryDao.php';
    require_once '../database/Dataclasses/Country.php';
} else{
    require_once 'database/Dao/UserDao.php';
    require_once 'database/Dao/CountryDao.php';
    require_once 'database/Dataclasses/Country.php';
}

$userDao = new UserDao();

if (isset($_POST['username'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $user = $userDao->getUserByName($username);

    if(null !== $user){
        $salt = $user->getSalt();
        $options = [
            'salt' => $salt
        ];
        if($user->getPassword() === password_hash($password, PASSWORD_BCRYPT, $options)){
            $_SESSION['loggedIn'] = 'true';
            $_SESSION['loggedInUser'] = $username;
            if(file_exists('../index.php')){
                header('Location: ../index.php');
            } else {
                header('Location: index.php');
            }
        } else {
            if(file_exists('../index.php')){
                header('Location: ../index.php?error=1');
            } else {
                header('Location: index.phperror=1');
            }
        }
    } else {
        if(file_exists('../index.php')){
            header('Location: ../index.php?error=2');
        } else {
            header('Location: index.php?error=2');
        }
    }
}
