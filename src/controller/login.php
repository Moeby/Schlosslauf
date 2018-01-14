<?php
//TODO: check if required
//session_start();
if(file_exists('../database/Dao/UserDao.php')){
    require_once('../database/Dao/UserDao.php');
    require_once('../database/Dao/CountryDao.php');
    require_once('../database/Dataclasses/Country.php');
} else{
    require_once('database/Dao/UserDao.php');
    require_once('database/Dao/CountryDao.php');
    require_once('database/Dataclasses/Country.php');
}

$userDao = new UserDao();

if (isset($_POST['username'])) {
//	$username = mysql_real_escape_string($_POST['username']);

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $user = $userDao->getUserByName($username);

    if($user !== null){
        if($user->getPassword() === password_hash($password, PASSWORD_BCRYPT)){
            $_SESSION['loggedIn'] = 'true';
            //echo 'Success.';
            //header('Location: schlosslauf.php');
            require_once('../index.php');
        } else {
            echo 'Fail. Password incorrect.';
            //header('Location: index.php');
            require_once('../index.php');
        }
    } else {
        echo 'Fail.No user with this username exits.';
    }
}
