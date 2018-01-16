<?php
if(file_exists('../database/DB.php')){
    require_once '../database/DB.php';
    require_once '../database/Dataclasses/Group.php';
}else {
    require_once 'database/DB.php';
    require_once 'database/Dataclasses/Group.php';
}

$db = new DB();
$con = $db ->getConnection();
class GroupDao
{
    public function getGroupByName($name){
        global $con;
        $name_test = htmlspecialchars($name);

        $sth = $con->prepare('SELECT * FROM `group` WHERE `group` = :group');
        $sth->bindParam(':group', $name_test);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if(null !== $result['id']){
            return new Group($result['id'], $result['group']);
        }
        return null;
    }
    public function getGroupById($id){
        global $con;
        $id_test = htmlspecialchars($id);

        $sth = $con->prepare('SELECT * FROM `group` WHERE id = :group_id');
        $sth->bindParam(':group_id', $id_test);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if(null !== $result['id']){
            return new Group($result['id'], $result['group']);
        }
        return null;
    }

    public function getAllGroups(){
        global $con;
        $group_list = array();

        $sth = $con->prepare('SELECT * FROM `group`');
        if(!$sth->execute()){
            return 1;
        } else {
            $sth->setFetchMode(PDO::FETCH_ASSOC);
            while($result = $sth->fetch()) {
                $group_list[] = new Group($result['id'], $result['group']);
            }
        }
        return $group_list;
    }
}