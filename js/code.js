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