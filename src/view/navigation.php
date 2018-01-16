<?php
require_once 'sessionCheck.php';

$siteRoot = 'index.php?inhalt_mitte=';
$menuStruct = array('Home' => array('root' => $siteRoot . "view\\home.html"),
    'Schlosslauf' => array('root' => $siteRoot . "view\\beschreibung_form.php"),
    'Eigenschaften' => array('root' => $siteRoot . "view\\eigenschaften.html"),
    'Aufgaben' => array('root' => $siteRoot . "view\\aufgaben.html"),
    'Anmeldung Schlosslauf' => array('root' => $siteRoot . "view\\schlosslauf_form.php"),
    'Logout' => array('root' => $siteRoot . "controller\\logout.php")
);
$url = '';
if (isset($_GET['inhalt_mitte'])) {
    //TODO: check if htmlspecialchars is necessary
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