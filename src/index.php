<?php
require_once 'sessionCheck.php';
require_once 'database/Dao/ErrorDao.php';
$whitelist = array('controller\\uebersicht.php'
                    ,'view\\aufgaben.html'
                    ,'view\\beschreibung_form.php'
                    ,'view\\eigenschaften.html'
                    ,'view\\home.html'
                    ,'view\\login_form.php'
                    ,'view\\registration_form.php'
                    ,'view\\schlosslauf_form.php'
                    ,'view\\vorwort.html'
                    ,'controller\\logout.php'
                    ,'controller\\schlosslauf.php');
?>
<html>
<head>
    <title>Schlosslauf</title>
    <?php
    $css = 'resources/css/screen.css';
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
    include 'view/kopf.php';
    ?>
</div>

<div id="inhalt_links">
    <?PHP
    if ($loggedIn) {
        include 'view/navigation.php';
    }
    ?>
</div>


<div id="inhalt_mitte">
    <?PHP

    if ($loggedIn) {
        if (isset($_GET['inhalt_mitte'])) {
            global $whitelist;
            $inhalt_mitte = htmlspecialchars($_GET['inhalt_mitte']);
            if(in_array($inhalt_mitte, $whitelist, TRUE)){
                include $inhalt_mitte;
            } else{
                include 'view/home.html';
                $_GET['error'] = 10;
            }
        } else {
            include 'view/home.html';
        }
    } else {
        if (isset($_GET['inhalt_mitte']) && 'registration_form.php' === $_GET['inhalt_mitte']) {
            include 'view/registration_form.php';
        } else {
            include 'view/login_form.php';
        }
    }
    if(isset($_GET['error'])){
        $error_dao = new ErrorDao();
        $error = htmlspecialchars($_GET['error']);
        $error_msg = $error_dao->getErrorNameById($error);
        echo '<p id="error">Error: '.$error_msg.'</p>';
    }
    ?>
</div>

</body>
</html>