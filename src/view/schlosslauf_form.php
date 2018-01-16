<?php
if(!file_exists('sessionCheck.php')) {
    require_once("../sessionCheck.php");
    if(!$loggedIn) {
        require_once("../index.php");
        die();
    }
}
//TODO: check which fields are no longer used
?>

<br>
<title>Anmeldung Schlosslauf</title>
<script type="text/javascript">
    function chkFormular() {

        var format = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if ("" === document.Formular.Name.value) {
            alert("Bitte Ihren Namen eingeben!");
            document.Formular.Name.focus();
            return false;
        }
        if ("" === document.Formular.Vorname.value) {
            alert("Bitte Ihren Vornamen eingeben!");
            document.Formular.Vorname.focus();
            return false;
        }
        if ("" === document.Formular.Strasse.value) {
            alert("Bitte Ihre Strasse eingeben!");
            document.Formular.Strasse.focus();
            return false;
        }
        if ("" === document.Formular.Ort.value) {
            alert("Bitte Ihren Wohnort eingeben!");
            document.Formular.Ort.focus();
            return false;
        }
        if ("" === document.Formular.PLZ.value) {
            alert("Bitte Ihre PLZ eingeben!");
            document.Formular.PLZ.focus();
            return false;
        }
        if ("" === document.Formular.Mail.value) {
            alert("Bitte Ihre E-Mail-Adresse eingeben!");
            document.Formular.Mail.focus();
            return false;
        }


        if (!document.Formular.Mail.value.match(format)) {
            alert("Keine E-Mail-Adresse!");
            document.Formular.Mail.focus();
            return false;
        }
        var chkZ = 1;
        for (i = 0; i < document.Formular.PLZ.value.length; ++i)
            if (document.Formular.PLZ.value.charAt(i) < "0" ||
                document.Formular.PLZ.value.charAt(i) > "9")
                chkZ = -1;
        if (-1 === chkZ) {
            alert("PLZ keine Zahl!");
            document.Formular.PLZ.focus();
            return false;
        }
        if (!document.Formular.Deutsch.checked && !document.Formular.Franzoesisch.checked && !document.Formular.Italienisch.checked && !document.Formular.Englisch.checked) {
            alert("Bitte Sprache waehlen!");
            document.Formular.Deutsch.focus();
            return false;
        }
    }
</script>
</head>
<body>

<h2>Anmeldung Schlosslauf</h2>

<form name="Formular" action="../controller/save.php"
      method="post" onsubmit="return chkFormular()">
    <p>
        Wählen Sie hier die Länge der Strecke, die Sie gerne laufen würden </br> und melden Sie Sich direkt zum Schlosslauf an.
    </p>
    <table>
        <tr>
            <td>Gruppe:</td>
            <td><select name="Gruppe">
                <?php
                if(file_exists('../database/Dao/GroupDao.php')){
                    require_once('../database/Dao/GroupDao.php');
                    require_once('../database/Dataclasses/Group.php');
                } else{
                    require_once ('database/Dao/GroupDao.php');
                    require_once ('database/Dataclasses/Group.php');
                }
                $group_dao = new GroupDao();
                $group_list = $group_dao->getAllGroups();
                if($group_list === 1){
                    echo 'Database connection problem.';
                } else{
                    if($group_list !== null) {
                        foreach ($group_list as $group) {
                            echo('<option value="'.$group->getGroup().'">'.$group->getGroup().'</option>');
                        }
                    } else{
                        echo 'Problem Language';
                    }
                }
                ?>
            </select></td>
        </tr>
        <tr>
            <td><input type="submit" value="Absenden"></td>
            <td><input type="reset" value="Abbrechen"></td>
        </tr>
    </table>
</form>