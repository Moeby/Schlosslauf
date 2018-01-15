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
$con = $db->getConnection();
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

        $sth = $con->prepare('SELECT * FROM user WHERE username = :username');
        $sth->bindParam(':username', $username);
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
        //TODO: check if wothout admin code the instert is still working
        global $con;
        $admin_code = 0;
        $group = null;
        $country_id = $country->getId();
        $language_id = $language->getId();

        $sth = $con->prepare('INSERT INTO user VALUES (
            null,
           :username
          ,:password
          ,:salt
          ,:last_name
          ,:first_name
          ,:email
          ,:street
          ,:location
          ,:area_code
          ,:country
          ,:user_language
          ,:admin_code
          ,:user_group)');

        $sth->bindParam(':username', $username);
        $sth->bindParam(':password', $password);
        $sth->bindParam(':salt', $salt);
        $sth->bindParam(':last_name', $name);
        $sth->bindParam(':first_name', $first_name);
        $sth->bindParam(':email', $email);
        $sth->bindParam(':street', $street);
        $sth->bindParam(':location', $location);
        $sth->bindParam(':area_code', $area_code);
        $sth->bindParam(':country', $country_id);
        $sth->bindParam(':user_language', $language_id);
        $sth->bindParam(':admin_code', $admin_code);
        $sth->bindParam(':user_group', $group);

        if(!$sth->execute()){
            return null;
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

        $sth = $con->prepare('SELECT * FROM user WHERE admin_code = :admin_code');
        $adminCode = 0;
        $sth->bindParam(':admin_code', $adminCode);

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