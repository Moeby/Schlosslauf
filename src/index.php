<?php
require_once("sessionCheck.php");
?>
<html>
<head>
    <title>Schlosslauf</title>
    <link rel="stylesheet" type="text/css" href="resources/css/screen.css"/>
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
    if (isLoggedIn()) {
        include "view/navigation.inc.php";
    }
    ?>
</div>


<div id="inhalt_mitte">
    <?PHP
    if (isLoggedIn()) {
        if (isset($_GET["inhalt_mitte"])) {
            include($_GET["inhalt_mitte"]);
        } else {
            include("view/home.html");
        }
    } else {
        include("view/login_form.php");
    }
    ?>
</div>

</body>
</html>