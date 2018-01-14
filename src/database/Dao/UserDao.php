<?php
if(file_exists('../database/DB.php')){
    require_once ('../database/DB.php');
    require_once ('../database/Dataclasses/User.php');
    require_once ('../database/Dao/CountryDao.php');
    require_once ('../database/Dao/LanguageDao.php');
    require_once ('../database/Dao/GroupDao.php');
}else {
    //TODO: check where the file is called and add require one
    require_once ('database/DB.php');
    require_once ('database/Dataclasses/User.php');
    require_once ('database/Dao/CountryDao.php');
    require_once ('database/Dao/LanguageDao.php');
    require_once ('database/Dao/GroupDao.php');
}

$db = new DB();
$con = $db ->getConnection();
$countryDao = new CountryDao();
$languageDao = new LanguageDao();
$groupDao = new GroupDao();

class UserDao
{
    public function getUserByName($username){
        global $con;
        global $countryDao;
        global $languageDao;
        global $groupDao;

        $sth = $con->prepare('SELECT * FROM user WHERE username = ?');
        $sth->bindParam('s', htmlspecialchars($username));
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);

        if($result['id'] !== null){
            $user = new User();
            $country = $countryDao->getCountryById($result['country_fk']);
            $language = $languageDao->getLanguageById($result['language_fk']);
            $group = $groupDao->getGroupById($result['group_fk']);

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
            $user->setCountry($country);
            $user->setLanguage($language);
            $user->setAdminCode($result['admin_code']);
            $user->setGroup($group);
            return $user;
        }
        return null;
    }

    public function newUser($username, $password, $salt, $name, $first_name, $email, $street, $location, $area_code, $country, $language){
        global $con;

        $sth = $con->prepare('INSERT INTO user VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)');

        $sth->bindParam('sssssssssiiii'
            ,$username
            ,$password
            ,$salt
            ,$name
            ,$first_name
            ,$email
            ,$street
            ,$location
            ,$area_code
            ,$country->getId()
            ,$language->getId()
            ,0
            ,null
        );

        if(!$sth->execute()){
            return 1;
        }
        $insert_id = $con->lastInsertId();
        return $insert_id;
    }

    public function getAllUsers(){
        global $con;
        global $countryDao;
        global $languageDao;
        global $groupDao;
        $user_list = [];

        $sth = $con->prepare('SELECT * FROM user WHERE admin_code = ?');
        $adminCode = 0;
        $sth->bindParam('i', $adminCode);

        if(!$sth->execute()){
            return 1;
        } else {
            $sth->setFetchMode(PDO::FETCH_ASSOC);

            while($result = $sth->fetch()) {
                $user = new User();
                $country = $countryDao->getCountryById($result['country_fk']);
                $language = $languageDao->getLanguageById($result['language_fk']);
                $group = $groupDao->getGroupById($result['group_fk']);

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
                $user->setCountry($country);
                $user->setLanguage($language);
                $user->setAdminCode($result['admin_code']);
                $user->setGroup($group);
                //add user
                $user_list[] = $user;
            }
            return $user_list;
        }
    }
}