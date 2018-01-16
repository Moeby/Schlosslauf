<?php
require_once 'sessionCheck.php';
if(file_exists('../database/Dao/UserDao.php')){
    require_once('../database/Dao/UserDao.php');
    require_once('../database/Dao/CountryDao.php');
    require_once('../database/Dataclasses/Country.php');
} else{
    require_once('database/Dao/UserDao.php');
    require_once('database/Dao/CountryDao.php');
    require_once('database/Dataclasses/Country.php');
}

$siteRoot = 'index.php?inhalt_mitte=';

$loggedInUsername = $_SESSION['loggedInUser'];
$userDao = new UserDao();
$loggedInUser = $userDao->getUserByName($loggedInUsername);

if ($loggedInUser->getAdminCode()) {
    $menuStruct = array('Home' => array('root' => $siteRoot . "view\\home.html"),
        'Vorwort' => array('root' => $siteRoot . "view\\vorwort.html"),
        'Eigenschaften' => array('root' => $siteRoot . "view\\eigenschaften.html"),
        'Aufgaben' => array('root' => $siteRoot . "view\\aufgaben.html"),
        'Anmeldung Schlosslauf' => array('root' => $siteRoot . "controller\\schlosslauf.php"),
        'Anmeldungsübersicht' => array('root' => $siteRoot . "controller\\uebersicht.php"),
        'Logout' => array('root' => $siteRoot . "controller\\logout.php")
    );
} else {
    $menuStruct = array('Home' => array('root' => $siteRoot . "view\\home.html"),
        'Vorwort' => array('root' => $siteRoot . "view\\vorwort.html"),
        'Eigenschaften' => array('root' => $siteRoot . "view\\eigenschaften.html"),
        'Aufgaben' => array('root' => $siteRoot . "view\\aufgaben.html"),
        'Anmeldung Schlosslauf' => array('root' => $siteRoot . "controller\\schlosslauf.php"),
        'Logout' => array('root' => $siteRoot . "controller\\logout.php")
    );
}

$url = '';
if (isset($_GET['inhalt_mitte'])) {
    $aktuell = $_GET['inhalt_mitte'];
    $url = $siteRoot . $aktuell;
}
foreach ($menuStruct as $key => $value) {
    if ($value['root'] === $url) {
        echo '<a  class="fstLevelActive" href=' . $value['root'] . ">$key</a>\n";
    } else {
        echo '<a class="fstLevel" href=' . $value['root'] . ">$key</a>\n";
    }
}