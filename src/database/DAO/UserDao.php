<?php
/**
 * Created by PhpStorm.
 * User: natal
 * Date: 10.01.2018
 * Time: 10:31
 */
if(file_exists('../database/DB.php')){
    require_once ('../database/DB.php');
    require_once ('../database/Dataclasses/User.php');
}else {
    //TODO: check where the file is called and add require one
    require_once ('/database/DB.php');
    require_once ('/database/Dataclasses/User.php');
}

$db = new DB();
$con = $db ->getConnection();

class UserDao
{
    public function getUserByName($username){
        global $con;

        $sth = $con->prepare('SELECT * FROM user WHERE username = "'.$username.'"');
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);

        if($sth->fetchColumn(0) !== null){
            $user = new User();
            $user->setId($result['id']);
            $user->setUsername($result['username']);
            $user->setPassword($result['password']);
            $user->setSalt($result['salt']);
            $user->setName($result['name']);
            $user->setFirstName($result['first name']);
            $user->setEmail($result['email']);
            $user->setStreet($result['street']);
            $user->setLocation($result['location']);
            $user->setAreaCode($result['area_code']);
            $user->setCountry($result['country_fk']);
            $user->setLanguage($result['language_fk']);
            $user->setAdminCode($result['admin_code']);
            return $user;
        }
        return null;
    }

    public function newUser($username, $password, $salt, $name, $first_name, $email, $street, $location, $area_code, $country, $language){
        //TODO; check if fields were checked (SQL-Injection)
        global $con;

        $query = 'INSERT INTO user VALUES '.
            $username.
            ','.$password.
            ','.$salt.
            ','.$name.
            ','.$first_name.
            ','.$email.
            ','.$street.
            ','.$location.
            ','.$area_code.
            '.'.$country->getId().
            ','.$language->getId();

        $result = $con->query($query);
        $insert_id = $con->lastInsertId();

        return $insert_id;
    }

    public function getAllUsers(){
        global $con;
        $user_list = [];

        $query = 'SELECT * FROM user WHERE admin_code = 0';

        $result = $con->query($query);
        foreach ($result as $user){
            $user_list[] = new User();
            //TODO: set uservariables to user
        }
    }
}