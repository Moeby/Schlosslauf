<?php
require_once ('../database/DAO/UserDao.php');

$userDao = new UserDao();

if (isset($_POST['username'])) {
//	$username = mysql_real_escape_string($_POST['username']);

    $password = htmlspecialchars($_POST['password']);
    $repPassword = htmlspecialchars($_POST['repPassword']);
    if($password === $repPassword){
        $username = htmlspecialchars($_POST['username']);
        $name = htmlspecialchars($_POST['name']);
        $first_name = htmlspecialchars($_POST['vorname']);
        $email = htmlspecialchars($_POST['email']);
        $salt = "111";
        $userDao->newUser($username, $password, $salt, $name, $first_name, $email)
    } else {
        //TODO: error, passwords are not the same
    }
    $user = $userDao->getUserByName($username);

    if($user !== null){
        echo $user->getFirstName().':'.$user->getName();
        if($user->getPassword() === password_hash($password, PASSWORD_BCRYPT)){
            $_SESSION['loggedIn'] = 'true';
            echo 'Success.';
            //header('Location: schlosslauf.php');
            require_once ('../index.php');
        } else {
            echo 'Fail. Password incorrect.';
            //header('Location: index.php');
            require_once ('../index.php');
        }
    } else {
        echo 'Fail.No user with this username exits.';
    }

    $insert = $userDao->newUser();
}
