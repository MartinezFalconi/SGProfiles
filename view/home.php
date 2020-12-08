<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet">
    <script src="../js/code.js"></script>
    <title>Home | Social Gallery</title>
</head>

<body>
<!-- Control de sesion iniciada -->
<?php
    require_once '../controller/sessionController.php';
?>
    <!-- The Navbar -->
    <ul>
        <?php
        require_once '../controller/sessionController.php';
        echo "<li><a href='./home.php'>".$_SESSION['user']->getName()."</a></li>";
        ?>
        <li><a href="#" onclick="openModal()">+</a></li>
        <li><a href="../controller/logoutController.php">Cerrar sesion</a></li>
    </ul>

    <!--Galería-->

    <div class="row padding-20"></div>
        <?php
        require_once '../model/postDAO.php';
        $postDAO = new postDAO();
        $postDAO->viewImages();
        ?>
    <div class="row padding-lat">

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Crear post</h2>
            </div>
            <div class="modal-body">
                <div>
                    <form action="../controller/postController.php" method="POST" enctype="multipart/form-data">
                        <input type="text" id="title" name="title" placeholder="Título de la foto...">
                        <input type="file" id="img" name="img" accept="image/gif, image/jpeg, image/jpg, image/png">
                        <p>Solamente se aceptan imagenes en formato: png, jpg, jpeg, gif.</p>
                        <input type="submit" value="Subir">
                    </form>
                </div>
            </div>
        </div>
    </div>
   
</body>

</html>