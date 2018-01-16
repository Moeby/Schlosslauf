<?php
    if(file_exists('sessionCheck.php')){
        require_once ('sessionCheck.php');
        require_once ('database/Dataclasses/User.php');
        require_once ('database/Dao/GroupDao.php');
        require_once ('database/Dao/UserDao.php');
    } else {
        require_once('../sessionCheck.php');
        require_once ('../database/Dataclasses/User.php');
        require_once ('../database/Dao/GroupDao.php');
        require_once ('../database/Dao/UserDao.php');
    }

    if(isset($_POST['Gruppe'])){
        $group_dao = new GroupDao();
        $group_name = htmlspecialchars($_POST['Gruppe']);
        $group = $group_dao->getGroupByName($group_name);
        if($group !== null){
            $user_dao = new UserDao();
            $user = $user_dao->getUserByName($_SESSION['loggedInUser']);
            if($user !== null){
                if($user_dao->setGroup($group, $user) === null){
                    echo('Group could not be set.');
                    if(file_exists('../index.php')){
                        header('Location: ../index.php?inhalt_mitte=view/schlosslauf_form.php');
                    } else {
                        header('Location: index.php?inhalt_mitte=view/schlosslauf_form.php');
                    }
                }else{
                    if(file_exists('../index.php')){
                        header('Location: ../index.php?inhalt_mitte=view/schlosslauf_form.php');
                    } else {
                        header('Location: index.php?inhalt_mitte=view/schlosslauf_form.php');
                    }
                }
            } else{
                echo('User not found.');
                if(file_exists('../index.php')){
                    header('Location: ../index.php?inhalt_mitte=view/schlosslauf_form.php');
                } else {
                    header('Location: index.php?inhalt_mitte=view/schlosslauf_form.php');
                }
            }
        } else {
            echo('Chosen group is not valid.');
            if(file_exists('../index.php')){
                header('Location: ../index.php?inhalt_mitte=view/schlosslauf_form.php');
            } else {
                header('Location: index.php?inhalt_mitte=view/schlosslauf_form.php');
            }
        }
    } else {
        echo('Keine Gruppe ausgewählt');
        if(file_exists('../index.php')){
            header('Location: ../index.php?inhalt_mitte=view/schlosslauf_form.php');
        } else {
            header('Location: index.php?inhalt_mitte=view/schlosslauf_form.php');
        }
    }



