<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Registro | Social Gallery</title>
    <link rel="stylesheet" href="../css/styleRegister.css">
    <script src="../js/code.js"></script>
</head>
<body>

<div class="wrapper">
    <form action="./newAccount.php" method="POST" onsubmit="return validacionCreate()">
    <div class="title">
        Rellene el formulario para registrarse.
    </div>
    <div class="form">
        <div class="inputfield">
            <label>Nombre: </label>
            <input type="text" class="input" name="name" id="name">
        </div>  
        <div class="inputfield">
            <label>Apellido: </label>
            <input type="text" class="input" name="lastname" id="lastname">
        </div>  
        <div class="inputfield">
            <label>Contraseña: </label>
            <input type="password" class="input" name="pass" id="pass">
        </div>  
        <div class="inputfield">
            <label>Confirmar contraseña: </label>
            <input type="password" class="input" name="passConfirm" id="passConfirm" onfocusout="validacionPassword()">
        </div> 
        <div id="mensajePassIncorrect" class="mensajePassIncorrect"></div>
        <div class="inputfield">
            <label>Correo electrónico: </label>
            <input type="text" class="input" name="email" id="email">
        </div>
        <div class="inputfield terms">
            <label class="check">
                <input type="checkbox">
                <span class="checkmark"></span>
            </label><br>
            <p>Acepto los terminos y condiciones.</p>
        </div> 
        <div class="inputfield">
            <input type="submit" value="Registrarme" class="btn">
        </div>
        <div id="mensajeEmpty" class="mensajeEmpty"></div>
    </div>
    </form>
</div>	

<?php
    if (isset($_REQUEST['name'])) {
        require_once '../model/user.php';
        require_once '../model/userDAO.php';
        $user = new user($_REQUEST['email'], $_REQUEST['pass']);
        $user->setName($_REQUEST['name']);
        $userDAO = new userDAO;
        $userDAO->create($user);
    }
?>
</body>
</html>