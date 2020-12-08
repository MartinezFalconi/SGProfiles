<?php
require_once '../model/user.php';
require_once '../model/userDAO.php';

if (isset($_POST['email'])) {
    $user = new user($_POST['email'], md5($_POST['pass']));
    $userDAO = new userDAO();
    if($userDAO->login($user) && ($_SESSION['user']->getProfile() == 3)){
        header('Location:../view/homeAdmin.php');
    }else if($userDAO->login($user) && ($_SESSION['user']->getStatus() == 1)) {
        header('Location:../view/home.php');
    }else{
        header('Location:../view/login.php');
    }
}else {
    header('Location:../view/login.php');
}

?>