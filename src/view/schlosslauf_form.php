<?php
if(!file_exists('sessionCheck.php')) {
    require_once '../sessionCheck.php';
    if(!$loggedIn) {
        header('Location: ../index.php?10');
        die();
    }
} else{
    require_once 'sessionCheck.php';
}

?>

<h2>Anmeldung Schlosslauf</h2>

<?php
if(file_exists('../controller/schlosslauf.php')){
    echo '<form name="Formular" action="../controller/schlosslauf.php" method="post">';
} else {
    echo '<form name="Formular" action="controller/schlosslauf.php" method="post">';
}
?>

<?php
    if(file_exists('../database/Dao/GroupDao.php')){
        require_once '../database/Dao/GroupDao.php';
        require_once '../database/Dao/UserDao.php';
        require_once '../database/Dataclasses/Group.php';
        require_once '../database/Dataclasses/User.php';
    } else{
        require_once 'database/Dao/GroupDao.php';
        require_once 'database/Dao/UserDao.php';
        require_once 'database/Dataclasses/Group.php';
        require_once 'database/Dataclasses/User.php';
   }

    $user_dao = new UserDao();
    $user = $user_dao->getUserByName($_SESSION['loggedInUser']);
    $group_dao = new GroupDao();
    $group_list = $group_dao->getAllGroups();
    if(null !== $user && 1 !== $group_list  ){
        $user_group = $user->getGroup();
        if(null !== $user_group){
            echo '<p>Sie haben Sich für den Schlosslauf bereits in der Gruppe '.$user_group->getGroup().' angemeldet. </p>
                    <table>
                        <tr>
                            <td>Gruppe ändern:</td>
                            <td><select name="Gruppe">';
            foreach ($group_list as $group) {
                echo '<option value="'.$group->getGroup().'">'.$group->getGroup().'</option>';
            }
            echo    '</select></td>
                  </tr>
                  <tr>
                    <td><input type="submit" value="Absenden"></td>
                    <td><input type="reset" value="Abbrechen"></td>
                  </tr>
                </table>';
        } else{
            echo '  <p>Wählen Sie hier die Länge der Strecke, die Sie gerne laufen würden </br> und melden Sie Sich direkt zum Schlosslauf an.</p>
                    <table>
                        <tr>
                            <td>Gruppe:</td>
                            <td><select name="Gruppe">';
            foreach ($group_list as $group) {
                echo '<option value="'.$group->getGroup().'">'.$group->getGroup().'</option>';
            }
            echo    '</select></td>
                  </tr>
                  <tr>
                    <td><input type="submit" value="Absenden"></td>
                    <td><input type="reset" value="Abbrechen"></td>
                  </tr>
                </table>';
        }

    } else {
        $error_dao = new ErrorDao();
        $error = $error_dao->getErrorNameById(11);
        echo '<h1>Error: '.$error.'</h1>';
    }
?>
</form>
