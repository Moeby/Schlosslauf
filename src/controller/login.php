<?php
session_start();
require_once ('../database/DAO/UserDao.php');

$userDao = new UserDao();

if (isset($_POST['username'])) {
//	$username = mysql_real_escape_string($_POST['username']);

    $username = htmlspecialchars($_POST['username']);
/*    $con = mysqli_connect("localhost", "root", "", "schlosslauf");
    $query = "select * from login where username='" . $username . "'";

    $result = mysqli_query($con, $query);
    if (null === $result) {
        return false;
    }*/

    $user = $userDao->getUserByName($username);

    if($user !== null){
        echo $user->getFirstName().':'.$user->getName();
    } else {
        echo 'No user with this username exits.';
    }


    while ($row = mysqli_fetch_array($result)) {
        if ($row['password'] === md5($_POST['password'])) {
            $_SESSION['loggedIn'] = 'true';
//			echo "succsess";
            header('Location: index.php');
        } else {
            echo 'fail';
            //header('Location: index.php');

        }
    }
}
