<?php
require_once '../model/user.php';
if (isset($_REQUEST['title'])) {
    require_once '../model/post.php';
    require_once '../model/postDAO.php';
    $path = 'public/'.($_FILES['img']['name']+rand(0,1000000000));
    $post = new post($_REQUEST['title'], $path);
    $postDAO = new postDAO;
    $postDAO->createPost($post);
    if ($_SESSION['user']->getProfile() == 3) {
        header('Location:../view/homeAdmin.php');
    }else{
        header('Location:../view/home.php');
    }
}else{
    header('Location:../view/home.php');
}
?>