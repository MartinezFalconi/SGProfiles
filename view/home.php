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
        <li><a href="./home.html">@username</a></li>
        <li><a href="#" onclick="openModal()">+</a></li>
        <li><a href="../controller/logoutController.php">Cerrar sesion</a></li>
    </ul>

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
                    <form action="../model/postDAO.php" method="POST" enctype="multipart/form-data">
                        <input type="text" id="title" name="title" placeholder="Título de la foto...">
                        <input type="file" id="img" name="img">
                        <input type="submit" value="Subir">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="three-column">
            <img src="../public/706053.jpg"></img>
        </div>
    </div>

</body>

</html>