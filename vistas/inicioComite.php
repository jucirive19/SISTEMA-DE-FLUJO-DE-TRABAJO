<?php
session_start();
// Incluye el archivo que contiene la función login
// Verifica si la variable de sesión está definida
if (isset($_SESSION['usuario'])) {
    include "headerComite.php";
?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <!-- Contenido de la página de inicio -->
            </div>
        </div>
    </div>
<?php 
    include "footer.php";
} else {
    header("location:../registar.php");
    // Redirige al usuario a la página de inicio de sesión si la variable de sesión no está definida
    exit();
}
?>