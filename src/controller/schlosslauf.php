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
    if(!file_exists('sessionCheck.php')) {
        require_once '../sessionCheck.php';
        if(!$loggedIn) {
            header('Location: ../index.php?10');
            die();
        }
    } else{
        require_once 'sessionCheck.php';
    }

    if(isset($_POST['Gruppe'])){
        $group_dao = new GroupDao();
        $group_name = htmlspecialchars($_POST['Gruppe']);
        $group = $group_dao->getGroupByName($group_name);
        if(null !== $group){
            $user_dao = new UserDao();
            $user = $user_dao->getUserByName($_SESSION['loggedInUser']);
            if(null !== $user){
                $result = $user_dao->setGroup($group, $user);
                if(null === $result){
                    if(file_exists('../index.php')){
                        header('Location: ../index.php?inhalt_mitte=view\\schlosslauf_form.php&error=6');
                    } else {
                        header('Location: index.php?inhalt_mitte=view\\schlosslauf_form.php&error=6');
                    }
                } elseif(0 === $result) {
                    if(file_exists('../index.php')){
                        header('Location: ../index.php?inhalt_mitte=view\\schlosslauf_form.php&error=12');
                    } else {
                        header('Location: index.php?inhalt_mitte=view\\schlosslauf_form.php&error=12');
                    }
                } else{
                    if(file_exists('../index.php')){
                        header('Location: ../index.php?inhalt_mitte=view\\schlosslauf_form.php');
                    } else {
                        header('Location: index.php?inhalt_mitte=view\\schlosslauf_form.php');
                    }
                }
            } else{
                if(file_exists('../index.php')){
                    header('Location: ../index.php?inhalt_mitte=view\\schlosslauf_form.php&error=7');
                } else {
                    header('Location: index.php?inhalt_mitte=view\\schlosslauf_form.php&error=7');
                }
            }
        } else {
            if(file_exists('../index.php')){
                header('Location: ../index.php?inhalt_mitte=view\\schlosslauf_form.php&error=8');
            } else {
                header('Location: index.php?inhalt_mitte=view\\schlosslauf_form.php&error=8');
            }
        }
    } else {
        if(file_exists('../index.php')){
            header('Location: ../index.php?inhalt_mitte=view\\schlosslauf_form.php&error=9');
        } else {
            header('Location: index.php?inhalt_mitte=view\\schlosslauf_form.php&error=9');
        }
    }



