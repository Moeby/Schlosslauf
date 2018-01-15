<?php
if(file_exists('../database/DB.php')){
    require_once ('../database/DB.php');
    require_once ('../database/Dataclasses/Country.php');
}else {
    //TODO: check where the file is called and add require one
    require_once ('database/DB.php');
    require_once ('database/Dataclasses/Country.php');
}

$db = new DB();
$con = $db ->getConnection();
class CountryDao
{
    public function getCountryByName($name){
        global $con;

        $sth = $con->prepare('SELECT * FROM country WHERE country = :country');
        $sth->bindParam(':country', $name);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if($result['id'] !== null){
            $country = new Country();
            $country->setId($result['id']);
            $country->setCountry($result['country']);
            return $country;
        }
        return 1;
    }
    public function getCountryById($id){
        global $con;

        $sth = $con->prepare('SELECT * FROM country WHERE id = :counrty_id');
        $sth->bindParam(':counrty_id', $id);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if($result['id'] !== null){
            $country = new Country();
            $country->setId($result['id']);
            $country->setCountry($result['country']);
            return $country;
        }
        return 1;
    }

    public function getAllCountries(){
        global $con;
        $country_list = array();

        $sth = $con->prepare('SELECT * FROM country');
        //$sth = $con->prepare('SELECT id FROM country WHERE 1 = ?');
        //$index = 1;
        //$sth->bindParam('i', $index);
        if(!$sth->execute()){
            return 1;
        } else {
            $sth->setFetchMode(PDO::FETCH_ASSOC);
            while($result = $sth->fetch()) {
                //echo($result['id'].$result['country']);
                $country_list[] = new Country($result['id'], $result['country']);
            }
        }
        return $country_list;
    }
}