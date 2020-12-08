<?php
class postDAO {
    // ATRIBUTOS
    private $pdo;

    // CONSTRUCTOR
    public function __construct() {
        include_once '../services/connection.php';
        $this->pdo=$pdo;
    }

    public function createPost($post) {
        require_once '../controller/sessionController.php';
        try {
            if (move_uploaded_file($_FILES['img']['tmp_name'],'../'.$post->getPath())) {
                $this->pdo->beginTransaction();
                $query = "INSERT INTO `posts`(`title`, `path`, `user`) VALUES (?,?,?)";
                $sentencia=$this->pdo->prepare($query);
                    $sentencia->bindValue(1,$post->getTitle());
                    $sentencia->bindValue(2,$post->getPath());
                    $sentencia->bindValue(3,$_SESSION['user']->getId());
                $sentencia->execute();
                $this->pdo->commit();
                echo "La imagen ha sido publicada.";
            }
        } catch (Exception $e) {
            $this->pdo->rollBack();
            echo $e;
            echo "La imagen no ha sido publicada.";
        }
    }

    public function viewImages() {
        require_once '../controller/sessionController.php';
        try {
            $this->pdo->beginTransaction();
            $query = "SELECT * FROM `posts` WHERE user = ?";
            $sentencia=$this->pdo->prepare($query);
                $sentencia->bindValue(1,$_SESSION['user']->getId());
            $sentencia->execute();
            $images = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            echo '<div class="grid-container">';
            foreach ($images as $image) {
                $id = $image['id'];
                $title = $image['title'];
                $path = $image['path'];  
                echo "<div>";
                echo "<img src='../$path'><span class='spanFoto'>MINE</span>";
                echo "<h4>$title</h4>";
                echo "</div>";
            }
            echo '</div>';

            $query = "SELECT * FROM users INNER JOIN posts ON users.id = posts.user WHERE users.id <> ?";
            $sentencia=$this->pdo->prepare($query);
                $sentencia->bindValue(1,$_SESSION['user']->getId());
            $sentencia->execute();
            $images = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            echo '<div class="xgrid-container">';
            foreach ($images as $image) {
                $id = $image['id'];
                $title = $image['title'];
                $path = $image['path'];
                $user = $image['name'];  
                echo "<div>";
                echo "<img src='../$path'><span class='spanFoto'>$user</span>";
                echo "<h4>$title</h4>";
                echo "</div>";
            }
            echo '</div>';

            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollBack();
            echo $e;
        }
    }
}