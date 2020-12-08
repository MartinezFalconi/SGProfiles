<?php
if (isset($_REQUEST['title'])) {
    require_once '../model/post.php';
    require_once '../model/postDAO.php';
    $path = 'public/'.$_FILES['img']['name'];
    $post = new post($_REQUEST['title'], $path);
    $postDAO = new postDAO;
    $postDAO->createPost($post);
    header('Location:../view/home.php');
}else{
    header('Location:../view/home.php');
}
?>