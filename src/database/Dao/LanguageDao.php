<?php
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

        $sth = $con->prepare('SELECT * FROM language WHERE language = :language');
        $sth->bindParam(':language', $name);
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

        $sth = $con->prepare('SELECT * FROM language WHERE id = :language_id');
        $sth->bindParam(':language_id', $id);
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

    public function getAllLanguages(){
        global $con;
        $language_list = array();
        $language_list2 = array();

        $sth = $con->prepare('SELECT * FROM language');
        if(!$sth->execute()){
            return 1;
        } else {
            $sth->setFetchMode(PDO::FETCH_ASSOC);
            while($result = $sth->fetch()) {
                //echo($result['id'].$result['language']);
                //$language->setId($result['id']);
                //$language->setLanguage($result['language']);
                //$language_list[] = &$language;
                $language_list[] = new Language($result['id'], $result['language']);
                //$language_list2[] = $result['language'];
            }
        }
        return $language_list;
        //return $language_list2;
    }
}