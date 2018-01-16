<form action="controller/registration.php" method="post">
    <h2>Registration</h2>
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
                        if(file_exists('../database/Dao/CountryDao.php')){
                            require_once '../database/Dao/CountryDao.php';
                            require_once '../database/Dataclasses/Country.php';
                        } else{
                            require_once 'database/Dao/CountryDao.php';
                            require_once 'database/Dataclasses/Country.php';
                        }
                        $country_dao = new CountryDao();
                        $country_list = $country_dao->getAllCountries();
                        if(1 === $country_list){
                            echo 'Database connection problem.';
                        } else {
                            if(null !== $country_list) {
                                foreach ($country_list as $country) {
                                    echo('<option value="'.$country->getCountry().'">'.$country->getCountry().'</option>');
                                }
                            } else{
                                echo 'Problem Country.';
                            }
                        }
                    ?>
                </select></td>
        </tr>
        <tr>
            <td>Sprache:</td>
            <td><select name="sprache" required>
                <?php
                if(file_exists('../database/Dao/LanguageDao.php')){
                    require_once '../database/Dao/LanguageDao.php';
                    require_once '../database/Dataclasses/Language.php';
                } else{
                    require_once 'database/Dao/LanguageDao.php';
                    require_once 'database/Dataclasses/Language.php';
                }
                $language_dao = new LanguageDao();
                $language_list = $language_dao->getAllLanguages();
                if(1 === $language_list){
                    echo 'Database connection problem.';
                }else {
                    if(null !== $language_list) {
                        foreach ($language_list as $language) {
                            echo('<option value="'.$language->getLanguage().'">'.$language->getLanguage().'</option>');
                        }
                    } else{
                        echo 'Problem Language';
                    }
                }
                ?>
                </select></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="reset" value="Abbrechen">&nbsp;<input type="submit" value="Anmelden"/></td>
        </tr>
    </table>
</form>
<a href="index.php?inhalt_mitte=login_form.php">Account bereits vorhanden? Log dich ein!</a>