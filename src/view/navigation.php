<?php
if(!file_exists('sessionCheck.php')) {
    require_once '../sessionCheck.php';
    if(!$loggedIn) {
        header('Location: ../index.php?10');
        die();
    }
} else{
    require_once 'sessionCheck.php';
}
if(file_exists('../database/Dao/UserDao.php')){
    require_once '../database/Dao/UserDao.php';
    require_once '../database/Dao/CountryDao.php';
    require_once '../database/Dataclasses/Country.php';
    require_once '../sessionCheck.php';
} else{
    require_once 'database/Dao/UserDao.php';
    require_once 'database/Dao/CountryDao.php';
    require_once 'database/Dataclasses/Country.php';
    require_once 'sessionCheck.php';
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
        'Schlosslauf' => array('root' => $siteRoot . "view\\beschreibung_form.php"),
        'Anmeldung Schlosslauf' => array('root' => $siteRoot . "view\\schlosslauf_form.php"),
        'Anmeldungsübersicht' => array('root' => $siteRoot . "controller\\uebersicht.php"),
        'Logout' => array('root' => $siteRoot . "controller\\logout.php")
    );
} else {
    $menuStruct = array('Home' => array('root' => $siteRoot . "view\\home.html"),
        'Vorwort' => array('root' => $siteRoot . "view\\vorwort.html"),
        'Eigenschaften' => array('root' => $siteRoot . "view\\eigenschaften.html"),
        'Aufgaben' => array('root' => $siteRoot . "view\\aufgaben.html"),
        'Schlosslauf' => array('root' => $siteRoot . "view\\beschreibung_form.php"),
        'Anmeldung Schlosslauf' => array('root' => $siteRoot . "view\\schlosslauf_form.php"),
        'Logout' => array('root' => $siteRoot . "controller\\logout.php")
    );
}

$url = '';
if (isset($_GET['inhalt_mitte'])) {
    $aktuell = $_GET['inhalt_mitte'];
    $url = $siteRoot . $aktuell;
}
foreach ($menuStruct as $key => $value) {
    if ($url === $value['root']) {
        echo '<a  class="fstLevelActive" href=' . $value['root'] . ">$key</a>\n";
    } else {
        echo '<a class="fstLevel" href=' . $value['root'] . ">$key</a>\n";
    }
}