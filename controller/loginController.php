<?php
require_once '../model/user.php';
require_once '../model/userDAO.php';

if (isset($_POST['email'])) {
    $user = new user($_POST['email'], md5($_POST['pass']));
    $userDAO = new userDAO();
    if($userDAO->login($user)){
        header('Location:../view/home.php');
    }else {
        header('Location:../view/login.php');
    }
}else {
    header('Location:../view/login.php');
}

?>