<?php
/**
 * Created by PhpStorm.
 * User: natal
 * Date: 10.01.2018
 * Time: 10:40
 */
if(file_exists('../database/DB.php')){
    require_once ('../database/DB.php');
    require_once ('../database/Dataclasses/Language.php');
}else {
    //TODO: check where the file is called and add require one
    require_once ('database/DB.php');
    require_once ('database/Dataclasses/Language.php');
}

$db = new DB();
$con = $db ->getConnection();
class LanguageDao
{
    public function getLanguageByName($name){
        global $con;

        $sth = $con->prepare('SELECT id FROM language WHERE language = ?');
        $sth->bindParam('s', htmlspecialchars($name));
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if($result['id'] !== null){
            $language = new Language();
            $language->setId($result['id']);
            $language->setLanguage($result['language']);
            return $language;
        }
        return 1;
    }

    public function getLanguageById($id){
        global $con;

        $sth = $con->prepare('SELECT id FROM language WHERE id = ?');
        $sth->bindParam('i', htmlspecialchars($id));
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if($result['id'] !== null){
            $language = new LanguageDao();
            $language->setId($result['id']);
            $language->setLanguage($result['language']);
            return $language;
        }
        return 1;
    }

    public function getAllLanguages(){
        global $con;
        $language_list = [];

        $sth = $con->prepare('SELECT id FROM language');
        if(!$sth->execute()){
            return 1;
        } else {
            $sth->setFetchMode(PDO::FETCH_ASSOC);
            while($result = $sth->fetch()) {
                $language = new Country();
                $language->setId($result['id']);
                $language->setCountry($result['language']);
                $language_list = $language;
            }
        }
        return $language_list;
    }
}