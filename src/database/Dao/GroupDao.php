<?php
/**
 * Created by PhpStorm.
 * User: natal
 * Date: 10.01.2018
 * Time: 10:41
 */

class GroupDao
{
    public function getGroupByName($name){
        global $con;

        $sth = $con->prepare('SELECT id FROM group WHERE group = ?');
        $sth->bindParam('s', htmlspecialchars($name));
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

        $sth = $con->prepare('SELECT id FROM group WHERE id = ?');
        $sth->bindParam('i', htmlspecialchars($id));
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

        $sth = $con->prepare('SELECT id FROM group');
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