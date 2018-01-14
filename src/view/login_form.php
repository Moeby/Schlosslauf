<form action="controller/login.php" method="post">
			Username: <input type="text" name="username" /><br />
			Passwort: <input type="password" name="password" /><br />
		<input type="submit" value="Anmelden" />
</form>
<a href="index.php?inhalt_mitte=registration_form.php">Keinen Account? Registriere dich jetzt!</a>
<?php
    require_once('C:/xampp/htdocs/Schlosslauf/src/database/Dao/CountryDao.php');
    require_once('C:/xampp/htdocs/Schlosslauf/src/database/Dataclasses/Country.php');
    $country_dao = new CountryDao();
    $country_list = $country_dao->getAllcountries();
    if($country_list === 1){
        echo "DB Connection failed.";
    } else {
        foreach ($country_list as $country) {
            echo "Country: " . $country->getCountry;
        }
    }