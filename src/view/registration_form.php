<form action="controller/registration.php" method="post">
    <h1>Registration</h1>
    <table>
        <tr>
            <td>Username:</td>
            <td><input type="text" name="username"/></td>
        </tr>
        <tr>
            <td>Passwort:</td>
            <td><input id="password" name="password" type="password" pattern="^\S{6,}$"
                       onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must have at least 6 characters' : ''); if(this.checkValidity()) form.password_two.pattern = this.value;"
                       required></td>
        </tr>
        <tr>
            <td>Passwort bestätigen:</td>
            <td><input id="password_two" name="password_two" type="password" pattern="^\S{6,}$"
                       onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter the same Password as above' : '');"
                       required></td>
        </tr>
        <tr>
            <td>Name:</td>
            <td><input type="text" name="Name" required></td>
        </tr>
        <tr>
            <td>Vorname:</td>
            <td><input type="text" name="Vorname" required></td>
        </tr>
        <tr>
            <td>Strasse:</td>
            <td><input type="text" name="Strasse" required></td>
        </tr>
        <tr>
            <td>Ort:</td>
            <td><input type="text" name="Ort" required></td>
        </tr>
        <tr>
            <td>PLZ:</td>
            <td><input type="text" name="PLZ" required></td>
        </tr>
        <tr>
            <td>E-Mail:</td>
            <td><input type="email" name="Mail" required></td>
        </tr>
        <tr>
            <td>Land:</td>
            <td><select name="Land" required>
                    <?php
                        /*if(file_exists('../database/Dao/CountryDao.php')){*/
                            require_once ('C:/xampp/htdocs/Schlosslauf/src/database/Dao/CountryDao.php');
                            require_once ('C:/xampp/htdocs/Schlosslauf/src/database/Dataclasses/Country.php');
                        /*} else{
                            require_once ('database/Dao/CountryDao.php');
                            require_once ('database/Dataclasses/Country.php');
                        }*/
                    $country_dao = new CountryDao();
                        $country_list = $country_dao->getAllCountries();
                        foreach ($country_list as $country){
                            echo('<option value"'.$country->getCountry().'">'.$country->getCountry().'</option>');
                        }
                    ?>
                    <!-- <option value="schweiz">Schweiz</option>
                    <option value="deutschland">Deutschland</option>
                    <option value="italien">Italien</option>
                    <option value="frankreich">Frankreich</option> -->
                </select></td>
        </tr>
        <tr>
            <td>Sprache:</td>
            <td>
                <?php
                if(file_exists('../database/Dao/LanguageDao.php')){
                    require_once ('../database/Dao/LanguageDao.php');
                    require_once ('../database/Dataclasses/Language.php');
                } else{
                    require_once ('database/Dao/LanguageDao.php');
                    require_once ('database/Dataclasses/Language.php');
                }
                $language_dao = new LanguageDao();
                $language_list = $language_dao->getAllLanguages();
                foreach ($language_list as $language){
                    echo('<input type="radio" name="sprache" value="'.$language->getLanguage().'">'.$language->getLanguage());
                }
                ?>
                <!-- <input type="radio" name="sprache" value="Deutsch"> Deutsch
                <input type="radio" name="sprache" value="Franzoesisch"> Franzoesisch
                <input type="radio" name="sprache" value="Italienisch"> Italienisch
                <input type="radio" name="sprache" value="Englisch"> Englisch -->
            </td>
        </tr>
    </table>

    <input type="submit" value="Anmelden"/>
</form>
<a href="index.php?inhalt_mitte=login_form.php">Account bereits vorhanden? Log dich ein!</a>