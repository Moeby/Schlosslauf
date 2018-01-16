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

        $sth = $con->prepare('SELECT * FROM `group` WHERE group = :group');
        $sth->bindParam(':group', htmlspecialchars($name));
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if($result['id'] !== null){
            $group = new Group($result['id'], $result['group']);
            return $group;
        }
        return null;
    }
    public function getGroupById($id){
        global $con;

        $sth = $con->prepare('SELECT * FROM `group` WHERE id = :group_id');
        $sth->bindParam(':group_id', $id);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if($result['id'] !== null){
            $group = new Group($result['id'], $result['group']);
            return $group;
        }
        return null;
    }

    public function getAllGroups(){
        global $con;
        $group_list = array();

        $sth = $con->prepare('SELECT * FROM `group`');
        if(!$sth->execute()){
            echo('untilhere');
            return 1;
        } else {
            $sth->setFetchMode(PDO::FETCH_ASSOC);
            while($result = $sth->fetch()) {
                echo($result['group']);
                $group_list[] = new Group($result['id'], $result['group']);
            }
        }
        return $group_list;
    }
}