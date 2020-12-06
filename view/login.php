<html>

<head>
    <title>Iniciar sesion | Social Gallery</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="../js/code.js"></script>
    <script src="https://kit.fontawesome.com/2c5b66e935.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="login-box">
        <form action="../controller/loginController.php" method="POST" onsubmit="return validacionLogin()">
            <h1>Inciar sesion</h1>

            <div class="textbox">
                <i class="fas fa-user"></i>
                <input type="email" name="email" id="email" placeholder="Email...">
            </div>

            <div class="textbox">
                <i class="fas fa-lock"></i>
                <input type="password" name="pass" id="pass" placeholder="Contraseña...">
            </div>

            <input type="submit" class="btn" value="Iniciar sesión">
        </form>
        <div id="mensajeLogin" class="mensajeLogin"></div>
        <p>Si todavia no tienes una cuenta, estas a un clic de crear una. <a href = "./newAccount.php">Crear una nueva cuenta.</a></p>
    </div>

</body>

</html>