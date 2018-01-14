<?php
if(file_exists('../database/DB.php')){
    require_once ('../database/DB.php');
    require_once ('../database/Dataclasses/Group.php');
}else {
    //TODO: check where the file is called and add require one
    require_once ('database/DB.php');
    require_once ('database/Dataclasses/Group.php');
}

$db = new DB();
$con = $db ->getConnection();
class GroupDao
{
    public function getGroupByName($name){
        global $con;

        $sth = $con->prepare('SELECT * FROM group WHERE group = :group');
        $sth->bindParam(':group', htmlspecialchars($name));
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if($result['id'] !== null){
            $group = new Group();
            $group->setId($result['id']);
            $group->setGroup($result['group']);
            return $group;
        }
        return 1;
    }
    public function getGroupById($id){
        global $con;

        $sth = $con->prepare('SELECT * FROM group WHERE id = :group_id');
        $sth->bindParam(':group_id', $id);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if($result['id'] !== null){
            $group = new Group();
            $group->setId($result['id']);
            $group->setGroup($result['group']);
            return $group;
        }
        return 1;
    }

    public function getAllGroups(){
        global $con;
        $group_list = [];

        $sth = $con->prepare('SELECT * FROM group');
        if(!$sth->execute()){
            return 1;
        } else {
            $sth->setFetchMode(PDO::FETCH_ASSOC);
            while($result = $sth->fetch()) {
                $group = new Country();
                $group->setId($result['id']);
                $group->setCountry($result['group']);
                $group_list = $group;
            }
        }
        return $group_list;
    }
}