<?php
if(file_exists('../database/DB.php')){
    require_once '../database/DB.php';
    require_once '../database/Dataclasses/ErrorMsg.php';
}else {
    require_once 'database/DB.php';
    require_once 'database/Dataclasses/ErrorMsg.php';
}

$db = new DB();
$con = $db ->getConnection();
class ErrorDao
{
    public function getErrorNameById($id){
        global $con;
        $id_test = htmlspecialchars($id);

        $sth = $con->prepare('SELECT * FROM error WHERE id = :id');
        $sth->bindParam(':id', $id_test);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        if(null !== $result['id']){
            $error =  new ErrorMsg($result['id'], $result['error_msg']);
            return $error->getErrorMsg();
        }
        return "Not known error.";
    }
}