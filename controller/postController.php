<?php
require_once "../model/connection.php";
$title = $_REQUEST['title'];
$path = 'public/'.$_FILES['img']['name'];

if (move_uploaded_file($_FILES['img']['tmp_name'],'../'.$path)) {
    /* Poner el id de forma correcta y no en hardcode mode */

    $query = "INSERT INTO `posts`(`title`, `path`, `user`) VALUES (?,?,'1')";
    $setencia = $pdo->prepare($query);
        $setencia->bindParam(1, $title);
        $setencia->bindParam(2, $path);
    $setencia->execute();
    
    header("Location: ../view/home.html");
}

header("Location: ../view/home.html");