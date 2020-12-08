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
                echo "Esta en la base de datos";
            }else{
                $query = "INSERT INTO `users`(`name`, `email`, `password`, `status`, `profile`) VALUES (?, ?, md5(?), 1,1)";
                $sentencia=$this->pdo->prepare($query);
                    $sentencia->bindValue(1,$user->getName());
                    $sentencia->bindValue(2,$user->getEmail());
                    $sentencia->bindValue(3,$user->getPassword());
                $sentencia->execute();
                echo "Has sido inscrito";
            }
            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollBack();
            echo $e;
            echo "No has sido inscrito";
        }
        
    }
}