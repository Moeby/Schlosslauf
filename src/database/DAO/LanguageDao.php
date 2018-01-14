<?php
/**
 * Created by PhpStorm.
 * User: natal
 * Date: 10.01.2018
 * Time: 10:40
 */

class LanguageDao
{
    public function getLanguageByName($language){
        global $con;

        $sth = $con->prepare('SELECT id FROM language WHERE language = "'.$language.'"');
        $sth->execute();

    }

    public function getLanguageById(){

    }
}