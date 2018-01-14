<?php
require_once 'sessionCheck.php';
?>
<html>
<head>
    <title>Schlosslauf</title>
    <?php
    $css = "resources/css/screen.css";
    if (file_exists($css)) {
        echo '<link rel="stylesheet" type="text/css" href="' . $css . '" />';
    } else {
        echo '<link rel="stylesheet" type="text/css" href="../' . $css . '" />';
    }
    ?>
    <meta charset="UTF-8">
</head>
<body>

<div id="kopf">
    <?PHP
    include "view/kopf.php";
    ?>
</div>

<div id="inhalt_links">
    <?PHP
    if ($loggedIn) {
        include "view/navigation.php";
    }
    ?>
</div>


<div id="inhalt_mitte">
    <?PHP
    if ($loggedIn) {
        if (isset($_GET["inhalt_mitte"])) {
            include($_GET["inhalt_mitte"]);
        } else {
            include("view/home.html");
        }
    } else {
        if (isset($_GET["inhalt_mitte"]) && "registration_form.php" === ($_GET["inhalt_mitte"])) {
            include("view/registration_form.php");
        } else {
            include("view/login_form.php");
        }
    }
    ?>
</div>

</body>
</html>