<?php
/**
 * Created by PhpStorm.
 * User: natal
 * Date: 10.01.2018
 * Time: 10:41
 */

class CountryDao
{
    public function getCountryByName($name){
        global $con;

        $sth = $con->prepare('SELECT id FROM country WHERE country = ?');
        $sth->bindParam('s', htmlspecialchars($name));
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

        $sth = $con->prepare('SELECT id FROM country WHERE id = ?');
        $sth->bindParam('i', htmlspecialchars($id));
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

    public function getAllcountries(){
        global $con;
        $country_list = [];

        $sth = $con->prepare('SELECT id FROM country');
        if(!$sth->execute()){
            return 1;
        } else {
            $sth->setFetchMode(PDO::FETCH_ASSOC);
            while($result = $sth->fetch()) {
                $country = new Country();
                $country->setId($result['id']);
                $country->setCountry($result['country']);
                $country_list = $country;
            }
        }
        return $country_list;
    }
}