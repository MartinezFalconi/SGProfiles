<?php
if (isset($_REQUEST['id'])) {
    require_once '../model/user.php';
    require_once '../model/userDAO.php';
    $emailNeed = 's@x.com';
    $passNeed = '1234';
    $user1 = new user($emailNeed, $passNeed);
    $user1->setId($_REQUEST['id']);
    $userDAO = new userDAO;
    $userDAO->deleteUser($user1);
    header('Location: ../view/userSettings.php');
}