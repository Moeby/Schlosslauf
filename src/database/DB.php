<?php
/**
 * Created by PhpStorm.
 * User: natal
 * Date: 10.01.2018
 * Time: 10:01
 */
/*if(!file_exists('controller/ErrorController.php')){
    require_once('../../controller/ErrorController.php');
}
ErrorController::noDirectExecution();*/

class DB {
    private static $host = 'mysql:host=localhost';
    //TODO: change user
    private static $user = 'root';
    private static $pw = '';
    private static $db = 'schlosslauf';

    public function getConnection() {
        $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        try{
            $db = new PDO(self::$host.';dbname='.self::$db, self::$user, self::$pw, $options);
            return $db;
        }catch(PDOexeption $e){
            echo 'No db access!';
            if(ini_get('display_errors')){
                echo '<br>'.$e -> getMessage();
            }
            exit;
        }
    }
}