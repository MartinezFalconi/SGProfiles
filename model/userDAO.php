<?php
class userDAO {
    // ATRIBUTOS
    private $pdo;

    // CONSTRUCTOR
    public function __construct() {
        include_once '../services/connection.php';
        $this->pdo=$pdo;
    }

    public function login($user) {
        $query = "SELECT * FROM `users` WHERE `email` = ? AND `password` = ?";
        $sentencia=$this->pdo->prepare($query);
        $email = $user->getEmail();
        $pass = $user->getPassword();
            $sentencia->bindParam(1,$email);
            $sentencia->bindParam(2,$pass);
        $sentencia->execute();
        $result = $sentencia->fetch(PDO::FETCH_ASSOC);
        $numRow = $sentencia->rowCount();
        if(!empty($numRow) && $numRow==1){
            $user->setId($result['id']);
            $user->setName($result['name']);
            $user->setProfile($result['profile']);
            session_start();
            $_SESSION['user'] = $user;
            return true;
        } else {
            return false;
        }
    }

    public function create($user) {
        try {
            $this->pdo->beginTransaction();
            $query = "SELECT * FROM `users` WHERE `email` = ?";
            $sentencia=$this->pdo->prepare($query);
                $sentencia->bindValue(1,$user->getEmail());
            $sentencia->execute();
            $result = $sentencia->fetch(PDO::FETCH_ASSOC);
            $numRow = $sentencia->rowCount();
            if(!empty($numRow) && $numRow==1){
                //alert("Esta en la base de datos");
            }else{
                $query = "INSERT INTO `users`(`name`, `email`, `password`, `status`, `profile`) VALUES (?, ?, md5(?), 1,1)";
                $sentencia=$this->pdo->prepare($query);
                    $sentencia->bindValue(1,$user->getName());
                    $sentencia->bindValue(2,$user->getEmail());
                    $sentencia->bindValue(3,$user->getPassword());
                $sentencia->execute();
                //alert("Has sido inscrito");
            }
            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollBack();
            echo $e;
            //alert("No has sido inscrito");
        }
        
    }

    public function viewUsers(){
        require_once '../controller/sessionController.php';
        try {
            $this->pdo->beginTransaction();
            $query = "SELECT * FROM `users`";
            $sentencia=$this->pdo->prepare($query);
            $sentencia->execute();
            $users = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            foreach ($users as $oneUser) {
                $id = $oneUser['id'];
                echo "<tr>";
                echo "<td>{$oneUser['id']}</td>";
                echo "<td>{$oneUser['name']}</td>";
                echo "<td>{$oneUser['email']}</td>";
                echo "<td>{$oneUser['password']}</td>";
                if ($oneUser['status'] == 1) {
                    echo "<td>Desbloqueado</td>";
                }else{
                    echo "<td>Bloqueado</td>";
                }
                if ($oneUser['profile'] == 3) {
                    echo "<td>Administrador</td>";
                } else if ($oneUser['profile'] == 2) {
                    echo "<td>Moderador</td>";  
                }else{
                    echo "<td>Sin privilegios</td>"; 
                }
                if ($oneUser['id'] != $_SESSION['user']->getId()) {
                    echo "<td><a href='../controller/deleteController.php?id=$id' style='text-decoration:none;color:white;'><i class='fas fa-trash-alt'></a></i></td>";
                    if ($oneUser['status'] == 1) {
                        echo "<td><a href='../controller/disableUser.php?id=$id' style='text-decoration:none;color:white;'><i class='fas fa-user-alt-slash'></i></a></i></td>";
                    } else {
                        echo "<td><a href='../controller/enableUser.php?id=$id' style='text-decoration:none;color:white;'><i class='fas fa-user-check'></i></a></i></td>";
                    }
                }
                echo "</tr>";
            }

            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollBack();
            echo $e;
        }
    }

    public function deleteUser($user1) {
        require_once '../model/user.php';
        try {
            $this->pdo->beginTransaction();
            $query = "DELETE FROM `posts` WHERE `posts`.`user` = ?";
            $sentencia=$this->pdo->prepare($query);
                $sentencia->bindValue(1,$user1->getId());
            $sentencia->execute();
            $query = "DELETE FROM `users` WHERE `users`.`id` = ?";
            $sentencia=$this->pdo->prepare($query);
                $sentencia->bindValue(1,$user1->getId());
            $sentencia->execute();
            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollBack();
            echo $e;
        }
    }

    public function enableUser($user1) {
        require_once '../model/user.php';
        try {
            $this->pdo->beginTransaction();
            $query = "UPDATE `users` SET `status` = '1' WHERE `users`.`id` = ?;";
            $sentencia=$this->pdo->prepare($query);
                $sentencia->bindValue(1,$user1->getId());
            $sentencia->execute();
            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollBack();
            echo $e;
        }
    }

    public function disableUser($user1) {
        require_once '../model/user.php';
        try {
            $this->pdo->beginTransaction();
            $query = "UPDATE `users` SET `status` = '0' WHERE `users`.`id` = ?;";
            $sentencia=$this->pdo->prepare($query);
                $sentencia->bindValue(1,$user1->getId());
            $sentencia->execute();
            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollBack();
            echo $e;
        }
    }
}
