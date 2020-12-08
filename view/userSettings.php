<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet">
    <script src="../js/code.js"></script>
    <script src="https://kit.fontawesome.com/2c5b66e935.js" crossorigin="anonymous"></script>
    <title>Configuracion de usuarios</title>
</head>

<body>
<!-- Control de sesion iniciada -->
<?php
    require_once '../controller/sessionController.php';
    if ($_SESSION['user']->getProfile() != 3) {
        header('Location: ./home.php');
    }
?>
    <!-- The Navbar -->
    <ul>
        <li><a href="./userSettings.php"><i class="fas fa-users-cog"></i></i></a></li>
        <?php
        require_once '../controller/sessionController.php';
        echo "<li><a href='./homeAdmin.php'><i class='fas fa-house-user'></i> ".$_SESSION['user']->getName()."</a></li>";
        ?>
        <li><a href="../controller/logoutController.php"><i class="fas fa-sign-out-alt"></i></a></li>
    </ul>
    <?php
    require_once '../model/userDAO.php';
    $userDAO = new userDAO();
    echo "<table class='container'>";
    echo "<thead>";
		echo "<tr>";
			echo "<th><h1>Nº user</h1></th>";
			echo "<th><h1>Nombre</h1></th>";
			echo "<th><h1>Email</h1></th>";
            echo "<th><h1>Contraseña</h1></th>";
            echo "<th><h1>Status</h1></th>";
            echo "<th><h1>Perfil</h1></th>";
            echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
    $userDAO->viewUsers();
        echo "</tbody>";
    echo "</table>";
    ?>
</body>

</html>