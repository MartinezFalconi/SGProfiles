<?php
    if (isset($_REQUEST['name'])) {
        require_once '../model/user.php';
        require_once '../model/userDAO.php';
        $user = new user($_REQUEST['email'], $_REQUEST['pass']);
        $user->setName($_REQUEST['name']);
        $userDAO = new userDAO;
        $userDAO->create($user);
        header('Location:../view/login.php');
    }else{
        header('Location:../newAccount.php');
        return false;
    }
?>