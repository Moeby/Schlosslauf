<?php
$siteRoot = "index.php?inhalt_mitte=";
$menuStruct = array("Home" => array("root" => $siteRoot . "view\\home.inc.php"),
    "Vorwort" => array("root" => $siteRoot . "view\\vorwort.inc.php"),
    "Eigenschaften" => array("root" => $siteRoot . "view\\eigenschaften.inc.php"),
    "Aufgaben" => array("root" => $siteRoot . "view\\aufgaben.inc.php"),
    "Anmeldung Schlosslauf" => array("root" => $siteRoot . "controller\\schlosslauf.php"),
    "Logout" => array("root" => $siteRoot . "controller\\logout.php")
);
$url = "";
if (isset($_GET["inhalt_mitte"])) {
    $aktuell = $_GET["inhalt_mitte"];
    $url = $siteRoot . $aktuell;
}
foreach ($menuStruct as $key => $value) {
    if ($value['root'] === $url) {
        echo "<a  class=\"fstLevelActive\" href=" . $value['root'] . ">$key</a>\n";
    } else {
        echo "<a class=\"fstLevel\" href=" . $value['root'] . ">$key</a>\n";
    }
}
?>