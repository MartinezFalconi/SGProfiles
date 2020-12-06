window.onload = function() {
    modal = document.getElementById('myModal');
}

// Clicar en cualquier parte fuera del model para cerrar
window.onclick = function(event) {

    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Abrir modal 
function openModal() {
    modal.style.display = "block";
}

// Cerrar modal
function closeModal() {
    modal.style.display = "none";
}

// Validacion de que los campos de login estan comletos/rellenados
function validacionLogin() {
    var email = document.getElementById('email').value;
    var pass = document.getElementById('pass').value;

    if (email == "" && pass == "") {
        document.getElementById("mensajeLogin").innerHTML = "Los campos de correo y contraseña estan vacios.";
    } else if (email == "") {
        document.getElementById("mensajeLogin").innerHTML = "El campo de correo no puede estar vacio.";
    } else if (pass == "") {
        document.getElementById("mensajeLogin").innerHTML = "El campo de contraseña no puede estar vacio.";
    } else {
        return true;
    }
    document.getElementById("mensajeLogin").style.display = 'inline-block';
    return false;
}

//Validacion de que la contraseña es la misma en los dos inputs
function validacionPassword() {
    var pass1 = document.getElementById('pass').value;
    var pass2 = document.getElementById('passConfirm').value;

    if (pass1 == pass2) {
        document.getElementById("mensajePassIncorrect").style.display = 'none';
        return true;
    } else {
        document.getElementById("mensajePassIncorrect").innerHTML = "Las contraseñas no coinciden.";
        document.getElementById("mensajePassIncorrect").style.display = 'inline-block';
        return false;
    }

}

function validacionCreate() {
    var name = document.getElementById('name').value;
    var lastname = document.getElementById('lastname').value;
    var pass = document.getElementById('pass').value;
    var passConfirm = document.getElementById('passConfirm').value;
    var email = document.getElementById('email').value;

    if ((name || lastname || pass || passConfirm || email) == "") {
        document.getElementById("mensajeEmpty").innerHTML = "Algún campo del formulario esta vacio.";
        document.getElementById("mensajeEmpty").style.display = 'inline-block';
        return false;
    } else {
        document.getElementById("mensajeEmpty").style.display = 'none';
        return true;
    }
}