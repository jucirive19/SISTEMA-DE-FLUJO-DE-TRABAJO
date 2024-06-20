<?php
try {
    session_start();
    require_once "../../Clases/roles.php";// Incluye el archivo que contiene la clase Roles
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["idrol"]) && isset($_POST["nuevoNombreRol"])) {
            $idrol = $_POST["idrol"];
            $nuevoNombreRol = $_POST["nuevoNombreRol"];
    
            $roles = new roles();
            $respuesta = $roles->actualizarrol($idrol, $nuevoNombreRol);
    
            echo $respuesta;
        } else {
            echo "Parámetros no recibidos correctamente.";
        }
    } else {
        echo "Acceso denegado.";
    }
} catch (\Throwable $th) {
    echo $th;
}
?>