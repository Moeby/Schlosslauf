<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once('../database/Dao/UserDao.php');

$userDao = new UserDao();
$languageDao = new LanguageDao();
$countryDao = new CountryDao();

if (isset($_POST['username'])) {
    //Strip html
    $username = htmlspecialchars($_POST['username']);
    $userAlreadyExisting = $userDao->getUserByName($username);

    //check username not taken
    if (null === $userAlreadyExisting) {
        //check if any of the required fields are empty
        if (!isset($_POST['username']) || !isset($_POST['password']) || !isset($_POST['Name']) || !isset($_POST['Vorname'])
            || !isset($_POST['Strasse']) || !isset($_POST['PLZ']) || !isset($_POST['Mail'])
            || !isset($_POST['Land']) || !isset($_POST['sprache']) || !isset($_POST['Ort'])) {
            echo "Fehlende Informationen.";
        } else {
            //TODO: check email format
            $password = htmlspecialchars($_POST['password']);
            $name = htmlspecialchars($_POST['Name']);
            $firstName = htmlspecialchars($_POST['Vorname']);
            $street = htmlspecialchars($_POST['Strasse']);
            $cityCode = htmlspecialchars($_POST['PLZ']);
            $location = htmlspecialchars($_POST['Ort']);
            $mail = htmlspecialchars($_POST['Mail']);
            $country = htmlspecialchars($_POST['Land']);
            $language = htmlspecialchars($_POST['sprache']);

            //Generate salt and hash password
            $seed = '';
            for ($i = 0; $i < 16; $i++) {
                $seed .= chr(mt_rand(0, 255));
            }
            $salt = substr(strtr(base64_encode($seed), '+', '.'), 0, 22);

            $options = [
                'salt' => $salt
            ];
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT, $options);

            // Create new user
            $languageObj = $languageDao->getLanguageByName($language);
            $countryObj = $countryDao->getCountryByName($country);
            $user = $userDao->newUser($username, $hashedPassword, $salt, $name, $firstName, $mail, $street, $location, $cityCode, $countryObj, $languageObj);
            if(null !== $user){
                $_SESSION['loggedIn'] = 'true';
                $_SESSION['loggedInUser'] = $username;
                header('Location: /Schlosslauf/src/index.php?');
            } else {
                echo "Registrierung fehlgeschlagen.";
                //TODO: check what is necessary
                if(file_exists('index.php')){
                    header('index.php');
                } else{
                    header('../index.php');
                }
            }
        }
    } else {
        echo "Benutzername bereits in Verwendung.";
    }
}