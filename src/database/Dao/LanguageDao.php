<?php
if(file_exists('../database/DB.php')){
    require_once '../database/DB.php';
    require_once '../database/Dataclasses/Language.php';
}else {
    require_once 'database/DB.php';
    require_once 'database/Dataclasses/Language.php';
}

$db = new DB();
$con = $db ->getConnection();
class LanguageDao
{
    public function getLanguageByName($name){
        global $con;
        $name_test = htmlspecialchars($name);

        $sth = $con->prepare('SELECT * FROM language WHERE language = :language');
        $sth->bindParam(':language', $name_test);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if(null !== $result['id']){
            return new Language($result['id'], $result['language']);
        }
        return 1;
    }

    public function getLanguageById($id){
        global $con;
        $id_test = htmlspecialchars($id);

        $sth = $con->prepare('SELECT * FROM language WHERE id = :language_id');
        $sth->bindParam(':language_id', $id_test);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if(null !== $result['id']){
            return new Language($result['id'], $result['language']);
        }
        return 1;
    }

    public function getAllLanguages(){
        global $con;
        $language_list = array();

        $sth = $con->prepare('SELECT * FROM language');
        if(!$sth->execute()){
            return 1;
        } else {
            $sth->setFetchMode(PDO::FETCH_ASSOC);
            while($result = $sth->fetch()) {
                $language_list[] = new Language($result['id'], $result['language']);
            }
        }
        return $language_list;
    }
}