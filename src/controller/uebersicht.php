<?php
require_once 'sessionCheck.php';
if (file_exists('../database/Dao/UserDao.php')) {
    require_once '../database/Dao/UserDao.php';
    require_once '../database/Dao/CountryDao.php';
    require_once '../database/Dataclasses/Country.php';
} else {
    require_once 'database/Dao/UserDao.php';
    require_once 'database/Dao/CountryDao.php';
    require_once 'database/Dataclasses/Country.php';
}

$loggedInUsername = $_SESSION['loggedInUser'];
$userDao = new UserDao();
$loggedInUser = $userDao->getUserByName($loggedInUsername);

// Check that user that tries to access the site is actually an admin
if ($loggedInUser->getAdminCode()) {
    echo '<h2>Anmeldungsübersicht</h2>' .
        '  <table style="width:100%" >
        <tr>
            <th align="left">Username</th>
            <th align="left">Name</th>
            <th align="left">Vorname</th>
            <th align="left">Email</th>
            <th align="left">Strasse</th>
            <th align="left">Ort</th>
            <th align="left">Postleitzahl</th>
            <th align="left">Land</th>
            <th align="left">Sprache</th>
            <th align="left">Gruppe</th>
        </tr>';
    $users = $userDao->getAllUsers();

    //add information for all signed up users for the race
    foreach ($users as $user) {
        if (!$user->getAdminCode() && null !== $user->getGroup()) {
            $username = $user->getUsername();
            $name = $user->getName();
            $firstname = $user->getFirstName();
            $email = $user->getEmail();
            $street = $user->getStreet();
            $location = $user->getLocation();
            $areaCode = $user->getAreaCode();
            $country = $user->getCountry()->getCountry();
            $language = $user->getLanguage()->getLanguage();
            $group = $user->getGroup()->getGroup();

            echo "<tr>
                    <td>$username</td>
                    <td>$name</td>
                    <td>$firstname</td>
                    <td>$email</td>
                    <td>$street</td>
                    <td>$location</td>
                    <td>$areaCode</td>
                    <td>$country</td>
                    <td>$language</td>
                    <td>$group</td>
                </tr>";
        }
    }
    echo '</table>';
} else {
    echo '<h1>Keine Berechtigung für diese Seite</h1>';
}